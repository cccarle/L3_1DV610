<?php

namespace view;

class RegisterView
{
    private static $register = 'RegisterView::Register';
    private static $logout = 'RegisterView::Logout';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $keep = 'RegisterView::KeepMeLoggedIn';
    private static $messageId = 'RegisterView::Message';

    private const PASSWORD_LENGTH_LESS_THEN_THREE = 3;
    private const USERNAME_LENGTH_LESS_THEN_SIX = 6;

    private $registerModel;

    public function __construct($registerModel)
    {
        $this->registerModel = $registerModel;
    }

    public function renderRegisterView(): string
    {
        $message = $this->showResponseMessage();

        return $this->generateRegisterFormHTML($message);
    }

    private function generateRegisterFormHTML($message): string
    {
        return '
        <div class="container py-5 mt-5">
        <form method="POST" class="form">
            <fieldset>

                <legend class="h1">Register a new user - Enter Username and password</legend>

                <p id="' . self::$messageId . '">' . $message . '</p>

                <div class="form-group">
                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" class="form-control" name="' . self::$name . '" id="' . self::$name . '" value="' . $this->getUserName() . '" />
                </div>

                <div class="form-group">

                    <label for="' . self::$password . '">Password :</label>

                    <input type="password" class="form-control" id="' . self::$password . '" name="' . self::$password . '" />
                </div>

                <div class="form-group">

                    <label for="' . self::$passwordRepeat . '"> Repeat password :</label>
                    <input type="password" class="form-control" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />

                </div>
                <input type="submit" class="btn btn-primary" name="' . self::$register . '" value="Register" />
            </fieldset>
        </form>
    </div>
    ';
    }

    private function showResponseMessage(): string
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
                $message .= 'Passwords do not match. <br>';
            }

            if (!$this->registerModel->wasRegSuccess() && $this->registerModel->isUsernameTaken()) {
                $message .= 'User exists, pick another username. <br>';
            }
        } else {
            return $message = '';
        }

        return $message;
    }

    public function isUserCredentialsValid(): bool
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
