<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet_model extends CI_Model {

    protected $table = 'wallets';
    protected $transaction_table = 'wallet_transactions';
    
    public function get_by_driver($driver_id) {
        return $this->db->get_where($this->table, [
            'driver_id' => $driver_id
        ])->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function update_by_ritasi_id($id_ritasi, $data) {
        $this->db->where('id_ritasi', $id_ritasi);
        return $this->db->update($this->transaction_table, $data);
    }

    public function updateWalletTransactionByIdWallets($id, $data) {
        $this->db->update($this->transaction_table, $data, $id);
        return $this->db->affected_rows();
    }

    public function updateWalletByIdDriver($id, $data) {
        $this->db->update($this->table, $data, $id);
        return $this->db->affected_rows();
    }

    public function update_nodo($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->transaction_table, $data);
    }

    public function insert_transaction($data) {
        return $this->db->insert($this->transaction_table, $data);
    }

    public function getAllWallet() {
        $this->db->select('wallets.id AS wallet_id, wallets.*, drivers.name, drivers.nik'); // Pilih field secara eksplisit
        $this->db->from('wallets');
        $this->db->join('drivers', 'wallets.driver_id = drivers.id');
        $this->db->where('wallets.is_delete', 0);
        $this->db->order_by('wallets.id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getWalletTransactionsByWalletId($id)
    {
        return $this->db
            ->where('id', $id)
            ->where('is_delete', 0)
            ->order_by('id', 'DESC')
            ->get('wallets')
            ->result();
    }

    public function getWalletTransactionsAll($wallet_id)
    {
        return $this->db
            ->where('wallet_id', $wallet_id)
            ->where('is_delete', 0)
            ->not_like('description', 'Uang Jalan DO -', 'after')
            ->order_by('id', 'ASC')
            ->get('wallet_transactions')
            ->result();
    }

    public function getWalletByDriverId($driver_id)
    {
        return $this->db
            ->select('wallets.*, wallets.id AS wallet_id, drivers.name AS driver_name') // alias id jadi wallet_id
            ->from('wallets')
            ->join('drivers', 'wallets.driver_id = drivers.id')
            ->where('wallets.is_delete', 0)
            ->where('wallets.driver_id', $driver_id)
            ->order_by('wallets.id', 'DESC')
            ->get()
            ->result();
    }

    public function getWalletTransactionsByTabungan($id)
    {
        return $this->db
            ->where('id_ritasi', $id)
            ->where('is_delete', 0)
            ->like('description', 'Tabungan DO -', 'after')
            ->get('wallet_transactions')
            ->row();
    }

    public function getTransactionById($id)
    {
        return $this->db
            ->where('id', $id)
            ->where('is_delete', 0)
            ->get('wallet_transactions')
            ->row();
    }

    public function getAllJmlTotalSaldo() {
        $this->db->select_sum('balance');
        $query = $this->db->get('wallets');
        $result = $query->row();
        $query->free_result();
        return $result->balance ?? 0;
    }

    public function getDriverWithHighestBalance() {
        $this->db->select('drivers.name, wallets.driver_id, wallets.balance');
        $this->db->from('wallets');
        $this->db->join('drivers', 'drivers.id = wallets.driver_id', 'left');
        $this->db->order_by('wallets.balance', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        $result = $query->row();
        $query->free_result();

        return $result ?? null;
    }

    public function getWalletBalanceByWalletId($wallet_id)
    {
        $this->db->select_sum('balance');
        $this->db->where('id', $wallet_id);
        $query = $this->db->get('wallets');
        $result = $query->row();
        $query->free_result();
        return $result->balance ?? 0;
    }

    var $column_order = array('name', 'balance', 'status_wallet', 'updated_at',null);
    var $column_search = array('name', 'balance', 'status_wallet');
    var $order = array('name' => 'asc');

    private function _get_datatables_queryWsupir() {
        $this->db->select('wallets.*, drivers.name');
        $this->db->from('wallets');
        $this->db->join('drivers', 'drivers.id = wallets.driver_id');
        $this->db->where('wallets.is_delete', 0);

        if(!empty($_POST['nmSupir'])) {
            $this->db->like('drivers.name', $_POST['nmSupir']);
        }
        if(!empty($_POST['statusWallet'])) {
            $this->db->where('wallets.status_wallet', $_POST['statusWallet']);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) $this->db->group_start();
                $this->db->like($item, $_POST['search']['value']);
                if ($i === count($this->column_search) - 1) $this->db->group_end();
                else $this->db->or_like($item, $_POST['search']['value']);
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']
            );
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    function get_datatablesWSupir() {
        $this->_get_datatables_queryWsupir();
        $length = $_POST['length'] ?? -1;
        $start  = $_POST['start'] ?? 0;

        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    function count_filteredWSupir() {
        $this->_get_datatables_queryWsupir();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allWSupir() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    var $column_order2 = array('updated_at', 'name', 'amount','description',null);
    var $column_search2 = array('updated_at', 'name', 'amount','description');
    var $order2 = array('tgl_klaim' => 'desc');

    private function _get_datatables_queryKlaimWallet() {
        $this->db->select('wallet_transactions.*, drivers.name');
        $this->db->from($this->transaction_table);
        $this->db->join('drivers', 'drivers.id = wallet_transactions.wallet_id');
        $this->db->where('wallet_transactions.transaction_type', 'debit');
        $this->db->where('wallet_transactions.is_delete', 0);
        $this->db->where('wallet_transactions.status', 'sudah');
        $this->db->not_like('wallet_transactions.description', 'Uang Jalan DO -', 'after');
        
        if (!empty($_POST['nmSupir'])) {
            $this->db->like('drivers.name', $_POST['nmSupir']);
        }
        if (!empty($_POST['blnKlaim'])) {
            $this->db->where('MID(wallet_transactions.tgl_klaim, 4, 2) =', $_POST['blnKlaim']);
        }
        if (!empty($_POST['thnKlaim'])) {
            $this->db->where('RIGHT(wallet_transactions.tgl_klaim, 4) =', $_POST['thnKlaim']);
        }

        $i = 0;
        if (!empty($_POST['search']['value'])) {
            foreach ($this->column_search2 as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                }
                $this->db->like($item, $_POST['search']['value']);
                if ($i === count($this->column_search2) - 1) {
                    $this->db->group_end();
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                $i++;
            }
        }

        $dtOrderMap = [
          0 => "STR_TO_DATE(wallet_transactions.tgl_klaim, '%d-%m-%Y')", // Tanggal
          1 => "drivers.name",                                            // Nama
          2 => "wallet_transactions.amount",                              // Jumlah
          3 => "wallet_transactions.description"                          // Keperluan
        ];

        if (isset($_POST['order'])) {
            $colIndex = (int) $_POST['order'][0]['column'];
            $dir      = $_POST['order'][0]['dir'] === 'asc' ? 'ASC' : 'DESC';
            $orderCol = $dtOrderMap[$colIndex] ?? $dtOrderMap[0];
            $this->db->order_by($orderCol, $dir, false); // false = jangan escape ekspresi
        } else {
            $this->db->order_by("STR_TO_DATE(wallet_transactions.tgl_klaim, '%d-%m-%Y')", 'DESC', false);
        }
    }

    function get_datatablesKlaimWallet() {
        $this->_get_datatables_queryKlaimWallet();
        $length = $_POST['length'] ?? -1;
        $start  = $_POST['start'] ?? 0;

        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    function count_filteredKlaimWallet() {
        $this->_get_datatables_queryKlaimWallet();
        return $this->db->get()->num_rows();
    }

    public function count_allKlaimWallet() {
        $this->db->from($this->transaction_table);
        return $this->db->count_all_results();
    }
}