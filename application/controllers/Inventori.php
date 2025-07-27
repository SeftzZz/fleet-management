<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Controller {
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
        $this->load->model('Inventori_model');
        $this->load->database();
    }

    public function baru()
    {
        $data = [
            "title" => "Dashboard Utama | Fleet Management System",
            "nopage" => 1100,
        ];

        $this->load->view('headernew', $data);
        $this->load->view('inventori_baru');
        $this->load->view('footernew');
    }

    public function bekas()
    {
        $data = [
            "title" => "Dashboard Utama | Fleet Management System",
            "nopage" => 1101,
        ];

        $this->load->view('headernew', $data);
        $this->load->view('inventori_bekas');
        $this->load->view('footernew');
    }
}