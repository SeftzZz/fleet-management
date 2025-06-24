<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timmgmt_model extends CI_Model {

    private $table = 'tim_mgmt';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllTimMgmt() {
        $data = array();
        $this->db->from('tim_mgmt'); 
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

    public function getAllTimMgmtAktif() {
        $data = array();
        $this->db->from('tim_mgmt'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status_tim_mgmt', 'Aktif');
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

    public function getAllTimMgmtByFilter($caritim,$carisupir,$carimobil,$caristatus) {
        $data = array();
        $this->db->from('tim_mgmt'); 
        $this->db->where('is_delete', 0);
        if ($caritim) {
            $this->db->where('tim_id', $caritim);
        }
        if ($carisupir) {
            $this->db->like('nama_supir', $carisupir);
        }
        if ($carimobil) {
            $this->db->like('no_pol', $carimobil);
        }
        if ($caristatus) {
            $this->db->where('status_tim_mgmt', $caristatus);
        }
        $this->db->order_by('nama_tim', 'ASC');
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

    public function getKendaraanTimByIdMobil($id) {
        $data = array();
        $this->db->select('drivers.id, drivers.name, tim.nama_tim'); 
        $this->db->from('tim_mgmt');    
        $this->db->join('drivers', 'drivers.id = tim_mgmt.driver_id');
        $this->db->join('tim', 'tim.id = tim_mgmt.tim_id');
        $this->db->where('tim_mgmt.vehicle_id', $id);
        $this->db->where('tim_mgmt.status_tim_mgmt', 'Aktif');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function insert($dataAtim) {
        return $this->db->insert($this->table, $dataAtim);
    }

    public function update($id, $dataAtim) {
        return $this->db->where('id', $id)->update($this->table, $dataAtim);
    }

    public function getKendaraanByTimId($tim_id) {
        $this->db->select('vehicle_id, no_pol');
        $this->db->from('tim_mgmt');
        $this->db->where('tim_id', $tim_id);
        $this->db->where('is_delete', 0);
        $this->db->where('status_tim_mgmt', 'Aktif');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function nonAktifkanTimByVehicleDanDriver($no_pol, $driver_id)
    {
        // Nonaktifkan semua tim_mgmt aktif dengan kendaraan ini
        $this->db->where('no_pol', $no_pol);
        $this->db->where('status_tim_mgmt', 'Aktif');
        $this->db->where('is_delete', 0);
        $this->db->update('tim_mgmt', [
            'status_tim_mgmt' => 'Non Aktif',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Nonaktifkan semua tim_mgmt aktif milik supir ini
        $this->db->where('driver_id', $driver_id);
        $this->db->where('status_tim_mgmt', 'Aktif');
        $this->db->where('is_delete', 0);
        $this->db->update('tim_mgmt', [
            'status_tim_mgmt' => 'Non Aktif',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timmgmt_model extends CI_Model {

    private $table = 'tim_mgmt';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getAllTimMgmt() {
        $data = array();
        $this->db->from('tim_mgmt'); 
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

    public function getAllTimMgmtAktif() {
        $data = array();
        $this->db->from('tim_mgmt'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status_tim_mgmt', 'Aktif');
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

    public function getAllTimMgmtByFilter($caritim,$carisupir,$carimobil,$caristatus) {
        $data = array();
        $this->db->from('tim_mgmt'); 
        $this->db->where('is_delete', 0);
        if ($caritim) {
            $this->db->where('tim_id', $caritim);
        }
        if ($carisupir) {
            $this->db->like('nama_supir', $carisupir);
        }
        if ($carimobil) {
            $this->db->like('no_pol', $carimobil);
        }
        if ($caristatus) {
            $this->db->where('status_tim_mgmt', $caristatus);
        }
        $this->db->order_by('nama_tim', 'ASC');
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

    public function getKendaraanTimByIdMobil($id) {
        $data = array();
        $this->db->select('drivers.id, drivers.name, tim.nama_tim'); 
        $this->db->from('tim_mgmt');    
        $this->db->join('drivers', 'drivers.id = tim_mgmt.driver_id');
        $this->db->join('tim', 'tim.id = tim_mgmt.tim_id');
        $this->db->where('tim_mgmt.vehicle_id', $id);
        $this->db->where('tim_mgmt.status_tim_mgmt', 'Aktif');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function insert($dataAtim) {
        return $this->db->insert($this->table, $dataAtim);
    }

    public function update($id, $dataAtim) {
        return $this->db->where('id', $id)->update($this->table, $dataAtim);
    }

    public function getKendaraanByTimId($tim_id) {
        $this->db->select('vehicle_id, no_pol');
        $this->db->from('tim_mgmt');
        $this->db->where('tim_id', $tim_id);
        $this->db->where('is_delete', 0);
        $this->db->where('status_tim_mgmt', 'Aktif');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function nonAktifkanTimByVehicleDanDriver($no_pol, $driver_id)
    {
        // Nonaktifkan semua tim_mgmt aktif dengan kendaraan ini
        $this->db->where('no_pol', $no_pol);
        $this->db->where('status_tim_mgmt', 'Aktif');
        $this->db->where('is_delete', 0);
        $this->db->update('tim_mgmt', [
            'status_tim_mgmt' => 'Non Aktif',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Nonaktifkan semua tim_mgmt aktif milik supir ini
        $this->db->where('driver_id', $driver_id);
        $this->db->where('status_tim_mgmt', 'Aktif');
        $this->db->where('is_delete', 0);
        $this->db->update('tim_mgmt', [
            'status_tim_mgmt' => 'Non Aktif',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
