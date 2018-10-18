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

    public function initialize(): void
    {
        $this->checkIfUserWantToLogIn();
        $this->checkIfUserWantToLogout();
        $this->checkIfUserWasLoggedIn();
    }

    private function checkIfUserWantToLogIn(): void
    {
        if ($this->loginView->isLogInButtonPressed()) {
            $this->newLoginAttemp();
        }
    }

    private function checkIfUserWantToLogout(): void
    {
        if ($this->sessionModel->checkIfLoggedIn() && $this->loginView->isLogOutButtonPressed()) {
            $this->logutUser();
        }
    }

    private function checkIfUserWasLoggedIn()
    {
        if ($this->loginModel->checkIfLoginSuccess()) {
            $this->sessionModel->setToLoggedIn(true);
        }
    }

    private function newLoginAttemp(): void
    {
        $this->loginModel->login($this->loginView->getRequestUserName(), $this->loginView->getRequestUserPassword());
    }

    private function logutUser(): void
    {
        $this->sessionModel->logoutUser();
    }
}
