<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasigalian extends CI_Controller {
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
        $this->load->model('Lokasigalian_model');
        $this->load->model('Proyek_model');
        $this->load->model('Uangjalan_model');
        $this->load->database();
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Lokasi Galian | Fleet Management",
            "nopage" => 1021,
        ];

        $data['galians'] = $this->Lokasigalian_model->getAllGalianByLokasi();
        $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
        $data['ujalans'] = $this->Uangjalan_model->getAllUangJalanAktif();
        
        $this->load->view('headernew', $data);
        $this->load->view('lokasigalian', $data);
        $this->load->view('footernew');
	}

    public function add()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('galian','Lokasi Galian','required');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Lokasi Galian | Fleet Management",
                    "nopage" => 1021,
                ];

                $data['galians'] = $this->Lokasigalian_model->getAllGalianByLokasi();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['ujalans'] = $this->Uangjalan_model->getAllUangJalanAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('lokasigalian', $data);
                $this->load->view('footernew');
            } else {
                // insert tabel galian  
                $dataGalian = array(
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'lokasi'            => $this->input->post('galian'),
                    'status_lokasi'     => $this->input->post('status'),
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Lokasigalian_model->insert($dataGalian); 
                redirect('/lokasigalian');
            }
        } 
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('galian','Lokasi Galian','required');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Lokasi Galian | Fleet Management",
                    "nopage" => 1021,
                ];

                $data['galians'] = $this->Lokasigalian_model->getAllGalianByLokasi();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['ujalans'] = $this->Uangjalan_model->getAllUangJalanAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('lokasigalian', $data);
                $this->load->view('footernew');
            } else {
                // update tabel galian  
                $dataGalian = array(
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'lokasi'            => $this->input->post('galian'),
                    'status_lokasi'     => $this->input->post('status'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Lokasigalian_model->update($id,$dataGalian);
                redirect('/lokasigalian');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel galian  
            $dataGalian = array(
                'is_delete'       => $this->input->post('del'),
                'status_lokasi'   => 'Non Aktif',
                'updated_at'      => date('Y-m-d H:i:s')
            );                              
            $this->Lokasigalian_model->update($id,$dataGalian);
            redirect('/lokasigalian');
        } 
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasigalian extends CI_Controller {
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
        $this->load->model('Lokasigalian_model');
        $this->load->model('Proyek_model');
        $this->load->model('Uangjalan_model');
        $this->load->database();
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Lokasi Galian | Fleet Management",
            "nopage" => 1021,
        ];

        $data['galians'] = $this->Lokasigalian_model->getAllGalianByLokasi();
        $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
        $data['ujalans'] = $this->Uangjalan_model->getAllUangJalanAktif();
        
        $this->load->view('headernew', $data);
        $this->load->view('lokasigalian', $data);
        $this->load->view('footernew');
	}

    public function add()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('galian','Lokasi Galian','required');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Lokasi Galian | Fleet Management",
                    "nopage" => 1021,
                ];

                $data['galians'] = $this->Lokasigalian_model->getAllGalianByLokasi();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['ujalans'] = $this->Uangjalan_model->getAllUangJalanAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('lokasigalian', $data);
                $this->load->view('footernew');
            } else {
                // insert tabel galian  
                $dataGalian = array(
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'lokasi'            => $this->input->post('galian'),
                    'status_lokasi'     => $this->input->post('status'),
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Lokasigalian_model->insert($dataGalian); 
                redirect('/lokasigalian');
            }
        } 
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('galian','Lokasi Galian','required');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Lokasi Galian | Fleet Management",
                    "nopage" => 1021,
                ];

                $data['galians'] = $this->Lokasigalian_model->getAllGalianByLokasi();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['ujalans'] = $this->Uangjalan_model->getAllUangJalanAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('lokasigalian', $data);
                $this->load->view('footernew');
            } else {
                // update tabel galian  
                $dataGalian = array(
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'lokasi'            => $this->input->post('galian'),
                    'status_lokasi'     => $this->input->post('status'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Lokasigalian_model->update($id,$dataGalian);
                redirect('/lokasigalian');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel galian  
            $dataGalian = array(
                'is_delete'       => $this->input->post('del'),
                'status_lokasi'   => 'Non Aktif',
                'updated_at'      => date('Y-m-d H:i:s')
            );                              
            $this->Lokasigalian_model->update($id,$dataGalian);
            redirect('/lokasigalian');
        } 
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
