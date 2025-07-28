<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori_model extends CI_Model {

    private $table = 'inventori';
    private $inventori_vehicles = 'inventori_vehicles';

    public function get_by_vehicle($no_pintu = null) {
        // Ambil semua data inventori dasar
        $this->db->select('i.id, i.name, i.qty as inventory_qty, iv.qty as vehicle_qty, iv.kondisi, iv.no_pintu');
        $this->db->from('inventori i');
        $this->db->join('inventori_vehicles iv', 'iv.inventori_id = i.id AND (iv.no_pintu = "'.($no_pintu ?? '').'")', 'left');
        
        $query = $this->db->get();
        $result = $query->result_array();
        
        // Format hasil
        $formatted = [];
        foreach ($result as $row) {
            $formatted[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'inventory_qty' => $row['inventory_qty'], // Qty dari tabel inventori
                'vehicle_qty' => $row['vehicle_qty'] ?? 0, // Qty dari inventori_vehicles (default 0 jika null)
                'kondisi' => $row['kondisi'] ?? '',
                'no_pintu' => $row['no_pintu'] ?? ''
            ];
        }
        
        return $formatted;
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

    public function get_all_inventori() {
        $data = array();
        $this->db->from('inventori');
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

    public function update_vehicle_inventory($inventori_id, $no_pintu, $no_pol, $data) {
        // Cek apakah data sudah ada
        $this->db->where('inventori_id', $inventori_id);
        $this->db->where('no_pintu', $no_pintu);
        if ($no_pol) {
            $this->db->where('no_pol', $no_pol);
        }
        $query = $this->db->get($this->inventori_vehicles);
        
        if ($query->num_rows() > 0) {
            // Update data yang ada
            $this->db->where('inventori_id', $inventori_id);
            $this->db->where('no_pintu', $no_pintu);
            if ($no_pol) {
                $this->db->where('no_pol', $no_pol);
            }
            return $this->db->update($this->inventori_vehicles, $data);
        } else {
            // Insert data baru
            $data['inventori_id'] = $inventori_id;
            $data['no_pintu'] = $no_pintu;
            if ($no_pol) {
                $data['no_pol'] = $no_pol;
            }
            return $this->db->insert($this->inventori_vehicles, $data);
        }
    }
}
