<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Route_model extends CI_Model {

    private $table = 'routes';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function get_routes($limit, $offset) {
        $this->db->select('*');
        $this->db->from('routes');
        $this->db->limit($limit, $offset);
        $this->db->order_by('start_point', 'ASC');
        return $this->db->get()->result();
    }

    public function count_routes() {
        return $this->db->count_all('routes');
    }
}
