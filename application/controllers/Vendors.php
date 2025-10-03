<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller {
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
        $this->load->model('Vendor_model');
        $this->load->model('Log_model');
        $this->load->database();

        if(!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $data = [
            "title" => "Manajemen Vendor | Fleet Management System",
            "nopage" => 1400,
        ];

        $data['vendors'] = $this->Vendor_model->getAllVendor();
        
        $this->load->view('headernew', $data);
        $this->load->view('vendors', $data);
        $this->load->view('footernew');
    }

    public function vendoradd() {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmVendor','Nama Vendor','required');
            $this->form_validation->set_rules('kodeVendor','Kode Vendor','required');
            $this->form_validation->set_rules('statusVendor','Status Vendor','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen vendor | Fleet Management",
                    "nopage" => 1400,
                ];

                $this->session->set_flashdata('pesanerror','Data gagal disimpan, ada form yang belum diisi'); 
                $data['vendors'] = $this->Vendor_model->getAllvendor();
        
                $this->load->view('headernew', $data);
                $this->load->view('vendors', $data);
                $this->load->view('footernew');
            } else {
                // insert tabel vendor  
                $dataVendor = array(
                    'name'              => $this->input->post('nmVendor'),
                    'kode'              => $this->input->post('kodeVendor'),
                    'status'            => $this->input->post('statusVendor'),
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Vendor_model->insert($dataVendor); 
                $vendor_id = $this->db->insert_id();

                // insert tabel log
                $dataLog = array(
                    'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
                    'aktifitas'     => 'Tambah vendor dengan nama '.$this->input->post('nmVendor').', vendor_id '.$vendor_id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );                              
                $this->Log_model->insert($dataLog);

                redirect('/vendors');
            }
        } 
    }

    public function vendoredit($id) {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('nmVendor','Nama Proyek','required');
            $this->form_validation->set_rules('kodeVendor','Kode Vendor','required');
            $this->form_validation->set_rules('picVendor','PIC Vendor','');
            $this->form_validation->set_rules('noTelpVendor','Phone Vendor','');
            $this->form_validation->set_rules('statusVendor','Status Proyek','required');
            $this->form_validation->set_rules('alamatVendor','Alamat Proyek','');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Proyek | Fleet Management",
                    "nopage" => 1400,
                ];

                $this->session->set_flashdata('pesanerror','Data gagal disimpan, ada form yang belum diisi'); 
                $data['vendors'] = $this->Vendor_model->getAllVendor();
        
                $this->load->view('headernew', $data);
                $this->load->view('vendors', $data);
                $this->load->view('footernew');
            } else {
                // update tabel vendor  
                $dataVendor = array(
                    'name'              => $this->input->post('nmVendor'),
                    'kode'              => $this->input->post('kodeVendor'),
                    'pic'               => $this->input->post('picVendor'),
                    'phone'             => $this->input->post('noTelpVendor'),
                    'address'           => $this->input->post('alamatVendor'),
                    'status'            => $this->input->post('statusVendor'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Vendor_model->update($id,$dataVendor);

                // update tabel vendor_items  
                $dataVendorItem = array(
                    'status'            => $this->input->post('statusVendor'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Vendor_model->updateItemByIdVendor($id,$dataVendorItem);

                // insert tabel log  
                $this->db->select('name'); 
                $this->db->from('vendors'); 
                $this->db->where('id', $id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $vendor = $query->row();
                } 
                $query->free_result();

                $dataLog = array(
                    'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
                    'aktifitas'     => 'Edit vendor dengan nama '.$vendor->name.', vendor_id '.$id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );                              
                $this->Log_model->insert($dataLog);

                redirect('/vendors');
            }
        } 
    }

    public function vendordel($id) {
        if ($post = $this->input->post('submit')) {
            // update tabel vendor  
            $dataVendor = array(
                'is_delete'       => $this->input->post('del'),
                'status'          => 'Non Aktif',
                'updated_at'      => date('Y-m-d H:i:s')
            );                              
            $this->Vendor_model->update($id,$dataVendor);

            // update tabel vendor_items  
            $dataVendorItem = array(
                'is_delete'       => 1,
                'status'          => 'Non Aktif',
                'updated_at'      => date('Y-m-d H:i:s')
            );               
            $this->Vendor_model->updateItemByIdVendor($id,$dataVendorItem);

            // insert tabel log  
            $this->db->select('name'); 
            $this->db->from('vendors'); 
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $vendor = $query->row();
            } 
            $query->free_result();

            $dataLog = array(
                'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
                'aktifitas'     => 'Hapus vendor dengan nama '.$vendor->name.', vendor_id '.$id,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            );                              
            $this->Log_model->insert($dataLog);

            redirect('/vendors');
        } 
    }

    public function items($id)
    {
        $data = [
            "title" => "Manajemen Vendor | Fleet Management System",
            "nopage" => 1401,
        ];

        $data['sparepart'] = $this->Vendor_model->getAllVendorItems($id);
        $data['vendor_id'] = $id;

        $this->load->view('headernew', $data);
        $this->load->view('vendor_items', $data);
        $this->load->view('footernew');
    }

    public function sparepartadd($id)
    {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('sparepart','Sparepart','required');
            $this->form_validation->set_rules('harga','Harga','required');
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Sparepart | Fleet Management",
                    "nopage" => 1401,
                ];

                $data['sparepart'] = $this->Vendor_model->getAllVendorItems($id);
                $data['vendor_id'] = $id;
                $this->session->set_flashdata('pesanerror','Semua field (Sparepart, Harga, Status) wajib diisi!');

                $this->load->view('headernew', $data);
                $this->load->view('vendor_items', $data);
                $this->load->view('footernew');
            } else {
                $vendor_id = $this->input->post('vendor_id');
                // insert tabel vendor_items  
                $dataVendor = array(
                    'vendor_id'         => $vendor_id,
                    'sparepart'         => $this->input->post('sparepart'),
                    'harga'             => $this->input->post('harga'),
                    'status'            => $this->input->post('status'),
                    'is_delete'         => 0,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Vendor_model->insert_items($dataVendor); 

                // insert tabel log
                $this->db->select('name'); 
                $this->db->from('vendors'); 
                $this->db->where('id', $vendor_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $vendor = $query->row();
                } 
                $query->free_result();

                $dataLog = array(
                    'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
                    'aktifitas'     => 'Tambah sparepart '.$this->input->post('sparepart').', untuk vendor '.$vendor->name.' dengan vendor_id '.$vendor_id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );                              
                $this->Log_model->insert($dataLog);

                $this->session->set_flashdata('pesansukses','Data berhasil disimpan');
                redirect('vendors/items/'.$vendor_id.'/');
            }
        } 
    }

    public function sparepartedit($id) {
        if ($post = $this->input->post('submit')) {
            $this->form_validation->set_rules('status','Status','required');

            if ($this->form_validation->run()==FALSE) {     
                $data = [
                    "title" => "Manajemen Sparepart | Fleet Management",
                    "nopage" => 1401,
                ];

                $data['sparepart'] = $this->Vendor_model->getAllVendorItems($this->input->post('vendor_id'));
                $data['vendor_id'] = $this->input->post('vendor_id');
                $this->session->set_flashdata('pesanerror','Field status wajib diisi!');

                $this->load->view('headernew', $data);
                $this->load->view('vendor_items', $data);
                $this->load->view('footernew');
            } else {
                // update tabel vendor_item  
                $dataVendorItem = array(
                    'status'            => $this->input->post('status'),
                    'updated_at'        => date('Y-m-d H:i:s')
                );                              
                $this->Vendor_model->update_item($id,$dataVendorItem);

                // insert tabel log
                $this->db->select('sparepart'); 
                $this->db->from('vendor_items'); 
                $this->db->where('id', $id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $vendorItem = $query->row();
                } 
                $query->free_result();

                $dataLog = array(
                    'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
                    'aktifitas'     => 'Edit sparepart '.$vendorItem->sparepart.', vendor_item_id '.$id,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );                              
                $this->Log_model->insert($dataLog);

                $this->session->set_flashdata('pesansukses','Data berhasil diupdate');
                redirect('/vendors/items/'.$this->input->post('vendor_id'));
            }
        } 
    }

    // public function sparepartdel($id)
    // {
    //     if ($post = $this->input->post('submit')) {
    //         // update tabel vendor  
    //         $dataVendor = array(
    //             'is_delete'       => $this->input->post('del'),
    //             'status'          => 'Non Aktif',
    //             'updated_at'      => date('Y-m-d H:i:s')
    //         );               
    //         $this->Vendor_model->update_items($id,$dataVendor);

    //         // insert tabel log
    //         $this->db->select('vendor_id, sparepart'); 
    //         $this->db->from('vendor_items'); 
    //         $this->db->where('id', $id);
    //         $query = $this->db->get();
    //         if ($query->num_rows() > 0) {
    //             $vendorItem = $query->row();
    //         } 
    //         $query->free_result();

    //         $dataLog = array(
    //             'nama_user'     => $this->session->userdata('user_firstname').' '.$this->session->userdata('user_lastname'),
    //             'aktifitas'     => 'Hapus sparepart '.$vendorItem->sparepart.', dengan sparepart_id '.$id,
    //             'created_at'    => date('Y-m-d H:i:s'),
    //             'updated_at'    => date('Y-m-d H:i:s')
    //         );                              
    //         $this->Log_model->insert($dataLog);

    //         $this->session->set_flashdata('pesansukses','Data berhasil dihapus');
    //         redirect('vendors/items/'.$vendorItem->vendor_id.'/');
    //     } 
    // }
}
