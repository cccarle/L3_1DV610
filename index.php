<?php
//INCLUDE THE FILES NEEDED...
require_once 'view/LoginView.php';
require_once 'view/DateTimeView.php';
require_once 'view/LayoutView.php';
require_once 'view/RegisterView.php';
require_once 'view/GameView.php';

require_once 'controller/MainController.php';
require_once 'controller/LoginController.php';
require_once 'controller/RegisterController.php';
require_once 'controller/GameController.php';

require_once 'model/SessionModel.php';
require_once 'model/LoginModel.php';
require_once 'model/RegisterModel.php';
require_once 'model/GameModel.php';
require_once 'model/Database.php';
require_once 'model/TimeModel.php';

require_once 'config/Config.php';

if (!isset($_SESSION)) {
    session_start();
}

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// CREATE OBJECTS OF THE VIEWS
$database = new \model\Database();
$sessionModel = new \model\SessionModel();
$gameModel = new \model\GameModel($sessionModel);
$loginModel = new \model\LoginModel($database, $sessionModel);
$registerModel = new \model\RegisterModel($database);

$loginView = new \view\LoginView($sessionModel, $loginModel);
$registerView = new \view\RegisterView($registerModel);
$gameView = new \view\GameView($gameModel, $sessionModel);
$layoutView = new \view\LayoutView($loginView, $registerView, $gameView);

$logInController = new \controller\LoginController($loginView, $loginModel, $sessionModel);
$registerController = new \controller\RegisterController($registerView, $registerModel);
$gameController = new \controller\GameController($gameView, $gameModel, $sessionModel);

$mainController = new \controller\MainController($layoutView, $logInController, $registerController, $gameController, $sessionModel);
$mainController->render();
