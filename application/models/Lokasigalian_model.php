<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasigalian_model extends CI_Model {

    private $table = 'galian';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllGalianByLokasi() {
        $data = array();
        $this->db->from('galian'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('lokasi', 'ASC');
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

    public function getAllGalianAktif() {
        $data = array();
        $this->db->from('galian'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('lokasi', 'ASC');
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

    public function getGalianById($id) {
        $data = array();
        $this->db->from('galian');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function insert($dataGalian) {
        return $this->db->insert($this->table, $dataGalian);
    }

    public function update($id, $dataGalian) {
        return $this->db->where('id', $id)->update($this->table, $dataGalian);
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasigalian_model extends CI_Model {

    private $table = 'galian';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllGalianByLokasi() {
        $data = array();
        $this->db->from('galian'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('lokasi', 'ASC');
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

    public function getAllGalianAktif() {
        $data = array();
        $this->db->from('galian'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('lokasi', 'ASC');
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

    public function getGalianById($id) {
        $data = array();
        $this->db->from('galian');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function insert($dataGalian) {
        return $this->db->insert($this->table, $dataGalian);
    }

    public function update($id, $dataGalian) {
        return $this->db->where('id', $id)->update($this->table, $dataGalian);
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
