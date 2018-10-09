<?php

namespace controller;

class RegisterController
{

    private $registerView;
    private $registerModel;

    public function __construct($registerView,$registerModel)
    {
        $this->registerView = $registerView;
        $this->registerModel = $registerModel;
    }


    public function checkIfUserWantToRegister()
    {
        if ($this->registerView->isRegisterButtonPressed()) {
            $this->newRegisterAttemp();
        }
    }

    private function newRegisterAttemp()
    {
        
        $this->registerModel->register($this->registerView->getUserName(), $this->registerView->getUserPassword());
    }


}
