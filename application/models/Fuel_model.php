<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fuel_model extends CI_Model {

    private $table = 'fuel_logs';

    public function get_by_vehicle($vehicle_id) {
        return $this->db->get_where($this->table, ['vehicle_id' => $vehicle_id])->result_array();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }
}
