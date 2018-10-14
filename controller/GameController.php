<?php

namespace controller;

class GameController
{

    private $gameView;
    private $gameModel;

    public function __construct($gameView, $gameModel)
    {
        $this->gameView = $gameView;
        $this->gameModel = $gameModel;
    }

    public function checkIfMatch()
    {
        if ($this->gameModel->getMagicNumber() == $this->gameView->getGuessedNumber()) {
            echo ' lika';
        } elseif ($this->gameView->getGuessedNumber() > $this->gameModel->getMagicNumber()) {
            echo 'To high';
        } elseif ($this->gameView->getGuessedNumber() < $this->gameModel->getMagicNumber()) {
            echo 'To Low';
        }
    }
}
