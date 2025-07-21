<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
// use namespace
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    public function login_post() {
        $input = json_decode(file_get_contents("php://input"), true);
        $email = $input['email'];
        $password = $input['password'];

        $this->load->model('User_model');
        $user = $this->User_model->authenticate($email, $password);

        if ($user) {
            $this->response(['token' => md5($user['id'] . time()), 'user' => $user]);
        } else {
            http_response_code(401);
            $this->response(['error' => 'Invalid credentials']);
        }
    }

    public function me_get() {
        // You may check token here
        $this->response(['user' => 'current-user']);
    }
}
