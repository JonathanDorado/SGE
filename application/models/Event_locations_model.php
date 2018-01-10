<?php

class Event_locations_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getLocationsByEvent($event_id) {

        $sql = "SELECT
                    el.event_location_id,
                    el.event_id,
                    c.city_id,
                    c.name AS city,
                    el.place,
                    el.date_from,
                    el.date_until,
                    el.total_hours
                FROM
                    event_locations el
                    INNER JOIN cities c ON c.city_id=el.city_id
                WHERE
                    el.event_id=$event_id;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('event_locations', $data);
    }

    public function update($event_location_id, $data) {
        $this->db->where('event_location_id', $event_location_id);
        if ($this->db->update('event_locations', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function delete($event_location_id) {
        $this->db->where('event_location_id', $event_location_id);
        $this->db->delete('event_locations');
    }

}

?>