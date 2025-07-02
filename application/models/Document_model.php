<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model {

    private $table = 'documents';

    public function get_by_vehicle($vehicle_id) {
        return $this->db->get_where($this->table, ['vehicle_id' => $vehicle_id])->result_array();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
