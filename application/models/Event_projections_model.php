<?php

class Event_projections_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getProjectionsByEvent($event_id) {

        $sql = "SELECT
                    ep.event_projection_id,
                    ep.event_id,
                    ep.projected_guests, 
                    ep.projected_pre_registered, 
                    ep.projected_confirmed,
                    ep.projected_assistants,
                    ep.projected_new_clients
                FROM
                event_projections ep
                WHERE
                ep.event_id='$event_id';";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('event_projections', $data);
    }

    public function update($event_projection_id, $data) {
        $this->db->where('event_projection_id', $event_projection_id);
        if ($this->db->update('event_projections', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

}

?>