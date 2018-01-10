<?php

class Training_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTrainingTypes() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('training_types');

        return $sql->result();
    }

}

?>