<?php

namespace view;

class LayoutView
{

    private $loginView;
    private $registerView;
    private $gameView;
    private $sessionModel;
    private $dateTime;

    private $register_link = "register";

    public function __construct(\view\LoginView $loginView, \view\RegisterView $registerView, \view\GameView $gameView, \model\SessionModel $sessionModel)
    {
        $this->dateTime = new \view\DateTimeView();
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->gameView = $gameView;
        $this->sessionModel = $sessionModel;
    }

    public function renderLayoutHTML()
    {
        echo '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Login Example</title>
        </head>

        <body>

        <h1>Assignment 2</h1>

        ' . $this->renderNavLinks() . '

        ' . $this->renderIsLoggedIn() . '

        ' . $this->renderGameView() . '

        <div>
        ' . $this->renderViews() . '

        ' . $this->dateTime->showTime() . '
        </div>

        </body>
        </html>
    ';
    }

    private function renderNavLinks()
    {
        if ($this->userWantToRegister()) {
            return '<a href="?">Back to login</a>';
        } elseif (!$this->sessionModel->checkIfLoggedIn()) {
            return '<a href="/?' . $this->register_link . '">Register a new user</a>';
        }
    }

    private function renderIsLoggedIn(): string
    {
        if ($this->sessionModel->checkIfLoggedIn()) {
            return '<h2>Logged in</h2>';
        } else {
            return '<h2>Not logged in</h2>';
        }
    }

    private function renderViews(): string
    {
        if ($this->userWantToRegister()) {
            return $this->registerView->renderRegisterView();
        } else {
            return $this->loginView->renderLoginView();
        }
    }

    private function userWantToRegister(): bool
    {
        return isset($_GET[$this->register_link]);
    }

    private function renderGameView()
    {
        if ($this->sessionModel->checkIfLoggedIn()) {
            return $this->gameView->render();
        }
    }
}
