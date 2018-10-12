<?php

namespace view;

class RegisterView
{
    private static $register = 'RegisterView::Register';
    private static $logout = 'RegisterView::Logout';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $cookieName = 'RegisterView::CookieName';
    private static $cookiePassword = 'RegisterView::CookiePassword';
    private static $keep = 'RegisterView::KeepMeLoggedIn';
    private static $messageId = 'RegisterView::Message';

    private const PASSWORD_LENGTH_LESS_THEN_THREE = 3;
    private const USERNAME_LENGTH_LESS_THEN_SIX = 6;


    private $registerModel;

    public function __construct($registerModel)
    {
        $this->registerModel = $registerModel;
    }

    public function renderRegisterView()
    {

        $message = $this->showResponseMessage();
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

    private function showResponseMessage()
    {
        $message = '';

        if ($this->isRegisterButtonPressed()) {

            if (strlen($this->getUserName()) < self::PASSWORD_LENGTH_LESS_THEN_THREE) {
                $message .= 'Username has too few characters, at least 3 characters. <br>';
            }

            if (strlen($this->getUserPassword()) < self::USERNAME_LENGTH_LESS_THEN_SIX) {
                $message .= 'Password has too few characters, at least 6 characters. <br>';
            }

            if ($this->getUserPassword() != $this->getUserPasswordRepeat()) {
                $message .= 'Password do not match. <br>';
            }

            if (!$this->registerModel->wasRegSuccess() && $this->registerModel->isUsernameTaken()) {
                $message .= 'User exists, pick another username. <br>';
            }
        } else {
            return $message = '';
        }

        return $message;
    }

    public function isUserCredentialsValid()
    {
        return empty($this->showResponseMessage());
    }

    public function isRegisterButtonPressed(): bool
    {
        return isset($_POST[self::$register]);
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
