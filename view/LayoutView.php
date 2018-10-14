<?php

namespace view;

class LayoutView
{

    private $view;
    private $session;
    private $dateTime;
    private $timeModel;
    private $register_link = "register";

    public function __construct($sessionController)
    {
        $this->session = $sessionController;
        $this->timeModel = new \model\Time();
        $this->dateTime = new \view\DateTimeView($this->timeModel);
    }


    // TODO 
    // baka ihop nav till att lyssan på om användern vill registera annars view log in 

    public function render(LoginView $loginView, RegisterView $registerView, GameView $gameView)
    {

        if ($this->userWantToRegister()) {
            $this->view = $registerView->renderRegisterView();
        } elseif($this->session->checkIfLoggedIn()) {
            $this->view .= $loginView->renderLoginView();
            $this->view .=  $gameView->render();

        }else {
            $this->view .= $loginView->renderLoginView();
        }

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

          <div class="container">

              ' . $this->view . '

              ' . $this->dateTime->showTime() . '
          </div>
         </body>
      </html>
    ';
    }

    private function userWantToRegister(): bool
    {
        return isset($_GET[$this->register_link]);
    }

    private function renderNavLinks()
    {
        if ($this->userWantToRegister()) {
            return '<a href="?">Back to login</a>';
        } elseif (!$this->session->checkIfLoggedIn()) {
            return '<a href="/L3_1dv610/?' . $this->register_link . '">Register a new user</a>';
        }
    }

    private function renderIsLoggedIn()
    {
        if ($this->session->checkIfLoggedIn()) {
            return '<h2>Logged in</h2>';
        } else {
            return '<h2>Not logged in</h2>';
        }
    }
}
