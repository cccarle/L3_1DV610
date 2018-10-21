<?php

namespace model;

use PDO;

class DatabaseModel
{
    private $databaseHandler;
    private $statement;
    private $error;
    private $dsn;

    public function __construct()
    {
        $this->config = new \Config\Config();
        $this->createNewPDOInstance();
    }

    private function createNewPDOInstance()
    {

        $this->dsn = 'mysql:host=' . $this->config->dbHost() . ';dbname=' . $this->config->dbName();

        $options = array(
            PDO::ATTR_PERSISTENT => true, // Persistent connection - increase preformance
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Handle errors
        );

        try {
            $this->databaseHandler = new PDO($this->dsn, $this->config->dbUsername(), $this->config->dbPassword(), $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Query Prepare statement with query
    public function query($sql): void
    {
        $this->statement = $this->databaseHandler->prepare($sql);
    }

    // Bind values & check which type is passed in
    // http://php.net/manual/en/pdostatement.bindvalue.php
    public function bindValues($param, $value, $type = null): void
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

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute(): bool
    {
        return $this->statement->execute();
    }

    public function resultSet(): array
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSingleRecord()
    {
        $this->execute();

        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
