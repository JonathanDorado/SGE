<?php

class Event_topics_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTopicsByEvent($event_id) {
        $sql = "SELECT
                    et.event_topic_id,
                    t.topic_id,
                    t.name AS topic,
                    t.thematic_area_type_id,
                    tap.name as thematic_area_type,
                    p.provider_id,
                    p.name AS provider_name,
                    p.lastname AS provider_lastname,
                    p.url_img_profile,
                    et.date_hour,
                    et.url_memories
                FROM
                    event_topics et
                    INNER JOIN topics t ON t.topic_id = et.topic_id
                    INNER JOIN providers p ON p.provider_id = et.provider_id
                    INNER JOIN thematic_area_types tap ON tap.thematic_area_type_id=t.thematic_area_type_id
                WHERE et.event_id = '$event_id'
                ORDER BY et.date_hour ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('event_topics', $data);
    }

    public function update($event_topic_id, $data) {
        $this->db->where('event_topic_id', $event_topic_id);
        if ($this->db->update('event_topics', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function delete($event_topic_id) {
        $this->db->where('event_topic_id', $event_topic_id);
        $this->db->delete('event_topics');
    }

}

?>