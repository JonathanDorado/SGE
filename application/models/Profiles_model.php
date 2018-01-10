<?php

class Profiles_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getProfiles($profile_id="") {

        $WHERE = "";
        if ($profile_id != "") {
            $WHERE = "WHERE p.profile_id='$profile_id'";
        }
        $sql = "SELECT 
                    p.profile_id,
                    p.name
                FROM 
                    profiles p
                $WHERE;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>