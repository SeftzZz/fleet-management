<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivers extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(["form", "url"]);
        $this->load->library("curl");
        $this->load->helper("slug");
        $this->load->library("upload");
        $this->load->library("session");
        $this->load->library("user_agent");
        $this->load->library("datetime");
        $this->load->library(["form_validation"]);
        $this->load->library("recaptcha");
        $this->load->library("user_agent");
        $this->load->library('pagination');
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Driver_model');
        $this->load->model('Wallet_model');
        $this->load->database();

        // if(!$this->ion_auth->logged_in()) {
        //     redirect('auth/login', 'refresh');
        // }
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        $data = [
            "title" => "Manajemen Supir | Fleet Management",
            "nopage" => 1041,
        ];

        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmSupir','Nama Supir','');
            $this->form_validation->set_rules('tglJoin','Tanggal Bergabung','');
            $this->form_validation->set_rules('statusSupir','Status','');

            $carisupir = $this->input->post('nmSupir');
            $caritanggal = $this->input->post('tglJoin');
            $caristatus = $this->input->post('statusSupir');

            $data['supirs'] = $this->Driver_model->getAllSupirByFilter($carisupir,$caritanggal,$caristatus);
            $data['wallets'] = $this->Wallet_model->getAllWallet();
            
            $this->load->view('headernew', $data);
            $this->load->view('drivers', $data);
            $this->load->view('footernew');
        } else {
            $data['supirs'] = $this->Driver_model->getAllSupir();
            $data['wallets'] = $this->Wallet_model->getAllWallet();

            foreach ($data['wallets'] as $wallet) {
                $data['wallet_transactions'][$wallet->wallet_id] = $this->Wallet_model->getWalletTransactionsAll($wallet->wallet_id);
            }

            $this->load->view('headernew', $data);
            $this->load->view('drivers', $data);
            $this->load->view('footernew');
        }
    }

    public function supiradd()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmSupir','Nama Supir','required');
            $this->form_validation->set_rules('tglLahir','Tanggal Lahir','required');
            $this->form_validation->set_rules('tglJoin','Tanggal Bergabung','required');
            $this->form_validation->set_rules('fotoSupir','Foto Supir','');
            $this->form_validation->set_rules('noHp','Nomer HP','required');
            $this->form_validation->set_rules('noDarurat','No HP Darurat','required');
            $this->form_validation->set_rules('fotoSim','Foto SIM','');
            $this->form_validation->set_rules('noSim','Nomer SIM','required');
            $this->form_validation->set_rules('tglExpSim','Tgl. Ext. SIM','required');
            $this->form_validation->set_rules('fotoKtp','Foto KTP','');
            $this->form_validation->set_rules('alamat','Alamat','required');
            $this->form_validation->set_rules('statusSupir','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Supir | Fleet Management",
                    "nopage" => 1041,
                ];

                $data['supirs'] = $this->Driver_model->getAllSupir();
                
                $this->load->view('headernew', $data);
                $this->load->view('drivers', $data);
                $this->load->view('footernew');
            } else {
                $extensi1 = explode(".", $_FILES['fotoSupir']['name']);
                $extensi2 = explode(".", $_FILES['fotoSim']['name']);
                $extensi3 = explode(".", $_FILES['fotoKtp']['name']);
                $size1 = $_FILES['fotoSupir']['size'];
                $size2 = $_FILES['fotoSim']['size'];
                $size3 = $_FILES['fotoKtp']['size'];

                if($_FILES['fotoSupir']['name'] && $_FILES['fotoSim']['name'] && $_FILES['fotoKtp']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // inser tabel drivers dengan file foto, sim dan ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_sim'           => $unggahSim['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->insert($dataSupir);
                        $driver_id = $this->db->insert_id();

                        $initialBalance = 0;    

                        $dataWallet = array(
                            'driver_id'     => $driver_id,
                            'balance'       => $initialBalance,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert($dataWallet);
                        $wallet_id = $this->db->insert_id();

                        $dataWalletTransaction = array(
                            'wallet_id'         => $wallet_id,
                            'transaction_type'  => 'debit',
                            'description'       => 'Initial balance',
                            'amount'            => $initialBalance,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert_transaction($dataWalletTransaction);

                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSupir']['name'] && $_FILES['fotoSim']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        // insert tabel drivers dengan file foto dan sim
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_sim'           => $unggahSim['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->insert($dataSupir);
                        $driver_id = $this->db->insert_id();

                        $initialBalance = 0;

                        $dataWallet = array(
                            'driver_id'     => $driver_id,
                            'balance'       => $initialBalance,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert($dataWallet);
                        $wallet_id = $this->db->insert_id();

                        $dataWalletTransaction = array(
                            'wallet_id'         => $wallet_id,
                            'transaction_type'  => 'debit',
                            'description'       => 'Initial balance',
                            'amount'            => $initialBalance,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert_transaction($dataWalletTransaction);

                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSim']['name'] && $_FILES['fotoKtp']['name']) {
                    if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // inser tabel drivers dengan file sim dan ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_sim'           => $unggahSim['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->insert($dataSupir);
                        $driver_id = $this->db->insert_id();

                        $initialBalance = 0;

                        $dataWallet = array(
                            'driver_id'     => $driver_id,
                            'balance'       => $initialBalance,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert($dataWallet);
                        $wallet_id = $this->db->insert_id();

                        $dataWalletTransaction = array(
                            'wallet_id'         => $wallet_id,
                            'transaction_type'  => 'debit',
                            'description'       => 'Initial balance',
                            'amount'            => $initialBalance,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert_transaction($dataWalletTransaction);

                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSupir']['name'] && $_FILES['fotoKtp']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // insert tabel drivers dengan file foto dan ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->insert($dataSupir);
                        $driver_id = $this->db->insert_id();

                        $initialBalance = 0;

                        $dataWallet = array(
                            'driver_id'     => $driver_id,
                            'balance'       => $initialBalance,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert($dataWallet);
                        $wallet_id = $this->db->insert_id();

                        $dataWalletTransaction = array(
                            'wallet_id'         => $wallet_id,
                            'transaction_type'  => 'debit',
                            'description'       => 'Initial balance',
                            'amount'            => $initialBalance,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert_transaction($dataWalletTransaction);

                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSupir']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        // insert tabel drivers dengan file foto
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->insert($dataSupir);
                        $driver_id = $this->db->insert_id();

                        $initialBalance = 0;

                        $dataWallet = array(
                            'driver_id'     => $driver_id,
                            'balance'       => $initialBalance,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert($dataWallet);
                        $wallet_id = $this->db->insert_id();

                        $dataWalletTransaction = array(
                            'wallet_id'         => $wallet_id,
                            'transaction_type'  => 'debit',
                            'description'       => 'Initial balance',
                            'amount'            => $initialBalance,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert_transaction($dataWalletTransaction);

                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSim']['name']) {
                    if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        // insert tabel drivers dengan file sim
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_sim'           => $unggahSim['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->insert($dataSupir);
                        $driver_id = $this->db->insert_id();

                        $initialBalance = 0;

                        $dataWallet = array(
                            'driver_id'     => $driver_id,
                            'balance'       => $initialBalance,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert($dataWallet);
                        $wallet_id = $this->db->insert_id();

                        $dataWalletTransaction = array(
                            'wallet_id'         => $wallet_id,
                            'transaction_type'  => 'debit',
                            'description'       => 'Initial balance',
                            'amount'            => $initialBalance,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert_transaction($dataWalletTransaction);

                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoKtp']['name']) {
                    if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // insert tabel drivers dengan file ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->insert($dataSupir);
                        $driver_id = $this->db->insert_id();

                        $initialBalance = 0;

                        $dataWallet = array(
                            'driver_id'     => $driver_id,
                            'balance'       => $initialBalance,
                            'created_at'    => date('Y-m-d H:i:s'),
                            'updated_at'    => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert($dataWallet);
                        $wallet_id = $this->db->insert_id();

                        $dataWalletTransaction = array(
                            'wallet_id'         => $wallet_id,
                            'transaction_type'  => 'debit',
                            'description'       => 'Initial balance',
                            'amount'            => $initialBalance,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Wallet_model->insert_transaction($dataWalletTransaction);

                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else {
                    $dataSupir = array(
                        'name'              => $this->input->post('nmSupir'),
                        'license_number'    => $this->input->post('noSim'),
                        'phone'             => $this->input->post('noHp'),
                        'tgl_join'          => $this->input->post('tglJoin'),
                        'tgl_lahir'         => $this->input->post('tglLahir'),
                        'alamat'            => $this->input->post('alamat'),
                        'nomor_darurat'     => $this->input->post('noDarurat'),
                        'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                        'status'            => $this->input->post('statusSupir'),
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    );
                    $this->Driver_model->insert($dataSupir);
                    $driver_id = $this->db->insert_id();

                    $initialBalance = 0;

                    $dataWallet = array(
                        'driver_id'     => $driver_id,
                        'balance'       => $initialBalance,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s')
                    );
                    $this->Wallet_model->insert($dataWallet);
                    $wallet_id = $this->db->insert_id();

                    $dataWalletTransaction = array(
                        'wallet_id'         => $wallet_id,
                        'transaction_type'  => 'debit',
                        'description'       => 'Initial balance',
                        'amount'            => $initialBalance,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    );
                    $this->Wallet_model->insert_transaction($dataWalletTransaction);

                    $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                    redirect('/drivers');
                }
            }
        } 
    }

    public function supiredit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('tglJoin','Tanggal Bergabung','required');
            $this->form_validation->set_rules('nmSupir','Nama Supir','required');
            $this->form_validation->set_rules('noSim','Nomer SIM','required');
            $this->form_validation->set_rules('noHp','Nomer HP','required');
            $this->form_validation->set_rules('tglLahir','Tanggal Lahir','required');
            $this->form_validation->set_rules('noDarurat','No HP Darurat','required');
            $this->form_validation->set_rules('tglExpSim','Tgl. Ext. SIM','required');
            $this->form_validation->set_rules('fotoSupir','Foto Supir','');
            $this->form_validation->set_rules('fotoSim','Foto Supir','');
            $this->form_validation->set_rules('alamat','Alamat','required');
            $this->form_validation->set_rules('statusSupir','Status','required');
            $this->form_validation->set_rules('keterangan','Keterangan','');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Supir | Fleet Management",
                    "nopage" => 1041,
                ];

                $data['supirs'] = $this->Driver_model->getAllSupir();
                
                $this->load->view('headernew', $data);
                $this->load->view('drivers', $data);
                $this->load->view('footernew');
            } else {
                $extensi1 = explode(".", $_FILES['fotoSupir']['name']);
                $extensi2 = explode(".", $_FILES['fotoSim']['name']);
                $extensi3 = explode(".", $_FILES['fotoKtp']['name']);
                $size1 = $_FILES['fotoSupir']['size'];
                $size2 = $_FILES['fotoSim']['size'];
                $size3 = $_FILES['fotoKtp']['size'];

                if($_FILES['fotoSupir']['name'] && $_FILES['fotoSim']['name'] && $_FILES['fotoKtp']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        unlink('./uploads/foto/'.$this->input->post('fileFotoLama'));
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        unlink('./uploads/sim/'.$this->input->post('fileSimLama'));
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        unlink('./uploads/ktp/'.$this->input->post('fileKtpLama'));
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // update tabel drivers dengan file foto, sim dan ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_sim'           => $unggahSim['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->update($id, $dataSupir);
                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSupir']['name'] && $_FILES['fotoSim']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        unlink('./uploads/foto/'.$this->input->post('fileFotoLama'));
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        unlink('./uploads/sim/'.$this->input->post('fileSimLama'));
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        // update tabel drivers dengan file foto dan sim
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_sim'           => $unggahSim['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->update($id, $dataSupir);
                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSim']['name'] && $_FILES['fotoKtp']['name']) {
                    if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        unlink('./uploads/sim/'.$this->input->post('fileSimLama'));
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        unlink('./uploads/ktp/'.$this->input->post('fileKtpLama'));
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // update tabel drivers dengan file foto, sim dan ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_sim'           => $unggahSim['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->update($id, $dataSupir);
                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSupir']['name'] && $_FILES['fotoKtp']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        unlink('./uploads/foto/'.$this->input->post('fileFotoLama'));
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        unlink('./uploads/ktp/'.$this->input->post('fileKtpLama'));
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // update tabel drivers dengan file foto dan ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->update($id, $dataSupir);
                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSupir']['name']) {
                    if ($extensi1[1]!='gif' && $extensi1[1]!='png' && $extensi1[1]!='jpg' && $extensi1[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file Foto tidak didukung!');
                        redirect('drivers');
                    } else if ($size1 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Foto tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config1['upload_path'] = './uploads/foto/';
                        $config1['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config1['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config1);
                        unlink('./uploads/foto/'.$this->input->post('fileFotoLama'));
                        $this->upload->do_upload('fotoSupir'); 
                        $unggahFoto = $this->upload->data();

                        // update tabel drivers dengan file foto
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->update($id, $dataSupir);
                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoSim']['name']) {
                    if ($extensi2[1]!='gif' && $extensi2[1]!='png' && $extensi2[1]!='jpg' && $extensi2[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file SIM tidak didukung');
                        redirect('drivers');
                    } else if ($size2 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File Sim tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config2['upload_path'] = './uploads/sim/';
                        $config2['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config2['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config2);
                        unlink('./uploads/sim/'.$this->input->post('fileSimLama'));
                        $this->upload->do_upload('fotoSim'); 
                        $unggahSim = $this->upload->data();

                        // update tabel drivers dengan file sim
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_sim'           => $unggahSim['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->update($id, $dataSupir);
                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else if($_FILES['fotoKtp']['name']) {
                    if ($extensi3[1]!='gif' && $extensi3[1]!='png' && $extensi3[1]!='jpg' && $extensi3[1]!='jpeg') {
                        $this->session->set_flashdata('pesanerror','Format file KTP tidak didukung');
                        redirect('drivers');
                    } else if ($size3 > 3072000) {
                        $this->session->set_flashdata('pesanerror','File KTP tidak boleh lebih besar dari 3 MB!');
                        redirect('drivers');
                    } else {
                        $config3['upload_path'] = './uploads/ktp/';
                        $config3['allowed_types'] = 'gif|png|jpg|jpeg';
                        $config3['max_size'] = 3072; // 3MB
                        $this->upload->initialize($config3);
                        unlink('./uploads/ktp/'.$this->input->post('fileKtpLama'));
                        $this->upload->do_upload('fotoKtp'); 
                        $unggahKtp = $this->upload->data();

                        // update tabel drivers dengan file ktp
                        $dataSupir = array(
                            'name'              => $this->input->post('nmSupir'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        );
                        $this->Driver_model->update($id, $dataSupir);
                        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                        redirect('/drivers');
                    }
                } else {
                    $dataSupir = array(
                        'name'              => $this->input->post('nmSupir'),
                        'license_number'    => $this->input->post('noSim'),
                        'phone'             => $this->input->post('noHp'),
                        'tgl_join'          => $this->input->post('tglJoin'),
                        'tgl_lahir'         => $this->input->post('tglLahir'),
                        'alamat'            => $this->input->post('alamat'),
                        'nomor_darurat'     => $this->input->post('noDarurat'),
                        'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                        'status'            => $this->input->post('statusSupir'),
                        'keterangan'        => $this->input->post('keterangan'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    );
                    $this->Driver_model->update($id, $dataSupir);
                    $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                    redirect('/drivers');
                }
            }
        } 
    }

    public function supirdel($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel ritasi  
            $data = array(
                'is_delete'     => $this->input->post('del'),
                'updated_at'    => date('Y-m-d H:i:s')
            );                              
            $this->Driver_model->update($id,$data);
            $this->session->set_flashdata('pesansukses','Data berhasil dihapus');
            redirect('/drivers');
        } 
    }
}
