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

    public function update2($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
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

    var $column_order = array('name', 'qty',null);
    var $column_search = array('name', 'qty');
    var $order = array('name' => 'asc');

    private function _get_datatables_query($filter_qty = '') {
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('is_delete', 0);

        if(!empty($_POST['nmVendor'])) {
            $this->db->like('name', $_POST['nmVendor']);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) $this->db->group_start();
                $this->db->like($item, $_POST['search']['value']);
                if ($i === count($this->column_search) - 1) $this->db->group_end();
                else $this->db->or_like($item, $_POST['search']['value']);
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']
            );
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    function get_datatables($filter_qty = '') {
        $this->_get_datatables_query($filter_qty);
        $length = $_POST['length'] ?? -1;
        $start  = $_POST['start'] ?? 0;

        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    function count_filtered($filter_qty = '') {
        $this->_get_datatables_query($filter_qty);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from('vendors');
        $this->db->where('is_delete', 0);
        return $this->db->count_all_results();
    }
}
