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
    private $gameView;
    private $gameModel;
    private $gameController;

    public function __construct(
        \view\LoginView $loginView,
        \view\RegisterView $registerView,
        \view\LayoutView $layoutView,
        \controller\LoginController $loginController,
        \controller\RegisterController $registerController,
        \model\SessionModel $sessionModel,
        \view\GameView $gameView,
        \model\GameModel $gameModel,
        \controller\GameController $gameController

    ) {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
        $this->loginView = $loginView;
        $this->registerView = $registerView;
        $this->layoutView = $layoutView;
        $this->sessionModel = $sessionModel;
        $this->gameView = $gameView;
        $this->gameModel = $gameModel;
        $this->gameController = $gameController;

    }

    public function render()
    {
        if ($this->loginView->isLogInButtonPressed()) {
            $this->loginController->newLoginAttemp();
        }

        if ($this->sessionModel->checkIfLoggedIn() && $this->loginView->isLogOutButtonPressed()) {
            $this->loginController->logutUser();
        }

        if ($this->registerView->isRegisterButtonPressed() && $this->registerView->isUserCredentialsValid()) {
            $this->registerController->newRegisterAttemp();
        }

        if ($this->gameView->isStartGameButtonPressed()) {

            // this in GameController ?
            $this->gameModel->generateRandomNumber();
            $this->gameModel->setMagicNumberSession();
        }

        if ($this->gameView->isMakeGuessButtonPressed()) {
            // this in GameController ?
            $this->gameController->checkIfMatch();
        }

        $this->layoutView->render(
            $this->loginView,
            $this->registerView,
            $this->gameView
        );

        // ge annan metod en render vyerna
        // $this->layoutView->userwantstoregister
        // denna tar in register view
    }
}
