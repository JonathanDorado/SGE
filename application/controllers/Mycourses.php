<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MyCourses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('pdf');
        $this->load->library('ciqrcode');
        $this->load->model('clients_model', 'cm');
        $this->load->model('events_model', 'em');
        $this->load->model('event_resources_model', 'erm');
        $this->load->model('event_clients_model', 'ecm');
        $this->load->model('event_client_comments_model', 'eccm');
        $this->load->model('event_client_topics_model', 'ectm');
        $this->load->model('event_surveys_model', 'esm');
        $this->load->model('event_survey_clients_model', 'escm');
        $this->load->model('event_topics_model', 'etm');
        $this->load->model('event_client_payment_model', 'ecpm');
        $this->load->model('clients_model', 'clm');
        
         if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CLIENT") {
                $this->session->set_userdata('module', 'mycourses');
            } else {
                redirect('/home', 'refresh');
            }
        }

    }

    public function index() {
        $client = $this->cm->getClients($this->session->userdata('client_id'));
        if ($client[0]->habeas_data == "") {
            $data['content'] = "mycourses/form_habeas_data";
            $this->load->view('templates/admin/layout', $data);
        } else {
            $data['courses'] = $this->ecm->getEventsByClient($this->session->userdata('client_id'));
            $data['content'] = "mycourses/list_my_courses";
            $this->load->view('templates/admin/layout', $data);
        }
    }

    public function show_CourseDetail() {

        if (($this->session->userdata('event_client_id') and $this->session->userdata('event_id')) or ( $this->input->post('event_client_id') and $this->input->post('event_id'))) {
            if ($this->session->userdata('event_client_id') and $this->session->userdata('event_id')) {
                $event_id = $this->session->userdata('event_id');
                $event_client_id = $this->session->userdata('event_client_id');
            } else {
                $event_id = $this->input->post('event_id');
                $event_client_id = $this->input->post('event_client_id');
            }

            $response_survey = $this->escm->getSurveyEventByClient($event_id, $this->session->userdata('client_id'));
            $event = $this->em->getEvents($event_id);
            $resources = $this->erm->getResourcesByEvent($event_id);
            if (count($resources)) {
                $data['event_resources'] = $resources;
            }

            if (count($response_survey) > 0) {
                $data['event'] = $event;
                $data['memories'] = $this->etm->getTopicsByEvent($event_id);

                $data['event_client_payment'] = $this->ecpm->getEventClientPayment($event_client_id);
                $data['content'] = "mycourses/course_detail";
                $this->load->view('templates/admin/layout', $data);
            } else {
                $survey = $this->esm->getSurveyByEvent($event_id); //Check if the event has a survey
                if (count($survey) > 0) {//If it has, redirect to answer it
                    $data['survey'] = $survey;
                    $data['event'] = $event;
                    $data['event_client_id'] = $event_client_id;
                    $data['content'] = "mycourses/form_survey";
                    $this->load->view('templates/admin/layout', $data);
                } else {//If it has not survey, redirect to detail of event
                    $data['event'] = $event;
                    $data['memories'] = $this->etm->getTopicsByEvent($event_id);
                    $data['event_resources'] = $resources;
                    $data['event_client_payment'] = $this->ecpm->getEventClientPayment($event_client_id);
                    $data['content'] = "mycourses/course_detail";
                    $this->load->view('templates/admin/layout', $data);
                }
            }
        } else {
            $this->load->view('templates/error');
        }
    }

    public function store_habeas() {

        $data = array('habeas_data' => $this->input->post('habeas_data'));
        $this->cm->update($this->session->userdata('client_id'), $data);
        redirect('/mycourses', 'refresh');
    }

    public function store_survey() {

        $event_id = $this->input->post('event_id');
        $event_client_id = $this->input->post('event_client_id');
        $event_survey_id = $this->input->post('event_survey_id');
        $answers = $this->input->post('answers');
        $comment = $this->input->post('comment');
        $improve = $this->input->post('improve');

        for ($i = 0; $i < count($event_survey_id); $i++) {
            $insert = array(
                'event_survey_id' => $event_survey_id[$i],
                'client_id' => $this->session->userdata('client_id'),
                'score' => $answers[$i],
            );
            $this->escm->store($insert);
        }

        if ($comment != "" or $improve != "") {
            $data = array(
                'event_id' => $event_id,
                'client_id' => $this->session->userdata('client_id'),
                'comment' => $comment,
                'improve' => $improve
            );
            $this->eccm->store($data);
        }

        $this->session->set_flashdata('event_id', $event_id);
        $this->session->set_flashdata('event_client_id', $event_client_id);
        redirect('/mycourses/show_CourseDetail');
    }

    public function generateCertificate() {
        $event = $this->em->getEvents($this->input->get('event_id'));
        $client = $this->clm->getClients($this->input->get('client_id'));
        $resources = $this->erm->getResourcesByEvent($this->input->get('event_id'));
        $event_client_payment = $this->ecpm->getEventClientPayment($this->input->get('event_client_id'));

        $this->pdf = new Pdf();

        if ($event[0]->event_type_id == 2) {
            $event_client_topics = $this->ectm->getEventClientTopics($this->input->get('event_client_id'));

            foreach ($event_client_topics as $event_client_topic) {
                $this->pdf->AddPage('L');
                $this->pdf->AliasNbPages();
                $this->pdf->Image('uploads/events/certificate/' . $resources[0]->url_template_certificate, 0, 0, 297, 210);
                $this->pdf->getCertificateCurse($event, $client, $event_client_payment, $event_client_topic->topic);
            }
        } else {
            $this->pdf->AddPage('L');
            $this->pdf->AliasNbPages();
            $this->pdf->Image('uploads/events/certificate/' . $resources[0]->url_template_certificate, 0, 0, 297, 210);
            $this->pdf->getCertificate($event, $client, $event_client_payment);
        }

        $this->pdf->Output("certificate.pdf", 'I');
    }

    public function generateAssistanceCertificate() {
        $event = $this->em->getEvents($this->input->get('event_id'));
        $client = $this->clm->getClients($this->input->get('client_id'));
        $event_client_payment = $this->ecpm->getEventClientPayment($this->input->get('event_client_id'));

        $this->pdf = new Pdf();
        $this->pdf->AddPage('P');
        $this->pdf->AliasNbPages();
        $this->pdf->Image('resources/img/header_certificate.png', 0, 0, 210, 30);
        $this->pdf->Image('resources/img/sign_certificate.png', 80, 220, 50, 10);

        $this->pdf->getCertificateAssistance($event, $client, $event_client_payment);
        $this->pdf->Output("certificate_assistance.pdf", 'I');
    }

}
