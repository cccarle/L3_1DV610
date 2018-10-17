<?php

namespace controller;

class LoginController
{
    private $loginView;
    private $loginModel;
    private $sessionModel;

    public function __construct($loginView, $loginModel, $sessionModel)
    {
        $this->loginView = $loginView;
        $this->loginModel = $loginModel;
        $this->sessionModel = $sessionModel;
    }

    public function initialize()
    {
        if ($this->loginView->isLogInButtonPressed()) {
            $this->newLoginAttemp();
        }

        if ($this->sessionModel->checkIfLoggedIn() && $this->loginView->isLogOutButtonPressed()) {
            $this->logutUser();
        }
    }

    public function newLoginAttemp()
    {
        $this->loginModel->login($this->loginView->getRequestUserName(), $this->loginView->getRequestUserPassword());
    }

    public function logutUser()
    {
        $this->sessionModel->logoutUser();
    }
}
