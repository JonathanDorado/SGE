<?php

class Arl_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getArls() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('arl');

        return $sql->result();
        
    }

}

?>