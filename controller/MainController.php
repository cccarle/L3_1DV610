<?php

namespace controller;

class MainController
{
    private $logiView;
    private $registerView;
    private $layoutView;
    private $dateTimeView;
    private $loginController;
    private $sessionController;
    private $registerController;


    public function __construct(
        \view\LoginView $loginView,
        \view\RegisterView $registerView,
        \view\LayoutView $LayoutView,
        \view\DateTimeView $DateTimeView,
        \controller\LoginController $loginController,
        \controller\SessionController $sessionController,
        \controller\RegisterController $registerController
       
    ) {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->layoutView = $LayoutView;
        $this->dateTimeView = $DateTimeView;
        $this->sessionController = $sessionController;
    }

    public function render()
    {
        
        $this->loginController->checkIfUserWantToLogin();
        $this->loginController->checkIfUserWantToLogOut();


        $this->registerController->checkIfUserWantToRegister();

        $this->layoutView->render(
            $this->loginView,
            $this->registerView,
            $this->dateTimeView
        );
    }
}
