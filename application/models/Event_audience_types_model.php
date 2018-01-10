<?php

class Event_audience_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEventAudienceTypes() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('event_audience_types');
        return $sql->result();
    }

}

?>