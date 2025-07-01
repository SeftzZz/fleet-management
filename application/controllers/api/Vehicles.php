<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;
use \Firebase\JWT\JWT;
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Vehicles extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vehicle_model');
    }

    public function index_get() {
        $data = $this->Vehicle_model->get_all();
        $this->response($data);
    }

    public function index_post() {
        $input = json_decode(file_get_contents("php://input"), true);
        $this->Vehicle_model->insert($input);
        $this->response(['status' => 'success']);
    }

    public function show_get($id) {
        $data = $this->Vehicle_model->get_by_id($id);
        $this->response($data);
    }

    public function update_put($id) {
        $input = json_decode(file_get_contents("php://input"), true);
        $this->Vehicle_model->update($id, $input);
        $this->response(['status' => 'updated']);
    }

    public function delete_delete($id) {
        $this->Vehicle_model->delete($id);
        $this->response(['status' => 'deleted']);
    }
}
