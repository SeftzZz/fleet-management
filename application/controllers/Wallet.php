<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {
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
    public function index()
    {
        $data = [
            "title"  => "Manajemen Supir | Fleet Management System",
            "nopage" => 1071,
        ];

        // Ambil semua supir untuk dropdown
        $data['supirs'] = $this->Driver_model->getAllSupir();
        $data['wallets'] = [];
        $data['wallet_transactions'] = [];

        if ($this->input->post('submit')) {
            $caridriver = $this->input->post('driver_id');

            // Ambil wallet berdasarkan supir
            if (!empty($caridriver)) {
                $data['wallets'] = $this->Wallet_model->getWalletByDriverId($caridriver);

                foreach ($data['wallets'] as $wallet) {
                    $data['wallet_transactions'][$wallet->wallet_id] =
                        $this->Wallet_model->getWalletTransactionsByWalletId($wallet->wallet_id);
                }
            }
        }

        // Ambil data transaksi wallet yang sudah diklaim
        $data['klaim_done'] = $this->db
            ->where('transaction_type', 'credit')
            ->where('status', 'sudah')
            ->order_by('updated_at', 'DESC')
            ->get('wallet_transactions')
            ->result();

        $this->load->view('headernew', $data);
        $this->load->view('wallet_claim', $data);
        $this->load->view('footernew');
    }

    public function submit_wallet()
    {
        $wallet_id = $this->input->post('wallet_id');

        if (!empty($wallet_id)) {
            $this->db->where('wallet_id', $wallet_id);
            $this->db->update('wallet_transactions', [
                'status'     => 'sudah',
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('pesansukses', 'Form wallet berhasil diproses.');
        } else {
            $this->session->set_flashdata('pesanerror', 'Wallet tidak ditemukan.');
        }

        redirect('wallet');
    }

    public function submit_walletadd()
    {
        if ($this->input->post('utk') && $this->input->post('jmlnya')) {
            $this->db->insert('wallet_transactions', [
                'wallet_id'         => $this->input->post('wallet_id'),
                'transaction_type'  => $this->input->post('transaksiTipe'),
                'amount'            => $this->input->post('jmlnya'),
                'description'       => $this->input->post('utk'),
                'status'            => 'sudah',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

            $this->db->where('driver_id', $this->input->post('driver_id'));
            $this->db->update('wallets', [
                'balance'    => $this->input->post('balance') - $this->input->post('jmlnya'),
                'updated_at' => date('Y-m-d H:i:s')
            ]); 

            $this->session->set_flashdata('pesansukses', 'Form wallet berhasil diproses.');
        } else {
            $this->session->set_flashdata('pesanerror', 'Form Keperluan atau Jumlah tidak boleh kosong.');
        }
        
        redirect('wallet');
    }

}