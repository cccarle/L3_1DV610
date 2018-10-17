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

    public function initialize()
    {
        if ($this->gameView->isStartGameButtonPressed()) {
            $this->startNewGame();
        }

        if ($this->gameView->isMakeGuessButtonPressed()) {
            $this->checkIfMatch();
        }
    }

    private function userWantToStartNewGame()
    {
        if ($this->gameView->isStartGameButtonPressed()) {
            $this->startNewGame();
        }
    }

    private function startNewGame()
    {
        $this->sessionModel->cleanTriesCounter();
        $this->gameModel->generateRandomNumber();
        $this->gameModel->storeRandomNumber();
    }

    private function checkIfMatch()
    {
        $this->gameModel->checkIfMatch($this->gameView->getGuessedNumber());
        $this->sessionModel->addTriesToCounterSession();
    }
}
