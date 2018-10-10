<?php

namespace model;

class LoginModel
{
    private $db;
    private $session;
    private $wasLogInSuccesFull;
    
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

        if ($this->doesUserExist()) {

            if ($this->matchHashedPasswordWithInputPassword($password, $this->getHasedPasswordFromDB($row))) {

                $this->didLoginAttemtpSucces(true);

            } else {

                $this->didLoginAttemtpSucces(false);
                
            }
        }
    }

    public function doesUserExist()
    {
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function getHasedPasswordFromDB($row)
    {
        return $row->user_password;
    }

    private function matchHashedPasswordWithInputPassword($password, $hashed_password)
    {
        if (password_verify($password, $hashed_password)) {
            return true;
        }
    }

    public function didLoginAttemtpSucces($loginResult)
    {
        $this->wasLogInSuccesFull = $loginResult;
    }

    public function checkIfLoginSuccess()
    {
        if ($this->wasLogInSuccesFull === true) {
            $this->session->setToLoggedIn(true);
        }
        return $this->wasLogInSuccesFull;
    }
}
