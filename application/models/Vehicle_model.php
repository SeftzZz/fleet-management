<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model {

    private $table = 'vehicles';
    private $tableDocument = 'vehicle_documents';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function insertDocument($data) {
        return $this->db->insert($this->tableDocument, $data);
    }

    public function update($id, $dataVehicles) {
        return $this->db->where('id', $id)->update($this->table, $dataVehicles);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function getAllVehicles() {
        $data = array();
        $this->db->from('vehicles'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('id', 'DESC');
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

    public function getAllKendaraanAktif() {
        $data = array();
        $this->db->from('vehicles'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status', 'Aktif');
        $this->db->order_by('id', 'DESC');
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

    public function getKendaraanById($id) {
        $data = array();
        $this->db->from('vehicles');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function getAllVehiclesByFilter($carinopol,$carinopintu,$caristatus) {
        $data = array();
        $this->db->from('vehicles'); 
        $this->db->where('is_delete', 0);
        if ($carinopol) {
            $this->db->like('no_pol', $carinopol);
        }
        if ($carinopintu) {
            $this->db->where('no_pintu', $carinopintu);
        }
        if ($caristatus) {
            $this->db->where('status', $caristatus);
        }
        $this->db->order_by('id', 'ASC');
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

    public function getAllVDocDetail() {
        $data = array();
        $this->db->from('v_doc_detail'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status', 'Aktif');
        $this->db->order_by('id', 'DESC');
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
}
