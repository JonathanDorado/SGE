<?php

class Event_clients_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEventClients($event_id = "", $action) {
        $where_confirm = '';
        if ($action == 'PREREGISTER') {
            $join = "LEFT";
        } else if ($action == 'CONFIRMATION') {
            $join = "INNER";
        } else if ($action == 'ASSISTANCE') {
            $join = "INNER";
            $where_confirm = 'AND ec.state_id in (5,7)';
        }

        $sql = "SELECT
                    ec.event_client_id,
                    c.client_id,
                    c.name,
                    c.lastname,
                    c.document_number, 
                    c.phone_number,
                    c.email,
                    c.company,
                    c.position,
                    s.state_id,
                    s.name AS state,
                    ecp.isPaid,
                    CASE 
                            WHEN ec.event_client_id>0 
                                    THEN 1
                                    ELSE 0
                    END AS preregister,
                    ec.state_id as state_client,
                    ec.created_by_user_id
                FROM
                    clients c
                    $join JOIN event_clients ec ON (ec.client_id=c.client_id AND ec.event_id=$event_id $where_confirm)
                    LEFT JOIN event_client_payment ecp ON ecp.event_client_id=ec.event_client_id    
                    $join JOIN states s ON s.state_id=ec.state_id;";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getClientByEvent($event_id = "", $client_id) {

