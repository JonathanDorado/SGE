<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Providers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('providers_model', 'pm');
        $this->load->model('provider_types_model', 'ptm');
        $this->load->model('document_types_model', 'dtm');
        $this->load->model('areas_model', 'am');
        $this->load->model('thematic_area_types_model', 'tatm');
        $this->load->model('consultant_clasifications_model', 'ccm');

        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'providers');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }
    }

    public function index() {
        $data['providers'] = $this->pm->getProviders();
        $data['content'] = "providers/list_providers";
        $this->load->view('templates/admin/layout', $data);
    }

    public function show() {
        $data['provider'] = $this->pm->getProviders($this->input->post('provider_id'));
        $data['provider_types'] = $this->ptm->getProviderTypes();
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['areas'] = $this->am->getAreas();
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['consultant_clasifications'] = $this->ccm->getConsultantClasifications();
        $data['content'] = "providers/form_provider";
        $data['only_read'] = "true";
        $this->load->view('templates/admin/layout', $data);
    }

    public function create() {
        $data['provider_types'] = $this->ptm->getProviderTypes();
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['areas'] = $this->am->getAreas();
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['consultant_clasifications'] = $this->ccm->getConsultantClasifications();
        $data['content'] = "providers/form_provider";
        $this->load->view('templates/admin/layout', $data);
    }

    public function store() {

        $this->form_validation->set_rules('provider_type', 'Tipo de Proveedor', 'required|trim|xss_clean', array('required' => 'El Tipo de Proveedor es obligatorio'));
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim|xss_clean', array('required' => 'El Nombre del capacitador es obligatorio'));
        $this->form_validation->set_rules('lastname', 'Apellidos', 'required|trim|xss_clean', array('required' => 'El Apellido del capacitador es obligatorio'));
        $this->form_validation->set_rules('document_type', 'Tipo de Documento', 'required|trim|xss_clean', array('required' => 'El Tipo de Documento es obligatorio'));
        $this->form_validation->set_rules('document_number', 'Número de Doucmento', 'required|trim|xss_clean|is_unique[providers.document_number]', array('required' => 'El Número de Documento es obligatorio', 'is_unique' => 'El Número de Documento ingresado ya se encuentra registrado'));
        $this->form_validation->set_rules('date_birthday', 'Fecha de Nacimiento', 'required|trim|xss_clean', array('required' => 'La Fecha de Nacimiento es obligatoria'));
        $this->form_validation->set_rules('date_start_ccs', 'Fecha Inicio CCS', 'required|trim|xss_clean', array('required' => 'La Fecha de Inicio en CCS es obligatorio'));
        $this->form_validation->set_rules('area', 'Área Responsable', 'required|trim|xss_clean', array('required' => 'El Área Responsable es obligatoria'));
        $this->form_validation->set_rules('thematic_area_type', 'Área Temática', 'required|trim|xss_clean', array('required' => 'El Área Temática es obligatoria'));
        $this->form_validation->set_rules('consultant_clasification', 'Clasificación del Consultor', 'required|trim|xss_clean', array('required' => 'La Clasificación del Consultor es obligatorio'));


        $url_img_profile_name = "";
        if ($_FILES['url_img_profile']['name'] != "" and $_FILES['url_img_profile']['name'] != null) {
            $config_profile['upload_path'] = './uploads/providers/profile';
            $config_profile['allowed_types'] = 'jpg|png|jpeg';
            $config_profile['max_size'] = 2048 * 10;
            $config_profile['max_width'] = 3840;
            $config_profile['max_height'] = 2480;
            $this->load->library('upload', $config_profile);
            if (!$this->upload->do_upload('url_img_profile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $url_img_profile_name = $upload_data['upload_data']['file_name'];
            }
        }

        if ($this->form_validation->run() != false) {

            $data = array(
                'provider_type_id' => $this->input->post('provider_type'),
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'document_type_id' => $this->input->post('document_type'),
                'document_number' => $this->input->post('document_number'),
                'date_birthday' => $this->input->post('date_birthday'),
                'date_start_ccs' => $this->input->post('date_start_ccs'),
                'area_id' => $this->input->post('area'),
                'thematic_area_type_id' => $this->input->post('thematic_area_type'),
                'consultant_clasification_id' => $this->input->post('consultant_clasification'),
                'url_img_profile' => $url_img_profile_name
            );

            $res = $this->pm->store($data);

            $success = array('success' => 'El proveedor fue registrado correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/providers');
        }

//        $error = array('error' => $this->upload->display_errors());
//        $this->session->set_flashdata('error', $error['error']);

        $data['provider_types'] = $this->ptm->getProviderTypes();
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['areas'] = $this->am->getAreas();
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['consultant_clasifications'] = $this->ccm->getConsultantClasifications();
        $data['content'] = "providers/form_provider";
        $this->load->view('templates/admin/layout', $data);
    }

    public function edit() {

        $data['provider'] = $this->pm->getProviders($this->input->post('provider_id'));
        $data['provider_types'] = $this->ptm->getProviderTypes();
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['areas'] = $this->am->getAreas();
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['consultant_clasifications'] = $this->ccm->getConsultantClasifications();
        $data['content'] = "providers/form_provider";
        $this->load->view('templates/admin/layout', $data);
    }

    public function update() {

        $is_unique = "";
        if ($this->input->post('document_number') != $this->input->post('document_number_old')) {
            $is_unique = '|is_unique[providers.document_number]';
        }

        $this->form_validation->set_rules('provider_id', 'Id de Proveedor', 'required|trim|xss_clean', array('required' => 'El Id de Proveedor es obligatorio'));
        $this->form_validation->set_rules('provider_type', 'Tipo de Proveedor', 'required|trim|xss_clean', array('required' => 'El Tipo de Proveedor es obligatorio'));
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim|xss_clean', array('required' => 'El Nombre del capacitador es obligatorio'));
        $this->form_validation->set_rules('lastname', 'Apellidos', 'required|trim|xss_clean', array('required' => 'El Apellido del capacitador es obligatorio'));
        $this->form_validation->set_rules('document_type', 'Tipo de Documento', 'required|trim|xss_clean', array('required' => 'El Tipo de Documento es obligatorio'));
        $this->form_validation->set_rules('document_number', 'Número de Doucmento', 'required|trim|xss_clean' . $is_unique, array('required' => 'El Número de Documento es obligatorio', 'is_unique' => 'El Número de Documento ingresado ya se encuentra registrado'));
        $this->form_validation->set_rules('date_birthday', 'Fecha de Nacimiento', 'required|trim|xss_clean', array('required' => 'La Fecha de Nacimiento es obligatoria'));
        $this->form_validation->set_rules('date_start_ccs', 'Fecha Inicio CCS', 'required|trim|xss_clean', array('required' => 'La Fecha de Inicio en CCS es obligatorio'));
        $this->form_validation->set_rules('area', 'Área Responsable', 'required|trim|xss_clean', array('required' => 'El Área Responsable es obligatoria'));
        $this->form_validation->set_rules('thematic_area_type', 'Área Temática', 'required|trim|xss_clean', array('required' => 'El Área Temática es obligatoria'));
        $this->form_validation->set_rules('consultant_clasification', 'Clasificación del Consultor', 'required|trim|xss_clean', array('required' => 'La Clasificación del Consultor es obligatorio'));

        $url_img_profile_name = "";
        if ($_FILES['url_img_profile']['name'] != "" and $_FILES['url_img_profile']['name'] != null) {
            $config_profile['upload_path'] = './uploads/providers/profile';
            $config_profile['allowed_types'] = 'jpg|png|jpeg';
            $config_profile['max_size'] = 2048 * 10;
            $config_profile['max_width'] = 3840;
            $config_profile['max_height'] = 2480;
            $this->load->library('upload', $config_profile);
            if (!$this->upload->do_upload('url_img_profile')) {
                $error = array('error' => $this->upload->display_errors());
            }
            $upload_profile = $this->upload->do_upload('url_img_profile');
            $upload_data = $this->upload->data();
            $url_img_profile_name = $upload_data['file_name'];
        } else {
            $url_img_profile_name = $this->input->post('url_img_profile_old');
        }

        if ($this->form_validation->run() != false) {

            $data = array(
                'provider_type_id' => $this->input->post('provider_type'),
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'document_type_id' => $this->input->post('document_type'),
                'document_number' => $this->input->post('document_number'),
                'date_birthday' => $this->input->post('date_birthday'),
                'date_start_ccs' => $this->input->post('date_start_ccs'),
                'area_id' => $this->input->post('area'),
                'thematic_area_type_id' => $this->input->post('thematic_area_type'),
                'consultant_clasification_id' => $this->input->post('consultant_clasification'),
                'url_img_profile' => $url_img_profile_name
            );

            $res = $this->pm->update($this->input->post('provider_id'), $data);

            $success = array('success' => 'El proveedor fue actualizado correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/providers');
        }

        $data['provider'] = $this->pm->getProviders($this->input->post('provider_id'));
        $data['provider_types'] = $this->ptm->getProviderTypes();
        $data['document_types'] = $this->dtm->getDocumentTypes();
        $data['areas'] = $this->am->getAreas();
        $data['thematic_area_types'] = $this->tatm->getThematicAreaTypes();
        $data['consultant_clasifications'] = $this->ccm->getConsultantClasifications();
        $data['content'] = "providers/form_provider";
        $this->load->view('templates/admin/layout', $data);
    }

}
