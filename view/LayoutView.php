<?php

namespace view;

class LayoutView
{

    private $loginView;
    private $registerView;
    private $gameView;
    private $sessionModel;

    private $register_link = "register";

    public function __construct(\view\LoginView $loginView, \view\RegisterView $registerView, \view\GameView $gameView)
    {
        $this->dateTime = new \view\DateTimeView();
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->gameView = $gameView;
    }

    public function render(bool $isLoggedIn)
    {
        echo '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Login Example</title>
        </head>

        <body>

        <h1>Assignment 2</h1>

        ' . $this->renderNavLinks($isLoggedIn) . '

        ' . $this->renderIsLoggedIn($isLoggedIn) . '

        ' . $this->renderGameView($isLoggedIn) . '

                ' . $this->renderViews($isLoggedIn) . '

                ' . $this->dateTime->showTime() . '
        </body>
        </html>
    ';
    }

    private function renderNavLinks($isLoggedIn)
    {
        if ($this->userWantToRegister()) {
            return '<a href="?">Back to login</a>';
        } elseif (!$isLoggedIn) {
            return '<a href="/L3_1dv610/?' . $this->register_link . '">Register a new user</a>';
        }
    }

    private function renderIsLoggedIn($isLoggedIn)
    {
        if ($isLoggedIn) {
            return '<h2 >Logged in</h2>';
        } else {
            return '<h2 >Not logged in</h2>';
        }
    }

    private function renderViews()
    {
        if ($this->userWantToRegister()) {
            return $this->registerView->renderRegisterView();
        } else {
            return $this->loginView->renderLoginView();
        }
    }

    private function userWantToRegister()
    {
        return isset($_GET[$this->register_link]);
    }

    private function renderGameView($isLoggedIn)
    {
        if ($isLoggedIn) {
            return $this->gameView->render();
        }
    }
}
