<?php

namespace view;

class GameView
{
    private static $startGameButton = 'GameView::startGameButton';
    private static $makeGuessButton = 'GameView::makeGuessButton';
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

    public function __construct($gameModel, $sessionModel, $highScoreModel)
    {
        $this->gameModel = $gameModel;
        $this->sessionModel = $sessionModel;
        $this->highScoreModel = $highScoreModel;
    }

    public function render(): string
    {

        if ($this->isStartGameButtonPressed() || $this->isMakeGuessButtonPressed()) {
            return $this->gameContainer();
        }

        if ($this->isShowHighScoreGameButtonPressed() || $this->isAddToHighScoreButtonPressed()) {
            return $this->showHighScoreHTML();
        }

        return $this->renderGameDescription();
    }

    private function showResponseMessage(): string
    {
        $message = '';

        if ($this->isMakeGuessButtonPressed()) {
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
        }

        return $message;
    }

    public function renderGameDescription(): string
    {
        return '
            <form method="POST">
                <h1 class="display-4 font-weight-bold">Welcome To "Guess The Number" Game</h1>
                <p class="lead">Try to guess the number on least amount of tries.</p>
                <p>Click on the button below to start a new game.</p>
                <input type="submit" class="btn btn-info" name="' . self::$startGameButton . '" value="start game">
                <input type="submit" class="btn btn-info" name="' . self::$showHighScoreButton . '" value="show high score" />
            </form>
        ';
    }

    private function gameContainer(): string
    {
        if ($this->gameModel->isMatch()) {
            return $this->generateUserGuessedRightHTML();
        } else {
            return $this->generateInputFormHTML();
        }
    }

    private function generateUserGuessedRightHTML()
    {
        return '
        <form method="POST">
            <h1> Congratulation </h1>
            <p>' . $this->showResponseMessage() . '</p>
            <input type="submit" class="btn btn-info" name="' . self::$playAgainButton . '" value="Play Again" />
            <input type="submit" class="btn btn-info" name="' . self::$addToHighScoreButton . '" value="Add to highscore" />
        </form>
        ';
    }

    private function generateInputFormHTML()
    {
        return '
        <form method="POST">
            <div class="form-group">
                <p type="text" class="display-4" id="">Enter a number between 1-20 </p>
            </div>

            <div class="form-group">
                <input type="text" name="' . self::$guessedNumber . '" id="' . self::$guessedNumber . '" autocomplete="off">
            </div>

            <p>' . $this->showResponseMessage() . '</p>

            <input type="submit" class="btn btn-info" name="' . self::$makeGuessButton . '" value="Make a guess" />
            <input type="submit" class="btn btn-info" name="' . self::$goBackButton . '" value="Go to Start" />
        </form>
    ';
    }

    private function showHighScoreHTML(): string
    {
        $row = '';

        foreach ($this->highScoreModel->getTop10HighScore() as $highScoreRow) {
            $row .= "$highScoreRow <br>";
        }

        return '
        <form method="POST" class="form">
            <h2> Top 10 High Score</h2>
            <h2>Name Tries Date</h2>
            <h3> ' . $row . '</h3>
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
