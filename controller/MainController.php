<?php

namespace controller;

class MainController
{
    private $loginView;
    private $layoutView;
    private $dateTimeView;
    private $loginController;
    private $sessionController;

    public function __construct(
        \view\LoginView $loginView,
        \view\LayoutView $LayoutView,
        \view\DateTimeView $DateTimeView,
        \controller\LoginController $loginController,
        \controller\SessionController $sessionController
    ) {
        $this->loginController = $loginController;
        $this->loginView = $loginView;
        $this->layoutView = $LayoutView;
        $this->dateTimeView = $DateTimeView;
        $this->sessionController = $sessionController;
    }

    public function render()
    {
        $this->layoutView->render(
            $this->sessionController->checkIfLoggedIn(),
            $this->loginView,
            $this->dateTimeView
        );

        if ($this->loginView->isLogInButtonPressed()) {
            $this->loginController->tryLogIn();
            $this->loginController->isLoggedIn();
        }

        if ($this->loginView->isLogOutButtonPressed()) {
            $this->loginController->userWantToLogout();
        }

    }
}
