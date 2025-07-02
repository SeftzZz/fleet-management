<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Alerts extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Alerts_model');
    }

    public function index_get($vehicle_id) {
        $this->response($this->Alerts_model->get_by_vehicle($vehicle_id));
    }

    public function index_post($vehicle_id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $data['vehicle_id'] = $vehicle_id;
        $this->Alerts_model->insert($data);
        $this->response(['status' => 'created']);
    }

    public function show_get($id) {
        $this->response($this->Alerts_model->get_by_id($id));
    }

    public function update_put($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Alerts_model->update($id, $data);
        $this->response(['status' => 'updated']);
    }

    public function delete_delete($id) {
        $this->Alerts_model->delete($id);
        $this->response(['status' => 'deleted']);
    }
}
