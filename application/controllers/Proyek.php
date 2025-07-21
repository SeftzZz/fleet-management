<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {
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
        $this->load->model('Proyek_model');
        $this->load->database();

        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Proyek | Fleet Management System",
            "nopage" => 1011,
        ];

        $data['proyeks'] = $this->Proyek_model->getAllProyek();
        
        $this->load->view('headernew', $data);
        $this->load->view('proyek', $data);
        $this->load->view('footernew');
	}

    public function add()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('statusProyek','status Proyek','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Proyek | Fleet Management",
                    "nopage" => 1011,
                ];

                $data['proyeks'] = $this->Proyek_model->getAllProyek();
        
                $this->load->view('headernew', $data);
                $this->load->view('proyek', $data);
                $this->load->view('footernew');
            } else {
                // insert tabel proyek  
                $dataProyek = array(
                    'nama_proyek'       => $this->input->post('nmProyek'),
                    'status_proyek'     => $this->input->post('statusProyek'),
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Proyek_model->insert($dataProyek); 
                redirect('/proyek');
            }
        } 
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmProyek','Nama Proyek','required');
            $this->form_validation->set_rules('statusProyek','status Proyek','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Proyek | Fleet Management",
                    "nopage" => 1011,
                ];

                $data['proyeks'] = $this->Proyek_model->getAllProyek();
        
                $this->load->view('headernew', $data);
                $this->load->view('proyek', $data);
                $this->load->view('footernew');
            } else {
                // update tabel proyek  
                $dataProyek = array(
                    'nama_proyek'       => $this->input->post('nmProyek'),
                    'status_proyek'     => $this->input->post('statusProyek'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Proyek_model->update($id,$dataProyek);
                redirect('/proyek');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel proyek  
            $dataProyek = array(
                'is_delete'       => $this->input->post('del'),
                'status_proyek'   => 'Non Aktif',
                'updated_at'      => date('Y-m-d H:i:s')
            );                              
            $this->Proyek_model->update($id,$dataProyek);
            redirect('/proyek');
        } 
    }
}
