<?php

namespace controller;

class GameController
{
    private $gameView;
    private $gameModel;
    private $sessionModel;

    public function __construct($gameView, $gameModel, $sessionModel)
    {
        $this->gameView = $gameView;
        $this->gameModel = $gameModel;
        $this->sessionModel = $sessionModel;
    }

    public function initialize(): void
    {
        $this->checkIfUserWantToStartNewGame();
        $this->checkIfUserWantToMakeAGuess();
    }

    private function checkIfUserWantToStartNewGame(): void
    {
        if ($this->gameView->isStartGameButtonPressed()) {
            $this->startNewGame();
        }
    }

    private function checkIfUserWantToMakeAGuess(): void
    {
        if ($this->gameView->isMakeGuessButtonPressed()) {
            $this->checkIfMatch();
        }
    }

    private function startNewGame(): void
    {
        $this->sessionModel->cleanTriesCounter();
        $this->gameModel->generateRandomNumber();
        $this->gameModel->storeRandomNumber();
    }

    private function checkIfMatch(): void
    {
        $this->gameModel->checkIfMatch($this->gameView->getGuessedNumber());
        $this->sessionModel->addTriesToCounterSession();
    }
}
