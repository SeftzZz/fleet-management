<<<<<<< HEAD
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
=======
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
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
