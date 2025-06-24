<<<<<<< HEAD
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Drivers extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Driver_model');
    }

    public function index_get() {
        $this->response($this->Driver_model->get_all());
    }

    public function index_post() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Driver_model->insert($data);
        $this->response(['status' => 'success']);
    }

    public function show_get($id) {
        $this->response($this->Driver_model->get_by_id($id));
    }

    public function update_put($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Driver_model->update($id, $data);
        $this->response(['status' => 'updated']);
    }

    public function delete_delete($id) {
        $this->Driver_model->delete($id);
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

class Drivers extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Driver_model');
    }

    public function index_get() {
        $this->response($this->Driver_model->get_all());
    }

    public function index_post() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Driver_model->insert($data);
        $this->response(['status' => 'success']);
    }

    public function show_get($id) {
        $this->response($this->Driver_model->get_by_id($id));
    }

    public function update_put($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->Driver_model->update($id, $data);
        $this->response(['status' => 'updated']);
    }

    public function delete_delete($id) {
        $this->Driver_model->delete($id);
        $this->response(['status' => 'deleted']);
    }
}
>>>>>>> 73efc7e9b82e023a3212b22621cfe8b8eff37ad0
