<?php

namespace view;

class LayoutView
{

    private $view;
    private $dateTime;
    private $timeModel;
    private $loginView;
    private $registerView;
    private $register_link = "register";

    public function __construct(\view\LoginView $loginView, \view\RegisterView $registerView)
    {
        $this->timeModel = new \model\Time();
        $this->dateTime = new \view\DateTimeView($this->timeModel);
        $this->loginView = $loginView;
        $this->registerView = $registerView;

    }

    public function render(bool $isLoggedIn)
    {
        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

          <title>Login Example</title>
        </head>
        <body>

          <h1>Assignment 2</h1>
          ' . $this->renderNavLinks($isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          <div class="container">
              ' . $this->renderViews() . '
              ' . $this->dateTime->showTime() . '
          </div>
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
            return '<h2>Logged in</h2>';
        } else {
            return '<h2>Not logged in</h2>';
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
}
