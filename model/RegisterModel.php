<?php

namespace model;

class RegisterModel
{
    private $db;
    private $username;
    private $password;
    private $wasregSuccesFull;
    private $isUsernameTaken;

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

            $this->isUsernameTaken = true;
            $this->wasregSuccesFull = false;
    
        } else{

            $password = password_hash($password, PASSWORD_BCRYPT);
            $this->db->query('INSERT INTO users(user_username,user_password) VALUES(:user_username,:user_password)');
            // Bind values
            $this->db->bind(':user_username', $username);
            $this->db->bind(':user_password', $password);

            if ($this->db->execute()) {
              
                $this->wasregSuccesFull = true;

            }
        }
    }

    public function wasRegSuccess (){
        return $this->wasregSuccesFull;
    }

    public function isUsernameTaken()
    {
        return $this->isUsernameTaken;
    }


}
