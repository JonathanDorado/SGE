<?php

class Countries_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCountries($country_id = "") {

        $where = "";
        if ($country_id != "") {
            $where = "WHERE c.country_id=" . $country_id;
        }

        $sql = "SELECT
                    c.country_id,
                    c.name, 
                    c.country_code, 
                    c.created_at
                FROM
                countries c
                $where
                ORDER BY c.name ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>