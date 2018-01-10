<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('events_model', 'Events');
        $this->load->model('clients_model', 'Clients');
        $this->load->model('event_client_payment_model', 'EventClientPayments');
        $this->load->library('pdf');
    }

    public function show($id) {
        $payment = $this->EventClientPayments->getPaymentByCode($id);
        $Events = $this->Events->getEvents($payment[0]->event_id);
        $client = $this->Clients->getClients($payment[0]->event_client_id);
        $data['payment'] = $payment;
        $data['client'] = $client;
        $data['event'] = $Events;
        $data['content'] = "invoices/invoice";
       
        $this->load->view('templates/admin/layout', $data);
    }
}
