<?php

namespace model;

class RegisterModel
{
    private $database;
    private $username;
    private $password;
    private $wasregSuccesFull;
    private $isUsernameTaken;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function register($username, $password)
    {
        $this->database->query('SELECT * FROM users WHERE user_username = :user_username');
        $this->database->bind(':user_username', $username);

        $row = $this->database->single();

        if ($this->isUsernameIsTaken()) {

            $this->isUsernameTaken = true;
            $this->wasregSuccesFull = false;

        } else {

            $password = password_hash($password, PASSWORD_BCRYPT);
            $this->database->query('INSERT INTO users(user_username,user_password) VALUES(:user_username,:user_password)');
            // Bind values
            $this->database->bind(':user_username', $username);
            $this->database->bind(':user_password', $password);

            $this->regWasSucessfull();
        }
    }

    public function isUsernameIsTaken()
    {
        if ($this->database->rowCount() > 0) {
            return true;
        }
    }

    private function regWasSucessfull()
    {
        if ($this->database->execute()) {
            $this->wasregSuccesFull = true;
        }
    }

    public function wasRegSuccess()
    {
        return $this->wasregSuccesFull;
    }

    public function isUsernameTaken()
    {
        return $this->isUsernameTaken;
    }

}
