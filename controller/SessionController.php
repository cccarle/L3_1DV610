<?php

namespace controller;

class SessionController
{
    private static $isLoggedIn = "sessionController::isLoggedIn";
    private static $succesRegistration = "sessionController::succesRegistration";
    private static $registeredUser = "sessionController::registeredUser";

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
    

    public function setToSuccesfullRegistration($succesRegistration)
    {
        return $_SESSION[self::$succesRegistration] = $succesRegistration;
    }

    public function checkIfRegistrationWasSucceded()
    {
        return isset($_SESSION[self::$succesRegistration]);
    }

    public function setRegUsername($registeredUser)
    {
        return $_SESSION[self::$registeredUser] = $registeredUser;
    }

    public function getRegUsername()
    {
        if (isset($_SESSION[self::$registeredUser])) {
            return $_SESSION[self::$registeredUser];
        }
    }
}
