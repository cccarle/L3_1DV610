<?php

namespace view;

class GameView
{
    private static $makeGuessButton = 'GameView::makeGuessButton';
    private static $startGameButton = 'GameView::startGameButton';
    private static $guessedNumber = 'GameView::guessedNumber';

    private $gameModel;
    private $message;

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

        if ($this->getGuessedNumber() > 20) {
            $message = 'The number is higher then 20 <br> Only numbers between 1-20 is allowed';
        }

        if ($this->getGuessedNumber() < 1) {
            $message = 'The number is lower then 1 <br> Only numbers between 1-20 is allowed';
        }

        if (!preg_match("/^[0-9][0-9]*$/", $this->getGuessedNumber())) {
            $message = 'Only numbers allowed';
        }

        if ($this->getGuessedNumber() === null) {
            $message = '';
        }

        return $message;
    }

    public function renderGameDescription()
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

    public function renderInputForm($message)
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

          <input type="submit" class="btn btn-info" name="' . self::$makeGuessButton . '" value="Make a guess" />
          </form>
        </div>
        ';
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
