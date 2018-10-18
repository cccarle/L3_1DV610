<?php

namespace controller;

class MainController
{
    private $layoutView;
    private $loginController;
    private $registerController;
    private $gameController;
    private $sessionModel;

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
        $this->gameController = $gameController;
        $this->sessionModel = $sessionModel;
    }

    public function render()
    {
        $this->loginController->initialize();
        $this->registerController->initialize();
        $this->gameController->initialize();
        
        $this->layoutView->render($this->sessionModel->checkIfLoggedIn());
    }
}
