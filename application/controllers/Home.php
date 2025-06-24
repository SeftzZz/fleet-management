<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
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
            "title" => "Dashboard Utama | Fleet Management",
            "nopage" => 1,
        ];

		// $this->load->view('header', $data);
		$this->load->view('login');
		// $this->load->view('footer');
	}

    public function auth()
    {
        $this->form_validation->set_rules("email", "email", "required");
        $this->form_validation->set_rules("password_hash", "password_hash", "required");
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata("pesanerror", "all form must be filled out!");
            $this->load->view("login");
        } else {
            $email = $this->input->post("email");
            $password_hash = $this->input->post("password_hash");
            $data["user"] = $this->Api_m->cek_user(
                $email,
                sha1($password_hash)
            );
            if ($data["user"]) {
                // JWT Token
                // $kunci = $this->config->item("thekey"); // From config/config.php
                $token["id"] = $data["user"]->id;
                $token["email"] = $data["user"]->email;
                // $token = JWT::encode($token, $kunci, "HS256");
                $this->session->set_userdata([
                    "logged_in" => "login",
                    "email"     => $data["user"]->email,
                    "id"        => $data["user"]->id,
                ]);
                $this->session->set_flashdata("pesansukses", $this->input->post("email") . " Berhasil !");
                redirect("routes");
            } else {
                redirect("home");
            }
        }
    }
}
