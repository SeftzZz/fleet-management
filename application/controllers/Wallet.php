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
            ->where('transaction_type', 'debit')
            ->where('status', 'sudah')
            ->where('is_delete', 0)
            ->not_like('description', 'Uang Jalan DO -', 'after')
            ->order_by('tgl_klaim', 'DESC')
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
        $wallet_id = $this->input->post('wallet_id');
        $driver_id = $this->input->post('driver_id');
        $current_balance = $this->Wallet_model->getWalletBalanceByWalletId($wallet_id);

        if ($this->input->post('utk') && $this->input->post('jmlnya')) {
            $amount = $this->input->post('jmlnya');

            $this->db->insert('wallet_transactions', [
                'wallet_id'         => $wallet_id,
                'transaction_type'  => $this->input->post('transaksiTipe'),
                'amount'            => $amount,
                'tgl_klaim'         => $this->input->post('tgl_klaim'),
                'description'       => $this->input->post('utk'),
                'status'            => 'sudah',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ]);

            // Kurangi saldo berdasarkan balance dari DB, bukan dari input form
            $new_balance = $current_balance - $amount;

            $this->db->where('id', $wallet_id);
            $this->db->update('wallets', [
                'balance'    => $new_balance,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // insert tabel log  
            $this->db->select('name'); 
            $this->db->from('drivers'); 
            $this->db->where('id', $wallet_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $supir = $query->row();
            } 
            $query->free_result();

            $dataLog = array(
                'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
                'aktifitas'     => 'Membuat form klaim wallet '.$supir->name.' sebesar '.$amount,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            );                              
            $this->Log_model->insert($dataLog); 

            $this->session->set_flashdata('pesansukses', 'Form wallet berhasil diproses.');
        } else {
            $this->session->set_flashdata('pesanerror', 'Form Keperluan atau Jumlah tidak boleh kosong.');
        }
        
        redirect('wallet');
    }

    public function walletlog() {
        $data = [
            "title"  => "Data Klaim Wallet | Fleet Management System",
            "nopage" => 1072,
        ];

        $this->load->view('headernew', $data);
        $this->load->view('wallet_claimlog', $data);
        $this->load->view('footernew');
    }

    public function ajax_listklaimwallet() {
        $list = $this->Wallet_model->get_datatablesKlaimWallet();
        $data = array();
        $no = $_POST['start'] ?? 0;
        foreach ($list as $klaimwallet) {
            $no++;
            $row = array();
            $row[] = $klaimwallet->tgl_klaim;
            $row[] = $klaimwallet->name;
            $row[] = $this->fppfunction->rupiah_ind($klaimwallet->amount);
            $row[] = $klaimwallet->description;
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_POST['draw'] ?? 1),
            "recordsTotal" => $this->Wallet_model->count_allKlaimWallet(),
            "recordsFiltered" => $this->Wallet_model->count_filteredKlaimWallet(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}