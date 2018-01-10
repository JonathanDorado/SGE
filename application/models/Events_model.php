<?php

class Events_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEvents($event_id = "", $date_from = "", $date_until = "") {
        $where = "";
        if ($event_id != "") {
            $where = "WHERE event_id=" . $event_id;
        } else if ($date_from != "") {
            $where = "WHERE e.date_from='" . $date_from . "'";
        } else if ($date_until != "") {
            $where = "WHERE e.date_until='" . $date_until . "'";
        }

        $sql = "SELECT
                    e.event_id,
                    e.name, 
                    e.date_from, 
                    e.date_until, 
                    c.city_id,
                    c.name as city,
                    e.place,
                    e.total_hours,
                    eat.event_assistance_type_id,
                    eat.name as event_assistance_type,
                    e.event_type_id,
                    e.event_audience_type_id,
                    e.training_platform_id,
                    et.event_type_id, 
                    et.name AS event_type, 
                    s.state_id, 
                    s.name AS status,
                    e.created_at
                FROM
                events e
                INNER JOIN event_types et ON et.event_type_id=e.event_type_id
                INNER JOIN cities c ON c.city_id=e.city_id
                INNER JOIN states s ON s.state_id=e.state_id
                INNER JOIN event_assistance_types eat ON eat.event_assistance_type_id=e.event_assistance_type_id
                $where
                ORDER BY e.created_at DESC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {

        $this->db->insert('events', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function update($event_id, $data) {
        $this->db->where('event_id', $event_id);
        if ($this->db->update('events', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function getTotalEvents($year = '') {
        $where = "";

        $sql = "SELECT
                    COUNT(*) as total
                FROM
                    events
                    $where ;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTotalEventsByState() {
        $where = "";

        $sql = "SELECT
                    s.name AS state,
                    COUNT(*) AS total
                FROM 
                   events e
                   INNER JOIN states s ON s.state_id=e.state_id
                GROUP BY 
                    e.state_id;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTotalEventByMonth($year, $month) {

        $sql = "SELECT
                    e.name,
                    e.event_id,
                    MONTH(e.date_from),
                    YEAR(e.date_from)
                FROM
                    events e
                WHERE 
                    YEAR(date_from)=$year
                    AND MONTH(date_from)=$month
                ORDER BY 
                    MONTH(e.date_from);";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>