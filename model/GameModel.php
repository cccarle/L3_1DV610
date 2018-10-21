<?php

namespace model;

class GameModel
{
    private static $randomNumber = "gameModel::0";

    private $isMatch;
    private $numberToLow;
    private $numberToHigh;
    private $numberOfTries;

    private $sessionModel;

    public function __construct($sessionModel)
    {
        $this->sessionModel = $sessionModel;
    }

    public function generateRandomNumber()
    {
        self::$randomNumber = rand(0, 20);
    }

    public function storeRandomNumber()
    {
        $this->sessionModel->setMagicNumberSession(self::$randomNumber);
    }

    public function checkIfMatch($guessedNumber)
    {
        if ($this->sessionModel->getMagicNumber() == $guessedNumber) {
            $this->isMatch = true;
        }

        if ($guessedNumber > $this->sessionModel->getMagicNumber()) {
            $this->numberToHigh = true;
        }

        if ($guessedNumber < $this->sessionModel->getMagicNumber()) {
            $this->numberToLow = true;
        }
    }

    public function isMatch()
    {
        return $this->isMatch;
    }

    public function numberWasToHigh()
    {
        return $this->numberToHigh;
    }

    public function numberWasToLow()
    {
        return $this->numberToLow;
    }
}
