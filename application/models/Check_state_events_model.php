<?php

class Check_state_events_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCheckByDate($date) {

        $sql = "SELECT
                    date
                FROM
                    check_state_events
                WHERE
                    date='$date'";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {

        $this->db->insert('check_state_events', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

}

?>