<?php

namespace controller;

class LoginController
{
    private $logInView;
    private $loginModel;
    private $session;
    private $MessagesFromDatabase;

    public function __construct($logInView, $loginModel, $session, $MessagesFromDatabase)
    {
        $this->logInView = $logInView;
        $this->loginModel = $loginModel;
        $this->session = $session;
        $this->MessagesFromDatabase = $MessagesFromDatabase;
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
            $this->MessagesFromDatabase->logOut();
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
