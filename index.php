<?php

//INCLUDE THE FILES NEEDED...
require_once 'view/LoginView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'view/Messages.php';
require_once 'controller/MainController.php';
require_once 'controller/LoginController.php';
require_once 'controller/SessionController.php';
require_once 'model/LoginModel.php';
require_once 'model/Database.php';

if (!isset($_SESSION)) {
    session_start();
}

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$database = new \model\Database();
$sessionController = new \controller\SessionController();
$loginModel = new \model\LoginModel($database,$sessionController);

$v = new \view\LoginView($sessionController);
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView($sessionController);

$logInController = new \controller\LoginController($v,$loginModel,$sessionController);

$mainController = new \controller\MainController($v, $lv, $dtv, $logInController,$sessionController);
$mainController->render();
