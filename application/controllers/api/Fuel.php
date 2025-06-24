<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Fuel extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Fuel_model');
    }

    public function index_get($vehicle_id) {
        $this->response($this->Fuel_model->get_by_vehicle($vehicle_id));
    }

    public function index_post($vehicle_id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $data['vehicle_id'] = $vehicle_id;
        $this->Fuel_model->insert($data);
        $this->response(['status' => 'created']);
    }

    public function show_get($id) {
        $this->response($this->Fuel_model->get_by_id($id));
    }

    public function update_put($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Fuel_model->update($id, $data);
        $this->response(['status' => 'updated']);
    }

    public function delete_delete($id) {
        $this->Fuel_model->delete($id);
        $this->response(['status' => 'deleted']);
    }
}
=======
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Fuel extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Fuel_model');
    }

    public function index_get($vehicle_id) {
        $this->response($this->Fuel_model->get_by_vehicle($vehicle_id));
    }

    public function index_post($vehicle_id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $data['vehicle_id'] = $vehicle_id;
        $this->Fuel_model->insert($data);
        $this->response(['status' => 'created']);
    }

    public function show_get($id) {
        $this->response($this->Fuel_model->get_by_id($id));
    }

    public function update_put($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Fuel_model->update($id, $data);
        $this->response(['status' => 'updated']);
    }

    public function delete_delete($id) {
        $this->Fuel_model->delete($id);
        $this->response(['status' => 'deleted']);
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
