<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends CI_Model {

    private $table = 'maintenance_logs';

    public function get_by_vehicle($vehicle_id) {
        return $this->db->get_where($this->table, ['vehicle_id' => $vehicle_id])->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends CI_Model {

    private $table = 'maintenance_logs';

    public function get_by_vehicle($vehicle_id) {
        return $this->db->get_where($this->table, ['vehicle_id' => $vehicle_id])->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
