<?php

class Consultant_clasifications_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getConsultantClasifications() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('consultant_clasifications');

        return $sql->result();
    }

}

?>