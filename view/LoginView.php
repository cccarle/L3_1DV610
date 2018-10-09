<?php

namespace view;

class LoginView
{
    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $cookieName = 'LoginView::CookieName';
    private static $cookiePassword = 'LoginView::CookiePassword';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';

    private $message;
    private $session;
    private $MessagesFromDatabase;
    private $loginModel;

    public function __construct($session, $loginModel)
    {
        $this->session = $session;
        $this->loginModel = $loginModel;
    }

    public function renderLoginView()
    {
        return $this->renderOutputHTML();
    }

    private function renderOutputHTML()
    {
        $message = $this->showResponseMessage();

        if ($this->session->checkIfLoggedIn()) {
            return $this->generateLogoutButtonHTML($message);
        } else {
            return $this->generateLoginFormHTML($message);
        }
    }

    private function generateLogoutButtonHTML($message)
    {
        return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message . '</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
    }

    private function generateLoginFormHTML($message)
    {
        return '
			<form method="post" >
				<fieldset>
					<legend>Login - Enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestUserName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
    }

    private function showResponseMessage()
    {
        $message = '';

        if (empty($this->getRequestUserName())) {
            return $message .= 'Username is missing';
        } elseif (strlen($this->getRequestUserName()) < 3) {
            return $message .= 'Username has too few characters, at least 3 characters.';
        } elseif (empty($this->getRequestUserPassword())) {
            return $message .= 'Password is missing';
        } elseif (strlen($this->getRequestUserPassword()) < 6) {
            return $message .= 'Password has too few characters, at least 6 characters.';
        } elseif (!$this->loginModel->doesUserExist()) {
            return $message .= 'User do not exist';
        } elseif ($this->loginModel->inCorrectCredentials()) {
            return $message .= 'Wrong name or password';
        } elseif ($this->session->checkIfLoggedIn()) {
            return $message .= 'Welcome';
        } elseif ($this->session->checkIfLoggedIn() && $this->isLogOutButtonPressed()) {
            return $message .= 'Bye bye!';
        } else {
            return $message;
        }
    }

    public function isLogOutButtonPressed(): bool
    {
        return isset($_REQUEST[self::$logout]);
    }

    public function isLogInButtonPressed(): bool
    {
        return isset($_REQUEST[self::$login]);
    }

    public function getRequestUserName()
    {
        if (isset($_POST[self::$name])) {
            return $_POST[self::$name];
        }
    }

    public function getRequestUserPassword()
    {
        if (isset($_POST[self::$password])) {
            return $_POST[self::$password];
        }
    }
}
