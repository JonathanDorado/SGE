<?php

class Modules_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getModules() {

        $sql = $this
                ->db
                ->get('modules');

        return $sql->result();
    }

}

?>