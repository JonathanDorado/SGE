<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('users_model', 'um');
    }

    public function index() {
        $data['content'] = "login/reset_password";
        $this->load->view('templates/login/layout', $data);
    }

    public function edit() {

        $data['user_id'] = $this->input->post('user_id');
        $data['content'] = "login/change_password";
        $this->load->view('templates/login/layout', $data);
    }

    public function resetPassword() {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
        if ($this->form_validation->run() != false) {

            $user = $this->um->getUsers("", $this->input->post('email'));
            if (count($user) > 0) {
                $password = $this->getToken(8);
                $data = array(
                    'password' => sha1($password),
                    'isChangePasswordRequired' => 1
                );

                $res = $this->um->updateByEmail($this->input->post('email'), $data);

                ////Falta hacer envio de datos por email
                echo json_encode(array('result' => 1));
            } else {
                echo json_encode(array('result' => 0));
            }
        } else {
            echo json_encode(array('result' => 0));
        }
    }

    public function update() {

        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        if ($this->form_validation->run() != false) {

            $data = array(
                'password' => sha1($this->input->post('password')),
                'isChangePasswordRequired' => 0
            );

            $res = $this->um->update($this->input->post('user_id'), $data);

            ////Falta hacer envio de datos por email
            echo json_encode(array('result' => 1));
        } else {
            echo json_encode(array('result' => 0));
        }
    }

    function getToken($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }

}
