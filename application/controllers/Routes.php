<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends CI_Controller {
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
        $this->load->library('pagination');
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Route_model');
        $this->load->model('Driver_model');
        $this->load->model('Tim_model');
        $this->load->model('Proyek_model');
        $this->load->model('Ritasi_model');
        $this->load->model('Lokasigalian_model');
        $this->load->model('Timmgmt_model');
        $this->load->model('Vehicle_model');
        $this->load->model('Uangjalan_model');
        $this->load->model('Wallet_model');
        $this->load->database();
    }

    public function index()
    {
        $data = [
            "title" => "Manajemen Rute / Ritasi | Fleet Management",
            "nopage" => 4,
        ];

        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nama_tim','Nama Tim','');
            $this->form_validation->set_rules('nama_proyek','Nama Proyek','');
            $this->form_validation->set_rules('tgl_ritasi','Tanggal Ritasi','');
            $this->form_validation->set_rules('lokasi','Lokasi Galian','');

            $caritim = $this->input->post('nama_tim');
            $cariproyek = $this->input->post('nama_proyek');
            $caritanggal = $this->input->post('tgl_ritasi');
            $carilokasi = $this->input->post('lokasi');

            $data['routes'] = $this->Route_model->getAllRoutes();
            $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();
            $data['supirs'] = $this->Driver_model->getAllSupir();
            $data['ritasis'] = $this->Route_model->getAllRitasiByFilter($caritim,$cariproyek,$caritanggal,$carilokasi);
            $data['tims'] = $this->Tim_model->getAllTimAktif();
            $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
            $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
            // Ambil ringkasan ritasi terakhir
            $data['last_ritasi_summary'] = $this->Route_model->getLastInsertedRitasiSummary();
            $data['jmlritasiHari'] = $this->Route_model->getAllJmlRitasiHari();
            $data['jmlritasiGHari'] = $this->Route_model->getAllJmlRitasiTimGHari();
            $data['jmlritasiKHari'] = $this->Route_model->getAllJmlRitasiTimKHari();
            $data['jmlritasiMHari'] = $this->Route_model->getAllJmlRitasiTimMHari();
            $data['jmlritasiBln'] = $this->Route_model->getAllJmlRitasiBln();
            $data['jmlritasiTanpaNodo'] = $this->Route_model->getAllJmlRitasiTanpaNodo();
            
            $this->load->view('headernew', $data);
            $this->load->view('routes', $data);
            $this->load->view('footernew');
        } else {
            $data['routes'] = $this->Route_model->getAllRoutes();
            $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();
            $data['supirs'] = $this->Driver_model->getAllSupir();
            $data['ritasis'] = $this->Route_model->getAllRitasi();
            $data['tims'] = $this->Tim_model->getAllTimAktif();
            $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
            $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
            // Ambil ringkasan ritasi terakhir
            $data['last_ritasi_summary'] = $this->Route_model->getLastInsertedRitasiSummary();
            $data['jmlritasiHari'] = $this->Route_model->getAllJmlRitasiHari();
            $data['jmlritasiKemarin'] = $this->Route_model->getAllJmlRitasiKemarin();
            $data['jmlritasiGHari'] = $this->Route_model->getAllJmlRitasiTimGHari();
            $data['jmlritasiKHari'] = $this->Route_model->getAllJmlRitasiTimKHari();
            $data['jmlritasiMHari'] = $this->Route_model->getAllJmlRitasiTimMHari();
            $data['jmlritasiBln'] = $this->Route_model->getAllJmlRitasiBln();
            $data['jmlritasiBlnKemarin'] = $this->Route_model->getAllJmlRitasiBlnKemarin();
            $data['jmlritasiTanpaNodo'] = $this->Route_model->getAllJmlRitasiTanpaNodo();

            if ($data['jmlritasiKemarin'] > 0) {
                $data['persenRitasiHari'] = (($data['jmlritasiHari'] - $data['jmlritasiKemarin']) / $data['jmlritasiKemarin']) * 100;
            } else {
                $data['persenRitasiHari'] = 0;
            }

            if ($data['jmlritasiBlnKemarin'] > 0) {
                $data['persenRitasiBln'] = (($data['jmlritasiBln'] - $data['jmlritasiBlnKemarin']) / $data['jmlritasiBlnKemarin']) * 100;
            } else {
                $data['persenRitasiBln'] = 0;
            }

            
            $this->load->view('headernew', $data);
            $this->load->view('routes', $data);
            $this->load->view('footernew');
        }
    }

    public function tambah()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('asal','Asal','required');
            $this->form_validation->set_rules('tujuan','Tujuan','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Rute / Ritasi | Fleet Management",
                    "nopage" => 4,
                ];

                $data['routes'] = $this->Route_model->getAllRoutes();
                $data['kendaraans'] = $this->Vehicle_model->getAllKendaraan();
                $data['supirs'] = $this->Driver_model->getAllSupir();
                $data['ritasis'] = $this->Route_model->getAllRitasi();
                
                $this->load->view('headernew', $data);
                $this->load->view('routes', $data);
                $this->load->view('footernew');
            } else {
                // insert tabel routes  
                $dataRoute = array(
                    'start_point'       => $this->input->post('asal'),
                    'end_point'         => $this->input->post('tujuan'),
                    'planned_distance'  => $this->input->post('jarakRencana'),
                    'start_time'        => date('Y-m-d H:i:s'),
                    'end_time'          => date('Y-m-d H:i:s'),
                    'is_delete'         => 0
                );                              
                $this->Route_model->insert($dataRoute);
                $this->session->set_flashdata('pesansukses','Data Berhasil Disimpan');  
                redirect('/routes');
            }
        } 
    }

    public function edit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('asal','Asal','required');
            $this->form_validation->set_rules('tujuan','Tujuan','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Rute / Ritasi | Fleet Management",
                    "nopage" => 4,
                ];

                $data['routes'] = $this->Route_model->getAllRoutes();
                $data['kendaraans'] = $this->Vehicle_model->getAllKendaraan();
                $data['supirs'] = $this->Driver_model->getAllSupir();
                $data['ritasis'] = $this->Route_model->getAllRitasi();
                
                $this->load->view('headernew', $data);
                $this->load->view('routes', $data);
                $this->load->view('footernew');
            } else {
                // update tabel routes  
                $dataRoute = array(
                    'start_point'       => $this->input->post('asal'),
                    'end_point'         => $this->input->post('tujuan'),
                    'planned_distance'  => $this->input->post('jarakRencana'),
                    'start_time'        => date('Y-m-d H:i:s'),
                    'end_time'          => date('Y-m-d H:i:s')
                );                              
                $this->Route_model->update($id,$dataRoute);
                redirect('/routes');
            }
        } 
    }

    public function del($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel routes  
            $dataRoute = array(
                'is_delete'       => $this->input->post('del')
            );                              
            $this->Route_model->update($id,$dataRoute);
            redirect('/routes');
        } 
    }

    public function ritasiadd()
    {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
            $this->form_validation->set_rules('tim', 'Tim', 'required');
            $this->form_validation->set_rules('proyek', 'Proyek', 'required');
            $this->form_validation->set_rules('galian', 'Lokasi Galian', 'required');

            $kendaraan_ids = $this->input->post('kendaraan_id');
            $jam_list      = $this->input->post('jam');
            $nodo_list     = $this->input->post('nodo');

            // Validasi minimal satu kendaraan harus lengkap
            $valid_count = 0;
            for ($i = 0; $i < count($kendaraan_ids); $i++) {
                if (!empty(trim($kendaraan_ids[$i])) && !empty(trim($jam_list[$i]))) {
                    $valid_count++;
                }
            }

            if ($this->form_validation->run() == FALSE || $valid_count === 0) {
                $data = [
                    "title" => "Manajemen Rute / Ritasi | Fleet Management",
                    "nopage" => 4,
                ];

                $data['routes'] = $this->Route_model->getAllRoutes();
                $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();
                $data['supirs'] = $this->Driver_model->getAllSupir();
                $data['ritasis'] = $this->Route_model->getAllRitasi();
                $data['tims'] = $this->Tim_model->getAllTimAktif();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
                // Ambil ringkasan ritasi terakhir
                $data['last_ritasi_summary'] = $this->Route_model->getLastInsertedRitasiSummary();
                $data['jmlritasiHari'] = $this->Route_model->getAllJmlRitasiHari();
                $data['jmlritasiKemarin'] = $this->Route_model->getAllJmlRitasiKemarin();
                $data['jmlritasiGHari'] = $this->Route_model->getAllJmlRitasiTimGHari();
                $data['jmlritasiKHari'] = $this->Route_model->getAllJmlRitasiTimKHari();
                $data['jmlritasiMHari'] = $this->Route_model->getAllJmlRitasiTimMHari();
                $data['jmlritasiBln'] = $this->Route_model->getAllJmlRitasiBln();
                $data['jmlritasiBlnKemarin'] = $this->Route_model->getAllJmlRitasiBlnKemarin();
                $data['jmlritasiTanpaNodo'] = $this->Route_model->getAllJmlRitasiTanpaNodo();

                if ($data['jmlritasiKemarin'] > 0) {
                    $data['persenRitasiHari'] = (($data['jmlritasiHari'] - $data['jmlritasiKemarin']) / $data['jmlritasiKemarin']) * 100;
                } else {
                    $data['persenRitasiHari'] = 0;
                }

                if ($data['jmlritasiBlnKemarin'] > 0) {
                    $data['persenRitasiBln'] = (($data['jmlritasiBln'] - $data['jmlritasiBlnKemarin']) / $data['jmlritasiBlnKemarin']) * 100;
                } else {
                    $data['persenRitasiBln'] = 0;
                }

                $this->session->set_flashdata('pesanerror', 'Data tidak lengkap. Pastikan semua kendaraan memiliki jam dan DO.');
                $this->load->view('headernew', $data);
                $this->load->view('routes', $data);
                $this->load->view('footernew');
                return;
            }

            // Data utama
            $tgl        = $this->input->post('tgl');
            $timId      = $this->input->post('tim');
            $proyekId   = $this->input->post('proyek');
            $galianId   = $this->input->post('galian');

            $tim        = $this->Tim_model->getTimById($timId);
            $proyek     = $this->Proyek_model->getProyekById($proyekId);
            $galian     = $this->Lokasigalian_model->getGalianById($galianId);
            $tabungan   = $this->Proyek_model->getProyekById($proyekId);
            $uangjalan  = $this->Uangjalan_model->getUangJalanByGalianId($galianId);

            for ($i = 0; $i < count($kendaraan_ids); $i++) {
                if (empty($kendaraan_ids[$i]) || empty($jam_list[$i])) {
                    continue;
                }

                $kendaraan = $this->Vehicle_model->getKendaraanById($kendaraan_ids[$i]);
                if (!$kendaraan) {
                    log_message('error', "[ritasiadd] Kendaraan tidak ditemukan. ID: {$kendaraan_ids[$i]}");
                    continue;
                }

                $tim_mgmnt = $this->Timmgmt_model->getKendaraanTimByIdMobil($kendaraan_ids[$i]);
                if (!$tim_mgmnt) {
                    log_message('error', "[ritasiadd] Tim management tidak ditemukan untuk kendaraan ID: {$kendaraan_ids[$i]}");
                    continue;
                }

                $wallet_id = $this->Wallet_model->get_by_driver($tim_mgmnt->id);
                if (!$wallet_id) {
                    log_message('error', "[ritasiadd] Wallet tidak ditemukan untuk driver ID: {$tim_mgmnt->id}");
                    continue;

                    // Buat wallet baru jika tidak ada
                    $wallet_id = $this->Wallet_model->insert([
                        'driver_id' => $tim_mgmnt->id,
                        'balance' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    log_message('error', '[ritasiadd] Kendaraan ID: ' . print_r($kendaraan_ids, true));
                    log_message('error', '[ritasiadd] Jam: ' . print_r($jam_list, true));
                    log_message('error', '[ritasiadd] No DO: ' . print_r($nodo_list, true));

                    log_message('error', '[ritasiadd] INSERTING ritasi: ' . print_r([
                        'vehicle_id' => $kendaraan->id,
                        'no_pol' => $kendaraan->no_pol,
                        'jam' => $jam_list[$i],
                        'nodo' => $nodo_list[$i]
                    ], true));


                    // Simpan ke tabel ritasi
                    $this->Route_model->insertRitasi([
                        'tgl_ritasi'    => $tgl,
                        'tim_id'        => $timId,
                        'nama_tim'      => $tim->nama_tim,
                        'proyek_id'     => $proyekId,
                        'nama_proyek'   => $proyek->nama_proyek,
                        'galian_id'     => $galianId,
                        'lokasi'        => $galian->lokasi,
                        'vehicle_id'    => $kendaraan->id,
                        'no_pol'        => $kendaraan->no_pol,
                        'jam_angkut'    => $jam_list[$i],
                        'nomerdo'       => $nodo_list[$i],
                        'uang_jalan'    => $uangjalan->uang_jalan,
                        'is_delete'     => 0,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                    $id_ritasi = $this->db->insert_id();
                    log_message('error', "[ritasiadd] ID Ritasi Inserted: " . $id_ritasi);
                    
                    // Transaksi tabungan (credit)
                    $this->Wallet_model->insert_transaction([
                        'wallet_id'         => $wallet_id->id,
                        'transaction_type'  => 'credit',
                        'id_ritasi'         => $id_ritasi,
                        'description'       => 'Tabungan DO - ' . $nodo_list[$i],
                        'amount'            => $tabungan->tabungan,
                        'status'            => 'belum',
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    ]);

                    // Transaksi uang jalan (debit)
                    $this->Wallet_model->insert_transaction([
                        'wallet_id'         => $wallet_id->id,
                        'transaction_type'  => 'debit',
                        'id_ritasi'         => $id_ritasi,
                        'description'       => 'Uang Jalan DO - ' . $nodo_list[$i],
                        'amount'            => $uangjalan->uang_jalan,
                        'status'            => 'belum',
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    ]);

                    // Update saldo wallet
                    $this->Wallet_model->update($wallet_id->id, [
                        'driver_id'     => $tim_mgmnt->id,
                        'balance'       => $tabungan->tabungan + $wallet_id->balance,
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                }

                log_message('error', '[ritasiadd] Kendaraan ID: ' . print_r($kendaraan_ids, true));
                log_message('error', '[ritasiadd] Jam: ' . print_r($jam_list, true));
                log_message('error', '[ritasiadd] No DO: ' . print_r($nodo_list, true));

                log_message('error', '[ritasiadd] INSERTING ritasi: ' . print_r([
                    'vehicle_id' => $kendaraan->id,
                    'no_pol' => $kendaraan->no_pol,
                    'jam' => $jam_list[$i],
                    'nodo' => $nodo_list[$i]
                ], true));


                // Simpan ke tabel ritasi
                $this->Route_model->insertRitasi([
                    'tgl_ritasi'    => $tgl,
                    'tim_id'        => $timId,
                    'nama_tim'      => $tim->nama_tim,
                    'proyek_id'     => $proyekId,
                    'nama_proyek'   => $proyek->nama_proyek,
                    'galian_id'     => $galianId,
                    'lokasi'        => $galian->lokasi,
                    'vehicle_id'    => $kendaraan->id,
                    'no_pol'        => $kendaraan->no_pol,
                    'jam_angkut'    => $jam_list[$i],
                    'nomerdo'       => $nodo_list[$i],
                    'uang_jalan'    => $uangjalan->uang_jalan,
                    'is_delete'     => 0,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                ]);
                $id_ritasi = $this->db->insert_id();
                log_message('error', "[ritasiadd] ID Ritasi Inserted: " . $id_ritasi);
                
                // Transaksi tabungan (credit)
                $this->Wallet_model->insert_transaction([
                    'wallet_id'         => $wallet_id->id,
                    'transaction_type'  => 'credit',
                    'id_ritasi'         => $id_ritasi,
                    'description'       => 'Tabungan DO - ' . $nodo_list[$i],
                    'amount'            => $tabungan->tabungan,
                    'status'            => 'belum',
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);

                // Transaksi uang jalan (debit)
                $this->Wallet_model->insert_transaction([
                    'wallet_id'         => $wallet_id->id,
                    'transaction_type'  => 'debit',
                    'id_ritasi'         => $id_ritasi,
                    'description'       => 'Uang Jalan DO - ' . $nodo_list[$i],
                    'amount'            => $uangjalan->uang_jalan,
                    'status'            => 'belum',
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);

                // Update saldo wallet
                $this->Wallet_model->update($wallet_id->id, [
                    'driver_id'     => $tim_mgmnt->id,
                    'balance'       => $tabungan->tabungan + $wallet_id->balance,
                    'updated_at'    => date('Y-m-d H:i:s')
                ]);
            }

            $this->session->set_flashdata('pesansukses', 'Data berhasil disimpan');
            redirect('/routes');
        }
    }

    public function ritasiedit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('tgl','Tanggal','required');
            $this->form_validation->set_rules('tim','Tim','required');
            $this->form_validation->set_rules('proyek','Proyek','required');
            $this->form_validation->set_rules('galian','Lokasi Galian','required');
            $this->form_validation->set_rules('kendaraan','Kendaraan','');
            $this->form_validation->set_rules('jam','Jam Angkut','required');
            $this->form_validation->set_rules('nodo','Nomer DO','');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Rute / Ritasi | Fleet Management",
                    "nopage" => 4,
                ];

                $data['routes'] = $this->Route_model->getAllRoutes();
                $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();
                $data['supirs'] = $this->Driver_model->getAllSupir();
                $data['ritasis'] = $this->Route_model->getAllRitasi();
                $data['tims'] = $this->Tim_model->getAllTimAktif();
                $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
                $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
                
                $this->load->view('headernew', $data);
                $this->load->view('routes', $data);
                $this->load->view('footernew');
            } else {
                $tim = $this->Tim_model->getTimById($this->input->post('tim'));
                $proyek = $this->Proyek_model->getProyekById($this->input->post('proyek'));
                $galian = $this->Lokasigalian_model->getGalianById($this->input->post('galian'));
                $kendaraan = $this->Vehicle_model->getKendaraanById($this->input->post('kendaraan'));
                $tabungan   = $this->Proyek_model->getProyekById($proyek->id);
                $uangjalan  = $this->Uangjalan_model->getUangJalanByGalianId($galian->id);
                $tim_mgmnt = $this->Timmgmt_model->getKendaraanTimByIdMobil($kendaraan->id);
                $wallet = $this->Wallet_model->get_by_driver($tim_mgmnt->id);
                $wallet_id = $wallet->id;

                // update tabel ritasi  
                $dataRitasi = array(
                    'tgl_ritasi'    => $this->input->post('tgl'),
                    'tim_id'        => $this->input->post('tim'),
                    'nama_tim'      => $tim->nama_tim,
                    'proyek_id'     => $this->input->post('proyek'),
                    'nama_proyek'   => $proyek->nama_proyek,
                    'galian_id'     => $this->input->post('galian'),
                    'lokasi'        => $galian->lokasi,
                    'vehicle_id'    => $this->input->post('kendaraan'),
                    'no_pol'        => $kendaraan->no_pol,
                    'jam_angkut'    => $this->input->post('jam'),
                    'nomerdo'       => $this->input->post('nodo'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );                              
                $this->Route_model->updateRitasi($id,$dataRitasi);

                // Ambil transaksi wallet dengan id_ritasi dan deskripsi diawali "Tabungan DO - "
                $wallet_transactions = $this->Wallet_model->getWalletTransactionsByTabungan($id);

                // Ambil input NoDO
                $nodo = $this->input->post('nodo');

                $this->Wallet_model->update_nodo($wallet_transactions->id, [
                    'description' => 'Tabungan DO - ' . $nodo,
                    'updated_at'  => date('Y-m-d H:i:s')
                ]);

                $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                redirect('/routes');
            }
        } 
    }

    public function ritasidel($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel ritasi  
            $dataRitasi = array(
                'is_delete'     => $this->input->post('del'),
                'updated_at'    => date('Y-m-d H:i:s')
            );                              
            $this->Route_model->updateRitasi($id,$dataRitasi);
            $this->session->set_flashdata('pesansukses','Data berhasil dihapus');
            redirect('/routes');
        } 
    }

    public function oldpage()
    {
        $data = [
            "title" => "Manajemen Rute / Ritasi | Fleet Management",
            "nopage" => 4,
        ];
        
        // Pagination configuration
        $config['base_url'] = site_url('routes');
        $config['total_rows'] = $this->Route_model->count_routes();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data['routes'] = $this->Route_model->get_routes($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('header', $data);
        $this->load->view('routesOld01', $data);
        $this->load->view('footer');
    }

    public function get_kendaraan_by_tim() {
        $tim_id = $this->input->post('tim_id');
        if ($tim_id) {
            $data = $this->Timmgmt_model->getKendaraanByTimId($tim_id);
            echo json_encode($data);
        }
    }

    public function multi_ritasi()
    {
        $data = [
            "title" => "Manajemen Rute / Ritasi | Fleet Management",
            "nopage" => 4,
        ];

        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nama_tim','Nama Tim','');
            $this->form_validation->set_rules('nama_proyek','Nama Proyek','');
            $this->form_validation->set_rules('tgl_ritasi','Tanggal Ritasi','');
            $this->form_validation->set_rules('lokasi','Lokasi Galian','');

            $caritim = $this->input->post('nama_tim');
            $cariproyek = $this->input->post('nama_proyek');
            $caritanggal = $this->input->post('tgl_ritasi');
            $carilokasi = $this->input->post('lokasi');

            $data['routes'] = $this->Route_model->getAllRoutes();
            $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();
            $data['supirs'] = $this->Driver_model->getAllSupir();
            $data['ritasis'] = $this->Route_model->getAllRitasiByFilter($caritim,$cariproyek,$caritanggal,$carilokasi);
            $data['tims'] = $this->Tim_model->getAllTimAktif();
            $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
            $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
            
            $this->load->view('headernew', $data);
            $this->load->view('routes_multi', $data);
            $this->load->view('footernew');
        } else {
            $data['routes'] = $this->Route_model->getAllRoutes();
            $data['kendaraans'] = $this->Timmgmt_model->getAllTimMgmtAktif();
            $data['supirs'] = $this->Driver_model->getAllSupir();
            $data['ritasis'] = $this->Route_model->getAllRitasi();
            $data['tims'] = $this->Tim_model->getAllTimAktif();
            $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
            $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
            // Ambil ringkasan ritasi terakhir
            $data['last_ritasi_summary'] = $this->Route_model->getLastInsertedRitasiSummary();
            
            $this->load->view('headernew', $data);
            $this->load->view('routes_multi', $data);
            $this->load->view('footernew');
        }
    }

    public function routes_copy() {
        $ids = $this->input->get('ids');
        $idArray = explode(',', $ids);
        
        $ritasis = $this->Route_model->getRitasiByIds($idArray);

        // Ambil data pertama sebagai default (untuk proyek, galian, tim, tgl)
        $first = $ritasis[0];

        $data = [
            "title" => "Manajemen Rute / Ritasi | Fleet Management",
            "nopage" => 4,
        ];

        $data['ritasis'] = $ritasis;
        $data['tgl_default'] = $first->tgl_ritasi;
        $data['proyek_default'] = $first->proyek_id;
        $data['galian_default'] = $first->galian_id;
        $data['tim_default'] = $first->tim_id;

        // Untuk dropdown
        $data['proyeks'] = $this->Proyek_model->getAllProyekAktif();
        $data['galians'] = $this->Lokasigalian_model->getAllGalianAktif();
        $data['tims'] = $this->Tim_model->getAllTimAktif();

        // Load kendaraan milik tim yang sama
        $data['kendaraans'] = $this->Route_model->getKendaraanUsedInRitasi($idArray);

        $this->load->view('headernew', $data);
        $this->load->view('routes_copy', $data);
        $this->load->view('footernew');
    }

    public function get_ritasi_filtered() {
      $tanggal = $this->input->post('tanggal');
      $proyek = $this->input->post('proyek');
      $galian = $this->input->post('galian');
      $tim = $this->input->post('tim');

      $result = $this->Route_model->getRitasiByFilters($tanggal, $proyek, $galian, $tim);

      echo json_encode($result);
    }
}