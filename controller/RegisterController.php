<?php

namespace controller;

class RegisterController
{

    private $registerView;
    private $registerModel;

    public function __construct($registerView, $registerModel)
    {
        $this->registerView = $registerView;
        $this->registerModel = $registerModel;
    }

    public function initialize(): void
    {
        $this->checkIfUserWantToRegister();
    }

    private function checkIfUserWantToRegister(): void
    {
        if ($this->registerView->isRegisterButtonPressed() && $this->registerView->isUserCredentialsValid()) {
            $this->newRegisterAttemp();
        }
    }

    private function newRegisterAttemp(): void
    {
        $this->registerModel->registerAttempt($this->registerView->getUserName(), $this->registerView->getUserPassword());
    }
}
