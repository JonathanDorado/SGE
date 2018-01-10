<?php

class Event_resources_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getResourcesByEvent($event_id) {
        $sql = "SELECT
                    er.event_resource_id,
                    er.event_id,
                    er.url_logo_event, 
                    er.url_template_certificate, 
                    er.isLandingRequired, 
                    er.url_logo_landing,
                    er.landing_description
                FROM
                event_resources er
                WHERE
                er.event_id='$event_id';";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('event_resources', $data);
    }

    public function update($event_resource_id, $data) {
        $this->db->where('event_resource_id', $event_resource_id);
        if ($this->db->update('event_resources', $data)) {
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