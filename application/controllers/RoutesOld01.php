<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends CI_Controller {
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
        $this->load->model('Route_model');
        $this->load->database();
    }

	public function index()
	{
		$data = [
            "title" => "Manajemen Rute / Ritasi | Fleet Management",
            "nopage" => 4,
        ];
		
		// Pagination configuration
        $config['base_url'] = site_url('routes');
        $config['total_rows'] = $this->Route_model->count_routes();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data['routes'] = $this->Route_model->get_routes($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('header', $data);
        $this->load->view('routes', $data);
        $this->load->view('footer');
	}

	public function delete() {
		redirect('routes');
	}
}
