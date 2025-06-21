<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek_model extends CI_Model {

    private $table = 'proyek';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllProyek() {
        $data = array();
        $this->db->from('proyek'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('nama_proyek', 'ASC');
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

    public function getAllProyekAktif() {
        $data = array();
        $this->db->from('proyek'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status_proyek', 'Aktif');
        $this->db->order_by('nama_proyek', 'ASC');
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

    public function getProyekById($id) {
        $data = array();
        $this->db->from('proyek');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function insert($dataProyek) {
        return $this->db->insert($this->table, $dataProyek);
    }

    public function update($id, $dataProyek) {
        return $this->db->where('id', $id)->update($this->table, $dataProyek);
    }
}
