<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasing extends CI_Controller {
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

    public function detail($id = null)
    {
        if (!$id) {
            show_404();
        }

        $data = [
            "title" => "Purchasing | Fleet Management System",
            "nopage" => 1301,
            "pengajuan_id" => $id,
        ];

        $data['vendor_items'] = $this->Inventori_model->get_all_vendor_items();
        $data['pengajuan'] = $this->Inventori_model->get_pengajuan_by_id($id);

        // Ambil detail pengajuan
        $details = $this->Inventori_model->get_all_pengajuan_detail_with_vendor($id);
        $data['pengajuan_barang'] = json_encode($details);

        $data['vendors'] = $this->Inventori_model->get_all_vendor();

        $this->load->view('headernew', $data);
        $this->load->view('purchasing_detail', $data);
        $this->load->view('footernew');
    }

    public function generate_po_ajax()
    {
        $vendor_id = $this->input->get('vendor_id');
        $no_po = $this->Inventori_model->generate_no_po($vendor_id);
        echo json_encode(['no_po' => $no_po]);
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

    function getVendorNameById($vendor_id, $vendors) {
        foreach ($vendors as $v) {
            if ($v->id == $vendor_id) return $v->name;
        }
        return 'Unknown Vendor';
    }

    public function simpan_purchasing()
    {
        // echo '<pre>';
        // var_dump($this->input->post());
        // echo '</pre>';
        // exit;

        $pengajuan_id               = $this->input->post('pengajuan_id');
        $vendor_ids                 = $this->input->post('vendor_id');
        $spareparts                 = $this->input->post('sparepart');
        $qtys                       = $this->input->post('qty');
        $hargas                     = $this->input->post('harga');
        $vendor_item_ids            = $this->input->post('vendor_item_id');
        $no_pos_full                = $this->input->post('no_po');
        $form_pengajuan_detail_ids  = $this->input->post('form_pengajuan_detail_id');
        $no_pos = array_values(array_filter($no_pos_full, function ($index) use ($form_pengajuan_detail_ids) {
            return array_key_exists($index, $form_pengajuan_detail_ids);
        }, ARRAY_FILTER_USE_KEY));
        $is_bons                    = $this->input->post('is_bon');


        if (!$vendor_ids || !$spareparts || !$qtys || !$pengajuan_id || !$hargas || !$no_pos) {
            $this->session->set_flashdata('error', 'Data tidak lengkap!');
            return redirect('inventori/purchasing');
        }

        if (count($vendor_ids) !== count($spareparts) || count($spareparts) !== count($qtys)) {
            $this->session->set_flashdata('error', 'Jumlah data tidak konsisten!');
            return redirect('inventori/purchasing');
        }

        $nama_po    = trim($this->input->post('nama_po'));
        $jabatan_po = trim($this->input->post('jabatan_po'));
        $divisi_po  = trim($this->input->post('divisi_po'));
        $tanggal_po = trim($this->input->post('tanggal_po'));

        if (empty($nama_po) || empty($jabatan_po) || empty($divisi_po) || empty($tanggal_po)) {
            $this->session->set_flashdata('pesanerror', 'Nama, Jabatan, Divisi dan Tanggal wajib diisi!');
            return redirect('purchasing/detail/'.$pengajuan_id);
        }

        $this->db->insert('form_purchasing', [
            'pengajuan_id' => $pengajuan_id,
            'nama_po' => $this->input->post('nama_po'),
            'jabatan_po' => $this->input->post('jabatan_po'),
            'divisi_po' => $this->input->post('divisi_po'),
            'tanggal_po' => $this->input->post('tanggal_po'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // insert tabel log
        $dataLog = array(
            'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
            'aktifitas'     => 'Tambah purchasing tanggal '.$this->input->post('tanggal_po').', nama '.$this->input->post('nama_po').', pengajuan_id '.$pengajuan_id,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        );                              
        $this->Log_model->insert($dataLog);

        // Simpan ke inventori
        foreach ($spareparts as $i => $sparepart) {
            $this->db->insert('inventori', [
                'vendori_id'      => $vendor_ids[$i],
                'vendor_item_id'  => $vendor_item_ids[$i] ?? 0,
                'sparepart'       => $sparepart,
                'kondisi'         => 'Baru',
                'qty'             => $qtys[$i],
                'is_delete'       => 0,
            ]);
        }

        // Update form_pengajuan (status = Selesai)
        $this->db->where('id', $pengajuan_id)->update('form_pengajuan', [
            'status' => 'Selesai',
        ]);

        foreach ($form_pengajuan_detail_ids as $i => $detail_id) {
            $vendor_item_id = $vendor_item_ids[$i] ?? 0;
            $harga          = $hargas[$i];
            $no_po          = $no_pos[$i]; 
            $vendor_id      = $vendor_ids[$i];
            $is_bon         = $is_bons[$i];

            if ($detail_id) {
                $this->db->where('id', $detail_id)->update('form_pengajuan_detail', [
                    'vendor_item_id' => $vendor_id,
                    'harga'          => $harga,
                    'is_bon'         => $is_bon,
                    'no_po'          => $no_po
                ]);
            }

            // Update tabel vendors hanya jika BON tidak dicentang dan no_po tidak kosong
            if ($is_bon == 0 && !empty($no_po)) {
                $this->db->where('id', $vendor_id)->update('vendors', [
                    'no_po'      => $no_po,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
        return redirect('inventori/purchasing');
    }

    public function submited($id = null)
    {
        if (!$id) {
            show_404();
        }

        $data = [
            "title" => "Purchasing | Fleet Management System",
            "nopage" => 1302,
            "pengajuan_id" => $id,
        ];

        $data['vendor_items'] = $this->Inventori_model->get_all_vendor_items();
        $data['pengajuan'] = $this->Inventori_model->get_pengajuan_by_pengajuan_id($id);

        // Ambil detail pengajuan
        $details = $this->Inventori_model->get_all_pengajuan_detail_with_vendor($id);
        $data['pengajuan_barang'] = json_encode($details);

        $data['vendors'] = $this->Inventori_model->get_all_vendor();

        $this->load->view('headernew', $data);
        $this->load->view('purchasing_submited', $data);
        $this->load->view('footernew');
    }

    public function print_purchasing($id = null)
    {
        if (!$id) {
            show_404();
        }

        // Ambil data pengajuan berdasarkan ID form_purchasing
        $pengajuan = $this->Inventori_model->get_pengajuan_by_purchasing_id($id);
        if (!$pengajuan) {
            show_404();
        }

        // Ambil detail barang pengajuan
        $barangList = $this->Inventori_model->get_all_pengajuan_detail_with_vendor($pengajuan->id);

        // Ambil daftar vendor dari barang
        $vendors = [];
        $vendorGroupedItems = [];

        foreach ($barangList as $item) {
            $vendorId = $item->vendor_id;
            if (!isset($vendorGroupedItems[$vendorId])) {
                $vendorGroupedItems[$vendorId] = [];
            }
            $vendorGroupedItems[$vendorId][] = $item;
        }

        // Ambil nama vendor & no_po
        $allVendors = $this->Inventori_model->get_all_vendor(); // pastikan ada ->id, ->name

        foreach ($vendorGroupedItems as $vendorId => $items) {
            foreach ($allVendors as $v) {
                if ($v->id == $vendorId) {
                    $v->no_po = $items[0]->no_po ?? '-';
                    $vendors[] = $v;
                    break;
                }
            }
        }

        $data = [
            'title' => 'Print Purchasing',
            'pengajuan' => $pengajuan,
            'vendors' => $vendors,
            'vendor_items_grouped' => $vendorGroupedItems,
        ];

        $this->load->view('purchasing_printed', $data);
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
                'aktifitas'     => 'Hapus purchasing tanggal pengajuan '.$pengajuan->tanggal.', nama '.$pengajuan->nama.', pengajuan_id '.$id,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            );                              
            $this->Log_model->insert($dataLog);

            // delete tabel form_pengajuan_detail
            $this->Inventori_model->deletePengajuanDetail($id);

            // delete tabel form_pengajuan 
            $this->Inventori_model->pengajuandelete($id);

            $this->session->set_flashdata('pesansukses','Data berhasil dihapus'); 
            redirect('inventori/purchasing');
        } 
    }

}