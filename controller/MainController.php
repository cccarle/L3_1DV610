<?php

namespace controller;

class MainController
{
    private $loginView;
    private $layoutView;
    private $dateTimeView;
    private $loginController;


    public function __construct(
        \view\LoginView $loginView,
        \view\LayoutView $LayoutView,
        \view\DateTimeView $DateTimeView,
        \controller\LoginController $loginController
    ) {
        $this->loginView = $loginView;
        $this->layoutView = $LayoutView;
        $this->dateTimeView = $DateTimeView;
        $this->loginController = $loginController;
    }

    public function render()
    {
        $this->layoutView->render(
            true,
            $this->loginView,
            $this->dateTimeView
        );

        if($this->loginView->isLogInButtonPressed()){
            $this->loginController->tryLogIn();
        }
    }

}
