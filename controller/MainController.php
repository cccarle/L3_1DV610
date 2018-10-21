<?php

namespace controller;

class MainController
{
    private $layoutView;
    private $loginController;
    private $registerController;
    private $gameController;

    public function __construct(
        \view\LayoutView $layoutView,
        \controller\LoginController $loginController,
        \controller\RegisterController $registerController,
        \controller\GameController $gameController
    ) {
        $this->loginController = $loginController;
        $this->registerController = $registerController;
        $this->layoutView = $layoutView;
        $this->gameController = $gameController;
    }

    public function render() :void
    {
        $this->loginController->initialize();
        $this->registerController->initialize();
        $this->gameController->initialize();
        
        $this->layoutView->render();
    }
}
