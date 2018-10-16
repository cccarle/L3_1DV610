<?php

namespace model;

class GameModel
{

    private static $randomWord = "gameModel::randomWord";

    private $isMatch;
    private $numberToLow;
    private $numberToHigh;

    private $sessionModel;

    public function __construct($sessionModel)
    {
        $this->sessionModel = $sessionModel;
    }

    public function generateRandomNumber()
    {
        return self::$randomWord = rand(0, 20);
    }

    public function storeRandomNumber()
    {
        $this->sessionModel->setMagicNumberSession(self::$randomWord);
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
