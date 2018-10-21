<?php

namespace controller;

class GameController
{
    private $gameView;
    private $gameModel;
    private $sessionModel;
    private $highScoreModel;

    public function __construct($gameView, $gameModel, $sessionModel, $highScoreModel)
    {
        $this->gameView = $gameView;
        $this->gameModel = $gameModel;
        $this->sessionModel = $sessionModel;
        $this->highScoreModel = $highScoreModel;
    }

    public function initialize(): void
    {
        $this->checkIfUserWantToStartNewGame();
        $this->checkIfUserWantToMakeAGuess();
        $this->checkIfUserWantToSaveHighScore();
    }

    private function checkIfUserWantToStartNewGame(): void
    {
        if ($this->gameView->isStartGameButtonPressed()) {
            $this->startNewGame();
        }
    }

    private function startNewGame(): void
    {
        $this->sessionModel->resetTriesCounter();
        $this->gameModel->generateSecretNumber();
        $this->gameModel->storeRandomNumber();
    }

    private function checkIfUserWantToMakeAGuess(): void
    {
        if ($this->gameView->isMakeGuessButtonPressed()) {
            $this->checkIfMatch();
        }
    }

    private function checkIfMatch(): void
    {
        $this->gameModel->checkIfMatch($this->gameView->getGuessedNumber());
        $this->sessionModel->addTriesToCounterSession();
    }

    private function checkIfUserWantToSaveHighScore(): void
    {
        if ($this->gameView->isAddToHighScoreButtonPressed()) {
            $this->highScoreModel->addHighScoreToDatabase($this->sessionModel->getSessionUsername(), $this->sessionModel->getNumberOfTries());
        }
    }
}
