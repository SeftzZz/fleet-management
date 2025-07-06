<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_model extends CI_Model {

    private $table = 'drivers';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($dataSupir) {
        return $this->db->insert($this->table, $dataSupir);
    }

    public function update($id, $dataSupir) {
        return $this->db->where('id', $id)->update($this->table, $dataSupir);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function getAllSupir() {
        $data = array();
        $this->db->from('drivers'); 
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

    public function getAllSupirAktif() {
        $data = array();
        $this->db->from('drivers'); 
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

    public function getSupirById($id) {
        $data = array();
        $this->db->from('drivers');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();
        return $data;
    }

    public function getAllSupirByFilter($carisupir,$cariunit,$caritanggal,$caristatus) {
        $data = array();
        $this->db->from('drivers');
        $this->db->join('tim_mgmt', 'tim_mgmt.driver_id=drivers.id');
        $this->db->where('drivers.is_delete', 0);
        if ($carisupir) {
            $this->db->like('name', $carisupir);
        }
        if ($cariunit) {
            $this->db->like('no_pintu', $cariunit);
        }
        if ($caritanggal) {
            $this->db->like('tgl_join', $caritanggal);
        }
        if ($caristatus) {
            $this->db->where('status', $caristatus);
        }
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

    public function getAllSupirByFilterID($driver_id) {
        $data = array();
        $this->db->from('drivers'); 
        $this->db->where('is_delete', 0);
        if ($driver_id) {
            $this->db->like('id', $driver_id);
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
}
