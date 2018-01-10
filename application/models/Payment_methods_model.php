<?php

class Payment_methods_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getPaymentMethods() {
        $sql = $this
                ->db
                ->order_by("name", "asc")
                ->get('payment_methods');
        return $sql->result();
    }

}

?>