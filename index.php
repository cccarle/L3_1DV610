<?php
//INCLUDE THE FILES NEEDED...

require_once('Exceptions.php');
require_once 'view/LoginView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'view/RegisterView.php';
require_once 'controller/MainController.php';
require_once 'controller/LoginController.php';
require_once 'controller/RegisterController.php';
require_once 'controller/SessionController.php';
require_once 'model/LoginModel.php';
require_once 'model/RegisterModel.php';
require_once 'model/UserCredentials.php';
require_once 'model/Database.php';
require_once 'model/Time.php';

if (!isset($_SESSION)) {
    session_start();
}

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$database = new \model\Database();
$timeModel = new \model\Time();

$sessionController = new \controller\SessionController();
$loginModel = new \model\LoginModel($database, $sessionController);
$registerModel = new \model\RegisterModel($database);

$lv = new \view\LayoutView($sessionController);
$v = new \view\LoginView($sessionController,$loginModel);
$reg = new \view\RegisterView();
$dtv = new \view\DateTimeView($timeModel);

$logInController = new \controller\LoginController($v, $loginModel, $sessionController);
$registerController = new \controller\RegisterController($reg,$registerModel);

$mainController = new \controller\MainController($v,$reg, $lv, $dtv, $logInController, $sessionController, $registerController);
$mainController->render();
