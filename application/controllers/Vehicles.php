<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicles extends CI_Controller {
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
        $this->load->model('Driver_model');
        $this->load->model('Wallet_model');
        $this->load->model('Vehicle_model');
        $this->load->model('Inventori_model');
        $this->load->database();

        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$data = [
            "title" => "Manajemen Kendaraan | Fleet Management System",
            "nopage" => 1051,
        ];

        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('noPol','No. Polisi','');
            $this->form_validation->set_rules('noPintu','No. Pintu','');
            $this->form_validation->set_rules('statusCariMobil','Status','');

            $carinopol = $this->input->post('noPol');
            $carinopintu = $this->input->post('noPintu');
            $caristatus = $this->input->post('statusCariMobil');

            $data['vehicles'] = $this->Vehicle_model->getAllVehiclesByFilter($carinopol,$carinopintu,$caristatus);
            $data['vehicle_inventori'] = $this->Inventori_model->get_by_vehicle($carinopol,$carinopintu);
            $data['filter_applied'] = true; // Tambahkan flag ini
            $data['filter_no_pintu'] = $carinopintu;
            
            $this->load->view('headernew', $data);
            $this->load->view('vehicles', $data);
            $this->load->view('footernew');
        } else {
            $data['vehicles'] = $this->Vehicle_model->getAllVehicles();
            $data['v_doc_detail'] = $this->Vehicle_model->getAllVDocDetail();
            $data['inventori'] = $this->Inventori_model->get_all_inventori();
            
            $this->load->view('headernew', $data);
            $this->load->view('vehicles', $data);
            $this->load->view('footernew');
        }
	}

	public function vehiclesadd()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('no_pol','No. Polisi','required');
            $this->form_validation->set_rules('no_pintu','No. Pintu','required');
            $this->form_validation->set_rules('type','Type','required');
            $this->form_validation->set_rules('warna','Warna','required');
            $this->form_validation->set_rules('no_chasis','No. Chasis','required');
            $this->form_validation->set_rules('no_mesin','No. Mesin','required');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
		            "title" => "Manajemen Kendaraan | Fleet Management",
		            "nopage" => 1051,
		        ];

                $data['vehicles'] = $this->Vehicle_model->getAllVehicles();
                
                $this->load->view('headernew', $data);
                $this->load->view('vehicles', $data);
                $this->load->view('footernew');
            } else {
                $dataVehicles = array(
                    'no_pol'      	=> $this->input->post('no_pol'),
                    'no_pintu'      => $this->input->post('no_pintu'),
                    'type'			=> $this->input->post('type'),
                    'warna'         => $this->input->post('warna'),
                    'no_chasis'     => $this->input->post('no_chasis'),
                    'no_mesin'      => $this->input->post('no_mesin'),
                    'status'        => $this->input->post('status'),
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );
                $this->Vehicle_model->insert($dataVehicles);
                $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                redirect('/vehicles');
            }
        } 
    }

    public function vehiclesedit($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('no_pol','No. Polisi','required');
            $this->form_validation->set_rules('no_pintu','Nama','required');
            $this->form_validation->set_rules('type','No. SIM','required');
            $this->form_validation->set_rules('warna','No. HP','required');
            $this->form_validation->set_rules('no_chasis','No. Chasis','required');
            $this->form_validation->set_rules('no_mesin','No. Mesin','required');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Kendaraan | Fleet Management",
                    "nopage" => 1051,
                ];

                $data['vehicles'] = $this->Vehicle_model->getAllVehicles();
                
                $this->load->view('headernew', $data);
                $this->load->view('vehicles', $data);
                $this->load->view('footernew');
            } else {
                $dataVehicles = array(
                    'no_pol'        => $this->input->post('no_pol'),
                    'no_pintu'      => $this->input->post('no_pintu'),
                    'type'          => $this->input->post('type'),
                    'warna'         => $this->input->post('warna'),
                    'no_chasis'     => $this->input->post('no_chasis'),
                    'no_mesin'      => $this->input->post('no_mesin'),
                    'status'        => $this->input->post('status'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );
                $this->Vehicle_model->update($id, $dataVehicles);
                $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                redirect('/vehicles');
            }
        }
    }

    public function vehiclesdel($id)
    {
        if ($post = $this->input->post('submit')) {
            // update tabel vehicles  
            $dataVehicles = array(
                'is_delete'     => $this->input->post('del'),
                'updated_at'    => date('Y-m-d H:i:s')
            );                              
            $this->Vehicle_model->update($id,$dataVehicles);
            $this->session->set_flashdata('pesansukses','Data berhasil dihapus');
            redirect('/vehicles');
        } 
    }

    public function vehiclesdocumentadd()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('noPintu','Nomor Pintu','required');
            $this->form_validation->set_rules('doc_type','Type','required');
            $this->form_validation->set_rules('expiry_date','Tanggal Expired','required');
            $this->form_validation->set_rules('doc_number','Nomor Dokumen','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
		            "title" => "Manajemen Kendaraan | Fleet Management",
		            "nopage" => 1051,
		        ];

                $data['vehicles'] = $this->Vehicle_model->getAllVehicles();
                
                $this->load->view('headernew', $data);
                $this->load->view('vehicles', $data);
                $this->load->view('footernew');
            } else {
                $dataVehiclesDocument = array(
                    'vehicle_id'  	=> $this->input->post('noPintu'),
                    'doc_type'      => $this->input->post('doc_type'),
                    'doc_number'    => $this->input->post('doc_number'),
                    'expiry_date'	=> $this->input->post('expiry_date'),
                    'status'        => 'Aktif',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );
                $this->Vehicle_model->insertDocument($dataVehiclesDocument);
                $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                redirect('/vehicles');
            }
        } 
    }

    public function vehiclessparepartadd() {
        // Validasi input
        $this->form_validation->set_rules('no_pintu', 'No. Pintu', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $no_pintu = $this->input->post('no_pintu');
            $qtys = $this->input->post('qty');
            
            $this->db->trans_start();
            
            try {
                foreach ($qtys as $inventori_id => $new_qty) {
                    $new_qty = (int)$new_qty;
                    $current_data = $this->get_vehicle_inventory($inventori_id, $no_pintu);
                    $current_qty = $current_data ? $current_data->qty : 0;
                    
                    // Hitung selisih jumlah
                    $qty_diff = $new_qty - $current_qty;
                    
                    if ($new_qty > 0) {
                        // Update atau insert data inventori kendaraan
                        $this->db->where('inventori_id', $inventori_id);
                        $this->db->where('no_pintu', $no_pintu);
                        
                        $inventory_data = [
                            'qty' => $new_qty,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        
                        if ($this->db->count_all_results('inventori_vehicles') > 0) {
                            $this->db->where('inventori_id', $inventori_id);
                            $this->db->where('no_pintu', $no_pintu);
                            $this->db->update('inventori_vehicles', $inventory_data);
                        } else {
                            $inventory_data['inventori_id'] = $inventori_id;
                            $inventory_data['no_pintu'] = $no_pintu;
                            $this->db->insert('inventori_vehicles', $inventory_data);
                        }
                        
                        // Update stok inventori (boleh minus)
                        if ($qty_diff != 0) {
                            $this->db->set('qty', "qty-{$qty_diff}", false);
                            $this->db->where('id', $inventori_id);
                            $this->db->update('inventori');
                        }
                    } else {
                        // Jika qty = 0, hapus dari inventori kendaraan
                        $this->db->where('inventori_id', $inventori_id);
                        $this->db->where('no_pintu', $no_pintu);
                        $this->db->delete('inventori_vehicles');
                        
                        // Kembalikan stok ke inventori
                        if ($current_qty > 0) {
                            $this->db->set('qty', "qty+{$current_qty}", false);
                            $this->db->where('id', $inventori_id);
                            $this->db->update('inventori');
                        }
                    }
                }
                
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception('Gagal menyimpan data sparepart');
                }
                
                $this->session->set_flashdata('success', 'Data sparepart kendaraan berhasil diperbarui');
                redirect('vehicles');
                
            } catch (Exception $e) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', $e->getMessage());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    private function get_vehicle_inventory($inventori_id, $no_pintu) {
        $this->db->where('inventori_id', $inventori_id);
        $this->db->where('no_pintu', $no_pintu);
        return $this->db->get('inventori_vehicles')->row();
    }

    public function sparepart($no_pintu)
    {
        $data = [
            "title" => "Manajemen Kendaraan | Fleet Management System",
            "nopage" => 1051,
        ];

        $data['vehicles'] = $this->Vehicle_model->getAllVehicles();
        $data['v_doc_detail'] = $this->Vehicle_model->getAllVDocDetail();
        $data['inventori'] = $this->Inventori_model->get_all_inventori();
        $data['vehicle_inventori'] = $this->Inventori_model->get_by_vehicle($no_pintu);
        $data['filter_applied'] = true; // Tambahkan flag ini
        $data['filter_no_pintu'] = $no_pintu;
        
        $this->load->view('headernew', $data);
        $this->load->view('vehicles_sparepart', $data);
        $this->load->view('footernew');
    }
}
