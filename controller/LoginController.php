<?php

namespace controller;

class LoginController
{
    private $logInView;
    private $LoginModel;

    public function __construct($logInView)
    {
        $this->logInView = $logInView;
    }

    public function tryLogIn()
    {
        echo $this->logInView->getRequestUserName();
    }
}
