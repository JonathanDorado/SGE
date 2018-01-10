<?php

class Client_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getClientTypes($client_type_id = "", $name = "") {
        $where = "";
        if ($client_type_id != "") {
            $where = "WHERE ct.client_type_id=" . $client_type_id;
        } else if ($name != "") {
            $where = "WHERE ct.name='" . $name . "'";
        }

        $sql = "SELECT
                    ct.client_type_id,
                    ct.name, 
                    ct.created_at
                FROM
                client_types ct
                $where
                ORDER BY ct.name ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>