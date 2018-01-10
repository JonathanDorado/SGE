<?php

class Profile_permissions_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getPermissionsByProfile($profile_id = "") {

        $WHERE = "";
        if ($profile_id != "") {
            $WHERE = "WHERE pp.profile_id='$profile_id'";
        }
        $sql = "SELECT 
                    pp.profile_permission_id,
                    pp.profile_id,
                    pp.permission_id,
                    p.alias
                FROM 
                    profile_permissions pp
                    INNER JOIN permissions p ON p.permission_id=pp.permission_id
                $WHERE;";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function store($data) {
        $this->db->insert('profile_permissions', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function delete($profile_id, $permission_id) {
        $this->db->where('profile_id', $profile_id);
        $this->db->where('permission_id', $permission_id);
        $this->db->delete('profile_permissions');
    }

}

?>