<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model {

    private $table = 'users';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllPengguna() {
        $data = array();
        $this->db->from('users'); 
        $this->db->where('is_delete', 0);
        $this->db->where('username !=', 'febriansyah@gmail.com');
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

    public function getAllGroup() {
        $data = array();
        $this->db->from('groups');
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

    public function insert($dataUser) {
        $this->db->insert('users', $dataUser); 
    }

    public function insertUserG($dataUserG) {
        $this->db->insert('users_groups', $dataUserG); 
    }

    public function update($id, $dataUser) {
        return $this->db->where('id', $id)->update($this->table, $dataUser);
    }

    public function updateUserG($id, $dataUser) {
        return $this->db->where('id', $id)->update('users_groups', $dataUser);
    }
}
