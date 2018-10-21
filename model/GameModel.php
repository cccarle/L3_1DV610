<?php

namespace model;

class GameModel
{
    private $secretNumber;
    private $isMatch = false;
    private $numberToLow = false;
    private $numberToHigh = false;

    private const LOWEST_NUMBER_EQUAL_TO_ONE = 1;
    private const HIGEST_NUMBER_EQUAL_TO_TWENTY = 20;

    private $sessionModel;

    public function __construct($sessionModel)
    {
        $this->sessionModel = $sessionModel;
    }

    public function generateSecretNumber(): void
    {
        $this->secretNumber = rand(self::LOWEST_NUMBER_EQUAL_TO_ONE, self::HIGEST_NUMBER_EQUAL_TO_TWENTY);
    }

    public function storeRandomNumber(): void
    {
        $this->sessionModel->setSecretNumberSession($this->secretNumber);
    }

    public function checkIfMatch($guessedNumber): void
    {
        if ($this->sessionModel->getSecretNumber() == $guessedNumber) {
            $this->isMatch = true;
        }

        if ($guessedNumber > $this->sessionModel->getSecretNumber()) {
            $this->numberToHigh = true;
        }

        if ($guessedNumber < $this->sessionModel->getSecretNumber()) {
            $this->numberToLow = true;
        }
    }

    public function isMatch(): bool
    {
        return $this->isMatch;
    }

    public function numberWasToHigh(): bool
    {
        return $this->numberToHigh;
    }

    public function numberWasToLow(): bool
    {
        return $this->numberToLow;
    }
}
