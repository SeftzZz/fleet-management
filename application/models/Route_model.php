<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Route_model extends CI_Model {

    private $table = 'routes';

    public function get_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($dataRoute) {
        return $this->db->insert($this->table, $dataRoute);
    }

    public function update($id, $dataRoute) {
        return $this->db->where('id', $id)->update($this->table, $dataRoute);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function count_routes() {
        return $this->db->count_all('routes');
    }

    public function get_routes($limit, $offset) {
        $this->db->select('*');
        $this->db->from('routes');
        $this->db->limit($limit, $offset);
        $this->db->order_by('start_point', 'ASC');
        return $this->db->get()->result();
    }

    public function getAllRoutes() {
        $data = array();
        $this->db->from('routes'); 
        $this->db->where('is_delete', 0);
        $this->db->order_by('start_point', 'ASC');
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

    public function getAllRitasi() {
        $data = array();
        $this->db->from('ritasi'); 
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

    public function insertRitasi($dataRitasi) {
        $this->db->insert('ritasi', $dataRitasi); 
    }

    public function updateRitasi($id, $dataRitasi) {
        $this->db->where('id', $id);
        $this->db->update('ritasi', $dataRitasi);
    }

    public function getAllRitasiByFilter($caritim,$cariproyek,$caritanggal,$carilokasi) {
        $data = array();
        $this->db->from('ritasi'); 
        $this->db->where('is_delete', 0);
        if ($caritanggal) {
            $this->db->like('tgl_ritasi', $caritanggal);
        }
        if ($caritim) {
            $this->db->where('tim_id', $caritim);
        }
        if ($cariproyek) {
            $this->db->like('proyek_id', $cariproyek);
        }
        if ($carilokasi) {
            $this->db->like('galian_id', $carilokasi);
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

    public function getLastInsertedRitasiSummary()
    {
        $this->db->select('MAX(nama_proyek) AS nama_proyek, MAX(lokasi) AS lokasi, MAX(nama_tim) AS nama_tim, COUNT(vehicle_id) AS jumlah_kendaraan');
        $this->db->from('ritasi');
        $this->db->where('is_delete', 0);
        $this->db->group_by(['tgl_ritasi', 'tim_id', 'proyek_id', 'galian_id']);
        $this->db->order_by('MAX(created_at)', 'DESC'); // Untuk mengurutkan berdasarkan ritasi terbaru
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function getRitasiByIds($ids) {
        $this->db->from('ritasi');
        $this->db->where_in('id', $ids);
        $this->db->where('is_delete', 0);
        return $this->db->get()->result();
    }

    public function getKendaraanUsedInRitasi($ids) {
        $this->db->select('vehicles.id as vehicle_id, vehicles.no_pol');
        $this->db->from('ritasi');
        $this->db->join('vehicles', 'ritasi.vehicle_id = vehicles.id');
        $this->db->where_in('ritasi.id', $ids);
        $this->db->group_by('ritasi.vehicle_id');
        return $this->db->get()->result();
    }

    public function getRitasiByFilters($tanggal, $proyek_id, $galian_id, $tim_id) {
        $this->db->select('ritasi.*, vehicles.no_pol');
        $this->db->from('ritasi');
        $this->db->join('vehicles', 'vehicles.id = ritasi.vehicle_id');
        $this->db->where('ritasi.tgl_ritasi', $tanggal);
        $this->db->where('ritasi.proyek_id', $proyek_id);
        $this->db->where('ritasi.galian_id', $galian_id);
        $this->db->where('ritasi.tim_id', $tim_id);
        $this->db->where('ritasi.is_delete', 0);
        return $this->db->get()->result();
    }
}
