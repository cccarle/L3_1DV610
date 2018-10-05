<?php

namespace view;

class DateTimeView {

    private $timeModel;

    public function __construct($timeModel){
        $this->timeModel = $timeModel;
    }

	/* 
	Returns a string with time from server.
	*/
	
	public function showTime() {

        $timeString =  $this->timeModel->getTime();
        
		return '<p>' . $timeString . '</p>';
	}
}