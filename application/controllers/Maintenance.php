<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {
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
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Api_m');
        $this->load->database();
    }

	public function index()
	{
        $data = [
            "title" => "Dashboard Utama | Fleet Management System",
            "nopage" => 1200,
        ];

		$this->load->view('headernew', $data);
		$this->load->view('maintenance');
		$this->load->view('footernew');
	}
}