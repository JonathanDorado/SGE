<?php

class Clients_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getClients($client_id = "", $document_number = "", $email = "") {
        $WHERE = "";
        if ($client_id != "") {
            $WHERE = "WHERE c.client_id='$client_id'";
        } else if ($document_number != "") {
            $WHERE = "WHERE c.document_number='$document_number'";
        } else if ($email != "") {
            $WHERE = "WHERE c.email='$email'";
        }

        $sql = "SELECT
                    c.client_id,
                    pt.person_type_id,
                    pt.name AS person_type,
                    ct.client_type_id,
                    ct.name AS client_type,
                    c.name,
                    c.lastname,
                    dt.document_type_id,
                    dt.name AS document_type,
                    c.document_number,
                    c.city_id_citizenship,
                    ci.name AS city_citizenship,
                    co.country_id,
                    co.country_code,
                    co.name AS country_citizenship,
                    c.address,
                    c.phone_number,
                    c.cellphone_number,
                    c.email,
                    c.company,
                    c.position,
                    c.habeas_data,
                    c.created_at
                FROM
                    clients c
                    INNER JOIN person_types pt ON pt.person_type_id=c.person_type_id
                    INNER JOIN client_types ct ON ct.client_type_id=c.client_type_id
                    INNER JOIN document_types dt ON dt.document_type_id = c.document_type_id
                    INNER JOIN cities ci ON ci.city_id = c.city_id_citizenship
                    INNER JOIN countries co ON co.country_code = ci.country_code
                $WHERE
                ORDER BY c.name ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('clients', $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function update($client_id, $data) {
        $this->db->where('client_id', $client_id);
        $this->db->update('clients', $data);
    }

    public function getTotalClients($action = '') {
        $where = "";
        if ($action == "HABEAS_DATA_YES") {
            $where = "WHERE habeas_data=1";
        } else if ($action == "HABEAS_DATA_NO") {
            $where = "WHERE habeas_data=0";
        }

        $sql = "SELECT
                    COUNT(*) as total
                FROM
                    clients
                    $where ;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getClientsOffline() {
        $sql = "SELECT
                    *
                FROM
                    clients
                WHERE
                    offline_mode_create=1
                    OR offline_mode_update=1;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>