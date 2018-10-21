<?php
namespace model;

class LoginModel
{
    private $db;
    private $session;
    private $wasLogInSuccesFull;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function login($username, $password): void
    {
        if ($this->isUsernameInDatabase($username) && $this->isHashedPasswordMatchWithPasswordInput($password)) {

            $this->wasLogInSuccesFull = true;

        } else {

            $this->wasLogInSuccesFull = false;

        }
    }

    private function isUsernameInDatabase($username): bool
    {
        $this->database->query('SELECT * FROM users WHERE user_username = :user_username');
        $this->database->bindValues(':user_username', $username);
        $this->getRowInDatabase();

        return $this->database->rowCount() > 0;
    }

    private function isHashedPasswordMatchWithPasswordInput($password) : bool
    {
        return password_verify($password, $this->getRowInDatabase()->user_password);
    }

    private function getRowInDatabase()
    {
        return $row = $this->database->getSingleRecord();
    }

    public function checkIfLoginSuccess()
    {
        return $this->wasLogInSuccesFull;
    }
}
