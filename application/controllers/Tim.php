<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tim extends CI_Controller {
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
        $this->load->model('Tim_model');
        $this->load->database();
        
        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Tim | Fleet Management System",
            "nopage" => 1091,
        ];

        $data['tims'] = $this->Tim_model->getAllTim();
        
        $this->load->view('headernew', $data);
        $this->load->view('tim', $data);
        $this->load->view('footernew');
	}

    public function add()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmTim','Nama Proyek','required');
            $this->form_validation->set_rules('statusTim','status Proyek','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Proyek | Fleet Management",
                    "nopage" => 1091,
                ];

                $data['tims'] = $this->Tim_model->getAllTim();
        
                $this->load->view('headernew', $data);
                $this->load->view('tim', $data);
                $this->load->view('footernew');
            } else {
                $nmTim = $this->input->post('nmTim');
                // 1. Update semua status uangjalan yang aktif untuk galian ini jadi Non Aktif
                $this->Tim_model->nonAktifkanTimkByNama($nmTim);
                
                // insert tabel tim  
                $dataTim = array(
                    'nama_tim'          => $this->input->post('nmTim'),
                    'status_tim'        => $this->input->post('statusTim'),
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Tim_model->insert($dataTim); 
                $this->session->set_flashdata('pesansukses','Tim berhasil ditambah'); 
                redirect('/tim');
            }
        } 
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmTim','Nama Tim','required');            
            $this->form_validation->set_rules('statusTim','status Tim','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Tim | Fleet Management",
                    "nopage" => 1091,
                ];

                $data['tims'] = $this->Tim_model->getAllTim();

                $this->load->view('headernew', $data);
                $this->load->view('tim', $data);
                $this->load->view('footernew');
            } else {
                // update tabel tim  
                $dataTim = array(
                    'nama_tim'          => $this->input->post('nmTim'),
                    'status_tim'        => $this->input->post('statusTim'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Tim_model->update($id,$dataTim);
                $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                redirect('/tim');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel tim  
            $dataTim = array(
                'is_delete'       => $this->input->post('del'),
                'updated_at'      => date('Y-m-d H:i:s')
            );                              
            $this->Tim_model->update($id,$dataTim);
            $this->session->set_flashdata('pesansukses','Data berhasil dihapus');
            redirect('/tim');
        } 
    }
}
