<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori_model extends CI_Model {

    private $table = 'inventori';
    private $inventori_vehicles = 'inventori_vehicles';
    private $tablePengajuan = 'form_pengajuan';

    public function get_by_vehicle($no_pintu = null) {
        // Ambil semua data inventori dasar
        $this->db->select('i.id, i.sparepart, i.qty as inventory_qty, iv.qty as vehicle_qty, iv.kondisi, iv.no_pintu');
        $this->db->from('inventori i');
        $this->db->join('inventori_vehicles iv', 'iv.inventori_id = i.id AND (iv.no_pintu = "'.($no_pintu ?? '').'")', 'left');
        
        $query = $this->db->get();
        $result = $query->result_array();
        
        // Format hasil
        $formatted = [];
        foreach ($result as $row) {
            $formatted[] = [
                'id' => $row['id'],
                'sparepart' => $row['sparepart'],
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
        $displayed_name = array();
        $data = array();
        $this->db->from('vendor_items');
        $this->db->where('status', 'Aktif');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                if (!in_array($row->sparepart, $displayed_name)) {
                    // Add the invoice to the list of displayed invoices
                    $displayed_name[] = $row->sparepart;
                    $data[] = $row;
                }
            } 
        }
        $query->free_result();  
        return $data;  
    }

    public function get_all_vendor() {
        $data = array();
        $this->db->from('vendors');
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

    public function generate_no_po($vendor_id) {
        $prefix = 'KMJP';

        // Bulan-tahun sekarang (MMYY)
        $dateCode = date('my'); // contoh: 0125

        // Tahun sekarang (YYYY) → untuk reset
        $yearNow = date('Y');

        // Ambil data vendor
        $vendor = $this->db->where('id', $vendor_id)->get('vendors')->row();
        if (!$vendor) {
            return null;
        }

        $vendorCode = strtoupper($vendor->kode);

        // Format dasar: KMJP/MS/0125
        $baseCode = $prefix . '/' . $vendorCode . '/' . $dateCode;

        // Cari nomor terakhir untuk vendor ini
        $this->db->like('no_po', $prefix . '/' . $vendorCode . '/', 'after');
        $this->db->where('kode', $vendorCode);
        $this->db->order_by('no_po', 'DESC');
        $this->db->limit(1);
        $last = $this->db->get('vendors')->row();

        if ($last && !empty($last->no_po)) {
            // Ambil tahun dari no_po terakhir
            preg_match('/\d{2}(\d{2})-/', $last->no_po, $matches);
            $lastYear = isset($matches[1]) ? ('20' . $matches[1]) : null;

            if ($lastYear == $yearNow) {
                $lastNumber = (int)substr($last->no_po, strrpos($last->no_po, '-') + 1);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1; // reset jika tahun berbeda
            }
        } else {
            $newNumber = 1;
        }

        // Format nomor 4 digit (0001, 0002, dst.)
        $numberFormatted = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // Hasil akhir
        $finalCode = $baseCode . '-' . $numberFormatted;

        return $finalCode;
    }

    public function get_all_inventori_gudang()
    {
        return $this->db->select('sparepart, SUM(qty) as qty, MAX(created_at) as created_at') // tambahkan kolom lain sesuai kebutuhan
                        ->from('inventori')
                        ->group_by('sparepart')
                        ->order_by('sparepart', 'ASC')
                        ->get()
                        ->result();
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

    var $column_orderPengajuan = array(null, 'tanggal', 'nama', 'status', null);
    var $column_searchPengajuan = array('tanggal','nama');
    var $orderPengajuan = array('tanggal' => 'desc');

    private function _get_datatables_queryPengajuan() {
        $this->db->select('*');
        $this->db->from('form_pengajuan');
        $this->db->order_by('tanggal', 'desc');

        if(!empty($_POST['tglPengajuan'])) {
            $tglPengajuan = date('d-m-Y', strtotime($_POST['tglPengajuan']));
            $this->db->like('tanggal', $tglPengajuan);
        }

        $i = 0;
        foreach ($this->column_searchPengajuan as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) $this->db->group_start();
                $this->db->like($item, $_POST['search']['value']);
                if ($i === count($this->column_searchPengajuan) - 1) $this->db->group_end();
                else $this->db->or_like($item, $_POST['search']['value']);
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_orderPengajuan[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']
            );
        } else {
            $order = $this->orderPengajuan;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatablesPengajuan() {
        $this->_get_datatables_queryPengajuan();
        $length = $_POST['length'] ?? -1;
        $start  = $_POST['start'] ?? 0;

        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    public function count_filteredPengajuan() {
        $this->_get_datatables_queryPengajuan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allPengajuan() {
        $this->db->from($this->tablePengajuan);
        return $this->db->count_all_results();
    }

    public function get_all_pengajuan() {
        $data = array();
        $this->db->from('form_pengajuan');
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

    public function get_all_pengajuan_detail($pengajuan_id) {
        $data = array();
        $this->db->from('form_pengajuan_detail');
        $this->db->where('pengajuan_id', $pengajuan_id);
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

    public function get_pengajuan_by_id($id)
    {
        return $this->db->get_where('form_pengajuan', ['id' => $id])->row();
    }

    public function get_all_pengajuan_with_purchasing()
    {
        return $this->db->select('form_pengajuan.*, form_purchasing.id as form_purchasing_id, form_purchasing.nama_po, form_purchasing.divisi_po, form_purchasing.jabatan_po, form_purchasing.tanggal_po')
                        ->from('form_pengajuan')
                        ->join('form_purchasing', 'form_purchasing.pengajuan_id = form_pengajuan.id', 'left')
                        ->order_by('form_pengajuan.created_at', 'DESC')
                        ->get()
                        ->result();
    }

    public function get_pengajuan_by_pengajuan_id($pengajuan_id)
    {
        return $this->db->select('form_pengajuan.*, form_purchasing.id as form_purchasing_id, form_purchasing.nama_po, form_purchasing.divisi_po, form_purchasing.jabatan_po, form_purchasing.tanggal_po')
                        ->from('form_pengajuan')
                        ->join('form_purchasing', 'form_purchasing.pengajuan_id = form_pengajuan.id', 'left')
                        ->where('form_pengajuan.id', $pengajuan_id)
                        ->get()
                        ->row();
    }

    public function get_pengajuan_by_purchasing_id($purchasing_id)
    {
        return $this->db->select('form_pengajuan.*, form_purchasing.id as form_purchasing_id, form_purchasing.nama_po, form_purchasing.divisi_po, form_purchasing.jabatan_po, form_purchasing.tanggal_po')
                        ->from('form_pengajuan')
                        ->join('form_purchasing', 'form_purchasing.pengajuan_id = form_pengajuan.id', 'left')
                        ->where('form_purchasing.id', $purchasing_id)
                        ->get()
                        ->row();
    }

    public function get_all_pengajuan_detail_with_vendor($pengajuan_id)
    {
        $this->db->select('d.*, d.id as form_pengajuan_detail_id, vi.vendor_id');
        $this->db->from('form_pengajuan_detail d');
        $this->db->join('vendor_items vi', 'vi.id = d.vendor_item_id', 'left');
        $this->db->where('d.pengajuan_id', $pengajuan_id);
        return $this->db->get()->result();
    }

    public function get_all_vendor_items() {
        $this->db->from('vendor_items');
        $this->db->where('status', 'Aktif');
        $this->db->order_by('harga', 'ASC'); // Urutkan berdasarkan harga dari paling murah
        return $this->db->get()->result();
    }

    public function kurangi_stok_fifo($sparepart, $kondisi, $jumlah)
    {
        // Ambil data inventori berdasarkan FIFO (urutan terlama)
        $this->db->where('sparepart', $sparepart);
        $this->db->where('kondisi', $kondisi);
        $this->db->where('qty >', 0);
        $this->db->where('is_delete', 0);
        $this->db->order_by('created_at', 'ASC');
        $query = $this->db->get('inventori');

        $sisa = (int)$jumlah;

        foreach ($query->result() as $row) {
            if ($sisa <= 0) break;

            $ambil = min($sisa, $row->qty);

            $this->db->set('qty', 'qty - ' . $ambil, false);
            $this->db->set('is_used', 'is_used + ' . $ambil, false);
            $this->db->where('id', $row->id);
            $this->db->update('inventori');

            $sisa -= $ambil;
        }

        if ($sisa > 0) {
            log_message('error', "Stok tidak cukup untuk $sparepart. Kurang: $sisa");
        }
    }

    public function pengajuandelete($id) {
        return $this->db->delete('form_pengajuan', ['id' => $id]);
    }

    var $column_order = array('sparepart', 'qty',null);
    var $column_search = array('sparepart', 'qty');
    var $order = array('sparepart' => 'asc');

    private function _get_datatables_queryInvBaru($filter_qty = '') {
        $this->db->select('id, sparepart, SUM(qty) AS total_qty, SUM(is_used) AS total_used, COUNT(*) AS rows_count');
        $this->db->from('inventori');
        $this->db->where('kondisi', 'Baru');
        $this->db->where('is_delete', 0);
        $this->db->group_by('sparepart');

        if(!empty($_POST['nmBarang'])) {
            $this->db->like('sparepart', $_POST['nmBarang']);
        }

        // Filter stok habis
        if ($filter_qty === 'habis') {
            $this->db->having('total_qty', 0);
        }

        $i = 0;
        foreach ($this->column_search as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) $this->db->group_start();
                $this->db->like($item, $_POST['search']['value']);
                if ($i === count($this->column_search) - 1) $this->db->group_end();
                else $this->db->or_like($item, $_POST['search']['value']);
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']
            );
        } else {
            $this->db->order_by(key($this->order), $this->order[key($this->order)]);
        }
    }

    function get_datatablesInvBaru($filter_qty = '') {
        $this->_get_datatables_queryInvBaru($filter_qty);
        $length = $_POST['length'] ?? -1;
        $start  = $_POST['start'] ?? 0;

        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    function count_filteredInvBaru($filter_qty = '') {
        $this->_get_datatables_queryInvBaru($filter_qty);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allInvBaru() {
        $this->db->from('inventori');
        $this->db->where('kondisi', 'Baru');
        $this->db->where('is_delete', 0);
        return $this->db->count_all_results();
    }

    public function getInventoriById($id) {
        $data = array();
        $this->db->from('inventori');    
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
        }
        $query->free_result();  
        return $data;
    }

    public function getAllBrgBySparepart($sparepart) {
        $data = array();
        $this->db->from('maintenance_orders');
        $this->db->where('sparepart', $sparepart);
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

    public function count_stok_habis() {
        $this->db->select('COUNT(*) as jml');
        $this->db->from('(SELECT sparepart, SUM(qty) as total_qty 
                          FROM inventori 
                          WHERE kondisi = "Baru" AND is_delete = 0 
                          GROUP BY sparepart 
                          HAVING total_qty = 0) as subquery');
        $row = $this->db->get()->row();
        return $row ? $row->jml : 0;
    }

    public function count_total_barang() {
        $this->db->select('COUNT(DISTINCT sparepart) as jml');
        $this->db->from('inventori');
        $this->db->where('kondisi', 'Baru');
        $this->db->where('is_delete', 0);
        $row = $this->db->get()->row();
        return $row ? $row->jml : 0;
    }

    public function deletePengajuanDetail($id) {
        $this->db->where('pengajuan_id', $id);  
        $this->db->delete('form_pengajuan_detail');
    }
}
