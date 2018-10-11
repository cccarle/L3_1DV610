<?php

namespace controller;

class MainController
{
    private $logiView;
    private $registerView;
    private $layoutView;
    private $dateTimeView;
    private $loginController;
    private $sessionModel;
    private $registerController;

    public function __construct(
        \view\LoginView $loginView,
        \view\RegisterView $registerView,
        \view\LayoutView $layoutView,
        \controller\LoginController $loginController,
        \controller\RegisterController $registerController,
        \model\SessionModel $sessionModel
      
    ) {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->layoutView = $layoutView;
        $this->sessionModel = $sessionModel;
    }

    public function render()
    {
        if ($this->loginView->isLogInButtonPressed()) {
            $this->loginController->newLoginAttemp();
        }

        if ($this->loginView->isLogOutButtonPressed()) {
            $this->loginController->logutUser();
        }

        $this->layoutView->render(
            $this->loginView,
            $this->registerView
        );

        // ge annan metod en render vyerna
        // $this->layoutView->userwantstoregister
        // denna tar in register view
    }
}
