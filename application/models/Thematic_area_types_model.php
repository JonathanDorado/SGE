<?php

class Thematic_area_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getThematicAreaTypes() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('thematic_area_types');

         return $sql->result();
    }

}

?>