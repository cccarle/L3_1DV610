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

    public function startNewGame()
    {
        $this->gameModel->generateRandomNumber();
        $this->gameModel->storeRandomNumber();
    }

    public function checkIfMatch()
    {
        $this->gameModel->checkIfMatch($this->gameView->getGuessedNumber());
    }
}
