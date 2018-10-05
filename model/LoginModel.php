<?php

namespace model;

class LoginModel
{
    private $db;
    private $session;

    public function __construct($database, $session)
    {
        $this->db = $database;
        $this->session = $session;
    }

    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE user_username = :user_username');
        $this->db->bind(':user_username', $username);

        $row = $this->db->single();
        // check that the row has an user found with the provide username

        if ($this->db->rowCount() > 0) {
            $hashed_password = $row->user_password;
            // om hasat lösen passar med inskriva lösen,
            if (password_verify($password, $hashed_password)) {

            $this->session->setToLoggedIn(true);


            } else {
            }
        } else {
        }
    }
}
