<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {
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
        $this->load->model('Timmgmt_model');
        $this->load->model('Inventori_model');
        $this->load->model('Maintenance_model');
        $this->load->database();
    }

	public function index()
	{
        $data = [
            "title" => "Dashboard Utama | Fleet Management System",
            "nopage" => 1200,
        ];

        $data['maintenances'] = $this->Maintenance_model->get_all_maintenances();

		$this->load->view('headernew', $data);
		$this->load->view('maintenance');
		$this->load->view('footernew');
	}

    public function addmaintenance()
    {
        $data = [
            "title" => "Dashboard Utama | Fleet Management System",
            "nopage" => 1200,
        ];

        $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();
        $data['inventori'] = $this->Inventori_model->get_all_inventori_gudang();

        $this->load->view('headernew', $data);
        $this->load->view('maintenance_add');
        $this->load->view('footernew');
    }

    public function simpan()
    {
        // 1. Simpan data utama ke tabel 'maintenances'
        $header = [
            'tgl_order'    => $this->input->post('tgl_order'),
            'tgl_selesai'  => $this->input->post('tgl_selesai'),
            'jam_order'    => $this->input->post('jam_order'),
            'jam_selesai'  => $this->input->post('jam_selesai'),
            'type'         => $this->input->post('type'),
            'requester'    => $this->input->post('mekanik'),
            'no_pintu'     => $this->input->post('no_pintu'),
            'staff_gudang' => 'Gudang default', // bisa dari session
            'security'     => 'Security default', // bisa dari session
            'driver_id'    => $this->input->post('driver_id'),
            'vehicle_id'   => $this->input->post('vehicle_id'), // kalau tidak pakai get_vehicle_id_by_no_pintu lagi
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('maintenances', $header);
        $maintenance_id = $this->db->insert_id(); // ID untuk relasi detail

        // 2. Ambil data sparepart detail
        $permintaan_perbaikan   = $this->input->post('permintaan_perbaikan[]');
        $spareparts             = $this->input->post('sparepart[]');
        $qtys                   = $this->input->post('qty[]');
        $kondisi                = $this->input->post('kondisi[]');
        $posisi                 = $this->input->post('posisi[]');
        $keterangan             = $this->input->post('keterangan[]');
        $no_seri                = ''; // placeholder
        $rows                   = [];

        foreach ($spareparts as $i => $sparepart) {
            // ✅ Skip jika sparepart kosong atau qty tidak valid
            if (empty($sparepart) || empty($qtys[$i]) || (int)$qtys[$i] <= 0) {
                continue;
            }

            $rows[] = [
                'maintenance_id'        => $maintenance_id,
                'permintaan_perbaikan'  => $permintaan_perbaikan[$i],
                'sparepart'             => $sparepart,
                'qty'                   => (int)$qtys[$i],
                'posisi'                => $posisi[$i],
                'kondisi'               => $kondisi[$i],
                'keterangan'            => $keterangan[$i],
                'no_seri'               => $no_seri,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ];

            // Kurangi stok hanya jika valid
            $this->Inventori_model->kurangi_stok_fifo($sparepart, $kondisi[$i], $qtys[$i]);
        }

        // 4. Simpan detail ke 'maintenance_orders'
        $this->db->insert_batch('maintenance_orders', $rows);

        redirect('maintenance');
    }
}