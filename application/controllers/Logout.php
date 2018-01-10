<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

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

    public function closeSession() {
        $this->session->userdata = array();
        $this->session->sess_destroy();
        redirect('/', 'refresh');
    }

}
