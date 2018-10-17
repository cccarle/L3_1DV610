<?php

namespace config;

class Config
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_password = '';
    private $db_name = 'Auth_1dv610';

    public function dbHost()
    {
        return $this->db_host;
    }

    public function dbUsername()
    {
        return $this->db_user;
    }

    public function dbPassword()
    {
        return $this->db_password;
    }

    public function dbName()
    {
        return $this->db_name;
    }
}
