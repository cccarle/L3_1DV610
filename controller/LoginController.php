<?php

namespace controller;

class LoginController
{
    private $logInView;
    private $loginModel;
    private $session;

    public function __construct($logInView, $loginModel, $session)
    {
        $this->logInView = $logInView;
        $this->loginModel = $loginModel;
        $this->session = $session;
    }

    public function checkIfUserWantToLogin()
    {
        if ($this->logInView->isLogInButtonPressed()) {
            $this->newLoginAttemp();
        }
    }

    public function checkIfUserWantToLogOut()
    {
        if ($this->logInView->isLogOutButtonPressed()) {
            $this->logutUser();
        }
    }

    private function newLoginAttemp()
    {
            $this->loginModel->login($this->logInView->getRequestUserName(), $this->logInView->getRequestUserPassword());  
    }

    private function logutUser()
    {
        $this->session->logoutUser();
    }
}
