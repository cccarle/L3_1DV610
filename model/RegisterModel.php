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
    echo'asd';
        } else{

            $password = password_hash($password, PASSWORD_BCRYPT);
            $this->db->query('INSERT INTO users(user_username,user_password) VALUES(:user_username,:user_password)');
            // Bind values
            $this->db->bind(':user_username', $username);
            $this->db->bind(':user_password', $password);

            if ($this->db->execute()) {
              
                $this->wasregSuccesFull = true;

            } else {
                echo 'somtjingwronf';
            }

        }
    }





    // public function Register()
    // {
    //     $this->db->query('SELECT * FROM users WHERE user_username = :user_username');
    //     $this->db->bind(':user_username', $this->username);
    //     $row = $this->db->single();
    //     // check that the row has an user found with the provide username
    //     if ($this->db->rowCount() > 0) {
    //         $this->regController->ShowUserReponseMessageFromDB($this->Err->usernameAlreadyTaken());
    //     } else {
            
    //         $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    //         $this->db->query('INSERT INTO users(user_username,user_password) VALUES(:user_username,:user_password)');
            
    //         // Bind values
    //         $this->db->bind(':user_username', $this->username);
    //         $this->db->bind(':user_password', $this->password);

    //         if ($this->db->execute()) {
    //                 $this->regController->SuccesRegistration($this->username);
    //         } else {
    //             $this->regController->ShowUserReponseMessageFromDB($this->Err->somethingWentWrong());
    //         }
    //     }
    // }

    public function wasRegSuccess (){
        return $this->wasregSuccesFull;
    }

    public function isUsernameTaken()
    {
        return $this->isUsernameTaken;
    }


}
