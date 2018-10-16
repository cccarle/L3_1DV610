<?php

namespace view;

class GameView
{
    private static $makeGuessButton = 'GameView::makeGuessButton';
    private static $startGameButton = 'GameView::startGameButton';
    private static $playAgainButton = 'GameView::playAgainButton';
    private static $guessedNumber = 'GameView::guessedNumber';

    private const NUMBER_HIGHER_THEN_TWENTY = 20;
    private const NUMBER_LOWER_THEN_ONE = 1;

    private $gameModel;
    private $sessionModel;
    private $message;

    public function __construct($gameModel,$sessionModel)
    {
        $this->gameModel = $gameModel;
        $this->sessionModel = $sessionModel;
    }

    public function render()
    {

        $message = $this->responseMessage();

        if ($this->isStartGameButtonPressed()) {
            return $this->renderInputForm($message);
        } elseif ($this->isMakeGuessButtonPressed()) {
            return $this->renderInputForm($message);
        }

        return $this->renderGameDescription();
    }

    public function responseMessage()
    {

        $message = '';

        if ($this->getGuessedNumber() === null) {
            $message = '';
        } elseif (!is_numeric($this->getGuessedNumber())) {
            $message = 'Only numbers allowed';
        } elseif ($this->getGuessedNumber() > self::NUMBER_HIGHER_THEN_TWENTY) {
            $message = 'The number is higher then 20 <br> Only numbers between 1-20 is allowed';
        } elseif ($this->getGuessedNumber() < self::NUMBER_LOWER_THEN_ONE) {
            $message = 'The number is lower then 1 <br> Only numbers between 1-20 is allowed';
        } elseif ($this->gameModel->numberWasToLow()) {
            $message = 'Your number was to low';
        } elseif ($this->gameModel->numberWasToHigh()) {
            $message = 'Your number was to high';
        } elseif ($this->gameModel->isMatch()) {
            $message = 'You guessed right on ' . $this->sessionModel->getNumberOfTries() . ' tries';
        }

        return $message;
    }

    private function renderGameDescription()
    {
        echo '
        <div class="container py-5 mt-5">
            <form method="POST" class="form">
                <h1 class="display-4 font-weight-bold">Welcome To "Guess The Number" Game</h1>
                <p class="lead">Try to guess the number on least amount of tries.</p>
                <p>Click on the button below to start a new game.</p>
                <input type="submit" class="btn btn-info" name="' . self::$startGameButton . '" value="start game">
            </form>
    </div>
        ';
    }

    private function renderInputForm($message)
    {
        echo '
        <div class="container py-5 mt-5 col-5">
        <form method="POST" class="form">

          <div class="form-group">
            <p type="text" class="display-4" id="">Enter a number between 1-20 </p>
          </div>

          <div class="form-group">
            <input type="text" class="form-control shadow-lg p-3 mb-5 bg-white rounded col-4" name="' . self::$guessedNumber . '" id="' . self::$guessedNumber . '">
          </div>

          <p>' . $message . '</p>

          ' . $this->renderButton() . '

          </form>
        </div>
        ';
    }

    private function renderButton()
    {
        if ($this->gameModel->isMatch()) {
            return '<input type="submit" class="btn btn-info" name="' . self::$playAgainButton . '" value="Play Again" />';
        } else {
            return '<input type="submit" class="btn btn-info" name="' . self::$makeGuessButton . '" value="Make a guess" />';
        }
    }

    public function isStartGameButtonPressed()
    {
        return isset($_POST[self::$startGameButton]);
    }

    public function isMakeGuessButtonPressed()
    {
        return isset($_POST[self::$makeGuessButton]);
    }

    public function getGuessedNumber()
    {
        if (isset($_POST[self::$guessedNumber])) {
            return $_POST[self::$guessedNumber];
        }
    }
}
