<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

    private $table = 'log';

    var $column_order = array('nama_user', 'aktifitas', 'updated_at',null);
    var $column_search = array('nama_user', 'aktifitas');
    var $order = array('updated_at' => 'desc');

    private function _get_datatables_queryLog() {
        $this->db->select('*');
        $this->db->from('log');
        $this->db->order_by('updated_at', 'desc');

        if(!empty($_POST['nmUser'])) {
            $this->db->like('nama_user', $_POST['nmUser']);
        }
        if(!empty($_POST['tglLog'])) {
            $tglLog = date('Y-m-d', strtotime($_POST['tglLog']));
            $this->db->like('updated_at', $tglLog);
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

    function get_datatablesLog() {
        $this->_get_datatables_queryLog();
        $length = $_POST['length'] ?? -1;
        $start  = $_POST['start'] ?? 0;

        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    function count_filteredLog() {
        $this->_get_datatables_queryLog();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allLog() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getAllLog() {
        $data = array();
        $this->db->from('log'); 
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

    public function insert($dataLog) {
        return $this->db->insert($this->table, $dataLog);
    }
}
