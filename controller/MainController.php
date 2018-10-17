<?php

namespace controller;

class MainController
{
    private $layoutView;
    private $loginController;
    private $sessionModel;
    private $registerController;
    private $gameController;

    public function __construct(
        \view\LayoutView $layoutView,
        \controller\LoginController $loginController,
        \controller\RegisterController $registerController,
        \controller\GameController $gameController,
        \model\SessionModel $sessionModel
    ) {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
        $this->layoutView = $layoutView;
        $this->sessionModel = $sessionModel;
        $this->gameController = $gameController;

    }

    public function render()
    {
        $this->loginController->initialize();
        $this->registerController->initialize();
        $this->gameController->initialize();

        $this->layoutView->render($this->sessionModel->checkIfLoggedIn());
    }
}
