<?php

namespace model;

class GameModel
{

    // generate a random number
    // store it
    // create a get method
    // method to check if it was a match or not

    private $randomNumber;

    private static $magicWord = "gameModel::magicWord";

    public function generateRandomNumber()
    {
        $this->randomNumber = rand(0, 20);
    }

    public function getRandomNumber()
    {
        return $this->randomNumber;
    }


    // Move this to session controller

    public function setMagicNumberSession()
    {
        return $_SESSION[self::$magicWord] = $this->randomNumber;
    }

    public function getMagicNumber()
    {

        if (isset($_SESSION[self::$magicWord])) {
            return $_SESSION[self::$magicWord];
        }

    }

}
