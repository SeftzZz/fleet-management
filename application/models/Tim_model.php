<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tim_model extends CI_Model {

    private $table = 'tim';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllTim() {
        $data = array();
        $this->db->from('tim'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('nama_tim', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
        }
        $query->free_result();  
        return $data;    
    }

    public function getAllTimAktif() {
        $data = array();
        $this->db->from('tim'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status_tim', 'Aktif');
        $this->db->order_by('nama_tim', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
        }
        $query->free_result();  
        return $data;    
    }

    public function getTimById($id) {
        $data = array();
        $this->db->from('tim');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function insert($dataTim) {
        return $this->db->insert($this->table, $dataTim);
    }

    public function update($id, $dataTim) {
        return $this->db->where('id', $id)->update($this->table, $dataTim);
    }
}
