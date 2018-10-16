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
    // rådfråga

    public function startGameController()
    {
        if ($this->gameView->isStartGameButtonPressed()) {
            $this->gameController->startNewGame();
        }

        if ($this->gameView->isMakeGuessButtonPressed()) {
            $this->gameController->checkIfMatch();
        }
    }

    public function startNewGame()
    {
        $this->sessionModel->cleanTriesCounter();
        $this->gameModel->generateRandomNumber();
        $this->gameModel->storeRandomNumber();
    }

    public function checkIfMatch()
    {
        $this->gameModel->checkIfMatch($this->gameView->getGuessedNumber());
        $this->sessionModel->addTriesToCounterSession();
    }
}
