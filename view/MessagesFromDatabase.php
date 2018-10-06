<?php

namespace View;

class MessagesFromDatabase
{

    private $message = '';

    public function userNameDoesNotExist()
    {
        $this->message .= 'User do not exist';
    }

    public function incorrectCredentials()
    {
        $this->message .= 'Wrong name or password';
    }

    public function loginAttempSuccessful()
    {
        $this->message .= 'Welcome';
    }

    public function logOut()
    {
        $this->message .= 'Bye bye!';
    }

    public function passwordNotMatch()
    {
        $this->message .= 'Passwords do not match.';
    }

    public function usernameAlreadyTaken()
    {
        $this->message .= 'User exists, pick another username.';
    }
    
    public function showMessage()
    {
        return $this->message;
    }
}
