<?php

namespace view;

class DateTimeView
{
    private $timeString;

    public function __construct()
    {
        $this->timeModel = new \model\TimeModel();
    }

    public function showTime()
    {

        $this->timeString = $this->timeModel->getTime();

        return '<p>' . $this->timeString . '</p>';
    }
}
