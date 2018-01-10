<?php

class Providers_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getProviders($provider_id = "") {
        $WHERE = "";
        if ($provider_id != "") {
            $WHERE = "WHERE p.provider_id='$provider_id'";
        }
        $sql = "SELECT
                    p.provider_id,
                    pt.provider_type_id,
                    pt.name as provider_type,
                    p.name,
                    p.lastname,
                    dt.document_type_id,
                    dt.name AS document_type,
                    p.document_number,
                    p.date_birthday,
                    p.date_start_ccs,
                    p.url_img_profile,
                    a.area_id,
                    a.name as area,
                    tat.thematic_area_type_id,
                    tat.name AS thematic_area_type,
                    cc.consultant_clasification_id,
                    cc.name AS consultant_clasification
                FROM
                    providers p
                    INNER JOIN provider_types pt on pt.provider_type_id=p.provider_type_id
                    INNER JOIN document_types dt ON dt.document_type_id=p.document_type_id
                    INNER JOIN areas a on a.area_id=p.area_id
                    INNER JOIN thematic_area_types tat ON tat.thematic_area_type_id=p.thematic_area_type_id
                    INNER JOIN consultant_clasifications cc ON cc.consultant_clasification_id=p.consultant_clasification_id
                $WHERE
                ORDER BY p.name ASC;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('providers', $data);
    }

    public function getProvidersByThematicAreaType($thematic_area_type_id) {
        $sql = "SELECT
                    p.provider_id,
                    p.name,
                    p.lastname,
                    dt.document_type_id,
                    dt.name AS document_type,
                    p.document_number,
                    p.date_birthday,
                    p.date_start_ccs,
                    tat.thematic_area_type_id,
                    tat.name AS thematic_area_type,
                    cc.consultant_clasification_id,
                    cc.name AS consultant_clasification
                FROM
                    providers p
                    INNER JOIN document_types dt ON dt.document_type_id=p.document_type_id
                    INNER JOIN thematic_area_types tat ON tat.thematic_area_type_id=p.thematic_area_type_id
                    INNER JOIN consultant_clasifications cc ON cc.consultant_clasification_id=p.consultant_clasification_id
                WHERE p.thematic_area_type_id='$thematic_area_type_id';";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function update($provider_id, $data) {
        $this->db->where('provider_id', $provider_id);
        $this->db->update('providers', $data);
    }

    public function getTotalProviders() {

        $sql = "SELECT
                    COUNT(*) as total
                FROM
                    providers;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>