<?php

class Person_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getPersonTypes($person_type_id = "", $name = "") {
        $where = "";
        if ($person_type_id != "") {
            $where = "WHERE pt.person_type_id=" . $person_type_id;
        } else if ($name != "") {
            $where = "WHERE pt.name='" . $name . "'";
        }

        $sql = "SELECT
                    pt.person_type_id,
                    pt.name, 
                    pt.created_at
                FROM
                person_types pt
                $where
                ORDER BY pt.name ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>