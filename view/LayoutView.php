<?php

namespace view;

class LayoutView
{

    private $session;

    public function __construct($sessionController)
    {
        $this->session = $sessionController;
    }

    public function render(LoginView $v, DateTimeView $dtv)
    {
        
        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn() . '

          <div class="container">
              ' . $v->response() . '

              ' . $dtv->showTime() . '
          </div>
         </body>
      </html>
    ';
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
