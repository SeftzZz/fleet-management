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

    public function insert_transaction($data) {
        return $this->db->insert($this->transaction_table, $data);
    }
}
