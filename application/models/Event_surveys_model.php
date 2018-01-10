<?php

class Event_surveys_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSurveyByEvent($event_id) {
        $sql = "SELECT
                    es.event_survey_id,
                    e.event_id,
                    e.name AS event,
                    es.question
                FROM
                    event_surveys es
                    INNER JOIN events e ON e.event_id=es.event_id
                WHERE
                    e.event_id='$event_id';";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('event_surveys', $data);
    }

    public function update($event_survey_id, $data) {
        $this->db->where('event_survey_id', $event_survey_id);
        if ($this->db->update('event_surveys', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function delete($event_survey_id) {
        $this->db->where('event_survey_id', $event_survey_id);
        $this->db->delete('event_surveys');
    }

    public function getAverageSurveyByEvent($event_id) {
        $sql = "SELECT
                    es.event_survey_id,
                    es.question,
                    AVG(esc.score) AS average
                FROM
                    event_survey_clients esc
                    INNER JOIN event_surveys es ON es.event_survey_id=esc.event_survey_id AND es.event_id=$event_id
                GROUP BY esc.event_survey_id;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>