<?php

namespace model;

class SessionModel
{
    private static $isLoggedIn = "sessionModel::isLoggedIn";
    private static $sessionUsername = "sessionModel::sessionUsername";
    private static $magicWord = "sessionModel::magicWord"; // change this to magic number
    private static $numberOfTries = "sessionModel::0";

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
        unset($_SESSION[self::$sessionUsername]);
    }

    public function setSessionUsername($sessionUsername)
    {
        return $_SESSION[self::$sessionUsername] = $sessionUsername;
    }

    public function getSessionUsername()
    {
        if (isset($_SESSION[self::$sessionUsername])) {
            return $_SESSION[self::$sessionUsername];
        }
    }

    public function setMagicNumberSession($magicWord)
    {
        return $_SESSION[self::$magicWord] = $magicWord;
    }

    public function getMagicNumber()
    {
        if (isset($_SESSION[self::$magicWord])) {
            return $_SESSION[self::$magicWord];
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
