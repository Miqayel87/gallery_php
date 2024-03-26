<?php

require_once 'database/database.php';
class Admin {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM admins WHERE username = :username');
        $this->db->bind(':username', $username);
        $row = $this->db->single();

        if(empty($row)){
            return false;
        }

        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
}
