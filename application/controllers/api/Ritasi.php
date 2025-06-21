<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Ritasi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ritasi_model');
        $this->load->model('Wallet_model');
    }

    public function index_post() {
        $data = json_decode($this->input->raw_input_stream, true);

        // Validasi sederhana
        $required = ['ritasi_date', 'vehicle_id', 'driver_id', 'route_id', 'bak_number', 'jam_angkut', 'no_do'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return $this->response([
                    'status' => false,
                    'message' => "Field $field wajib diisi"
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        // Simpan ritasi_logs
        $ritasiData = [
            'ritasi_date' => $data['ritasi_date'],
            'vehicle_id' => $data['vehicle_id'],
            'driver_id' => $data['driver_id'],
            'route_id' => $data['route_id'],
            'bak_number' => $data['bak_number'],
            'jam_angkut' => $data['jam_angkut'],
            'no_do' => $data['no_do'],
            'actual_distance' => isset($data['actual_distance']) ? $data['actual_distance'] : null,
            'end_time' => isset($data['end_time']) ? $data['end_time'] : null,
            'notes' => isset($data['notes']) ? $data['notes'] : null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $ritasi_id = $this->Ritasi_model->insert($ritasiData);
        if (!$ritasi_id) {
            return $this->response([
                'status' => false,
                'message' => 'Gagal menyimpan data ritasi'
            ], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Update wallet driver jika ada wallet_amount > 0
        $wallet_amount = isset($data['wallet_amount']) ? floatval($data['wallet_amount']) : 0;
        if ($wallet_amount > 0) {
            // Cek wallet driver
            $wallet = $this->Wallet_model->get_by_driver($data['driver_id']);
            if ($wallet) {
                // Update saldo wallet
                $new_balance = $wallet->balance + $wallet_amount;
                $this->Wallet_model->update($wallet->id, ['balance' => $new_balance]);
                $wallet_id = $wallet->id;
            } else {
                // Buat wallet baru untuk driver
                $wallet_id = $this->Wallet_model->insert([
                    'driver_id' => $data['driver_id'],
                    'balance' => $wallet_amount,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            // Catat transaksi wallet
            $this->Wallet_model->insert_transaction([
                'wallet_id' => $wallet_id,
                'amount' => $wallet_amount,
                'type' => 'credit', // uang jalan masuk
                'description' => "Uang jalan untuk ritasi ID $ritasi_id",
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $this->response([
            'status' => true,
            'message' => 'Ritasi dan wallet berhasil disimpan',
            'ritasi_id' => $ritasi_id
        ], REST_Controller::HTTP_CREATED);
    }
}
