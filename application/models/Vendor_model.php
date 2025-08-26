<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

    private $table = 'vendors';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllVendor() {
        $data = array();
        $this->db->from('vendors'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('name', 'ASC');
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

    public function getAllVendorAktif() {
        $data = array();
        $this->db->from('vendors'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status', 'Aktif');
        $this->db->order_by('name', 'ASC');
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

    public function getVendorById($id) {
        $data = array();
        $this->db->from('vendors');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function insert($dataVendor) {
        return $this->db->insert($this->table, $dataVendor);
    }

    public function update($id, $dataVendor) {
        return $this->db->where('id', $id)->update($this->table, $dataVendor);
    }

    public function update_item($id, $dataVendorItem) {
        return $this->db->where('id', $id)->update("vendor_items", $dataVendorItem);
    }

    public function updateItemByIdVendor($id, $dataVendorItem) {
        return $this->db->where('vendor_id', $id)->update("vendor_items", $dataVendorItem);
    }

    public function getAllVendorItems($id) {
        $data = array();
        $this->db->from('vendor_items');    
        $this->db->where('vendor_id', $id);
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

    public function insert_items($dataVendor) {
        return $this->db->insert("vendor_items", $dataVendor);
    }
}
