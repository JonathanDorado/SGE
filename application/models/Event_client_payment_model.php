<?php

class Event_client_payment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEventClientPayment($event_client_id) {
        $sql = "SELECT
                    ecp.event_client_payment_id,
                    ecp.event_client_id,
                    pt.payment_type_id,
                    pt.name AS payment_type,
                    pm.payment_method_id,
                    pm.name AS payment_method,
                    ecp.isCompanyPaying_nit_company,
                    ecp.isArlPaying_arl_id,
                    ecp.price,
                    ecp.comment,
                    ecp.isPaid,
                    ecp.invoice_code,
                    ecp.paid_date
                FROM
                    event_client_payment ecp
                    INNER JOIN event_clients ec ON ec.event_client_id=ecp.event_client_id  
                    INNER JOIN payment_types pt ON pt.payment_type_id=ecp.payment_type_id 
                    INNER JOIN payment_methods pm ON pm.payment_method_id=ecp.payment_method_id
                WHERE 
                    ecp.event_client_id=$event_client_id";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('event_client_payment', $data);
    }

    public function update($event_client_payment_id, $data) {
        $this->db->where('event_client_payment_id', $event_client_payment_id);
        if ($this->db->update('event_client_payment', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function getPaymentByCode($code) {
        $query = "Select * from event_client_payment where invoice_code = '" . $code . "'";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function getTotalAssistantsByPayment($event_id, $payment_type_id) {
        $sql = "SELECT 
                    e.event_id,
                    e.name,
                    pt.payment_type_id,
                    pt.name AS payment_type, 
                    COUNT(*) AS total
                FROM
                    EVENTS e
                    INNER JOIN event_clients ec ON ec.event_id=e.event_id AND ec.state_id=5
                    INNER JOIN event_client_payment ecp ON ecp.event_client_id=ec.event_client_id
                    INNER JOIN payment_types pt ON pt.payment_type_id=ecp.payment_type_id
                WHERE
		    e.event_id = $event_id
                    AND ecp.payment_type_id=$payment_type_id";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getEventClientPaymentOffline() {
        $sql = "SELECT
                    *
                FROM
                    event_client_payment ecp
                    INNER JOIN event_clients ec ON ec.event_client_id=ecp.event_client_id
                    INNER JOIN clients c ON c.client_id=ec.client_id
                WHERE
                    ecp.offline_mode_create=1
                    OR
                    ecp.offline_mode_update=1;";
        $result = $this->db->query($sql);
        return $result->result();
    }
    
}

?>