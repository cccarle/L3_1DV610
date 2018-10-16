<?php

namespace controller;

class MainController
{
    private $layoutView;
    private $loginController;
    private $sessionModel;
    private $registerController;
    private $gameView;
    private $gameController;

    public function __construct(
        \view\LayoutView $layoutView,
        \controller\LoginController $loginController,
        \controller\RegisterController $registerController,
        \model\SessionModel $sessionModel,
        \view\GameView $gameView,
        \controller\GameController $gameController

    ) {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
        $this->layoutView = $layoutView;
        $this->sessionModel = $sessionModel;
        $this->gameView = $gameView;
        $this->gameController = $gameController;

    }

    public function render()
    {

        $this->loginController->startLoginController();
        $this->registerController->startRegisterController();
        $this->gameController->startGameController();

        $this->layoutView->render(
            $this->sessionModel->checkIfLoggedIn()
        );
    }
}
