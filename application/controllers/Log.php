<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
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
        $this->load->model('Log_model');
        $this->load->database();

        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index() {
        $data = [
            "title"  => "Data Log | Fleet Management System",
            "nopage" => 1420,
        ];

        $this->load->view('headernew', $data);
        $this->load->view('log', $data);
        $this->load->view('footernew');
    }

    public function ajax_listlog() {
        $list = $this->Log_model->get_datatablesLog();
        $data = array();
        $no = $_POST['start'] ?? 0;
        foreach ($list as $log) {
            $no++;
            $row = array();
            $row[] = $this->fppfunction->tglangkajam2_ind($log->updated_at);
            $row[] = $log->nama_user;
            $row[] = $log->aktifitas;
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_POST['draw'] ?? 1),
            "recordsTotal" => $this->Log_model->count_allLog(),
            "recordsFiltered" => $this->Log_model->count_filteredLog(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}