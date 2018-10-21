<?php

namespace model;

class SessionModel
{
    private static $isLoggedIn = "sessionModel::isLoggedIn";
    private static $sessionUsername = "sessionModel::sessionUsername";
    private static $secretNumber = "sessionModel::secretNumber";
    private static $numberOfTries = "sessionModel::0";

    public function setToLoggedIn($isLoggedIn): bool
    {
        return $_SESSION[self::$isLoggedIn] = $isLoggedIn;
    }

    public function checkIfLoggedIn(): bool
    {
        return isset($_SESSION[self::$isLoggedIn]);
    }

    public function logoutUser()
    {
        unset($_SESSION[self::$isLoggedIn]);
        unset($_SESSION[self::$sessionUsername]);
    }

    public function setSessionUsername($sessionUsername) : string
    {
        return $_SESSION[self::$sessionUsername] = $sessionUsername;
    }

    public function getSessionUsername() : string
    {
        if (isset($_SESSION[self::$sessionUsername])) {
            return $_SESSION[self::$sessionUsername];
        }
    }

    public function setMagicNumberSession($secretNumber) : string
    {
        return $_SESSION[self::$secretNumber] = $secretNumber;
    }

    public function getMagicNumber() : string
    {
        if (isset($_SESSION[self::$secretNumber])) {
            return $_SESSION[self::$secretNumber];
        }
    }

    public function addTriesToCounterSession() 
    {
            return $_SESSION[self::$numberOfTries]++;
    }

    public function getNumberOfTries()
    {
        if (isset($_SESSION[self::$numberOfTries])) {
            return $_SESSION[self::$numberOfTries];
        }
    }

    public function cleanTriesCounter()
    {
        unset($_SESSION[self::$numberOfTries]);
    }
}
