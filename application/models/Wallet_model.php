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

    public function update_nodo($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->transaction_table, $data);
    }

    public function insert_transaction($data) {
        return $this->db->insert($this->transaction_table, $data);
    }

    public function getAllWallet() {
        $this->db->select('wallets.id AS wallet_id, wallets.*, drivers.name'); // Pilih field secara eksplisit
        $this->db->from('wallets');
        $this->db->join('drivers', 'wallets.driver_id = drivers.id');
        $this->db->where('wallets.is_delete', 0);
        $this->db->order_by('wallets.id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getWalletTransactionsByWalletId($wallet_id)
    {
        return $this->db
            ->where('wallet_id', $wallet_id)
            ->where('is_delete', 0)
            ->order_by('id', 'DESC')
            ->get('wallet_transactions')
            ->result();
    }

    public function getWalletTransactionsAll($wallet_id)
    {
        return $this->db
            ->where('wallet_id', $wallet_id)
            ->where('is_delete', 0)
            ->not_like('description', 'Uang Jalan DO - ', 'after')
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
            ->like('description', 'Tabungan DO - ', 'after')
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

}