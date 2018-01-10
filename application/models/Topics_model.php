<?php

class Topics_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTopics($topic_id = "") {
        $WHERE = "";
        if ($topic_id != "") {
            $WHERE = "WHERE t.topic_id='$topic_id'";
        }
        $sql = "SELECT 
                    t.topic_id,
                    t.name,
                    tat.thematic_area_type_id,
                    tat.name AS thematic_area_type
                FROM 
                    topics t
                    INNER JOIN thematic_area_types tat ON tat.thematic_area_type_id=t.thematic_area_type_id
                $WHERE
                ORDER BY t.name ASC;
                    ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('topics', $data);
    }

    public function update($topic_id, $data) {
        $this->db->where('topic_id', $topic_id);
        $this->db->update('topics', $data);
    }

}

?>