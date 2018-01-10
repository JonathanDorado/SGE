<?php

class Event_client_comments_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function store($data) {
        $this->db->insert('event_client_comments', $data);
    }

}

?>