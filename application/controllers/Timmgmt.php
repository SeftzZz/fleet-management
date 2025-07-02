<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timmgmt extends CI_Controller {
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
        $this->load->model('Timmgmt_model');
        $this->load->model('Tim_model');
        $this->load->model('Driver_model');
        $this->load->model('Vehicle_model');
        $this->load->database();

        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Anggota Tim | Fleet Management",
            "nopage" => 1031,
        ];
        
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmTim','Nama Tim','');
            $this->form_validation->set_rules('nmSupir','Nama Supir','');
            $this->form_validation->set_rules('noPol','No Polisi','');
            $this->form_validation->set_rules('statusAtim','Status Anggota Tim','');

            $caritim = $this->input->post('nmTim');
            $carisupir = $this->input->post('nmSupir');
            $carimobil = $this->input->post('noPol');
            $caristatus = $this->input->post('statusAtim');

            $data['atims'] = $this->Timmgmt_model->getAllTimMgmtByFilter($caritim,$carisupir,$carimobil,$caristatus);
            $data['tims'] = $this->Tim_model->getAllTimAktif();
            $data['supirs'] = $this->Driver_model->getAllSupirAktif();
            $data['mobils'] = $this->Vehicle_model->getAllKendaraanAktif();

            $this->load->view('headernew', $data);
            $this->load->view('timmgmt', $data);
            $this->load->view('footernew');
        } else {
            $data['atims'] = $this->Timmgmt_model->getAllTimMgmt();
            $data['tims'] = $this->Tim_model->getAllTimAktif();
            $data['supirs'] = $this->Driver_model->getAllSupirAktif();
            $data['mobils'] = $this->Vehicle_model->getAllKendaraanAktif();
            
            $this->load->view('headernew', $data);
            $this->load->view('timmgmt', $data);
            $this->load->view('footernew');
        }
	}

    public function add()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmTim','Nama Tim','required');
            $this->form_validation->set_rules('nmSupir','Nama Supir','required');
            $this->form_validation->set_rules('mobil','Kendaraan','required');
            $this->form_validation->set_rules('statusAtim','Status Anggota Tim','required');

            if ($this->form_validation->run()==FALSE) {
                $data = [
                    "title" => "Manajemen AAnggota Tim | Fleet Management",
                    "nopage" => 1031,
                ];

                $data['atims'] = $this->Timmgmt_model->getAllTimMgmt();
                $data['tims'] = $this->Tim_model->getAllTimAktif();
                $data['supirs'] = $this->Driver_model->getAllSupirAktif();
                $data['mobils'] = $this->Vehicle_model->getAllKendaraanAktif();
                $this->session->set_flashdata('pesanerror','Data kurang lengkap');

                $this->load->view('headernew', $data);
                $this->load->view('timmgmt', $data);
                $this->load->view('footernew');
            } else {
                $kendaraan = $this->Vehicle_model->getKendaraanById($this->input->post('mobil'));
                $supir = $this->Driver_model->getSupirById($this->input->post('nmSupir'));
                $tim = $this->Tim_model->getTimById($this->input->post('nmTim'));
                $data['mobil'] = $this->Timmgmt_model->getKendaraanTimByIdMobil($this->input->post('mobil'));
                if ($data['mobil']) {
                    $this->session->set_flashdata('pesanerror','Kendaraan masih aktif digunakan oleh '.$data['mobil']->name.' - Tim '.$data['mobil']->nama_tim); 
                    redirect('timmgmt');
                } else {
                    // insert tabel tim_mgmt  
                    $dataAtim = array(
                        'tim_id'            => $this->input->post('nmTim'),
                        'nama_tim'          => $tim->nama_tim,
                        'driver_id'         => $this->input->post('nmSupir'),
                        'nama_supir'        => $supir->name,
                        'vehicle_id'        => $this->input->post('mobil'),
                        'no_pol'            => $kendaraan->no_pol,
                        'no_pintu'          => $kendaraan->no_pintu,
                        'status_tim_mgmt'   => $this->input->post('statusAtim'),
                        'is_delete'         => 0,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    );                              
                    $this->Timmgmt_model->insert($dataAtim); 
                    redirect('timmgmt');
                }
            }
        } 
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmTim','Nama Tim','');
            $this->form_validation->set_rules('nmSupir','Nama Supir','');
            $this->form_validation->set_rules('mobil','Kendaraan','');
            $this->form_validation->set_rules('statusAtim','Status Anggota Tim','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Anggota Tim | Fleet Management",
                    "nopage" => 1031,
                ];

                $data['atims'] = $this->Timmgmt_model->getAllTimMgmt();
                $data['tims'] = $this->Tim_model->getAllTimAktif();
                $data['supirs'] = $this->Driver_model->getAllSupirAktif();
                $data['mobils'] = $this->Vehicle_model->getAllKendaraanAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('timmgmt', $data);
                $this->load->view('footernew');
            } else {
                // $data['mobil'] = $this->Timmgmt_model->getKendaraanTimByIdMobil($this->input->post('mobil'));
                // if ($data['mobil'] > 0) {
                //     $this->session->set_flashdata('pesanerror','Kendaraan masih aktif digunakan oleh '.$data['mobil']->name.' - Tim '.$data['mobil']->nama_tim); 
                //     redirect('timmgmt');
                // } else {
                // }

                $kendaraan = $this->Vehicle_model->getKendaraanById($this->input->post('mobil'));
                $supir = $this->Driver_model->getSupirById($this->input->post('nmSupir'));
                $tim = $this->Tim_model->getTimById($this->input->post('nmTim'));

                // 1. Update semua status tim_mgmnt yang aktif untuk no_pol ini jadi Non Aktif
                $this->Timmgmt_model->nonAktifkanTimByVehicleDanDriver($kendaraan->no_pol, $this->input->post('nmSupir'));

                // update tabel tim_mgmt  
                $dataAtim = array(
                    // 'tim_id'            => $this->input->post('nmTim'),
                    // 'nama_tim'          => $tim->nama_tim,
                    'driver_id'         => $this->input->post('nmSupir'),
                    'nama_supir'        => $supir->name,
                    'vehicle_id'        => $this->input->post('mobil'),
                    'no_pol'            => $kendaraan->no_pol,
                    'no_pintu'          => $kendaraan->no_pintu,
                    'status_tim_mgmt'   => $this->input->post('statusAtim'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Timmgmt_model->update($id,$dataAtim);
                redirect('/timmgmt');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel tim_mgmt  
            $dataAtim = array(
                'is_delete'         => $this->input->post('del'),
                'status_tim_mgmt'   => 'Non Aktif',
                'updated_at'        => date('Y-m-d H:i:s')
            );                              
            $this->Timmgmt_model->update($id,$dataAtim);
            redirect('/timmgmt');
        } 
    }
}
