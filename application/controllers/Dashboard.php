<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('excel');
        $this->load->model('events_model', 'em');
        $this->load->model('event_guests_model', 'egm');
        $this->load->model('event_projections_model', 'epm');
        $this->load->model('clients_model', 'cm');
        $this->load->model('providers_model', 'pm');
        $this->load->model('users_model', 'um');
        $this->load->model('event_clients_model', 'ecm');
        $this->load->model('event_client_payment_model', 'ecpm');
        $this->load->model('event_surveys_model', 'esm');
        $this->load->model('event_survey_clients_model', 'escm');

        if (!$this->session->userdata('user_type')) {
            redirect('/login', 'refresh');
        } else {
            if ($this->session->userdata('user_type') == "CCS") {
                $this->session->set_userdata('module', 'dashboard');
            } else {
                redirect('/mycourses', 'refresh');
            }
        }
    }

    public function index() {

        $data['total_events'] = $this->em->getTotalEvents();
        $data['total_clients'] = $this->cm->getTotalClients();
        $data['total_providers'] = $this->pm->getTotalProviders();
        $data['total_users'] = $this->um->getTotalUsers();
        $data['total_clients_habeas_data_yes'] = $this->cm->getTotalClients('HABEAS_DATA_YES');
        $data['total_clients_habeas_data_no'] = $this->cm->getTotalClients('HABEAS_DATA_NO');
        $data['events'] = $this->em->getEvents();
        $data['content'] = "dashboard/dashboard_platform";
        $this->load->view('templates/admin/layout', $data);
    }

    public function getDataEventsByState() {
//        $event_id = $this->input->get('event_id');

        $events_by_state = $this->em->getTotalEventsByState();
        $total_events_by_state = array();
        foreach ($events_by_state as $event_by_state) {
            $data_state = array(
                'label' => $event_by_state->state,
                'data' => $event_by_state->total,
                'color' => "#" . substr(md5(rand()), 0, 6)
            );
            $total_events_by_state[] = $data_state;
        }

        echo json_encode($total_events_by_state);
    }

    public function getDataAssistantsByEvent() {
        $assistants_by_events = $this->ecm->getTotalAssistantsByEvent();
        $total_assistants_by_event = array();
        foreach ($assistants_by_events as $assistants_by_event) {
            $data_assistants = array(
                $assistants_by_event->name => $assistants_by_event->total,
//                'data' => $assistants_by_event->total,
//                'color' => "#" . substr(md5(rand()), 0, 6)
            );
            $total_assistants_by_event[] = json_encode($data_assistants);
        }
        echo json_encode($total_assistants_by_event);
    }

    public function getDataEventsByMonth() {
        $year = $this->input->post('year');

        $array_series = array();
        for ($i = 1; $i <= 12; $i++) {
            $total = $this->em->getTotalEventByMonth($year, $i);
            $data = array('month' => $this->convierteMes($i), 'total' => count($total));
            array_push($array_series, $data);
        }

        echo json_encode(array('data' => $array_series));
    }

    public function index_event() {

        $event_id = $this->input->post('event_id');
        $data['event'] = $this->em->getEvents($event_id);
        $data['events'] = $this->em->getEvents();
        $data['survey_average'] = $this->esm->getAverageSurveyByEvent($event_id);
        $data['guests'] = $this->egm->getTotalGuestsByEvent($event_id);
        $data['preregister_clients'] = $this->ecm->getClientsByEvent('PREREGISTER', $event_id);
        $data['confirmed_clients'] = $this->ecm->getClientsByEvent('CONFIRMATION', $event_id);
        $data['attended_clients'] = $this->ecm->getClientsByEvent('ASSISTANCE', $event_id);
        $data['average_survey_questions'] = $this->escm->getAverageByQuestion($event_id);

        $data['content'] = "dashboard/dashboard_event";
        $this->load->view('templates/admin/layout', $data);
    }

    public function getDataProjectionsByEvent() {
        $event_id = $this->input->post('event_id');
        $projections = $this->epm->getProjectionsByEvent($event_id);

        $array_projections = array();
        array_push($array_projections, $projections[0]->projected_guests);
        array_push($array_projections, $projections[0]->projected_pre_registered);
        array_push($array_projections, $projections[0]->projected_confirmed);
        array_push($array_projections, $projections[0]->projected_assistants);

        $array_real = array();
        $guests = $this->egm->getTotalGuestsByEvent($event_id);
        $preregistered = $this->ecm->getClientsByEvent('PREREGISTER', $event_id);
        $confirmed = $this->ecm->getClientsByEvent('CONFIRMATION', $event_id);
        $assistant = $this->ecm->getClientsByEvent('ASSISTANCE', $event_id);
        array_push($array_real, $guests[0]->total);
        array_push($array_real, $preregistered[0]->total);
        array_push($array_real, $confirmed[0]->total);
        array_push($array_real, $assistant[0]->total);

        echo json_encode(array('data_projection' => $array_projections, 'data_real' => $array_real));
    }

    public function getDataPaymentTypes() {
        $event_id = $this->input->post('event_id');

        $total_payment_arl = $this->ecpm->getTotalAssistantsByPayment($event_id, 1);
        $total_payment_person = $this->ecpm->getTotalAssistantsByPayment($event_id, 2);
        $total_payment_scholarship = $this->ecpm->getTotalAssistantsByPayment($event_id, 3);
        $total_payment_company = $this->ecpm->getTotalAssistantsByPayment($event_id, 4);

        echo json_encode(array(
            'payment_arl' => $total_payment_arl,
            'payment_person' => $total_payment_person,
            'payment_scholarship' => $total_payment_scholarship,
            'payment_company' => $total_payment_company
        ));
    }

    public function getReportClientsPreregistered() {
        $event_id = $this->input->get('event_id');
        $preregistered_clients = $this->ecm->getClientsPreregistered($event_id);
        $this->excel->createSheet(NULL, 0);
        $this->excel->setActiveSheetIndex(0);
        $i = 0;
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, "TIPO DE PERSONA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TIPO DE CLIENTE");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NOMBRES");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "APELLIDOS");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TIPO DOCUMENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NUMERO DOCUMENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "PAIS ORIGEN");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CIUDAD ORIGEN");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "DIRECCION");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TELEFONO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CELULAR");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "EMAIL");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "EMPRESA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CARGO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "HABEAS DATA");
        $row_datos = 2;
        foreach ($preregistered_clients as $preregistered_client) {
            $j = 0;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $row_datos, $preregistered_client->person_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->client_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->lastname);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->document_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->document_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->city_citizenship);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->country_citizenship);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->address);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->phone_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->cellphone_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->email);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->company);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->position);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $preregistered_client->habeas_data);
            $row_datos ++;
        }
        $filename = 'clientes_preregistrados_' . date('Y-m-d') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

    public function getReportClientsConfirmed() {
        $event_id = $this->input->get('event_id');
        $confirmed_clients = $this->ecm->getClientsConfirmed($event_id);
        $this->excel->createSheet(NULL, 0);
        $this->excel->setActiveSheetIndex(0);
        $i = 0;
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, "TIPO DE PERSONA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i, 1, "TIPO DE CLIENTE");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NOMBRES");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "APELLIDOS");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TIPO DOCUMENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NUMERO DOCUMENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "PAIS ORIGEN");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CIUDAD ORIGEN");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "DIRECCION");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TELEFONO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CELULAR");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "EMAIL");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "EMPRESA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CARGO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "HABEAS DATA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TIPO DE PAGO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "METODO DE PAGO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "VALOR");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "ARL QUE PAGA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NIT EMPRESA PAGA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "PAGADO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NUMERO ORDEN");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "COMENTARIO");
        $row_datos = 2;
        foreach ($confirmed_clients as $confirmed_clients) {
            $j = 0;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $row_datos, $confirmed_clients->person_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $row_datos, $confirmed_clients->client_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->lastname);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->document_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->document_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->city_citizenship);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->country_citizenship);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->address);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->phone_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->cellphone_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->email);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->company);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->position);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->habeas_data);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->payment_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->payment_method);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->price);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->arl);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->isCompanyPaying_nit_company);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->isPaid);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->invoice_code);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $confirmed_clients->comment);
            $row_datos ++;
        }
        $filename = 'clientes_confirmados_' . date('Y-m-d') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function getReportAssitance() {
        $event_id = $this->input->get('event_id');
        $clients_assistance = $this->ecm->getAssistance($event_id);
        $this->excel->createSheet(NULL, 0);
        $this->excel->setActiveSheetIndex(0);
        $i = 0;
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i, 1, "TIPO DE PERSONA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TIPO DE CLIENTE");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NOMBRES");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "APELLIDOS");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TIPO DOCUMENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "NUMERO DOCUMENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "PAIS ORIGEN");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CIUDAD ORIGEN");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "DIRECCION");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "TELEFONO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CELULAR");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "EMAIL");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "EMPRESA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "CARGO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow($i = $i + 1, 1, "HABEAS DATA");
        $row_datos = 2;
        foreach ($clients_assistance as $client_assistance) {
            $j = 0;
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j, $row_datos, $client_assistance->person_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->client_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->lastname);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->document_type);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->document_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->country_citizenship);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->city_citizenship);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->address);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->phone_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->cellphone_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->email);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->company);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->position);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($j = $j + 1, $row_datos, $client_assistance->habeas_data);
            $row_datos ++;
        }
        $filename = 'clientes_asistentes_' . date('Y-m-d') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function getReportAnswersSurvey() {
        $event_id = $this->input->get('event_id');
        $answers_survey_event = $this->escm->getAnswersSurveyByEvent($event_id);
        $this->excel->createSheet(NULL, 0);
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "EVENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "NUMERO DOCUMENTO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, "NOMBRES");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, "APELLIDOS");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, "DIRECCION");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, "TELEFONO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, 1, "EMAIL");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, 1, "EMPRESA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, 1, "CARGO");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, 1, "PREGUNTA");
        $this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, 1, "RESPUESTA");

        $row_datos = 2;
        foreach ($answers_survey_event as $answer_survey_event) {
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $row_datos, $answer_survey_event->event);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $row_datos, $answer_survey_event->document_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $row_datos, $answer_survey_event->name);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $row_datos, $answer_survey_event->lastname);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $row_datos, $answer_survey_event->address);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $row_datos, $answer_survey_event->phone_number);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $row_datos, $answer_survey_event->email);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $row_datos, $answer_survey_event->company);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $row_datos, $answer_survey_event->position);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $row_datos, $answer_survey_event->question);
            $this->excel->getActiveSheet()->setCellValueByColumnAndRow(10, $row_datos, $answer_survey_event->answer);
            $row_datos ++;
        }
        $filename = 'respuestas_encuesta_' . date('Y-m-d') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    private function convierteMes($mes) {

        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        return $meses[$mes - 1];
    }

}
