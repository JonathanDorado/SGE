<?php

class Event_client_topics_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEventClientTopics($event_client_id = "") {
        $where = "";
        if ($event_client_id != "") {
            $where = "WHERE ect.event_client_id=" . $event_client_id;
        }

        $sql = "SELECT
                    ect.event_client_topic_id,
                    ect.event_client_id,
                    ect.event_topic_id,
                    t.name AS topic
                FROM
                event_client_topics ect
                INNER JOIN event_topics et ON et.event_topic_id=ect.event_topic_id
                INNER JOIN topics t ON t.topic_id=et.topic_id
                $where;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {

        $this->db->insert('event_client_topics', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function delete($event_client_id) {
        $this->db->where('event_client_id', $event_client_id);
        $this->db->delete('event_client_topics');
    }

    public function getEventClientTopicsOffline() {
        $sql = "SELECT
                    *
                FROM
                    event_client_topics ect
                    INNER JOIN event_clients ec ON ec.event_client_id=ect.event_client_id
                    INNER JOIN clients c ON c.client_id=ec.client_id
                WHERE
                    ect.offline_mode=1;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>