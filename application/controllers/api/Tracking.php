<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Tracking extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tracking_model');
    }

    public function index_post($vehicle_id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $data['vehicle_id'] = $vehicle_id;
        $this->Tracking_model->insert($data);
        $this->response(['status' => 'tracked']);
    }

    public function index_get($vehicle_id) {
        $this->response($this->Tracking_model->get_by_vehicle($vehicle_id));
    }
}
