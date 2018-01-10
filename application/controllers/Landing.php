<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $this->load->helper('url');
        $this->load->model('clients_model', 'cm');
        $this->load->model('document_types_model', 'dtm');
        $this->load->model('events_model', 'em');
        $this->load->model('event_resources_model', 'erm');
        $this->load->model('event_guests_model', 'egm');
        $this->load->model('event_clients_model', 'ecm');
        $this->load->model('event_topics_model', 'etom');
        $this->load->model('event_intentions_model', 'eim');
        $this->load->model('cities_model', 'cim');
    }

    public function index() {

        if (isset($_GET['id'])) {
            $event_id = $this->input->get('id');
            $event = $this->em->getEvents($event_id);
            if (count($event) > 0) {
                $resources = $this->erm->getResourcesByEvent($event_id);
                if ($resources[0]->isLandingRequired == 1 && $event[0]->state_id == 1) {
                    $data['event'] = $event;
                    $data['cities'] = $this->cim->getCities('COL');
                    $data['event_resources'] = $resources;
                    $data['topics'] = $this->etom->getTopicsByEvent($event_id);
                    $data['document_types'] = $this->dtm->getDocumentTypes();
                    $this->load->view('templates/landing/layout', $data);
                } else {
                    $this->load->view('templates/error');
                }
            } else {
                $this->load->view('templates/error');
            }
        } else {
            $this->load->view('templates/error');
        }
    }

    public function validateInvitation() {
        $event_id = $this->input->post('event_id');
        $email = $this->input->post('email');

        $client = $this->cm->getClients("", "", $email);
        $event = $this->em->getEvents($event_id);

        if (count($client) > 0) {
            $client_event = $this->ecm->getClientByEvent($event_id, $client[0]->client_id);
            if (count($client_event) > 0) {
                echo "Ya te encuentras registrado para el evento!";
            } else {
                $data['event'] = $event;
                $data['client'] = $client;
                $this->load->view('landing/confirmation_preregister', $data);
            }
        } else {
            $data['event'] = $event;
            $data['document_types'] = $this->dtm->getDocumentTypes();
            $this->load->view('landing/form_register_client', $data);
        }

        $guest = $this->egm->getGuest($event_id, $email);
    }

    public function store_Register() {

        $event_id = $this->input->post('event_id');

        $insert = array(
            'event_id' => $event_id,
            'name' => $this->input->post('name'),
            'lastname' => $this->input->post('lastname'),
            'phone_number' => $this->input->post('phone_number'),
            'email' => $this->input->post('email'),
        );

        //Aqui debe enviar email

        $response = $this->eim->store($insert);
        echo json_encode(array('response' => '1', 'msg' => '<h2 class="mu-title">Hemos recibido los datos de contacto!</h2><br> <p>Pronto nuestros asesores se estarán comunicando.</p>'));
    }

    public function store_Client() {

        $event_id = $this->input->post('event_id');
        if ($this->cm->getClients("", $this->input->post('document_number'), "")) {
            echo json_encode(array('response' => '0', 'msg' => 'El número de documento ya se encuentra registrado!'));
        } else if ($this->cm->getClients("", "", $this->input->post('email'))) {
            echo json_encode(array('response' => '0', 'msg' => 'El correo electrónico ya se encuentra registrado!'));
        } else {
            $insert = array(
                'client_type_id' => 1,
                'affiliated' => 0,
                'name' => $this->input->post('name'),
                'lastname' => $this->input->post('lastname'),
                'document_type_id' => $this->input->post('document_type'),
                'document_number' => $this->input->post('document_number'),
                'country_id_citizenship' => 1,
                'address' => $this->input->post('address'),
                'phone_number' => $this->input->post('phone_number'),
                'cellphone_number' => $this->input->post('cellphone_number'),
                'email' => $this->input->post('email'),
                'company' => $this->input->post('company'),
                'position' => $this->input->post('position'),
                'created_by_user_id' => 1
            );

            $client_id = $this->cm->store($insert);
            $result = $this->ecm->store($event_id, $client_id, 2, 1); //Se envia 1 como id de superadministrador pero fue landing page
            echo json_encode(array('response' => '1', 'msg' => '<h3>Te has registrado con exito!<br> Pronto nuestros asesores se estarán comunicando contigo</h3>'));
        }
    }

    public function store_replyToInvitation() {

        $reply_to_invitation = $this->input->post('reply_to_invitation');
        $event_id = $this->input->post('event_id');
        $client_id = $this->input->post('client_id');

        $client = $this->cm->getClients($client_id, "", "");
        $data = array(
            'reply_to_invitation' => 1,
            'isInterested' => $reply_to_invitation
        );

        $client_guest = $this->egm->update($event_id, $client[0]->email, $data);
        $result = $this->ecm->store($event_id, $client[0]->client_id, 2, 1); //Se envia 1 como id de superadministrador pero fue landing page
        echo json_encode(array('response' => '1', 'msg' => '<h3>Te has registrado con exito!<br> Pronto nuestros asesores se estarán comunicando contigo</h3>'));
    }

    public function test() {
        $event_id = $this->input->get('id');
        $event = $this->em->getEvents($event_id);
        $data['event'] = $event;
        $this->load->view('templates/landing/index', $data);
    }

}
