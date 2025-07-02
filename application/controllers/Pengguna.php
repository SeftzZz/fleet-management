<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
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
        $this->load->model('Pengguna_model');
        $this->load->database();

        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

	public function index()
	{
		$data = [
            "title" => "Master Data User | Fleet Management",
            "nopage" => 1081,
        ];

        $data['penggunas'] = $this->Pengguna_model->getAllPengguna();
        
        $this->load->view('headernew', $data);
        $this->load->view('user', $data);
        $this->load->view('footernew');
	}

    public function add()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('firstName','Nama Depan','required');
            $this->form_validation->set_rules('lastName','Nama Belakang','');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('pass','Password','required|min_length[8]');

            if ($this->form_validation->run() == FALSE) {
                $data = [
                    "title" => "Manajemen Data User | Fleet Management",
                    "nopage" => 1081,
                ];

                if (form_error('email')) {
                    $this->session->set_flashdata('pesanerror','Format Email Salah');
                } else {
                    $this->session->set_flashdata('pesanerror','Ada Form Yang Belum Terisi');
                }

                $data['penggunas'] = $this->Pengguna_model->getAllPengguna();
                
                $this->load->view('headernew', $data);
                $this->load->view('user', $data);
                $this->load->view('footernew');
            } else {
                // insert tabel users  
                $dataUser = array(
                    'ip_address'        => $this->input->ip_address(),
                    'username'          => $this->input->post('email'),
                    'password'          => password_hash($this->input->post('pass'),PASSWORD_BCRYPT),
                    'email'             => $this->input->post('email'),
                    'created_on'        => time(),
                    'active'            => 1,
                    'first_name'        => $this->input->post('firstName'),
                    'last_name'         => $this->input->post('lastName'),
                    'company'           => 'Karya Majujaya Perkasa'
                );  
                $this->Pengguna_model->insert($dataUser);
                $idUser = $this->db->insert_id();
                
                // insert tabel users_groups  
                $dataUserG = array(
                    'user_id'           => $idUser,
                    'group_id'          => 2
                );  
                $this->Pengguna_model->insertUserG($dataUserG);

                $this->session->set_flashdata('pesansukses','Data Berhasil Disimpan');
                redirect('/pengguna');
            }
        }
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('firstName','Nama Depan','required');
            $this->form_validation->set_rules('lastName','Nama Belakang','');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Data User | Fleet Management",
                    "nopage" => 1081,
                ];

                $data['penggunas'] = $this->Pengguna_model->getAllPengguna();

                $this->load->view('headernew', $data);
                $this->load->view('user', $data);
                $this->load->view('footernew');
            } else {
                // update tabel users  
                $dataUser = array(
                    'first_name'        => $this->input->post('firstName'),
                    'last_name'         => $this->input->post('lastName'),
                    'active'            => $this->input->post('status')
                );                              
                $this->Pengguna_model->update($id,$dataUser);
                $this->session->set_flashdata('pesansukses','Data Berhasil Disimpan');
                redirect('/pengguna');
            }
        } 
    }

    public function editpass($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('pass','Password','required|min_length[8]');
            
            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Data User | Fleet Management",
                    "nopage" => 1081,
                ];

                if (form_error('pass')) {
                    $this->session->set_flashdata('pesanerror','Password harus lebih dari atau sama dengan 8 karakter');
                } else {
                    $this->session->set_flashdata('pesanerror','Required form');
                }

                $data['penggunas'] = $this->Pengguna_model->getAllPengguna();

                $this->load->view('headernew', $data);
                $this->load->view('user', $data);
                $this->load->view('footernew');
            } else {
                // update tabel users  
                $dataUser = array(
                    'password'          => password_hash($this->input->post('pass'),PASSWORD_BCRYPT)
                );                              
                $this->Pengguna_model->update($id,$dataUser);
                $this->session->set_flashdata('pesansukses','Data Berhasil Disimpan');
                redirect('/pengguna');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel users  
            $dataUser = array(
                'is_delete'     => $this->input->post('del'),
                'active'        => 0
            );                              
            $this->Pengguna_model->update($id,$dataUser);
            $this->session->set_flashdata('pesansukses','Data Berhasil Disimpan');
            redirect('/pengguna');
        } 
    }
}
