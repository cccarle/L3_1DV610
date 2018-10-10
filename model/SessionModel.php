<?php

namespace model;

class SessionModel
{
    private static $isLoggedIn = "sessionModel::isLoggedIn";

    public function setToLoggedIn($isLoggedIn)
    {
        return $_SESSION[self::$isLoggedIn] = $isLoggedIn;
    }

    public function checkIfLoggedIn()
    {
        return isset($_SESSION[self::$isLoggedIn]);
    }

    public function logoutUser()
    {
        unset($_SESSION[self::$isLoggedIn]);
    }
}
