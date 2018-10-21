<?php

namespace model;

class HighScoreModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function addHighScoreToDatabase($name, $score): void
    {
        $this->database->query('INSERT INTO highScore(name,score) VALUES(:name,:score)');
        $this->database->bindValues(':name', $name);
        $this->database->bindValues(':score', $score);
        $this->database->execute();
    }

    public function getTop10HighScore(): array
    {
        $this->database->query('SELECT * FROM highScore ORDER by score ASC, ts ASC LIMIT 10');
        $highScoreListFromDatabase = $this->database->resultSet();
        $top10HighScoreArray = array();

        foreach ($highScoreListFromDatabase as $highScoreValue) {
            array_push($top10HighScoreArray, $highScoreValue);
        }

        return $top10HighScoreArray;
    }
}
