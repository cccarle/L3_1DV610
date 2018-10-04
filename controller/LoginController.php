<?php

namespace controller;

class LoginController
{
    private $logInView;
    private $loginModel;
    private $session;

    public function __construct($logInView, $loginModel,$session)
    {
        $this->logInView = $logInView;
        $this->loginModel = $loginModel;
        $this->session = $session;
    }


    public function tryLogIn()
    {
        if ($this->logInView->isLogInButtonPressed() && $this->logInView->isUserCredentialsValid()) {
            $this->loginModel->Login($this->logInView->getRequestUserName(), $this->logInView->getRequestUserPassword());
        }
    }

    public function isLoggedIn(){
        return $this->session->checkIfLoggedIn();
    }


    public function userWantToLogout(){
            $this->session->logOutUser();
    }
}
