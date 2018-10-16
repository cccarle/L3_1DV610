<?php

namespace model;

class SessionModel
{
    private static $isLoggedIn = "sessionModel::isLoggedIn";
    private static $magicWord = "sessionModel::magicWord";
  
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
}
