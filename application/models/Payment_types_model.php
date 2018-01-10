<?php

class Payment_types_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getPaymentTypes() {
        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('payment_types');
        return $sql->result();
    }

}

?>