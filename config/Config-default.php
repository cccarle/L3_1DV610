<?php

namespace config;

/* 
NOTE: This is a default config-file, to make this work you need to:
Change this php files name from "Config-default.php" to "Congfig.php"

This will make the gitignore to hinder you from uploading your config-file to github.
*/

class Config
{
    private $db_host = 'your host';
    private $db_user = 'your db username';
    private $db_password = 'your db password';
    private $db_name = 'your db name';

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
