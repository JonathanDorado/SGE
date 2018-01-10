<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('events_model', 'em');
        $this->load->model('cities_model', 'cm');

        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'home');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }
    }

    public function index() {
        $events = $this->em->getEvents();

        $events_calendar = array();
        foreach ($events as $event) {
            $fixed_date = new DateTime($event->date_until);
            $fixed_date->add(new DateInterval('P1D'));
            $data_event = array(
                'event_id' => $event->event_id,
                'title' => $event->name,
                'start' => $event->date_from,
                'end' => $fixed_date->format('Y-m-d')
            );
            $events_calendar[] = $data_event;
        }

        $data['events_calendar'] = json_encode($events_calendar);
        $data['content'] = "home/events_calendar";
        $this->load->view('templates/admin/layout', $data);
    }

}
