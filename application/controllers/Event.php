<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    private $mode;

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Bogota');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('pdf');
        $this->load->library('ciqrcode');
        $this->load->library('excel');
        $this->load->model('events_model', 'em');
        $this->load->model('event_resources_model', 'erm');
        $this->load->model('event_scores_model', 'escm');
        $this->load->model('event_projections_model', 'epm');
        $this->load->model('cities_model', 'cm');
        $this->load->model('event_types_model', 'etm');
        $this->load->model('event_audience_types_model', 'eam');
        $this->load->model('event_assistance_types_model', 'easm');
        $this->load->model('event_topics_model', 'etom');
        $this->load->model('event_client_payment_model', 'ecpm');
        $this->load->model('event_surveys_model', 'esm');
        $this->load->model('event_guests_model', 'egm');
        $this->load->model('event_clients_model', 'ecm');
        $this->load->model('event_client_topics_model', 'ectm');
        $this->load->model('training_types_model', 'ttm');
        $this->load->model('training_platforms_model', 'tpm');
        $this->load->model('topics_model', 'tm');
        $this->load->model('providers_model', 'pm');
        $this->load->model('clients_model', 'clm');
        $this->load->model('payment_types_model', 'ptm');
        $this->load->model('payment_methods_model', 'pmm');
        $this->load->model('arl_model', 'am');
        $this->load->model('check_state_events_model', 'csem');

        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'events');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }

        if (MODE == "OFFLINE") {
            $this->mode = 1;
        } else {
            $this->mode = 0;
        }
    }

    public function index() {
        $events = $this->em->getEvents();
        $data['events'] = $events;
        $data['content'] = "events/list_events";

        $this->load->view('templates/admin/layout', $data);
    }

    public function show() {

        $event_id = $this->input->post('event_id');

        $resources = $this->erm->getResourcesByEvent($event_id);
        if (count($resources) > 0) {
            $data['event_resources'] = $resources;
        }

        $scores = $this->escm->getScoresByEvent($event_id);
        if (count($scores) > 0) {
            $data['event_scores'] = $scores;
        }

        $projections = $this->epm->getProjectionsByEvent($event_id);
        if (count($projections) > 0) {
            $data['event_projections'] = $projections;
        }

        $data['event'] = $this->em->getEvents($event_id);
        $data['cities'] = $this->cm->getCities('COL');
        $data['event_types'] = $this->etm->getEventTypes();
        $data['event_assistance_types'] = $this->easm->getEventAssistanceTypes();
        $data['event_audience_types'] = $this->eam->getEventAudienceTypes();
        $data['training_types'] = $this->ttm->getTrainingTypes();
        $data['training_platforms'] = $this->tpm->getTrainingPlatforms();
        $data['only_read'] = "true";

        if (isset($_POST["modal"]) && !empty($_POST["modal"])) {
            $data['modal'] = "true";
//            $data['content'] = "events/form_event";
            $this->load->view('events/form_event_modal', $data);
        } else {
            $data['content'] = "events/form_event";
            $this->load->view('templates/admin/layout', $data);
        }
    }

    public function create() {
        $data['cities'] = $this->cm->getCities();
        $data['event'] = null;
        $data['event_types'] = $this->etm->getEventTypes();
        $data['event_assistance_types'] = $this->easm->getEventAssistanceTypes();
        $data['event_audience_types'] = $this->eam->getEventAudienceTypes();
        $data['training_types'] = $this->ttm->getTrainingTypes();
        $data['cities'] = $this->cm->getCities('COL');
        $data['training_platforms'] = $this->tpm->getTrainingPlatforms();
        $data['create'] = "true";
        $data['content'] = "events/form_event";
        $this->load->view('templates/admin/layout', $data);
    }

    public function store() {

        $this->session->set_flashdata('step_selected', 0);
        if ($this->input->post('event_id')) {
            $event_id = $this->input->post('event_id');
            $this->session->set_flashdata('event_id', $event_id);
            $action = "UPDATE";
        } else {
            $action = "CREATE";
        }

        $this->form_validation->set_rules('name', 'Nombre Evento', 'required', array('required' => 'El Nombre del evento es obligatorio'));
        $this->form_validation->set_rules('date', 'Fecha de Realización', 'required', array('required' => 'La Fecha de Realización del evento es obligatoria'));
        $this->form_validation->set_rules('event_assistance_type', 'Tipo Asistencia', 'required', array('required' => 'El Tipo de Asistencia es obligatorio'));
        $this->form_validation->set_rules('event_type', 'Tipo de Evento', 'required', array('required' => 'El Tipo de Evento es obligatorio'));
        $this->form_validation->set_rules('event_audience_type', 'Dirigido a', 'required', array('required' => 'A quien va dirigido el evento (Dirigido a) es obligatorio'));
        $this->form_validation->set_rules('training_platform', 'Plataforma de Capacitación', 'required', array('required' => 'La plataforma de capacitación es obligatoria'));
        $this->form_validation->set_rules('city', 'Ciudad del Evento', 'required', array('required' => 'La Ciudad del Evento es obligatoria'));
        $this->form_validation->set_rules('place', 'Lugar del Evento', 'required', array('required' => 'El Lugar del Evento es obligatorio'));
        $this->form_validation->set_rules('total_hours_event', 'Duración Total del Evento', 'required', array('required' => 'La Duración Total del Evento es obligatoria'));

        if ($this->form_validation->run() != false) {

            $date = explode("-", $this->input->post('date'));
            $date_from = $date[0];
            $date_until = $date[1];

            $data = array(
                'name' => $this->input->post('name'),
                'date_from' => $date_from,
                'date_until' => $date_until,
                'event_assistance_type_id' => $this->input->post('event_assistance_type'),
                'event_type_id' => $this->input->post('event_type'),
                'event_audience_type_id' => $this->input->post('event_audience_type'),
                'training_platform_id' => $this->input->post('training_platform'),
                'city_id' => $this->input->post('city'),
                'place' => $this->input->post('place'),
                'total_hours' => $this->input->post('total_hours_event'),
                'state_id' => 1, //Programed
                'created_by_user_id' => $this->session->userdata('user_id'),
                'updated_by_user_id' => $this->session->userdata('user_id')
            );

            if ($action == "CREATE") {
                $event_id = $this->em->store($data);
                $this->session->set_flashdata('event_id', $event_id);
            } else {
                unset($data["state_id"]);
                unset($data["created_by_user_id"]);
                $event_id = $this->em->update($event_id, $data);
            }

            $this->session->set_flashdata('success', 'El evento ha sido procesado correctamente!');
            redirect('/event/edit');
        } else {
            if ($action == "CREATE") {
                redirect('/event/create');
            } else {
                redirect('/event/edit');
            }
        }
    }

    public function store_resources() {

        $event_id = $this->input->post('event_id');
        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('step_selected', 1);

        if ($this->input->post('event_resource_id')) {
            $event_resource_id = $this->input->post('event_resource_id');
            $action = "UPDATE";
        } else {
            $action = "CREATE";
        }

        $upload_started = 0;
        if ($_FILES['url_logo_event']['name'] != "" and $_FILES['url_logo_event']['name'] != null) {

            $config_logo['upload_path'] = './uploads/events/logo';
            $config_logo['allowed_types'] = 'png|jpg|jpeg';
            $config_logo['max_size'] = 2048;
            $config_logo['max_width'] = 2048;
            $config_logo['max_height'] = 1024;
            if ($upload_started == 0) {
                $this->load->library('upload', $config_logo);
                $upload_started = 1;
            } else {
                $this->upload->initialize($config_logo);
            }
            $upload_logo = $this->upload->do_upload('url_logo_event');
            $upload_data = $this->upload->data();
            $logo_name = $upload_data['file_name'];
        } else {
            $logo_name = $this->input->post('url_logo_event_old');
        }

        if ($_FILES['url_template_certificate']['name'] != "" and $_FILES['url_template_certificate']['name'] != null) {
            $config_certificate['upload_path'] = './uploads/events/certificate';
            $config_certificate['allowed_types'] = 'jpg|png|jpeg';
            $config_certificate['max_size'] = 2048;
            $config_certificate['max_width'] = 2048;
            $config_certificate['max_height'] = 1024;
            if ($upload_started == 0) {
                $this->load->library('upload', $config_certificate);
                $upload_started = 1;
            } else {
                $this->upload->initialize($config_certificate);
            }
            $upload_certificate = $this->upload->do_upload('url_template_certificate');
            $upload_data = $this->upload->data();
            $template_certificate_name = $upload_data['file_name'];
        } else {
            $template_certificate_name = $this->input->post('url_template_certificate_old');
        }

        $landing_name = "";
        if ($this->input->post('isLandingRequired') == 1) {
            if ($_FILES['url_logo_landing']['name'] != "" and $_FILES['url_logo_landing']['name'] != null) {
                $config_landing['upload_path'] = './uploads/events/landing';
                $config_landing['allowed_types'] = 'jpg|png|jpeg';
                $config_landing['max_size'] = 2048 * 10;
                $config_landing['max_width'] = 3840;
                $config_landing['max_height'] = 2480;
                if ($upload_started == 0) {
                    $this->load->library('upload', $config_landing);
                    $upload_started = 1;
                } else {
                    $this->upload->initialize($config_landing);
                }
                $upload_logo = $this->upload->do_upload('url_logo_landing');
                $upload_data = $this->upload->data();
                $landing_name = $upload_data['file_name'];
            } else {
                $landing_name = $this->input->post('url_logo_landing_old');
            }
        }

        $data = array(
            'event_id' => $this->input->post('event_id'),
            'url_logo_event' => $logo_name,
            'url_template_certificate' => $template_certificate_name,
            'isLandingRequired' => $this->input->post('isLandingRequired'),
            'url_logo_landing' => $landing_name,
            'landing_description' => $this->input->post('landing_description'),
            'created_by_user_id' => $this->session->userdata('user_id'),
            'updated_by_user_id' => $this->session->userdata('user_id')
        );

        if ($action == "CREATE") {
            unset($data["updated_by_user_id"]);
            $event_id = $this->erm->store($data);
        } else {
            unset($data["created_by_user_id"]);
            $event_id = $this->erm->update($event_resource_id, $data);
        }

        $this->session->set_flashdata('success', 'Los Artes asociados al Evento han sido procesados correctamente!');
        redirect('/event/edit');
    }

    public function store_score() {

        $event_id = $this->input->post('event_id');
        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('step_selected', 2);

        if ($this->input->post('event_score_id')) {
            $event_score_id = $this->input->post('event_score_id');
            $action = "UPDATE";
        } else {
            $action = "CREATE";
        }

        $this->form_validation->set_rules('event_id', 'Id de Evento', 'required|trim|xss_clean', array('required' => 'El Id de Evento es obligatorio'));
        $this->form_validation->set_rules('isScoreRequired', '¿Es necesario el registro de puntaje de pruebas?', 'required', array('required' => 'Es necesario definir si el curso necesita calificación'));
        $this->form_validation->set_rules('score_assistance', 'La calificación de asistencia es obligatoria', 'required', array('required' => 'La calificación de asistencia es obligatoria'));
        $this->form_validation->set_rules('score_attention', 'La calificación de atención es obligatoria', 'required', array('required' => 'La calificación de atención es obligatoria'));

        if ($this->form_validation->run() != false) {

            $data = array(
                'event_id' => $this->input->post('event_id'),
                'isScoreRequired' => $this->input->post('isScoreRequired'),
                'score_assistance' => $this->input->post('score_assistance'),
                'score_attention' => $this->input->post('score_attention'),
                'created_by_user_id' => $this->session->userdata('user_id'),
                'updated_by_user_id' => $this->session->userdata('user_id')
            );

            if ($action == "CREATE") {
                unset($data["updated_by_user_id"]);
                $event_id = $this->escm->store($data);
            } else {
                unset($data["created_by_user_id"]);
                $event_id = $this->escm->update($event_score_id, $data);
            }

            $this->session->set_flashdata('success', 'La Configuración de Calificaciones del Evento ha sido procesada correctamente!');
            redirect('/event/edit');
        } else {
            redirect('/event/edit');
        }
    }

    public function store_projection() {

        $event_id = $this->input->post('event_id');
        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('step_selected', 3);

        if ($this->input->post('event_projection_id')) {
            $event_projection_id = $this->input->post('event_projection_id');

            $action = "UPDATE";
        } else {
            $action = "CREATE";
        }

        $this->form_validation->set_rules('event_id', 'Id de Evento', 'required|trim|xss_clean', array('required' => 'El Id de Evento es obligatorio'));
        $this->form_validation->set_rules('projected_guests', 'La Proyección de Clientes invitados es obligatoria', 'required', array('required' => 'La Proyección de Clientes invitados es obligatoria'));
        $this->form_validation->set_rules('projected_pre_registered', 'La Proyección de Clientes pre-registrados es obligatoria', 'required', array('required' => 'La Proyección de Clientes pre-registrados es obligatoria'));
        $this->form_validation->set_rules('projected_confirmed', 'La Proyección de Clientes confirmados es obligatoria', 'required', array('required' => 'La Proyección de Clientes confirmados es obligatoria'));
        $this->form_validation->set_rules('projected_assistants', 'La Proyección de Clientes asistentes es obligatoria', 'required', array('required' => 'La Proyección de Clientes asistentes es obligatoria'));
        $this->form_validation->set_rules('projected_new_clients', 'La Proyección de Clientes Nuevos para el día del evento es obligatoria', 'required', array('required' => 'La Proyección de Clientes nuevos para el día del evento es obligatoria'));

        if ($this->form_validation->run() != false) {

            $data = array(
                'event_id' => $this->input->post('event_id'),
                'projected_guests' => $this->input->post('projected_guests'),
                'projected_pre_registered' => $this->input->post('projected_pre_registered'),
                'projected_confirmed' => $this->input->post('projected_confirmed'),
                'projected_assistants' => $this->input->post('projected_assistants'),
                'projected_new_clients' => $this->input->post('projected_new_clients'),
                'created_by_user_id' => $this->session->userdata('user_id'),
                'updated_by_user_id' => $this->session->userdata('user_id')
            );

            if ($action == "CREATE") {
                unset($data["updated_by_user_id"]);
                $event_id = $this->epm->store($data);
            } else {
                unset($data["created_by_user_id"]);
                $event_id = $this->epm->update($event_projection_id, $data);
            }

            $this->session->set_flashdata('success', 'La Proyección del Evento ha sido procesada correctamente!');
            redirect('/event/edit');
        } else {
            redirect('/event/edit');
        }
    }

    public function edit() {

        if ($this->session->userdata('event_id') or $this->input->post('event_id')) {
            if ($this->session->userdata('event_id')) {
//                $manage_event_action = $this->session->userdata('manage_event_action');
                $event_id = $this->session->userdata('event_id');
            } else if ($this->input->post('event_id')) {
                $event_id = $this->input->post('event_id');
//                $manage_event_action = 'guests';
            }

            if ($this->session->userdata('step_selected')) {
                $data['step_selected'] = $this->session->userdata('step_selected');
            }

            $resources = $this->erm->getResourcesByEvent($event_id);
            if (count($resources) > 0) {
                $data['event_resources'] = $resources;
            }

            $scores = $this->escm->getScoresByEvent($event_id);
            if (count($scores) > 0) {
                $data['event_scores'] = $scores;
            }

            $projections = $this->epm->getProjectionsByEvent($event_id);
            if (count($projections) > 0) {
                $data['event_projections'] = $projections;
            }


            $data['event'] = $this->em->getEvents($event_id);
//            $data['event_locations'] = $this->elm->getLocationsByEvent($event_id);
            $data['cities'] = $this->cm->getCities('COL');
            $data['event_types'] = $this->etm->getEventTypes();
            $data['event_assistance_types'] = $this->easm->getEventAssistanceTypes();
            $data['event_audience_types'] = $this->eam->getEventAudienceTypes();
            $data['training_types'] = $this->ttm->getTrainingTypes();
            $data['training_platforms'] = $this->tpm->getTrainingPlatforms();
            $data['content'] = "events/form_event";
            $this->load->view('templates/admin/layout', $data);
        } else {
//            $this->session->set_flashdata('lolwut',$data);
//            redirect('/event');
            $this->load->view('templates/error');
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////Topics Assignation///////////////////////////////
    public function create_AssignationTopics() {

        if ($this->session->userdata('event_id') or $this->input->post('event_id')) {
            if ($this->session->userdata('event_id')) {
//                $manage_event_action = $this->session->userdata('manage_event_action');
                $event_id = $this->session->userdata('event_id');
            } else if ($this->input->post('event_id')) {
                $event_id = $this->input->post('event_id');
            }

            $data['event'] = $this->em->getEvents($event_id);
            $data['existent_topics'] = $this->etom->getTopicsByEvent($event_id);
            $data['topics'] = $this->tm->getTopics();
            $data['providers'] = $this->pm->getProviders();
            $data['content'] = "events/form_assign_topics";
            $this->load->view('templates/admin/layout', $data);
        } else {
            $this->load->view('templates/error');
        }
    }

    public function addRowAssignTopicsEvent() {
        $row = $this->input->get('row');
        $data['row'] = $row + 1;
        $data['topics'] = $this->tm->getTopics();
        $this->load->view('events/row_topics_event', $data);
    }

    public function getInstructorsByTopic() {
        $thematic_area_type_id = $this->input->post('thematic_area_type_id');
        $instructors = $this->pm->getProvidersByThematicAreaType($thematic_area_type_id);
        echo json_encode($instructors);
    }

    public function store_AssignTopicsEvent() {

        $event_id = $this->input->post('event');
        $this->session->set_flashdata('event_id', $event_id);

        $this->form_validation->set_rules('event', 'Evento', 'required', array('required' => 'El Evento es obligatorio'));

        if ($this->form_validation->run()) {

            $topics = $this->input->post('topic');
            $instructors = $this->input->post('instructor');
            $date_hour = $this->input->post('date_hour');

            $edit_event_topic_id = $this->input->post('edit_event_topic_id');
            $edit_topics = $this->input->post('edit_topic');
            $edit_instructors = $this->input->post('edit_instructor');
            $edit_date_hour = $this->input->post('edit_date_hour');

            for ($i = 0; $i < count($edit_event_topic_id); $i++) {

                if ($_FILES['edit_memories']['name'][$i] != "") {

                    $_FILES['userfile']['name'] = $_FILES['edit_memories']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['edit_memories']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['edit_memories']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['edit_memories']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['edit_memories']['size'][$i];

                    $config['upload_path'] = './uploads/events/memories';
                    $config['allowed_types'] = 'zip|rar';
                    $config['max_size'] = 0;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload()) {
//                        print_r($this->upload->display_errors());
                    } else {
                        $upload_data = $this->upload->data();
                        $data = array(
                            'topic_id' => $edit_topics[$i],
                            'provider_id' => $edit_instructors[$i],
                            'date_hour' => $edit_date_hour[$i],
                            'url_memories' => $upload_data['file_name'],
                            'created_by_user_id' => $this->session->userdata('user_id')
                        );
                        $this->etom->update($edit_event_topic_id[$i], $data);
                    }
                } else {

                    $_FILES['userfile']['name'] = $_FILES['edit_memories']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['edit_memories']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['edit_memories']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['edit_memories']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['edit_memories']['size'][$i];

                    $data = array(
                        'topic_id' => $edit_topics[$i],
                        'provider_id' => $edit_instructors[$i],
                        'date_hour' => $edit_date_hour[$i],
                        'created_by_user_id' => $this->session->userdata('user_id')
                    );
                }
                $this->etom->update($edit_event_topic_id[$i], $data);
            }

            for ($i = 0; $i < count($topics); $i++) {
                $_FILES['userfile']['name'] = $_FILES['memories']['name'][$i];
                $_FILES['userfile']['type'] = $_FILES['memories']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['memories']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $_FILES['memories']['error'][$i];
                $_FILES['userfile']['size'] = $_FILES['memories']['size'][$i];

                $config['upload_path'] = './uploads/events/memories';
                $config['allowed_types'] = 'zip|rar';
                $config['max_size'] = 0;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
//                    print_r($this->upload->display_errors());
                } else {
                    $upload_data = $this->upload->data();
                    $insert = array(
                        'event_id' => $event_id,
                        'topic_id' => $topics[$i],
                        'provider_id' => $instructors[$i],
                        'date_hour' => $date_hour[$i],
                        'url_memories' => $upload_data['file_name'],
                        'created_by_user_id' => $this->session->userdata('user_id')
                    );
                    $this->etom->store($insert);
                }
            }

            $this->session->set_flashdata('success', 'Las Temáticas del Evento fueron procesadas correctamente!');
            redirect('/event/create_AssignationTopics');
        } else {
            $this->session->set_flashdata('error', 'Hay errores en los datos ingresados!');

            redirect('/event/create_AssignationTopics');
        }
    }

    public function deleteTopicEvent() {
        $event_topic_id = $this->input->post('event_topic_id');
        $result = $this->etom->delete($event_topic_id);
        echo json_encode(array('msg' => 'Tématica eliminada de Evento'));
    }

    ////////////////////////////////////////////////////////////////////////////
    //////////////Assignation Survey////////////////////////////////////////////
    public function create_AssignationSurvey() {
        $data['event'] = $this->em->getEvents($this->input->post('event_id'));
        $data['questions'] = $this->esm->getSurveyByEvent($this->input->post('event_id'));
        $data['content'] = "events/form_assign_survey";
        $this->load->view('templates/admin/layout', $data);
    }

    public function addRowAssignSurveyEvent() {
        $row = $this->input->get('row');
        $data['row'] = $row + 1;
        $this->load->view('events/row_survey_event', $data);
    }

    public function store_AssignSurveyEvent() {

        $this->form_validation->set_rules('event', 'Evento', 'required', array('required' => 'El Evento es obligatorio'));

        if ($this->form_validation->run()) {
            $event_id = $this->input->post('event');
            $question = $this->input->post('question');

            $edit_event_survey_id = $this->input->post('edit_event_survey_id');
            $edit_question = $this->input->post('edit_question');

            for ($i = 0; $i < count($edit_event_survey_id); $i++) {
                $data = array(
                    'question' => $edit_question[$i],
                    'created_by_user_id' => $this->session->userdata('user_id')
                );
                $this->esm->update($edit_event_survey_id[$i], $data);
            }

            for ($i = 0; $i < count($question); $i++) {
                $insert = array(
                    'event_id' => $event_id,
                    'question' => $question[$i],
                    'created_by_user_id' => $this->session->userdata('user_id')
                );
                $this->esm->store($insert);
            }

            $success = array('success' => 'Las preguntas fueron agregadas correctamente!');
            $this->session->set_flashdata('success', $success['success']);
            redirect('/event');
        } else {
//            $error = array('error' => $this->upload->display_errors());
//            $this->session->set_flashdata('error', $error['error']);

            $data['event'] = $this->em->getEvents($this->input->post('event_id'));
            $data['content'] = "events/form_assign_survey";
            $this->load->view('templates/admin/layout', $data);
        }
    }

    public function deleteSurveyQuestion() {
        $event_survey_id = $this->input->post('event_survey_id');
        $result = $this->esm->delete($event_survey_id);
        echo json_encode(array('msg' => 'Pregunta eliminada de Encuesta correctamente!'));
    }

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////Guest Registration//////////////////////////////////

    public function manage_event() {

        if ($this->session->userdata('event_id') or $this->input->post('event_id')) {
            if ($this->session->userdata('event_id')) {
                $manage_event_action = $this->session->userdata('manage_event_action');
                $event_id = $this->session->userdata('event_id');
            } else if ($this->input->post('event_id')) {
                $event_id = $this->input->post('event_id');
                if ($this->session->userdata('profile_id') == 8) {
                    $manage_event_action = 'confirmation';
                } else {
                    $manage_event_action = 'guests';
                }
            }

            $data['manage_event_action'] = $manage_event_action;
            $data['event'] = $this->em->getEvents($event_id);
            $data['guests'] = $this->egm->getGuestByEvent($event_id);
            $data['content'] = "events/manage_event";
            $this->load->view('templates/admin/layout', $data);
        } else {
//            redirect($_SERVER['HTTP_REFERER']);
            $this->load->view('templates/error');
        }
    }

    public function list_Guests() {

        $data['event'] = $this->em->getEvents($this->input->post('event_id'));
        $data['guests'] = $this->egm->getGuestByEvent($this->input->post('event_id'));

        $this->load->view('events/list_guests', $data);
    }

    public function store_Guests() {

        set_time_limit(0);
        $event_id = $this->input->post('event_id');
        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('manage_event_action', 'guests');

        $config['upload_path'] = './uploads/guests';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('guests_file')) {

            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];

            $obj_excel = PHPExcel_IOFactory::load('./uploads/guests/' . $file_name);
            $obj_excel->setActiveSheetIndex(0);
            $sheetData = $obj_excel->getActiveSheet()->toArray(null, true, true, true);

            $total_updated = 0;
            $total_error = 0;
            $log_error = "";
            foreach ($sheetData as $index => $value) {
                if ($index != 1) {
                    $log_error .= "Fila " . $index . ": ";
                    if ($value['A'] != '') {
                        $validate_error = true;

                        if (!$this->validateEmail($value['A'])) {
                            $log_error .= "/Email con formato Incorrecto/";
                            $validate_error = false;
                        }

                        if ($validate_error) {
                            $guest = $this->egm->getGuest($event_id, $value['A']);
                            if (count($guest) == 0) {
                                $data = array(
                                    'event_id' => $event_id,
                                    'email' => $value['A'],
                                    'reply_to_invitation' => 0,
                                    'isInterested' => 0,
                                    'created_by_user_id' => $this->session->userdata('user_id')
                                );
                                $processed = $this->egm->store($data);
                            }

                            $total_updated++;
                            $log_error .= "Registro Procesado";
                        } else {
                            $total_error++;
                        }
                    } else {
                        $total_error++;
                        $log_error .= "/Campo vacio/";
                    }
                }
                $log_error .= PHP_EOL;
            }

            if ($total_error > 0) {
                $txt_name = "log_" . date("Y_m_d-H_i_s") . '.txt';
                if (write_file('./uploads/logs/' . $txt_name, $log_error)) {
                    $this->session->set_flashdata('error', 'Se encontraron errores en el archivo procesado. <a href="' . base_url() . 'uploads/logs/' . $txt_name . '" target="_blank"> Descargar Log</a>');
                } else {
                    $this->session->set_flashdata('error', 'Se encontraron errores en el archivo procesado pero no fue posible generar el Log de errores.');
                }
                redirect('/event/manage_event');
            } else {
                $this->session->set_flashdata('success', "El archivo fue procesado correctamente!");
                redirect('/event/manage_event');
            }
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('/event/manage_event');
        }
    }

    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////Pre-register clients/////////////////////////////////
    public function list_Clients() {
        $data['event'] = $this->em->getEvents($this->input->post('event_id'));
        $data['clients'] = $this->ecm->getEventClients($this->input->post('event_id'), 'PREREGISTER');

        $this->load->view('events/list_clients', $data);
    }

    public function addClientToEvent() {//This function add or delete an user as appropiate
        $event_id = $this->input->post('event_id');
        $client_id = $this->input->post('client_id');

        $event_client = $this->ecm->getClientByEvent($event_id, $client_id);
        if (count($event_client) > 0) {
            $this->ecm->delete($event_id, $client_id);
            echo json_encode(array('response' => '0', 'msg' => 'Usuario Eliminado del Evento'));
        } else {
            $data = array(
                'event_id' => $event_id,
                'client_id' => $client_id,
                'state_id' => 2, //Preregister
                'created_by_user_id' => ($this->session->userdata('user_id') != "") ? $this->session->userdata('user_id') : 1,
                'offline_mode' => $this->mode
            );
            $result = $this->ecm->store($data);
            echo json_encode(array('response' => '1', 'msg' => 'Usuario Pre-Registrado Correctamente'));
        }
    }

    public function store_MasivePreRegister() {
        set_time_limit(0);
        $event_id = $this->input->post('event_id');
        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('manage_event_action', 'preregister');

        $config['upload_path'] = './uploads/preregisters';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('masive_preregister_file')) {

            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];

            $obj_excel = PHPExcel_IOFactory::load('./uploads/preregisters/' . $file_name);
            $obj_excel->setActiveSheetIndex(0);
            $sheetData = $obj_excel->getActiveSheet()->toArray(null, true, true, true);

            $total_updated = 0;
            $total_error = 0;
            $log_error = "";

            foreach ($sheetData as $index => $value) {
                if ($index != 1) {
                    $log_error .= "Fila " . $index . ":";
                    if ($value['A'] != '') {
                        $client = $this->clm->getClients("", $value['A']);
                        if (count($client) > 0) {
                            $data = array(
                                'event_id' => $event_id,
                                'client_id' => $client[0]->client_id,
                                'state_id' => 2,
                                'created_by_user_id' => $this->session->userdata('user_id'),
                                'offline_mode' => $this->mode
                            );
                            $processed = $this->ecm->store_Masive($data, $this->input->post('event_id'), $client[0]->client_id);
                            $total_updated++;
                            $log_error .= "Pre-registro Exitoso";
                        } else {
                            $total_error++;
                            $log_error .= "/Identificación No existe/";
                        }
                    } else {
                        $log_error .= "/Campo Vacio/";
                    }
                }
                $log_error .= PHP_EOL;
            }

            if ($total_error > 0) {
                $txt_name = "log_" . date("Y_m_d-H_i_s") . '.txt';
                if (write_file('./uploads/logs/' . $txt_name, $log_error)) {
                    $this->session->set_flashdata('error', 'Se encontraron errores en el archivo procesado. <a href="' . base_url() . 'uploads/logs/' . $txt_name . '" target="_blank"> Descargar Log</a>');
                } else {
                    $this->session->set_flashdata('error', 'Se encontraron errores en el archivo procesado pero no fue posible generar el Log de errores.');
                }
            } else {
                $this->session->set_flashdata('success', "El archivo fue procesado correctamente!");
            }
            redirect('/event/manage_event');
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('/event/manage_event');
        }
        set_time_limit(30);
    }

    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////Confirmation clients/////////////////////////////////
    public function list_PreregisteredClients() {
        $data['event'] = $this->em->getEvents($this->input->post('event_id'));
        $data['clients'] = $this->ecm->getEventClients($this->input->post('event_id'), 'CONFIRMATION');
        $this->load->view('events/list_clients_preregistered', $data);
    }

    public function create_ConfirmClient() {
        if (($this->session->userdata('event_client_id') and $this->session->userdata('event_id') and $this->session->userdata('client_id')) or ( $this->input->post('event_client_id') and $this->input->post('event_id') and $this->input->post('client_id'))) {
            if (($this->session->userdata('event_client_id') and $this->session->userdata('event_id') and $this->session->userdata('client_id'))) {
                $event_client_id = $this->session->userdata('event_client_id');
                $event_id = $this->session->userdata('event_id');
                $client_id = $this->session->userdata('client_id');
            } else if ($this->input->post('event_client_id') and $this->input->post('event_id') and $this->input->post('client_id')) {
                $event_client_id = $this->input->post('event_client_id');
                $event_id = $this->input->post('event_id');
                $client_id = $this->input->post('client_id');
            }

            $data['event_client_id'] = $event_client_id;
            $data['event'] = $this->em->getEvents($event_id);
            $data['event_topics'] = $this->etom->getTopicsByEvent($event_id);
            $data['payment_types'] = $this->ptm->getPaymentTypes();
            $data['payment_methods'] = $this->pmm->getPaymentMethods();
            $data['arls'] = $this->am->getArls();
            $data['client'] = $this->clm->getClients($client_id);
            $data['event_client_topics'] = $this->ectm->getEventClientTopics($event_client_id);

            $event_client_payment = $this->ecpm->getEventClientPayment($event_client_id);
            if (count($event_client_payment) > 0) {
                $data['event_client_payment'] = $event_client_payment;
//                if ($event_client_payment[0]->isPaid == 1) {
//                    $data_to_hash = $event_client_payment[0]->invoice_code;
//                    $data['invoice_qr'] = $this->invoiceQRGenerator($this->strToHex($data_to_hash));
//                    $data['invoice_code'] = $this->strToHex($data_to_hash);
//                } else {
//                    $data_to_hash = $event_id . $client_id . date('Y-m-d');
//                    $data['invoice_qr'] = $this->invoiceQRGenerator($this->strToHex($data_to_hash));
//                    $data['invoice_code'] = $this->strToHex($data_to_hash);
//                }
            } else {
//                $data_to_hash = $event_id . $client_id . date('Y-m-d');
//                $data['invoice_qr'] = $this->invoiceQRGenerator($this->strToHex($data_to_hash));
//                $data['invoice_code'] = $this->strToHex($data_to_hash);
            }

            $data['content'] = "events/form_confirmation";
            $this->load->view('templates/admin/layout', $data);
        } else {
            $this->load->view('templates/error');
        }
    }

    public function store_ConfirmationClient() {

        $event_client_id = $this->input->post('event_client_id');
        $event_id = $this->input->post('event_id');
        $client_id = $this->input->post('client_id');
        $this->session->set_flashdata('event_client_id', $event_client_id);
        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('client_id', $client_id);
        $this->session->set_flashdata('manage_event_action', 'confirmation');

        $this->form_validation->set_rules('payment_type', 'Tipo de Pago', 'required', array('required' => 'El Tipo de Pago es obligatorio'));
        $this->form_validation->set_rules('payment_method', 'Método de Pago', 'required', array('required' => 'El Método de Pago es obligatorio'));
        $this->form_validation->set_rules('price', 'Valor a Cancelar', 'required', array('required' => 'El Valor a Cancelar es obligatorio'));
        $this->form_validation->set_rules('isPaid', 'Pagado', 'required', array('required' => 'Se debe especificar si el usuario pago el curso'));

        if ($this->form_validation->run() != false) {

            if ($this->input->post('isPaid') == 1) {
//                $invoice_code = $this->input->post('invoice_code');
                $paid_date = $this->input->post('paid_date');
            } else {
//                $invoice_code = "";
                $paid_date = "";
            }

            $data = array(
                'event_client_id' => $event_client_id,
                'payment_type_id' => $this->input->post('payment_type'),
                'payment_method_id' => $this->input->post('payment_method'),
                'isCompanyPaying_nit_company' => $this->input->post('isCompanyPaying_nit_company'),
                'isArlPaying_arl_id' => $this->input->post('isArlPaying_arl_id'),
                'price' => $this->input->post('price'),
                'comment' => $this->input->post('comment'),
                'isPaid' => $this->input->post('isPaid'),
                'paid_date' => $paid_date,
//                'invoice_code' => $invoice_code,
                'created_by_user_id' => $this->session->userdata('user_id'),
                'offline_mode_create' => $this->mode
            );
            $res = $this->ecpm->store($data);

            if ($this->input->post('event_client_topics')) {
                $event_client_topics = $this->input->post('event_client_topics');

                for ($i = 0; $i < count($event_client_topics); $i++) {

                    $data = array(
                        'event_client_id' => $event_client_id,
                        'event_topic_id' => $event_client_topics[$i],
                        'created_by_user_id' => $this->session->userdata('user_id'),
                        'updated_by_user_id' => $this->session->userdata('user_id'),
                        'offline_mode' => $this->mode
                    );
                    $this->ectm->store($data);
                }
            }

            if ($this->input->post('isPaid') == 1) {
                $data_update = array('state_id' => 7); //Confirmed paid
                $this->session->set_flashdata('success', 'El cliente fue confirmado exitosamente.');
            } else {
                $data_update = array('state_id' => 3); //Confirmed without payment
                $this->session->set_flashdata('success', 'La información fue registrada correctamente. Recuerde que el usuario aún esta pendiente de pago');
            }

            $res = $this->ecm->update($event_client_id, $data_update);

            redirect('/event/manage_event');
        } else {
            redirect('/event/create_ConfirmClient');
        }
    }

    public function update_ConfirmationClient() {

        $event_client_id = $this->input->post('event_client_id');
        $event_id = $this->input->post('event_id');
        $client_id = $this->input->post('client_id');
        $this->session->set_flashdata('event_client_id', $event_client_id);
        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('client_id', $client_id);
        $this->session->set_flashdata('manage_event_action', 'confirmation');

        $this->form_validation->set_rules('event_client_payment_id', 'El id del pago asociado al cliente es obligatorio', 'required', array('required' => 'El id del pago asociado al cliente es obligatorio'));
        $this->form_validation->set_rules('payment_type', 'Tipo de Pago', 'required', array('required' => 'El Tipo de Pago es obligatorio'));
        $this->form_validation->set_rules('payment_method', 'Método de Pago', 'required', array('required' => 'El Método de Pago es obligatorio'));
        $this->form_validation->set_rules('price', 'Valor a Cancelar', 'required', array('required' => 'El Valor a Cancelar es obligatorio'));
        $this->form_validation->set_rules('isPaid', 'Pagado', 'required', array('required' => 'Se debe especificar si el usuario pago el curso'));

        if ($this->form_validation->run() != false) {

            if ($this->input->post('isPaid') == 1) {
                $invoice_code = "";
//                $invoice_code = $this->input->post('invoice_code');
                if ($this->input->post('paid_date') == '0000-00-00') {
                    $paid_date = date('Y-m-d');
                } else {
                    $paid_date = $this->input->post('paid_date');
                }
            } else {
                $invoice_code = "";
                $paid_date = "";
            }

            $data = array(
                'event_client_id' => $event_client_id,
                'payment_type_id' => $this->input->post('payment_type'),
                'payment_method_id' => $this->input->post('payment_method'),
                'isCompanyPaying_nit_company' => $this->input->post('isCompanyPaying_nit_company'),
                'isArlPaying_arl_id' => $this->input->post('isArlPaying_arl_id'),
                'price' => $this->input->post('price'),
                'comment' => $this->input->post('comment'),
                'isPaid' => $this->input->post('isPaid'),
                'paid_date' => $paid_date,
//                'invoice_code' => $invoice_code,
                'updated_by_user_id' => $this->session->userdata('user_id'),
                'offline_mode_update' => $this->mode
            );
            $res = $this->ecpm->update($this->input->post('event_client_payment_id'), $data);

            if ($this->input->post('event_client_topics')) {
                $this->ectm->delete($event_client_id);
                $event_client_topics = $this->input->post('event_client_topics');

                for ($i = 0; $i < count($event_client_topics); $i++) {

                    $data = array(
                        'event_client_id' => $event_client_id,
                        'event_topic_id' => $event_client_topics[$i],
                        'created_by_user_id' => $this->session->userdata('user_id'),
                        'updated_by_user_id' => $this->session->userdata('user_id'),
                        'offline_mode' => $this->mode
                    );
                    $this->ectm->store($data);
                }
            }

            if ($this->input->post('isPaid') == 1) {
                if ($this->input->post('paid_date') == '0000-00-00') {
                    $data_update = array('state_id' => 7); //Confirmed paid
                    $this->session->set_flashdata('success', 'El cliente fue confirmado exitosamente.');
                    $res = $this->ecm->update($event_client_id, $data_update);
                }
            } else {
                $data_update = array('state_id' => 3); //Confirmed without payment
                $this->session->set_flashdata('success', 'La información fue registrada correctamente. Recuerde que el usuario aún esta pendiente de pago');
                $res = $this->ecm->update($event_client_id, $data_update);
            }

            redirect('/event/manage_event');
        } else {
            redirect('/event/create_ConfirmClient');
        }

        $data['event_client_id'] = $this->input->post('event_client_id');
        $data['event'] = $this->em->getEvents($this->input->post('event_id'));
        $data['payment_types'] = $this->ptm->getPaymentTypes();
        $data['arls'] = $this->am->getArls();
        $data['client'] = $this->clm->getClients($this->input->post('client_id'));
        $data['content'] = "events/form_confirmation";
        $this->load->view('templates/admin/layout', $data);
    }

    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////Assistance clients/////////////////////////////////
    public function list_ConfirmedClients() {
        $data['event'] = $this->em->getEvents($this->input->post('event_id'));
        $data['clients'] = $this->ecm->getEventClients($this->input->post('event_id'), 'ASSISTANCE');
        $this->load->view('events/list_clients_confirmed', $data);
    }

    public function updateAssistanceClientEvent() {//This function add or delete an user as appropiate
        $event_client_id = $this->input->post('event_client_id');
        $state_id = $this->input->post('state_id');

        $data = array(
            'state_id' => $state_id,
            'offline_mode' => $this->mode
        );

        $result = $this->ecm->update($event_client_id, $data);
        echo json_encode(array('msg' => 'Asistencia Actualizada'));
    }

    public function generateEscarapela() {
        $event = $this->em->getEvents($this->input->get('event_id'));
        $client = $this->clm->getClients($this->input->get('client_id'));

        $this->pdf = new Pdf('P', 'mm', array(20, 150));
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $params['data'] = $client[0]->document_number;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = 'uploads/qr_codes/' . $event[0]->event_id . "_" . $client[0]->document_number . ".png";
        $this->ciqrcode->generate($params);

        $this->pdf->getEscarapela($event, $client);

        $this->pdf->Output("escarapela.pdf", 'I');
    }

    ////////////////////////////////////////////////////////////////////////////
    ///////////////////////Score clients/////////////////////////////////
    public function list_Score() {
        $data['event'] = $this->em->getEvents($this->input->post('event_id'));
//        $data['clients'] = $this->ecm->getEventClients($this->input->post('event_id'), 'ASSISTANCE');
        $data['content'] = "events/list_score";
        $this->load->view('templates/admin/layout', $data);
    }

    ////////////////////////////////TASK Validation Events//////////////////////
    public function checkStateEventsByDate() {
        $validation = $this->csem->getCheckByDate(date('Y-m-d'));
        if (count($validation) == 0) {

            $events_in_progess = $this->em->getEvents("", date('Y-m-d'), "");
//            echo "Eventos en progreso " . count($events_in_progess);
            if (count($events_in_progess) > 0) {
                foreach ($events_in_progess as $event_in_progess) {
                    $update = array(
                        'state_id' => 6 //Event in progress
                    );

                    $event_id = $this->em->update($event_in_progess->event_id, $update);
                }
            }

            $today = date('Y-m-d');
            $yesterday = date('Y-m-d', strtotime($today . ' - 1 days'));
            $finished_events = $this->em->getEvents("", "", $yesterday);
//            echo "Eventos finalizados " . count($finished_events);
            if (count($finished_events) > 0) {
                foreach ($finished_events as $finished_event) {
                    $update = array(
                        'state_id' => 4 //Event finished
                    );

                    $event_id = $this->em->update($finished_event->event_id, $update);
                }
            }

            $insert = array(
                'date' => date('Y-m-d'),
                'user_id' => $this->session->userdata('user_id')
            );
            $this->csem->store($insert);
        }
    }

