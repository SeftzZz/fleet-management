<?php
class Api_m extends CI_Model {

    public function get_all($table) {
        return $this->db->get($table)->result();
    }

    public function get_by_id($table, $id, $key) {
        return $this->db->get_where($table, [$key => $id])->row();
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $data, $id, $key) {
        $this->db->where($key, $id);
        return $this->db->update($table, $data);
    }

    public function delete($table, $id, $key) {
        $this->db->where($key, $id);
        return $this->db->delete($table);
    }
}
