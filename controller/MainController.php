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
        \view\LayoutView $LayoutView,
        \view\DateTimeView $DateTimeView,
        \controller\LoginController $loginController,
        \model\SessionModel $sessionModel,
        \controller\RegisterController $registerController

    ) {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->layoutView = $LayoutView;
        $this->dateTimeView = $DateTimeView;
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
            $this->registerView,
            $this->dateTimeView
        );
    }
}
