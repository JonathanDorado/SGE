<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('profiles_model', 'pm');
        $this->load->model('users_model', 'um');
        
        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'users');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }

    }

    public function index() {
        $data['users'] = $this->um->getUsers();
        $data['content'] = "users/list_users";
        $this->load->view('templates/admin/layout', $data);
    }

    public function show() {
        $data['user'] = $this->um->getUsers($this->input->post('user_id'));
        $data['profiles'] = $this->pm->getProfiles();
        $data['content'] = "users/form_user";
        $data['only_read'] = "true";
        $this->load->view('templates/admin/layout', $data);
    }

    public function create() {
        $data['profiles'] = $this->pm->getProfiles();
        $data['content'] = "users/form_user";
        $this->load->view('templates/admin/layout', $data);
    }

    public function store() {
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim|xss_clean', array('required' => 'El Nombre del usuario es obligatorio'));
        $this->form_validation->set_rules('lastname', 'Apellidos', 'required|trim|xss_clean', array('required' => 'El Apellido del usuario es obligatorio'));
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|is_unique[users.email]', array('required' => 'El Email es obligatorio', 'is_unique' => 'El Email ingresado ya se encuentra registrado'));
        $this->form_validation->set_rules('profile', 'Perfil', 'required|trim|xss_clean', array('required' => 'El Perfil es obligatorio'));

        if ($this->form_validation->run() != false) {
            $password = $this->getToken(8);
            $data = array(
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'profile_id' => $this->input->post('profile'),
                'password' => sha1($password)
            );

            $res = $this->um->store($data);

            //Agregar envio de datos por email

            $success = array('success' => 'El usuario fue registrado correctamente! Los datos de acceso fueron enviados al correo del usuario.');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/users');
        }

        $data['profiles'] = $this->um->getUsers();
        $data['content'] = "users/form_user";
        $this->load->view('templates/admin/layout', $data);
    }

    public function edit() {

        $data['user'] = $this->um->getUsers($this->input->post('user_id'));
        $data['profiles'] = $this->pm->getProfiles();
        $data['content'] = "users/form_user";
        $this->load->view('templates/admin/layout', $data);
    }

    public function update() {

        $is_unique = "";
        if ($this->input->post('email') != $this->input->post('email_old')) {
            $is_unique = '|is_unique[users.email]';
        }

        $this->form_validation->set_rules('user_id', 'Id de Usuario', 'required|trim|xss_clean', array('required' => 'El Id del Usuario es obligatorio'));
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim|xss_clean', array('required' => 'El Nombre del usuario es obligatorio'));
        $this->form_validation->set_rules('lastname', 'Apellidos', 'required|trim|xss_clean', array('required' => 'El Apellido del usuario es obligatorio'));
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean' . $is_unique, array('required' => 'El Email es obligatorio', 'is_unique' => 'El Email ingresado ya se encuentra registrado'));
        $this->form_validation->set_rules('profile', 'Perfil', 'required|trim|xss_clean', array('required' => 'El Perfil es obligatorio'));

        if ($this->form_validation->run() != false) {

            $data = array(
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'profile_id' => $this->input->post('profile'),
            );

            $res = $this->um->update($this->input->post('user_id'), $data);

            $success = array('success' => 'El Usuario fue actualizado correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/users');
        }

        $data['user'] = $this->um->getUsers($this->input->post('user_id'));
        $data['profiles'] = $this->pm->getProfiles();
        $data['content'] = "users/form_user";
        $this->load->view('templates/admin/layout', $data);
    }

    public function reset_password_User() {
        $user_id = $this->input->post('user_id');

        $password = $this->getToken(8);
        $data = array(
            'password' => sha1($password),
            'isChangePasswordRequired' => 1
        );

        $res = $this->um->update($this->input->post('user_id'), $data);

        ////Falta hacer envio de datos por email
        echo json_encode(array('msg' => 'Contraseña reseteada correctamente! Se enviaran los nuevos datos al correo electrónico del usuario.'));
    }

    public function change_state_User() {
        $user_id = $this->input->post('user_id');
        $active = $this->input->post('state');

        $data = array(
            'active' => $active
        );
        $res = $this->um->update($this->input->post('user_id'), $data);

        if ($active == 0) {
            $success = array('success' => 'El Usuario fue inactivado exitosamentamente!');
        } else {
            $success = array('success' => 'El Usuario fue activado exitosamentamente!');
        }

        $this->session->set_flashdata('success', $success['success']);
        redirect('/users');
    }

    function getToken($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
//
//    function sendMail() {
//        $to = 'jdingenieria@outlook.com';
//        $subject = 'the subject';
//        $message = 'hello';
//        $headers = 'From: webmaster@example.com' . "\r\n" .
//                'Reply-To: webmaster@example.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//
//        mail($to, $subject, $message, $headers);
////        $config = Array(
////            'protocol' => 'smtp',
////            'smtp_host' => 'ssl://smtp.gmail.com',
////            'smtp_port' => 465,
////            'smtp_user' => 'jonathan910730@gmail.com', // change it to yours
////            'smtp_pass' => 'PraSiCrm01', // change it to yours
////            'mailtype' => 'html',
////            'charset' => 'iso-8859-1',
////            'wordwrap' => TRUE
////        );
////
////        $message = '';
////        $this->load->library('email', $config);
////        $this->email->set_newline("\r\n");
////        $this->email->from('eventosccs@gmail.com'); // change it to yours
////        $this->email->to('jdingenieria@outlook.com'); // change it to yours
////        $this->email->subject('Resume from JobsBuddy for your Job posting');
////        $this->email->message($message);
////        if ($this->email->send()) {
////            echo 'Email sent.';
////        } else {
////            show_error($this->email->print_debugger());
////        }
//    }

}
