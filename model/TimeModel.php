<?php
namespace model;

class TimeModel
{
    public function getTime() : string
    {

        date_default_timezone_set('Europe/Stockholm');
        $info = getdate();
        $weekday = $info['weekday'];
        $date = $info['mday'];
        $month = $info['month'];
        $year = $info['year'];
        $hour = $info['hours'];
        $min = $info['minutes'];
        $sec = $info['seconds'];
        $timeString = "$weekday, the {$date}th of $month $year, The time is  $hour:$min:$sec";

        return $timeString;
    }
}
