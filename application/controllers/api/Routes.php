<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Routes extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Route_model');
    }

    public function index_get() {
        $this->response($this->Route_model->get_all());
    }

    public function get_by_id_get($vehicle_id) {
        $this->response($this->Route_model->get_by_id($vehicle_id));
    }

    public function index_post() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Route_model->insert($data);
        $this->response(['status' => 'created']);
    }

    public function show_get($id) {
        $this->response($this->Route_model->get_by_id($id));
    }

    public function update_put($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Route_model->update($id, $data);
        $this->response(['status' => 'updated']);
    }

    public function delete_delete($id) {
        // Hapus dulu ritasi_logs yang terkait
        $this->db->where('route_id', $id);
        $this->db->delete('ritasi_logs');

        // Baru hapus route-nya
        $this->Route_model->delete($id);
        $this->response(['status' => 'deleted']);
    }

    public function get_route_post()
    {
        // Ambil raw JSON body
        $json = json_decode($this->input->raw_input_stream, true);

        if (!$json || !isset($json['start'], $json['goal'])) {
            return $this->response([
                'status' => false,
                'message' => 'Invalid input'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

        $start = $json['start']; // array [x, y]
        $goal = $json['goal'];   // array [x, y]

        $cmd = sprintf(
            'python3 /home/devtgx/api-fleet-management/route_calculation.py %s %s %s %s',
            escapeshellarg($start[0]),
            escapeshellarg($start[1]),
            escapeshellarg($goal[0]),
            escapeshellarg($goal[1])
        );
        log_message('debug', 'Route CMD: ' . $cmd);

        $output = shell_exec($cmd);
        log_message('debug', 'Route CMD: ' . $output);

        if ($output) {
            $decoded = json_decode($output, true);

            return $this->response([
                'status' => $decoded['status'],
                'message' => $decoded['message'],
                'path' => $decoded['path']
            ], REST_Controller::HTTP_OK);
        } else {
            log_message('error', 'Python script returned no output.');
            return $this->response([
                'status' => false,
                'message' => 'Failed to calculate route'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
