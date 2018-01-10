<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Topics extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('topics_model', 'tm');
        $this->load->model('thematic_area_types_model', 'tatm');

        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'topics');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }
    }

    public function index() {
        $data['topics'] = $this->tm->getTopics();
        $data['content'] = "topics/list_topics";
        $this->load->view('templates/admin/layout', $data);
    }

    public function show() {
        $data['topic'] = $this->tm->getTopics($this->input->post('topic_id'));
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['content'] = "topics/form_topic";
        $data['only_read'] = "true";
        $this->load->view('templates/admin/layout', $data);
    }

    public function create() {
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['content'] = "topics/form_topic";
        $this->load->view('templates/admin/layout', $data);
    }

    public function store() {
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim|xss_clean', array('required' => 'El Nombre de la tématica es obligatorio'));
        $this->form_validation->set_rules('thematic_area_type', 'Área Temática', 'required|trim', array('required' => 'El Área Temática es obligatoria'));

        if ($this->form_validation->run() != false) {

            $data = array(
                'name' => $this->input->post('name'),
                'thematic_area_type_id' => $this->input->post('thematic_area_type')
            );
            $res = $this->tm->store($data);

            $success = array('success' => 'La Tématica fue registrada correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/topics');
        }

        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['content'] = "topics/form_topic";
        $this->load->view('templates/admin/layout', $data);
    }

    public function edit() {

        $data['topic'] = $this->tm->getTopics($this->input->post('topic_id'));
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['content'] = "topics/form_topic";
        $this->load->view('templates/admin/layout', $data);
    }

    public function update() {
        $this->form_validation->set_rules('topic_id', 'Id de Temática', 'required|trim|xss_clean', array('required' => 'El Id de la tématica es obligatorio'));
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim|xss_clean', array('required' => 'El Nombre de la tématica es obligatorio'));
        $this->form_validation->set_rules('thematic_area_type', 'Área Temática', 'required|trim', array('required' => 'El Área Temática es obligatoria'));

        if ($this->form_validation->run() != false) {

            $data = array(
                'name' => $this->input->post('name'),
                'thematic_area_type_id' => $this->input->post('thematic_area_type')
            );

            $res = $this->tm->update($this->input->post('topic_id'), $data);

            $success = array('success' => 'La Tématica fue actualizada correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/topics');
        }

        $data['topic'] = $this->tm->getTopics($this->input->post('topic_id'));
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['content'] = "topics/form_topic";
        $this->load->view('templates/admin/layout', $data);
    }

}
