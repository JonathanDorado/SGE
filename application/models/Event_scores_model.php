<?php

class Event_scores_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getScoresByEvent($event_id) {
        $sql = "SELECT
                    es.event_score_id,
                    es.event_id,
                    es.isScoreRequired, 
                    es.score_assistance, 
                    es.score_attention
                FROM
                    event_scores es
                WHERE
                    es.event_id='$event_id';";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('event_scores', $data);
    }

    public function update($event_score_id, $data) {
        $this->db->where('event_score_id', $event_score_id);
        if ($this->db->update('event_scores', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

}

?>