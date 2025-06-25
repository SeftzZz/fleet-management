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
            "title" => "Manajemen Kendaraan | Fleet Management",
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
            
            $this->load->view('headernew', $data);
            $this->load->view('vehicles', $data);
            $this->load->view('footernew');
        } else {
            $data['vehicles'] = $this->Vehicle_model->getAllVehicles();
            $data['v_doc_detail'] = $this->Vehicle_model->getAllVDocDetail();
            
            $this->load->view('headernew', $data);
            $this->load->view('vehicles', $data);
            $this->load->view('footernew');
        }
	}

	public function vehiclesadd()
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('no_pol','Tanggal Bergabung','required');
            $this->form_validation->set_rules('no_pintu','Nama','required');
            $this->form_validation->set_rules('type','No. SIM','required');
            $this->form_validation->set_rules('warna','No. HP','required');
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
            $this->form_validation->set_rules('vehicle_id','Tanggal Bergabung','required');
            $this->form_validation->set_rules('doc_type','Nama','required');
            $this->form_validation->set_rules('expiry_date','No. SIM','required');
            $this->form_validation->set_rules('doc_number','No. HP','required');

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
                    'vehicle_id'  	=> $this->input->post('vehicle_id'),
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
}
