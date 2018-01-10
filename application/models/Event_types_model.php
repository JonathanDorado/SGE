<?php

class Event_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEventTypes() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('event_types');

        return $sql->result();
    }

}

?>