<?php

class Training_platforms_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTrainingPlatforms() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('training_platforms');

        return $sql->result();
    }

}

?>