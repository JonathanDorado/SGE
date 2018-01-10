<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('users_model', 'um');
        $this->load->model('clients_model', 'cm');
        $this->load->model('profile_permissions_model', 'ppm');
        $this->load->helper('cookie');
    }

    public function index() {
        if (!$this->session->userdata('user_type')) {
            $data['content'] = "login/login";
            $this->load->view('templates/login/layout', $data);
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                redirect('/home', 'refresh');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }
    }

    public function validate() {

        $this->form_validation->set_rules('login_type', 'Login Type', 'required|trim|xss_clean');
        if ($this->input->post('login_type') == 1) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[8]');
        } else {
            $this->form_validation->set_rules('document_number', 'Documento de Identificación', 'required|trim|xss_clean');
        }

        if ($this->form_validation->run() != false) {

            if ($this->input->post('login_type') == 1) {
                $res = $this->um->validate_login($this->input->post('email'), $this->input->post('password'));

                if ($res != false) {
                    if ($res[0]->isChangePasswordRequired == 1) {
                        echo json_encode(array('result' => 3, 'user_id' => $res[0]->user_id));
                    } else {
                        $permissions = $this->ppm->getPermissionsByProfile($res[0]->profile_id);

                        $array_permissions = array();
                        foreach ($permissions as $permission) {
                            array_push($array_permissions, $permission->alias);
                        }

                        $session = array(
                            'user_id' => $res[0]->user_id,
                            'name' => $res[0]->name,
                            'lastname' => $res[0]->lastname,
                            'email' => $res[0]->email,
                            'profile_id' => $res[0]->profile_id,
                            'permissions' => $array_permissions,
                            'user_type' => 'CCS'
                        );

                        $this->session->set_userdata($session);
                        echo json_encode(array('result' => 1, 'msg' => 'Ingreso exitoso usuario ccs'));
//                        redirect('/home', 'refresh');
                    }
                } else {
                    echo json_encode(array('result' => 0, 'msg' => 'Error de autentiación usuario ccs'));
                }
            } else {
                $res = $this->cm->getClients('', $this->input->post('document_number'));

                if (count($res) > 0) {

                    $session = array(
                        'client_id' => $res[0]->client_id,
                        'name' => $res[0]->name,
                        'lastname' => $res[0]->lastname,
                        'email' => $res[0]->email,
                        'permissions' => array(),
                        'user_type' => 'CLIENT'
                    );

                    $this->session->set_userdata($session);
                    echo json_encode(array('result' => 1, 'msg' => 'Ingreso exitoso cliente'));
//                    redirect('/mycourses', 'refresh');
                } else {
                    echo json_encode(array('result' => 0, 'msg' => 'Error de autentiación cliente'));
                }
            }
        } else {
            echo json_encode(array('result' => 0, 'msg' => 'Error de validacion de campos'));
        }
    }

}
