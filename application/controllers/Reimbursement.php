<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reimbursement extends CI_Controller {
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
        $this->load->model('Driver_model');
        $this->load->model('Wallet_model');
        $this->load->model('Vehicle_model');
        $this->load->model('Route_model');
        $this->load->model('Proyek_model');
        $this->load->model('Tim_model');
        $this->load->model('Lokasigalian_model');
        $this->load->model('Timmgmt_model');
        $this->load->database();
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
    {
        $data = [
            "title" => "Manajemen Reimbursement | Fleet Management",
            "nopage" => 1061,
        ];

        // Ambil data filter
        $tanggal   = $this->input->post('tanggal');
        $proyek_id = $this->input->post('proyek');
        $galian_id = $this->input->post('galian');
        $tim_id    = $this->input->post('tim');
        $submit    = $this->input->post('submit');

        // Kirim data master untuk dropdown
        $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
        $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
        $data['tims'] = $this->Tim_model->getAllTimAktif();
        $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();

        // Jika form submit (filter digunakan)
        if ($submit) {
            // Validasi form (jika perlu)
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('proyek', 'Proyek', 'required');
            $this->form_validation->set_rules('galian', 'Lokasi Galian', 'required');
            $this->form_validation->set_rules('tim', 'Tim', 'required');

            if ($this->form_validation->run() == TRUE) {
                // Ambil data ritasi berdasarkan filter
                $data['ritasi_list'] = $this->Route_model->getRitasiByFilters($tanggal, $proyek_id, $galian_id, $tim_id);
            } else {
                $data['ritasi_list'] = [];
            }
        } else {
            $data['ritasi_list'] = [];
        }

        $data['reimbursements_done'] = $this->db->select('wallet_transactions.*, vehicles.no_pol, ritasi.tgl_ritasi')
        ->from('wallet_transactions')
        ->join('ritasi', 'ritasi.id = wallet_transactions.id_ritasi')
        ->join('vehicles', 'vehicles.id = ritasi.vehicle_id')
        ->where('wallet_transactions.status', 'sudah')
        ->order_by('wallet_transactions.updated_at', 'DESC')
        ->get()
        ->result();

        $this->load->view('headernew', $data);
        $this->load->view('reimbursement', $data);
        $this->load->view('footernew');
    }

    public function submit_reimburse()
    {
        $ritasi_ids = $this->input->post('ritasi_ids');

        if (!empty($ritasi_ids)) {
            foreach ($ritasi_ids as $ritasi_id) {
                // Ambil data ritasi
                $ritasi = $this->db->get_where('ritasi', ['id' => $ritasi_id])->row();
                if ($ritasi) {
                    // Update wallet_transactions
                    $this->db->where('id_ritasi', $ritasi_id);
                    $this->db->where('transaction_type', 'debit');
                    $this->db->update('wallet_transactions', [
                        'amount' => $ritasi->uang_jalan,
                        'status' => 'sudah',
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }

            $this->session->set_flashdata('pesansukses', 'Reimbursement berhasil diproses.');
        } else {
            $this->session->set_flashdata('pesanerror', 'Tidak ada data yang dipilih.');
        }

        redirect('reimbursement');
    }
}
