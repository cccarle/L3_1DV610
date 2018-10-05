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

        $this->loginController->checkIfUserWantToLogin();
        $this->loginController->checkIfUserWantToLogOut();

        $this->layoutView->render(
            $this->loginView,
            $this->dateTimeView
        );
    }
}
