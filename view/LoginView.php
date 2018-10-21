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
    private $sessionModel;
    private $loginModel;

    public function __construct($sessionModel, $loginModel)
    {
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
    }

    public function renderLoginView(): string
    {

        if ($this->sessionModel->checkIfLoggedIn()) {
            return $this->generateLogoutButtonHTML();
        } else {
            return $this->generateLoginFormHTML();
        }
    }

    private function generateLogoutButtonHTML(): string
    {
        return '
			<form method="post" >
				<p id="' . self::$messageId . '">' . $this->showResponseMessage() . '</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
    }

    private function generateLoginFormHTML(): string
    {
        return '
        <form method="post" >
        <fieldset>
            <legend>Login - Enter Username and password</legend>
            <p id="' . self::$messageId . '">' . $this->showResponseMessage() . '</p>
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

    private function showResponseMessage(): string
    {
        $message = '';

        if (!$this->sessionModel->checkIfLoggedIn() && $this->isLogInButtonPressed()) {
            if (empty($this->getRequestUserName())) {
                return $message .= 'Username is missing';
            }
            if (empty($this->getRequestUserPassword())) {
                return $message .= 'Password is missing';
            }
            if (!$this->loginModel->checkIfLoginSuccess()) {
                return $message .= 'Wrong name or password';
            }
        }

        if ($this->loginModel->checkIfLoginSuccess()) {
            return $message .= 'Welcome';
        }

        if ($this->isLogOutButtonPressed()) {
            $message .= 'Bye bye!';
        }

        return $message;
    }

    public function isLogOutButtonPressed(): bool
    {
        return isset($_POST[self::$logout]);
    }

    public function isLogInButtonPressed(): bool
    {
        return isset($_POST[self::$login]);
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
