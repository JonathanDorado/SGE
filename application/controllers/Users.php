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
    function sendMail() {
        $this->load->library("php_mailer");
        $mail = $this->php_mailer->load();
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.yandex.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'USERNAME';                 // SMTP username
            $mail->Password = 'PASSWORD';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('USEREMAIL', 'Ganesha from Retainly');
            $mail->addAddress('andrea.amaya@ccs.org.co', 'Danny');     // Add a recipient
            $mail->addAddress('jdingenieria@outlook.com');               // Name is optional
//            $mail->addReplyTo('RECEIPIENTEMAIL03', 'Ganesha');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

}
