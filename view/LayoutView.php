<?php

namespace view;

class LayoutView
{

    private $session;

    public function __construct($sessionController)
    {
        $this->session = $sessionController;
    }

    public function render(LoginView $v, RegisterView $ref, DateTimeView $dtv)
    {

        $view = null;

        if (isset($_GET["register"])) {
            $view = $ref->renderRegisterView();
        } else {
            $view = $v->renderLoginView();
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

              ' . $view . '

              ' . $dtv->showTime() . '
          </div>
         </body>
      </html>
    ';
    }

    private function renderNavLinks()
    {
        if (isset($_GET["register"])) {
            return '<a href="?">Back to login</a>';
        } elseif (!$this->session->checkIfLoggedIn()) {
            return '<a href="/L3_1dv610/?register">Register a new user</a>';
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
