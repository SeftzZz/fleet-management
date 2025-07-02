<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'users';

    public function authenticate($email, $password) {
        return $this->db->get_where($this->table, [
            'email' => $email,
            'password' => md5($password)
        ])->row_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
}
