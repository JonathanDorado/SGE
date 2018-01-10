<?php

class Cities_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCities($country_code = "", $name = "") {

        $where = "";
        if ($country_code != "") {
            $where = "WHERE c.country_code='" . $country_code . "'";
        } else if ($name != "") {
            $where = "WHERE c.name='" . $name . "'";
        }

        $sql = "SELECT
                    c.city_id,
                    c.name, 
                    c.created_at
                FROM
                cities c
                $where
                ORDER BY c.name ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>