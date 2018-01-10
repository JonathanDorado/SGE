<?php

class Areas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAreas() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('areas');

        return $sql->result();
    }

}

?>