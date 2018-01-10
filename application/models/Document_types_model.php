<?php

class Document_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getDocumentTypes($document_type_id = "", $name = "") {

        $where = "";
        if ($document_type_id != "") {
            $where = "WHERE dt.document_type_id=" . $document_type_id;
        } else if ($name != "") {
            $where = "WHERE dt.name='" . $name . "'";
        }

        $sql = "SELECT
                    dt.document_type_id,
                    dt.name, 
                    dt.created_at
                FROM
                document_types dt
                $where
                ORDER BY dt.name ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>