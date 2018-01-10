<?php

class Event_guests_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getGuestByEvent($event_id) {

        $sql = $this
                ->db
                ->where('event_id', $event_id)
                ->get('event_guests');

        return $sql->result();
    }

    public function getGuest($event_id, $email) {

        $sql = $this
                ->db
                ->where('event_id', $event_id)
                ->where('email', $email)
                ->get('event_guests');

        return $sql->result();
    }

    public function store($data) {
        $this->db->insert('event_guests', $data);
    }

    public function update($event_id, $email, $data) {
        $this->db->where('event_id', $event_id);
        $this->db->where('email', $email);
        $this->db->update('event_guests', $data);
    }

    public function getTotalGuestsByEvent($event_id) {
        $sql = "SELECT 
                    COUNT(*) AS total
                FROM
                    events e
                    INNER JOIN event_guests eg ON eg.event_id=e.event_id
                WHERE
                    eg.event_id='$event_id';";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>