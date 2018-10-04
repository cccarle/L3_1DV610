<?php

namespace View;

class Messages
{

    private $message = '';

    public function noUsernameProvided()
    {
        $this->message .= 'Username is missing';
    }

    public function noPasswordProvided()
    {
        $this->message = 'Password is missing';
    }

    public function userNameToShort()
    {
        $this->message = 'Username has too few characters, at least 3 characters.';
    }

    public function passwordToShort()
    {
        $this->message = 'Password has too few characters, at least 6 characters.';
    }

    public function userNameDoesNotExist()
    {
        $this->message = 'Wrong name or password';
    }

    public function incorrectCredentials()
    {
        $this->message = 'Wrong name or password';
    }

    public function loginAttempSuccessful()
    {
        $this->message = 'Welcome';
    }

    public function logOut()
    {
        $this->message = 'Bye bye!';
    }

    public function passwordNotMatch()
    {
        $this->message = 'Passwords do not match.';
    }

    public function usernameAlreadyTaken()
    {
        $this->message = 'User exists, pick another username.';
    }

    public function somethingWentWrong()
    {
        $this->message = 'Something went wrong, please try register again';
    }

    public function showMessage()
    {
        return $this->message;
    }
}
