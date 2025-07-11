<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_model extends CI_Model {

    private $table = 'drivers';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_idOld1($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($dataSupir) {
        return $this->db->insert($this->table, $dataSupir);
    }

    public function update2($id, $dataSupir) {
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
        $this->db->from('tim_mgmt');
        $this->db->join('drivers', 'drivers.id=tim_mgmt.driver_id');
        $this->db->where('drivers.is_delete', 0);
        if ($carisupir) {
            $this->db->like('drivers.name', $carisupir);
        }
        if ($cariunit) {
            $this->db->like('tim_mgmt.no_pintu', $cariunit);
        }
        if ($caritanggal) {
            $this->db->like('drivers.tgl_join', $caritanggal);
        }
        if ($caristatus) {
            $this->db->where('drivers.status', $caristatus);
        }
        $this->db->order_by('drivers.name', 'ASC');
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

    var $column_order = array('name', 'tgl_join', 'phone', 'nomor_darurat', 'license_number', 'no_pintu', 'status', null, null);
    var $column_search = array('name', 'tgl_join', 'phone', 'nomor_darurat', 'license_number', 'no_pintu', 'status');
    var $order = array('name' => 'asc');

    private function _get_datatables_query() {
        $this->db->from($this->table);
        $this->db->where('is_delete', 0);

        if(!empty($_POST['nmSupir'])) {
            $this->db->like('name', $_POST['nmSupir']);
        }
        if(!empty($_POST['noPintu'])) {
            $this->db->where('no_pintu', $_POST['noPintu']);
        }
        if(!empty($_POST['tglJoin'])) {
            $this->db->where('tgl_join', $_POST['tglJoin']);
        }
        if(!empty($_POST['statusSupir'])) {
            $this->db->where('status', $_POST['statusSupir']);
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

    function get_datatables() {
        $this->_get_datatables_query();
        $length = $_POST['length'] ?? -1;
        $start  = $_POST['start'] ?? 0;

        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
