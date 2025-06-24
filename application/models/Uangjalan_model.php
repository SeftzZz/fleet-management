<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uangjalan_model extends CI_Model {

    private $table = 'uangjalan';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getUangJalanByGalianId($galian_id) {
        return $this->db->get_where($this->table, [
            'galian_id' => $galian_id,
            'status_uangjalan' => 'Aktif',
            'is_delete' => 0
        ])->row(); // Mengembalikan hasil sebagai objek
    }

    public function getAllUangJalan() {
        $data = array();
        $this->db->from('uangjalan'); 
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

    public function getAllUangJalanAktif() {
        $data = array();
        $this->db->from('uangjalan'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status_uangjalan', 'Aktif');
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

    public function getAllTabunganAktif() {
        return $this->db->get_where('tabungan', [
            'status' => 'Aktif',
            'is_delete' => 0
        ])->row();
    }

    public function insert($dataUjalan) {
        return $this->db->insert($this->table, $dataUjalan);
    }

    public function update($id, $dataUjalan) {
        return $this->db->where('id', $id)->update($this->table, $dataUjalan);
    }

    public function nonAktifkanUangJalanByGalian($galian_id) {
        $this->db->where('galian_id', $galian_id);
        $this->db->where('status_uangjalan', 'Aktif');
        $this->db->where('is_delete', 0);
        $this->db->update('uangjalan', [
            'status_uangjalan' => 'Non Aktif',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uangjalan_model extends CI_Model {

    private $table = 'uangjalan';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function getUangJalanByGalianId($galian_id) {
        return $this->db->get_where($this->table, [
            'galian_id' => $galian_id,
            'status_uangjalan' => 'Aktif',
            'is_delete' => 0
        ])->row(); // Mengembalikan hasil sebagai objek
    }

    public function getAllUangJalan() {
        $data = array();
        $this->db->from('uangjalan'); 
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

    public function getAllUangJalanAktif() {
        $data = array();
        $this->db->from('uangjalan'); 
        $this->db->where('is_delete', 0);
        $this->db->where('status_uangjalan', 'Aktif');
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

    public function getAllTabunganAktif() {
        return $this->db->get_where('tabungan', [
            'status' => 'Aktif',
            'is_delete' => 0
        ])->row();
    }

    public function insert($dataUjalan) {
        return $this->db->insert($this->table, $dataUjalan);
    }

    public function update($id, $dataUjalan) {
        return $this->db->where('id', $id)->update($this->table, $dataUjalan);
    }

    public function nonAktifkanUangJalanByGalian($galian_id) {
        $this->db->where('galian_id', $galian_id);
        $this->db->where('status_uangjalan', 'Aktif');
        $this->db->where('is_delete', 0);
        $this->db->update('uangjalan', [
            'status_uangjalan' => 'Non Aktif',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
