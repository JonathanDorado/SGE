<?php

class Event_survey_clients_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function store($data) {
        $this->db->insert('event_survey_clients', $data);
    }

    public function getAnswersSurveyByEvent($event_id) {
        $sql = "SELECT
                    e.event_id,
                    e.name AS event,
                    es.event_survey_id,
                    es.question,
                    esc.score AS answer,
                    c.client_id,
                    c.document_number,
                    c.name,
                    c.lastname,
                    c.address,
                    c.phone_number,
                    c.email,
                    c.company,
                    c.position
                FROM
                    event_survey_clients esc
                    INNER JOIN event_surveys es ON es.event_survey_id=esc.event_survey_id AND es.event_id=$event_id
                    INNER JOIN clients c ON c.client_id=esc.client_id
                    INNER JOIN events e ON e.event_id=es.event_id";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getSurveyEventByClient($event_id, $client_id) {
        $sql = " SELECT 
                    c.client_id,
                    c.name AS client,
                    esc.event_survey_client_id,
                    es.event_survey_id,
                    es.question,
                    esc.score
                FROM
                   event_survey_clients esc 
                   INNER JOIN event_surveys es ON (es.event_survey_id=esc.event_survey_id AND es.event_id='$event_id')
                   INNER JOIN events e ON e.event_id=es.event_id
                   INNER JOIN clients c ON (c.client_id=esc.client_id AND c.client_id='$client_id');";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getAverageByQuestion($event_id) {
        $sql = "SELECT 
                    es.question,
                    AVG(esc.score) AS average
                FROM
                    event_survey_clients esc
                    INNER JOIN event_surveys es ON es.event_survey_id=esc.event_survey_id AND es.event_id=$event_id
                GROUP BY 
                    esc.event_survey_id;";
        $result = $this->db->query($sql);
        return $result->result();
    }
}

?>