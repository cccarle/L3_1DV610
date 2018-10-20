<?php

namespace view;

class GameView
{
    private static $makeGuessButton = 'GameView::makeGuessButton';
    private static $startGameButton = 'GameView::startGameButton';
    private static $playAgainButton = 'GameView::playAgainButton';
    private static $goBackButton = 'GameView::goBackButton';
    private static $showHighScoreButton = 'GameView::showHighScoreButton';
    private static $addToHighScoreButton = 'GameView::addToHighScoreButton';

    private static $guessedNumber = 'GameView::guessedNumber';

    private const NUMBER_HIGHER_THEN_TWENTY = 20;
    private const NUMBER_LOWER_THEN_ONE = 1;

    private $gameModel;
    private $sessionModel;
    private $highScoreModel;
    private $message;

    public function __construct($gameModel, $sessionModel, $highScoreModel)
    {
        $this->gameModel = $gameModel;
        $this->sessionModel = $sessionModel;
        $this->highScoreModel = $highScoreModel;
    }

    public function render(): string
    {

        $message = $this->responseMessage();

        if ($this->isStartGameButtonPressed()) {
            return $this->renderInputForm($message);
        } elseif ($this->isMakeGuessButtonPressed()) {
            return $this->renderInputForm($message);
        } elseif ($this->isShowHighScoreGameButtonPressed() || $this->isAddToHighScoreButtonPressed()) {
            return $this->showHighScore();
        }
        return $this->renderGameDescription();
    }

    // TODO första gången sidan laddas ska de inte bli en

    public function responseMessage(): string
    {

        $message = '';

        if (empty($this->getGuessedNumber())) {
            $message = 'no number was entered';
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

    private function renderGameDescription(): string
    {
        return '
        <div class="container py-5 mt-5">
            <form method="POST" class="form">
                <h1 class="display-4 font-weight-bold">Welcome To "Guess The Number" Game</h1>
                <p class="lead">Try to guess the number on least amount of tries.</p>
                <p>Click on the button below to start a new game.</p>
                <input type="submit" class="btn btn-info" name="' . self::$startGameButton . '" value="start game">
                <input type="submit" class="btn btn-info" name="' . self::$showHighScoreButton . '" value="show high score" />

            </form>
    </div>
        ';
    }

    private function renderInputForm($message): string
    {
        return '
        <div class="container py-5 mt-5 col-12">
        <form method="POST" class="form">

          <div class="form-group">
            <p type="text" class="display-4" id="">Enter a number between 1-20 </p>
          </div>

          <div class="form-group">
            <input type="text"  name="' . self::$guessedNumber . '" id="' . self::$guessedNumber . '">
          </div>

          <p>' . $message . '</p>

          ' . $this->renderButton() . '

          </form>
        </div>
        ';
    }

    private function renderButton(): string
    {
        if ($this->gameModel->isMatch()) {
            return '
            <input type="submit" class="btn btn-info" name="' . self::$playAgainButton . '" value="Play Again" />
            <input type="submit" class="btn btn-info" name="' . self::$addToHighScoreButton . '" value="Add to highscore" />
            ';
        } else {
            return '
            <input type="submit" class="btn btn-info" name="' . self::$makeGuessButton . '" value="Make a guess" />
            <input type="submit" class="btn btn-info" name="' . self::$goBackButton . '" value="Go to Start" />
            ';
        }
    }

    private function showHighScore(): string
    {

        $ret = '';

        foreach ($this->highScoreModel->getHighScore() as $key) {
            $ret .= "$key <br>";
        }

        return '
        <form method="POST" class="form">

            <h2> Top 10 High Score</h2>
            <h2>Name  Tries Date</h2>
            <h3> ' . $ret . '</h3>
            <input type="submit" class="btn btn-info" name="' . self::$goBackButton . '" value="Go to Start" />
</form>
        ';
    }

    public function isStartGameButtonPressed(): bool
    {
        return isset($_POST[self::$startGameButton]);
    }

    public function isAddToHighScoreButtonPressed(): bool
    {
        return isset($_POST[self::$addToHighScoreButton]);
    }

    public function isShowHighScoreGameButtonPressed(): bool
    {
        return isset($_POST[self::$showHighScoreButton]);
    }

    public function isMakeGuessButtonPressed(): bool
    {
        return isset($_POST[self::$makeGuessButton]);
    }

    public function isBackButtonPressed(): bool
    {
        return isset($_POST[self::$goBackButton]);
    }

    public function getGuessedNumber()
    {
        if (isset($_POST[self::$guessedNumber])) {
            return $_POST[self::$guessedNumber];
        }
    }
}
