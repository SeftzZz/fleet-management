<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ritasi_model extends CI_Model {

    protected $table = 'ritasi';

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
