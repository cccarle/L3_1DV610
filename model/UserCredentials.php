<?php

namespace model;

class UserCredentials
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        if ($username === null || $username === '') {
            throw new \Exception\UsernameMissingException();
        }
        if ($password === null || $password === '') {
            throw new \Exception\PasswordMissingException();
        }


        $this->username = $username;
        $this->password = $password;

    }

    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
}
