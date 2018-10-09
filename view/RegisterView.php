<?php

namespace view;

class RegisterView
{
    private static $register = 'RegisterView::Register';
    private static $logout = 'RegisterView::Logout';
    private static $name = 'RegisterView::Username';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $cookieName = 'RegisterView::CookieName';
    private static $cookiePassword = 'RegisterView::CookiePassword';
    private static $keep = 'RegisterView::KeepMeLoggedIn';
    private static $messageId = 'RegisterView::Message';

    public function renderRegisterView()
    {
        $message = '';
        return $this->generateRegisterFormHTML($message);
    }

    private function generateRegisterFormHTML($message)
    {
        return '
			<form method="post"  >
				<fieldset>
					<legend>Register a new user - Enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<label for="' . self::$name . '">Username :</label>
					<input type="text" name="' . self::$name . '"  id="' . self::$name . '" value="' . $this->getUserName() . '" />
					<label for="' . self::$password . '">Password :</label>
                    <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
					<label for="' . self::$passwordRepeat . '"> Repeat password :</label>
                    <input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
					<input type="submit" name="' . self::$register . '" value="Register" />
				</fieldset>
			</form>
		';
    }

    public function isRegisterButtonPressed(): bool
    {
        return isset($_REQUEST[self::$register]);
    }

    public function getUserName()
    {
        if (isset($_POST[self::$name])) {
            return $_POST[self::$name];
        }
    }
    public function getUserPassword()
    {
        if (isset($_POST[self::$password])) {
            return $_POST[self::$password];
        }
    }
    public function getUserPasswordRepeat()
    {
        if (isset($_POST[self::$passwordRepeat])) {
            return $_POST[self::$passwordRepeat];
        }
    }
}
