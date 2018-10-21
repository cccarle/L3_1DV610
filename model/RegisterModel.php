<?php

namespace model;

class RegisterModel
{
    private $database;
    private $wasregSuccesFull;
    private $isUsernameTaken;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function registerAttempt($username, $password): void
    {
        if ($this->isUsernameAvailable($username)) {
            $this->isUsernameTaken = true;
            $this->wasregSuccesFull = false;
        } else {
            $this->registerNewUser($username, $password);
        }
    }

    private function registerNewUser($username, $password): void
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->database->query('INSERT INTO users(user_username,user_password) VALUES(:user_username,:user_password)');
        $this->database->bind(':user_username', $username);
        $this->database->bind(':user_password', $password);
        $this->database->execute();
        $this->wasregSuccesFull = false;
    }

    private function isUsernameAvailable($username): bool
    {
        $this->database->query('SELECT * FROM users WHERE user_username = :user_username');
        $this->database->bind(':user_username', $username);
        $row = $this->database->single();

        return $this->database->rowCount() > 0;
    }

    public function isRegistrationSuccess()
    {
        return $this->wasregSuccesFull;
    }

    public function isUsernameTaken()
    {
        return $this->isUsernameTaken;
    }

}
