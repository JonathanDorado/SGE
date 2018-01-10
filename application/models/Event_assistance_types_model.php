<?php

class Event_assistance_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEventAssistanceTypes() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('event_assistance_types');

        return $sql->result();
    }

}

?>