//    function strToHex($string) {
//        $hex = '';
//        for ($i = 0; $i < strlen($string); $i++) {
//            $hex .= dechex(ord($string[$i]));
//        }
//
//        return $hex;
//    }
//
//    function hexToStr($hex) {
//
//        $string = '';
//        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
//            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
//        }
//
//        return $string;
//    }

//    public function invoiceQRGenerator($string) {
//        $params['data'] = $string;
//        $params['level'] = 'H';
//        $params['size'] = 10;
//        $params['savename'] = FCPATH . 'invoice-code-' . $string . '.png';
//        $this->ciqrcode->generate($params);
//        return base_url() . "invoice-code-" . $string . ".png";
//    }

    function translateMonth($month) {
        switch ($month) {
            case "January":
                $month_spanish = "Enero";
                break;
            case "February":
                $month_spanish = "Febrero";
                break;
            case "March":
                $month_spanish = "Marzo";
                break;
            case "April":
                $month_spanish = "Abril";
                break;
            case "May":
                $month_spanish = "Mayo";
                break;
            case "June":
                $month_spanish = "Junio";
                break;
            case "July":
                $month_spanish = "Julio";
                break;
            case "August":
                $month_spanish = "Agosto";
                break;
            case "September":
                $month_spanish = "Septiembre";
                break;
            case "October":
                $month_spanish = "Ocutbre";
                break;
            case "November":
                $month_spanish = "Noviembre";
                break;
            case "December":
                $month_spanish = "Diciembre";
                break;
        }

        return $month_spanish;
    }

    function validateEmail($email) {
        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
        if (preg_match($pattern, $email) === 1) {
            return true;
        } else {
            return false;
        }
    }

}
