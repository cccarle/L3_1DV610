<?php

namespace model;

class HighScoreModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function addHighScoreToDatabase($name, $score)
    {
        $this->database->query('INSERT INTO highScore(name,score) VALUES(:name,:score)');
        $this->database->bind(':name', $name);
        $this->database->bind(':score', $score);
        $this->database->execute();
    }

    public function getHighScore()
    {
        $this->database->query('SELECT * FROM highScore ORDER by score ASC, ts ASC LIMIT 10');
        $highScore = $this->database->resultSet();
        $rowInDb = array();

        foreach ($highScore as $value) {
            $rows = "{$value->name}  {$value->score}  {$value->ts}";
            array_push($rowInDb, $rows);
        }

        return $rowInDb;
    }
}
