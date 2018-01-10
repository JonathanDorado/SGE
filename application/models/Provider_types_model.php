<?php

class Provider_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getProviderTypes() {

        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('provider_types');

        return $sql->result();
    }

}

?>