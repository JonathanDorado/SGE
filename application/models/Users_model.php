<?php

class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getUsers($user_id = "", $email = "") {
        $WHERE = "";
        if ($user_id != "") {
            $WHERE = "WHERE u.user_id='$user_id'";
        } else {
            if ($email != "") {
                $WHERE = "WHERE u.email='$email'";
            }
        }

        $sql = "SELECT 
                    u.user_id, 
                    u.name, 
                    u.lastname, 
                    u.email, 
                    u.active, 
                    u.created_at, 
                    p.profile_id, 
                    p.name AS profile_name
                FROM
                    users u
                    INNER JOIN profiles p ON p.profile_id=u.profile_id
                $WHERE
                ORDER BY u.name ASC;";
        $result = $this->db->query($sql);

        return $result->result();
    }

    public function store($data) {
        $this->db->insert('users', $data);
    }

    public function update($user_id, $data) {
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

    public function updateByEmail($email, $data) {
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }

    public function validate_login($email, $password) {

        $sql = $this
                ->db
                ->where('email', $email)
                ->where('password', sha1($password))
                ->where('active', 1)
                ->get('users');

        if ($sql->num_rows() > 0) {
            return $sql->result();
        }

        return false;
    }

    public function getTotalUsers() {

        $sql = "SELECT
                    COUNT(*) as total
                FROM
                    users;";
        $result = $this->db->query($sql);
        return $result->result();
    }

}

?>