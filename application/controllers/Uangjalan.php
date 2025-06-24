<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uangjalan extends CI_Controller {
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
        $this->load->model('Uangjalan_model');
        $this->load->model('Proyek_model');
        $this->load->model('Lokasigalian_model');
        $this->load->database();
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Uang Jalan | Fleet Management",
            "nopage" => 1001,
        ];

        $data['ujalans'] = $this->Uangjalan_model->getAllUangJalan();
        $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
        $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
        
        $this->load->view('headernew', $data);
        $this->load->view('uangjalan', $data);
        $this->load->view('footernew');
	}

    public function add()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek', 'Nama Proyek', 'required');
            $this->form_validation->set_rules('galian', 'Lokasi Galian', 'required');
            $this->form_validation->set_rules('uJalan', 'Uang Jalan', 'required');
            $this->form_validation->set_rules('statusUjalan', 'Status Uang Jalan', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data = [
                    "title" => "Manajemen Uang Jalan | Fleet Management",
                    "nopage" => 1001,
                    'ujalans' => $this->Uangjalan_model->getAllUangJalan(),
                    'proyeks' => $this->Proyek_model->getAllProyekAktif(),
                    'galians' => $this->Lokasigalian_model->getAllGalianAktif()
                ];
                $this->load->view('headernew', $data);
                $this->load->view('uangjalan', $data);
                $this->load->view('footernew');
            } else {
                $galian_id = $this->input->post('galian');
                $statusUjalan = $this->input->post('statusUjalan');

                // 1. Update semua status uangjalan yang aktif untuk galian ini jadi Non Aktif
                $this->Uangjalan_model->nonAktifkanUangJalanByGalian($galian_id);

                // 2. Insert data baru
                $dataUjalan = [
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'galian_id'         => $galian_id,
                    'uang_jalan'        => $this->input->post('uJalan'),
                    'status_uangjalan'  => $statusUjalan,
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ];
                $this->Uangjalan_model->insert($dataUjalan);

                redirect('/uangjalan');
            }
        }
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('galian','Lokasi Galian','required');
            $this->form_validation->set_rules('uJalan','Uang Jalan','required');
            $this->form_validation->set_rules('statusUjalan','Status Uang Jalan','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Uang Jalan | Fleet Management",
                    "nopage" => 1001,
                ];

                $data['ujalans'] = $this->Uangjalan_model->getAllUangJalan();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('uangjalan', $data);
                $this->load->view('footernew');
            } else {
                // update tabel uangjalan  
                $dataUjalan = array(
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'galian_id'         => $this->input->post('galian'),
                    'uang_jalan'        => $this->input->post('uJalan'),
                    'status_uangjalan'  => $this->input->post('statusUjalan'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Uangjalan_model->update($id,$dataUjalan);
                redirect('/uangjalan');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel uangjalan  
            $dataUjalan = array(
                'is_delete'          => $this->input->post('del'),
                'status_uangjalan'   => 'Non Aktif',
                'updated_at'         => date('Y-m-d H:i:s')
            );                              
            $this->Uangjalan_model->update($id,$dataUjalan);
            redirect('/uangjalan');
        } 
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uangjalan extends CI_Controller {
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
        $this->load->model('Uangjalan_model');
        $this->load->model('Proyek_model');
        $this->load->model('Lokasigalian_model');
        $this->load->database();
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Uang Jalan | Fleet Management",
            "nopage" => 1001,
        ];

        $data['ujalans'] = $this->Uangjalan_model->getAllUangJalan();
        $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
        $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
        
        $this->load->view('headernew', $data);
        $this->load->view('uangjalan', $data);
        $this->load->view('footernew');
	}

    public function add()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek', 'Nama Proyek', 'required');
            $this->form_validation->set_rules('galian', 'Lokasi Galian', 'required');
            $this->form_validation->set_rules('uJalan', 'Uang Jalan', 'required');
            $this->form_validation->set_rules('statusUjalan', 'Status Uang Jalan', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data = [
                    "title" => "Manajemen Uang Jalan | Fleet Management",
                    "nopage" => 1001,
                    'ujalans' => $this->Uangjalan_model->getAllUangJalan(),
                    'proyeks' => $this->Proyek_model->getAllProyekAktif(),
                    'galians' => $this->Lokasigalian_model->getAllGalianAktif()
                ];
                $this->load->view('headernew', $data);
                $this->load->view('uangjalan', $data);
                $this->load->view('footernew');
            } else {
                $galian_id = $this->input->post('galian');
                $statusUjalan = $this->input->post('statusUjalan');

                // 1. Update semua status uangjalan yang aktif untuk galian ini jadi Non Aktif
                $this->Uangjalan_model->nonAktifkanUangJalanByGalian($galian_id);

                // 2. Insert data baru
                $dataUjalan = [
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'galian_id'         => $galian_id,
                    'uang_jalan'        => $this->input->post('uJalan'),
                    'status_uangjalan'  => $statusUjalan,
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ];
                $this->Uangjalan_model->insert($dataUjalan);

                redirect('/uangjalan');
            }
        }
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('galian','Lokasi Galian','required');
            $this->form_validation->set_rules('uJalan','Uang Jalan','required');
            $this->form_validation->set_rules('statusUjalan','Status Uang Jalan','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Uang Jalan | Fleet Management",
                    "nopage" => 1001,
                ];

                $data['ujalans'] = $this->Uangjalan_model->getAllUangJalan();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('uangjalan', $data);
                $this->load->view('footernew');
            } else {
                // update tabel uangjalan  
                $dataUjalan = array(
                    'proyek_id'         => $this->input->post('nmProyek'),
                    'galian_id'         => $this->input->post('galian'),
                    'uang_jalan'        => $this->input->post('uJalan'),
                    'status_uangjalan'  => $this->input->post('statusUjalan'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Uangjalan_model->update($id,$dataUjalan);
                redirect('/uangjalan');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel uangjalan  
            $dataUjalan = array(
                'is_delete'          => $this->input->post('del'),
                'status_uangjalan'   => 'Non Aktif',
                'updated_at'         => date('Y-m-d H:i:s')
            );                              
            $this->Uangjalan_model->update($id,$dataUjalan);
            redirect('/uangjalan');
        } 
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
