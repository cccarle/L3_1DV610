<?php

namespace model;

class RegisterModel
{
    private $db;
    private $username;
    private $password;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function register($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE user_username = :user_username');
        $this->db->bind(':user_username', $username);
        $row = $this->db->single();
        // check that the row has an user found with the provide username
        if ($this->db->rowCount() > 0) {
            // $this->regController->ShowUserReponseMessageFromDB($this->Err->usernameAlreadyTaken());
            // echo 'username already taken';
        
        } else {
            
            $password = password_hash($password, PASSWORD_BCRYPT);
            $this->db->query('INSERT INTO users(user_username,user_password) VALUES(:user_username,:user_password)');
            
            // Bind values
            $this->db->bind(':user_username', $username);
            $this->db->bind(':user_password', $password);
            if ($this->db->execute()) {

                // echo 'succes reg';

                    // $this->regController->SuccesRegistration($this->username);
            } else {

            // echo ' something went wrong';

                // $this->regController->ShowUserReponseMessageFromDB($this->Err->somethingWentWrong());
            }
        }
    }
}