        $sql = "SELECT
                    ec.event_client_id,
                    c.client_id
                FROM
                    clients c
                    INNER JOIN event_clients ec ON (ec.client_id=c.client_id AND ec.event_id=$event_id)
                WHERE
		    c.client_id=$client_id;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {

        $this->db->insert('event_clients', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function delete($event_id, $client_id) {
        $this->db->where('event_id', $event_id);
        $this->db->where('client_id', $client_id);
        $this->db->delete('event_clients');
    }

    public function update($event_client_id, $data) {
        $this->db->where('event_client_id', $event_client_id);
        if ($this->db->update('event_clients', $data)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function store_Masive($data, $event_id, $client_id) {

        $sql = "SELECT 
                        ec.event_client_id,
                        ec.event_id,
                        c.client_id,
                        c.document_number
                    FROM
                        event_clients ec 
                        INNER JOIN clients c ON (c.client_id=ec.client_id AND c.client_id='$client_id')
                    WHERE
                       ec.event_id='$event_id';";
        $result = $this->db->query($sql);

        if (count($result->result()) == 0) {
            $this->db->insert('event_clients', $data);
        }
    }

    public function getClientsByEvent($action, $event_id) {
        $states = '';
        if ($action == 'PREREGISTER') {
            $states = "2,3,5,7";
        } else if ($action == 'CONFIRMATION') {
            $states = "3,5,7";
        } else if ($action == 'ASSISTANCE') {
            $states = "5";
        }

        $sql = "SELECT 
                    COUNT(*) AS total
                FROM
                    events e
                    INNER JOIN event_clients ec ON ec.event_id=e.event_id
                WHERE
                    ec.event_id='$event_id'
                    AND ec.state_id IN ($states)";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getClientsPreregistered($event_id) {

        $sql = "SELECT
                    pt.name as person_type,
                    ct.name AS client_type,
                    c.name,
                    c.lastname,
                    dt.name AS document_type,
                    c.document_number,
                    ci.name AS city_citizenship,
                    co.name AS country_citizenship,
                    c.address,
                    c.phone_number,
                    c.cellphone_number,
                    c.email,
                    c.company,
                    c.position,
                    c.habeas_data
                FROM
                    event_clients ec 
                    INNER JOIN clients c ON c.client_id=ec.client_id
                    INNER JOIN states s ON s.state_id=ec.state_id
                    INNER JOIN person_types pt ON pt.person_type_id=c.person_type_id
                    INNER JOIN client_types ct ON ct.client_type_id=c.client_type_id
                    INNER JOIN document_types dt ON dt.document_type_id=c.document_type_id
                    INNER JOIN cities ci ON ci.city_id=c.city_id_citizenship
                    INNER JOIN countries co ON co.country_code=ci.country_code
                WHERE
                    ec.event_id=$event_id
                    AND ec.state_id IN (2,3,5,7)";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getClientsConfirmed($event_id) {

        $sql = "SELECT
                    pet.name AS person_type,
                    ct.name AS client_type,
                    c.name,
                    c.lastname,
                    dt.name AS document_type,
                    c.document_number,
                    ci.name AS city_citizenship,
                    co.name AS country_citizenship,
                    c.address,
                    c.phone_number,
                    c.cellphone_number,
                    c.email,
                    c.company,
                    c.position,
                    c.habeas_data,
                    pt.name AS payment_type,
                    pmt.name AS payment_method,
                    ecp.price,
                    ecp.isCompanyPaying_nit_company,
                    arl.name AS arl,
                    ecp.isPaid,
                    ecp.comment,
                    ecp.invoice_code
                FROM
                    event_clients ec
                    INNER JOIN event_client_payment ecp ON ecp.event_client_id=ec.event_client_id 
                    INNER JOIN clients c ON c.client_id=ec.client_id
                    INNER JOIN states s ON s.state_id=ec.state_id
                    INNER JOIN person_types pet ON pet.person_type_id=c.person_type_id
                    INNER JOIN client_types ct ON ct.client_type_id=c.client_type_id
                    INNER JOIN document_types dt ON dt.document_type_id=c.document_type_id
                    INNER JOIN cities ci ON ci.city_id=c.city_id_citizenship
                    INNER JOIN countries co ON co.country_code=ci.country_code
                    INNER JOIN payment_types pt ON pt.payment_type_id=ecp.payment_type_id
                    INNER JOIN payment_methods pmt ON pmt.payment_method_id=ecp.payment_method_id
                    INNER JOIN arl arl ON arl.arl_id=ecp.isArlPaying_arl_id
                WHERE
                    ec.event_id=$event_id
                    AND ec.state_id IN (3,5,7)";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getAssistance($event_id) {

        $sql = "SELECT
                    pet.name AS person_type,
                    ct.name AS client_type,
                    c.name,
                    c.lastname,
                    dt.name AS document_type,
                    c.document_number,
                    ci.name AS city_citizenship,
                    co.name AS country_citizenship,
                    c.address,
                    c.phone_number,
                    c.cellphone_number,
                    c.email,
                    c.company,
                    c.position,
                    c.habeas_data
                FROM
                    event_clients ec 
                    INNER JOIN clients c ON c.client_id=ec.client_id
                    INNER JOIN states s ON s.state_id=ec.state_id
                    INNER JOIN person_types pet ON pet.person_type_id=c.person_type_id
                    INNER JOIN client_types ct ON ct.client_type_id=c.client_type_id
                    INNER JOIN document_types dt ON dt.document_type_id=c.document_type_id
                    INNER JOIN cities ci ON ci.city_id=c.city_id_citizenship
                    INNER JOIN countries co ON co.country_code=ci.country_code
                WHERE
                    ec.event_id=$event_id
                    AND ec.state_id IN (5)";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getEventsByClient($client_id) {

        $sql = "SELECT
                    ec.event_client_id,
                    c.client_id,
                    c.name,
                    c.lastname,
                    c.document_number,
                    c.address,
                    c.phone_number,
                    c.email,
                    c.company,
                    c.position,
                    e.event_id,
                    e.name AS event,
                    er.url_logo_event,
                    e.date_from
                FROM
                    clients c
                    INNER JOIN event_clients ec ON (ec.client_id=c.client_id AND ec.state_id=5)
                    INNER JOIN events e ON e.event_id=ec.event_id
                    INNER JOIN event_resources er ON er.event_id=e.event_id
                WHERE 
                    c.client_id=$client_id
                ORDER BY e.date_from ASC";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTotalAssistantsByEvent() {
        $sql = "SELECT 
                    e.event_id,
                    e.name,
                    COUNT(*) AS total
                FROM
                    events e
                    INNER JOIN event_clients ec ON ec.event_id=e.event_id AND ec.state_id=5
                WHERE
                    e.state_id=4";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getEventClientsOffline() {
        $sql = "SELECT
                    *
                FROM
                    event_clients ec
                    inner join clients c on c.client_id=ec.client_id
                WHERE
                    ec.offline_mode=1;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>