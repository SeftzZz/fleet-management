<<<<<<< HEAD
<?php
class Api_m extends CI_Model {

    public function get_all($table) {
        return $this->db->get($table)->result();
    }

    public function get_by_id($table, $id, $key) {
        return $this->db->get_where($table, [$key => $id])->row();
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $data, $id, $key) {
        $this->db->where($key, $id);
        return $this->db->update($table, $data);
    }

    public function delete($table, $id, $key) {
        $this->db->where($key, $id);
        return $this->db->delete($table);
    }

    public function cek_user($email, $password_hash){
        $data = array();
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password_hash', $password_hash);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }
}
=======
<?php
class Api_m extends CI_Model {

    public function get_all($table) {
        return $this->db->get($table)->result();
    }

    public function get_by_id($table, $id, $key) {
        return $this->db->get_where($table, [$key => $id])->row();
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $data, $id, $key) {
        $this->db->where($key, $id);
        return $this->db->update($table, $data);
    }

    public function delete($table, $id, $key) {
        $this->db->where($key, $id);
        return $this->db->delete($table);
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
