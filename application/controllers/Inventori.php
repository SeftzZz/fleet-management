<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->helper(["form", "url"]);
        $this->load->library("curl");
        $this->load->helper("slug");
        $this->load->library("upload");
        $this->load->library("session");
        $this->load->library("user_agent");
        $this->load->library("datetime");
        $this->load->library(["form_validation"]);
        $this->load->library("recaptcha");
        $this->load->library("user_agent");
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Inventori_model');
        $this->load->model('Log_model');
        $this->load->database();
    }

    public function baru()
    {
        $data = [
            "title" => "Inventori Barang Baru | Fleet Management System",
            "nopage" => 1100,
        ];

        $data['stok_habis'] = $this->Inventori_model->count_stok_habis();
        $data['total_barang'] = $this->Inventori_model->count_total_barang();

        $this->load->view('headernew', $data);
        $this->load->view('inventori_baru');
        $this->load->view('footernew');
    }

    public function barudetail()
    {
        $inventori_id = $this->uri->segment(3);
        $this->db->select('sparepart'); 
        $this->db->from('inventori'); 
        $this->db->where('id', $inventori_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $inventori = $query->row();
        } 
        $query->free_result();
        
        $data = [
            "title" => "Inventori Detail - Pemakaian Sparepart ".$inventori->sparepart,
            "nopage" => 1103,
        ];

        $data['sparepart'] = $inventori->sparepart;
        $data['pemakaian'] = $this->Inventori_model->getAllBrgBySparepart($data['sparepart']);
        $data['stok_habis'] = $this->Inventori_model->count_stok_habis();
        $data['total_barang'] = $this->Inventori_model->count_total_barang();

        $this->load->view('headernew', $data);
        $this->load->view('inventori_barudetail');
        $this->load->view('footernew');
    }

    public function bekas()
    {
        $data = [
            "title" => "Dashboard Utama | Fleet Management System",
            "nopage" => 1101,
        ];

        $this->load->view('headernew', $data);
        $this->load->view('inventori_bekas');
        $this->load->view('footernew');
    }

    public function pengajuan()
    {
        $data = [
            "title" => "Pengajuan | Fleet Management System",
            "nopage" => 1102,
        ];

        $data['vendor_items'] = $this->Inventori_model->get_all_inventori();
        $data['vendors'] = $this->Inventori_model->get_all_vendor();
        $data['pengajuan'] = $this->Inventori_model->get_all_pengajuan();
        foreach ($data['pengajuan'] as $pengajuan) {
            $data['pengajuan_detail'][$pengajuan->id] = $this->Inventori_model->get_all_pengajuan_detail($pengajuan->id);
        }
        $this->load->view('headernew', $data);
        $this->load->view('pengajuan', $data);
        $this->load->view('footernew');
    }

    public function purchasing()
    {
        $data = [
            "title" => "Purchasing | Fleet Management System",
            "nopage" => 1300,
        ];

        $data['vendor_items'] = $this->Inventori_model->get_all_inventori();
        $data['vendors'] = $this->Inventori_model->get_all_vendor();
        $data['pengajuan'] = $this->Inventori_model->get_all_pengajuan_with_purchasing();
        foreach ($data['pengajuan'] as $pengajuan) {
            $data['pengajuan_detail'][$pengajuan->id] = $this->Inventori_model->get_all_pengajuan_detail($pengajuan->id);
        }
        $this->load->view('headernew', $data);
        $this->load->view('purchasing', $data);
        $this->load->view('footernew');
    }

    public function generate_po_ajax()
    {
        $vendor_id = $this->input->get('vendor_id');
        $no_po = $this->Inventori_model->generate_no_po($vendor_id);
        echo json_encode(['no_po' => $no_po]);
    }

    public function pengajuanadd()
    {
        $json = $this->input->post('data');
        $decoded = json_decode($json, true);

        if (!$decoded) {
            echo json_encode(['status' => 'error', 'message' => 'JSON tidak valid']);
            return;
        }

        $form = $decoded['form'] ?? [];
        $barang = $decoded['barang'] ?? [];

        // Simpan data form ke tabel form_pengajuan
        $this->db->insert('form_pengajuan', [
            'nama' => $form['nama'],
            'jabatan' => $form['jabatan'],
            'divisi' => $form['divisi'],
            'tanggal' => $form['tanggal'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $id_form = $this->db->insert_id(); // Ambil ID form_pengajuan

        // insert tabel log
        $dataLog = array(
            'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
            'aktifitas'     => 'Tambah form pengajuan tanggal '.$form['tanggal'].', nama '.$form['nama'].', pengajuan_id '.$id_form,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        );                              
        $this->Log_model->insert($dataLog);

        // Simpan detail barang ke tabel form_pengajuan_detail
        foreach ($barang as $item) {
            if (!empty($item['vendor_item_id']) && !empty($item['qty'])) {
                $this->db->insert('form_pengajuan_detail', [
                    'pengajuan_id'      => $id_form,
                    'vendor_item_id'    => $item['vendor_item_id'],
                    'sparepart'         => $item['namaBarang'],
                    'qty'               => $item['qty'],
                    'harga'             => $item['harga']
                ]);
            }
        }

        echo json_encode([
            'status'  => 'success',
            'id_form' => $id_form,
            'redirect'=> base_url('inventori/pengajuan')
        ]);
    }

    public function get_pengajuan_barang_json()
    {
        $result = [];

        $pengajuanList = $this->Inventori_model->get_all_pengajuan();
        foreach ($pengajuanList as $pengajuan) {
            // ganti ke function yang baru
            $details = $this->Inventori_model->get_all_pengajuan_detail_with_vendor($pengajuan->id);
            foreach ($details as $detail) {
                $result[] = [
                    'pengajuan_id' => $pengajuan->id,
                    'tanggal' => $pengajuan->tanggal,
                    'nama' => $pengajuan->nama,
                    'status' => $pengajuan->status,
                    'sparepart' => $detail->sparepart,
                    'harga' => $detail->harga,
                    'qty' => $detail->qty,
                    'vendor_id' => $detail->vendor_id, // << ini yang penting
                ];
            }
        }

        echo json_encode($result);
    }

    public function get_vendors_json()
    {
        $vendors = $this->Inventori_model->get_all_vendor();
        echo json_encode($vendors);
    }

    public function pengajuandel($id)
    {
        if ($post = $this->input->post('submit')) {
            // insert tabel log  
            $this->db->select('nama, tanggal'); 
            $this->db->from('form_pengajuan'); 
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $pengajuan = $query->row();
            } 
            $query->free_result();

            $dataLog = array(
                'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
                'aktifitas'     => 'Hapus form pengajuan tanggal '.$pengajuan->tanggal.', nama '.$pengajuan->nama.', pengajuan_id '.$id,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            );                              
            $this->Log_model->insert($dataLog);

            // delete tabel form_pengajuan_detail
            $this->Inventori_model->deletePengajuanDetail($id);

            // delete tabel form_pengajuan  
            $this->Inventori_model->pengajuandelete($id);

            $this->session->set_flashdata('pesansukses','Data berhasil dihapus'); 
            redirect('inventori/pengajuan');
        } 
    }

    public function ajax_listinvbaru() {
        $filter_qty = $this->input->post('filter_qty');
        $list = $this->Inventori_model->get_datatablesInvBaru($filter_qty);
        $data = array();
        $no = $_POST['start'] ?? 0;
        foreach ($list as $inventori) {
            $no++;
            $row = array();
            $row[] = $inventori->sparepart;
            $row[] = $inventori->total_qty;
            $row[] = $inventori->total_used;
            $row[] = "
                        <a href=".site_url('inventori/barudetail/'.$inventori->id)." class='btn btn-sm btn-outline-success' data-toggle='tooltip' data-placement='top' title='Detail Pemakaian'><i class='fas fa-eye'></i> Detail Pemakaian</a>
                     ";
            $data[] = $row;
        }

        $output = array(
            "draw" => intval($_POST['draw'] ?? 1),
            "recordsTotal" => $this->Inventori_model->count_allInvBaru(),
            "recordsFiltered" => $this->Inventori_model->count_filteredInvBaru($filter_qty),
            "data" => $data,
        );
        echo json_encode($output);
    }
}