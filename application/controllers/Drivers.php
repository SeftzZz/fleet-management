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
        $this->load->model('Vehicle_model');
        $this->load->model('Wallet_model');
        $this->load->database();

        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
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
            "title" => "Manajemen Supir | Fleet Management System",
            "nopage" => 1041,
        ];

        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmSupir','Nama Supir','');
            $this->form_validation->set_rules('noPintu','Nama Supir','');
            $this->form_validation->set_rules('tglJoin','Tanggal Bergabung','');
            $this->form_validation->set_rules('statusSupir','Status','');

            $carisupir = $this->input->post('nmSupir');
            $cariunit = $this->input->post('noPintu');
            $caritanggal = $this->input->post('tglJoin');
            $caristatus = $this->input->post('statusSupir');

            $data['supirs'] = $this->Driver_model->getAllSupirByFilter($carisupir,$cariunit,$caritanggal,$caristatus);
            $data['wallets'] = $this->Wallet_model->getAllWallet();
            $data['mobils'] = $this->Vehicle_model->getAllKendaraanAktif();
            $data['jmltotalsaldo'] = $this->Wallet_model->getAllJmlTotalSaldo();
            $topSaldo = $this->Wallet_model->getDriverWithHighestBalance();

            $data['jmlhighestsaldo'] = $topSaldo->balance ?? 0;
            $data['nmhighestsaldo']  = $topSaldo->name ?? '-';

            foreach ($data['wallets'] as $wallet) {
                $data['wallet_transactions'][$wallet->wallet_id] = $this->Wallet_model->getWalletTransactionsAll($wallet->wallet_id);
            }
            
            $this->load->view('headernew', $data);
            $this->load->view('drivers', $data);
            $this->load->view('footernew');
        } else {
            $data['supirs'] = $this->Driver_model->getAllSupir();
            $data['wallets'] = $this->Wallet_model->getAllWallet();
            $data['mobils'] = $this->Vehicle_model->getAllKendaraanAktif();
            $data['jmltotalsaldo'] = $this->Wallet_model->getAllJmlTotalSaldo();
            $topSaldo = $this->Wallet_model->getDriverWithHighestBalance();

            $data['jmlhighestsaldo'] = $topSaldo->balance ?? 0;
            $data['nmhighestsaldo']  = $topSaldo->name ?? '-';

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
            $this->form_validation->set_rules('tmpLahir','Tempat Lahir','required');
            $this->form_validation->set_rules('tglLahir','Tanggal Lahir','required');
            $this->form_validation->set_rules('noNIK','No NIK','required');
            $this->form_validation->set_rules('tglJoin','Tanggal Bergabung','required');
            $this->form_validation->set_rules('tglKeluar','Tanggal Keluar','');
            $this->form_validation->set_rules('fotoSupir','Foto Supir','');
            $this->form_validation->set_rules('noHp','Nomer HP','required');
            $this->form_validation->set_rules('noDarurat','No HP Darurat','required');
            $this->form_validation->set_rules('fotoSim','Foto SIM','');
            $this->form_validation->set_rules('noSim','Nomer SIM','required');
            $this->form_validation->set_rules('tglExpSim','Tgl. Ext. SIM','required');
            $this->form_validation->set_rules('fotoKtp','Foto KTP','');
            $this->form_validation->set_rules('alamat','Alamat','required');
            $this->form_validation->set_rules('statusSupir','Status','required');
            $this->form_validation->set_rules('keterangan','Keterangan','');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Supir | Fleet Management",
                    "nopage" => 1041,
                ];

                $data['jmltotalsaldo'] = $this->Wallet_model->getAllJmlTotalSaldo();
                $topSaldo = $this->Wallet_model->getDriverWithHighestBalance();
                $data['jmlhighestsaldo'] = $topSaldo->balance ?? 0;
                $data['nmhighestsaldo']  = $topSaldo->name ?? '-';

                $this->session->set_flashdata('pesanerror','Data gagal tambah');
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
                            'nik'               => $this->input->post('noNIK'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_keluar'        => $this->input->post('tglKeluar'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'tempat_lahir'      => $this->input->post('tmpLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_sim'           => $unggahSim['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
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
                            'nik'               => $this->input->post('noNIK'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_keluar'        => $this->input->post('tglKeluar'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'tempat_lahir'      => $this->input->post('tmpLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_sim'           => $unggahSim['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
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
                            'nik'               => $this->input->post('noNIK'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_keluar'        => $this->input->post('tglKeluar'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'tempat_lahir'      => $this->input->post('tmpLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_sim'           => $unggahSim['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
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
                            'nik'               => $this->input->post('noNIK'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_keluar'        => $this->input->post('tglKeluar'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'tempat_lahir'      => $this->input->post('tmpLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
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
                            'nik'               => $this->input->post('noNIK'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_keluar'        => $this->input->post('tglKeluar'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'tempat_lahir'      => $this->input->post('tmpLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_profile'       => $unggahFoto['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
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
                            'nik'               => $this->input->post('noNIK'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_keluar'        => $this->input->post('tglKeluar'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'tempat_lahir'      => $this->input->post('tmpLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_sim'           => $unggahSim['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
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
                            'nik'               => $this->input->post('noNIK'),
                            'license_number'    => $this->input->post('noSim'),
                            'phone'             => $this->input->post('noHp'),
                            'tgl_join'          => $this->input->post('tglJoin'),
                            'tgl_keluar'        => $this->input->post('tglKeluar'),
                            'tgl_lahir'         => $this->input->post('tglLahir'),
                            'tempat_lahir'      => $this->input->post('tmpLahir'),
                            'alamat'            => $this->input->post('alamat'),
                            'nomor_darurat'     => $this->input->post('noDarurat'),
                            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                            'img_ktp'           => $unggahKtp['file_name'],
                            'status'            => $this->input->post('statusSupir'),
                            'keterangan'        => $this->input->post('keterangan'),
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
                        'nik'               => $this->input->post('noNIK'),
                        'license_number'    => $this->input->post('noSim'),
                        'phone'             => $this->input->post('noHp'),
                        'tgl_join'          => $this->input->post('tglJoin'),
                        'tgl_keluar'        => $this->input->post('tglKeluar'),
                        'tgl_lahir'         => $this->input->post('tglLahir'),
                        'tempat_lahir'      => $this->input->post('tmpLahir'),
                        'alamat'            => $this->input->post('alamat'),
                        'nomor_darurat'     => $this->input->post('noDarurat'),
                        'tgl_exp_sim'       => $this->input->post('tglExpSim'),
                        'status'            => $this->input->post('statusSupir'),
                        'keterangan'        => $this->input->post('keterangan'),
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

    public function ajax_list()
    {
        $list = $this->Driver_model->get_datatables();
        $data = array();
        $no = $_POST['start'] ?? 0;
        foreach ($list as $driver) {
            $no++;
            $row = array();
            $row[] = $driver->name;
            $row[] = $driver->tgl_join;
            $row[] = $driver->phone;
            $row[] = $driver->nomor_darurat;
            $row[] = $driver->license_number;
            $row[] = $driver->no_pintu;
            $row[] = $driver->status;
            $row[] = $driver->keterangan;

            $files = array();
            if ($driver->img_profile) $files[] = base_url('uploads/foto/'.$driver->img_profile);
            if ($driver->img_sim) $files[] = base_url('uploads/sim/'.$driver->img_sim);
            if ($driver->img_ktp) $files[] = base_url('uploads/ktp/'.$driver->img_ktp);
            $json_files = htmlspecialchars(json_encode($files), ENT_QUOTES, 'UTF-8');

            $row[] = "
                <button type='button' class='btn btn-sm btn-outline-success' onclick='view_files(".$json_files.")'><i class='fas fa-file-image'></i></button>
                <button type='button' class='btn btn-sm btn-outline-primary' onclick='edit_driver(".$driver->id.")'><i class='fas fa-pencil-alt'></i></button>
                <button type='button' class='btn btn-sm btn-outline-danger' onclick='delete_driver(".$driver->id.")'><i class='fas fa-trash'></i></button>
            ";
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_POST['draw'] ?? 1),
            "recordsTotal" => $this->Driver_model->count_all(),
            "recordsFiltered" => $this->Driver_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->Driver_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $config1['upload_path'] = './uploads/foto/';
        $config1['allowed_types'] = 'jpg|png';
        $config1['max_size'] = 3072; // 3MB
        $this->upload->initialize($config1);
        if (!empty($_FILES['fotoSupir']['name'])) {
            if (!$this->upload->do_upload('fotoSupir')) {
                $this->session->set_flashdata('pesanerror','File berukuran lebih besar dari 3MB atau formatnya bukan jpg/png');
                echo json_encode(array("status" => TRUE));
            } else {
                unlink('./uploads/foto/'.$this->input->post('fileFotoLama'));
                $unggahFoto = $this->upload->data();
                $data = array(
                    'img_profile'       => $unggahFoto['file_name']
                );
                $this->Driver_model->update(array('id' => $this->input->post('id')), $data);
            }
        }

        $config2['upload_path'] = './uploads/sim/';
        $config2['allowed_types'] = 'jpg|png';
        $config2['max_size'] = 3072; // 3MB
        $this->upload->initialize($config2);
        if (!empty($_FILES['fotoSim']['name'])) {
            if (!$this->upload->do_upload('fotoSim')) {
                $this->session->set_flashdata('pesanerror','File berukuran lebih besar dari 3MB atau formatnya bukan jpg/png');
                echo json_encode(array("status" => TRUE));
            } else {
                unlink('./uploads/sim/'.$this->input->post('fileSimLama'));
                $unggahSim = $this->upload->data();
                $data = array(
                    'img_sim'       => $unggahSim['file_name']
                );
                $this->Driver_model->update(array('id' => $this->input->post('id')), $data);
            }
        }

        $config3['upload_path'] = './uploads/ktp/';
        $config3['allowed_types'] = 'jpg|png';
        $config3['max_size'] = 3072; // 3MB
        $this->upload->initialize($config3);
        if (!empty($_FILES['fotoKtp']['name'])) {
            if (!$this->upload->do_upload('fotoKtp')) {
                $this->session->set_flashdata('pesanerror','File berukuran lebih besar dari 3MB atau formatnya bukan jpg/png');
                echo json_encode(array("status" => TRUE));
            } else {
                unlink('./uploads/ktp/'.$this->input->post('fileKtpLama'));
                $unggahKtp = $this->upload->data();
                $data = array(
                    'img_ktp'       => $unggahKtp['file_name']
                );
                $this->Driver_model->update(array('id' => $this->input->post('id')), $data);
            }
        }

        $data = array(
            'name'              => $this->input->post('nmSupir'),
            'tempat_lahir'      => $this->input->post('tmpLahir'),
            'tgl_lahir'         => $this->input->post('tglLahir'),
            'nik'               => $this->input->post('noNIK'),
            'tgl_join'          => $this->input->post('tglJoin'),
            'tgl_keluar'        => $this->input->post('tglKeluar'),
            'phone'             => $this->input->post('noHp'),
            'nomor_darurat'     => $this->input->post('noDarurat'),
            'license_number'    => $this->input->post('noSim'),
            'tgl_exp_sim'       => $this->input->post('tglExpSim'),
            'alamat'            => $this->input->post('alamat'),
            'status'            => $this->input->post('statusSupir'),
            'keterangan'        => $this->input->post('keterangan'),
            'updated_at'        => date('Y-m-d H:i:s')
        );
        $this->Driver_model->update(array('id' => $this->input->post('id')), $data);
        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_del($id)
    {
        $data = $this->Driver_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_delete()
    {
        $data = array(
            'is_delete'         => 1,
            'updated_at'        => date('Y-m-d H:i:s')
        );
        $this->Driver_model->update(array('id' => $this->input->post('id')), $data);
        $this->session->set_flashdata('pesansukses','Data berhasil dihapus');
        echo json_encode(array("status" => TRUE));
    }

    public function wallet()
    {
        $data = [
            "title" => "Manajemen Wallet Supir | Fleet Management System",
            "nopage" => 1041,
        ];
        
        $data['jmltotalsaldo'] = $this->Wallet_model->getAllJmlTotalSaldo();
        $topSaldo = $this->Wallet_model->getDriverWithHighestBalance();

        $data['jmlhighestsaldo'] = $topSaldo->balance ?? 0;
        $data['nmhighestsaldo']  = $topSaldo->name ?? '-';

        $this->load->view('headernew', $data);
        $this->load->view('driver_wallet', $data);
        $this->load->view('footernew');
        
    }

    public function ajax_listwallet() {
        $list = $this->Wallet_model->get_datatablesWSupir();
        $data = array();
        $no = $_POST['start'] ?? 0;
        foreach ($list as $wallet) {
            $no++;
            $row = array();
            $row[] = $wallet->name;
            $row[] = $this->fppfunction->rupiah_ind($wallet->balance);
            $row[] = $wallet->status_wallet;
            $row[] = $wallet->updated_at;;
            $row[] = "
                        <a href=".site_url('drivers/walletdetail/'.$wallet->id)." class='btn btn-sm btn-outline-success'><i class='fas fa-eye'></i></a>
                     ";
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_POST['draw'] ?? 1),
            "recordsTotal" => $this->Wallet_model->count_allWSupir(),
            "recordsFiltered" => $this->Wallet_model->count_filteredWSupir(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function walletdetail($id)
    {
        $SupirID = $this->uri->segment(3);
        $namaSupir = $this->Driver_model->get_by_id($SupirID);
        $totWallet = $this->Wallet_model->get_by_driver($SupirID);

        $data = [
            "title" => "Wallet detail ".$namaSupir->name." - ".$this->fppfunction->rupiah_ind($totWallet->balance),
            "nopage" => 1041,
        ];
        
        $data['walletID'] = $this->uri->segment(3);
        $data['supir'] = $this->Driver_model->get_by_id($SupirID);
        $data['wallet'] = $this->Wallet_model->get_by_driver($SupirID);
        $data['wallet_transactions'] = $this->Wallet_model->getWalletTransactionsAll($id);
        $data['jmlTransaksi'] = count($data['wallet_transactions']);
        $data['jmltotalsaldo'] = $this->Wallet_model->getAllJmlTotalSaldo();
        $topSaldo = $this->Wallet_model->getDriverWithHighestBalance();

        $data['jmlhighestsaldo'] = $topSaldo->balance ?? 0;
        $data['nmhighestsaldo']  = $topSaldo->name ?? '-';

        $this->load->view('headernew', $data);
        $this->load->view('driver_walletdetail', $data);
        $this->load->view('footernew');
        
    }
}
