<?php

class Permissions_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getPermissions() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('permissions');

        return $sql->result();
    }

}

?>