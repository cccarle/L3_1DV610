<?php

namespace model;

use PDO;
/*
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind Values
 * Return rows and results
 */

include './config/config.php';
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $databaseName = DB_NAME;
    private $databaseHandler;
    private $stmt;
    private $error;

    // TODO: change function name to display the comments - this is messy.
    public function __construct()
    {
        // set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName;
        // TODO : check for more usefull options
        $options = array(
            PDO::ATTR_PERSISTENT => true, // Persistent connection -increase preformance
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Handle errors
        );
        // Create PDO instance
        try {
            $this->databaseHandler = new PDO($dsn, $this->user, $this->pass);
        } catch (PDOExeption $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->databaseHandler->prepare($sql);
    }
    // Bind values & check which type is passed in
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statment
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
