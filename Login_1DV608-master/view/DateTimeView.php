<?php

class DateTimeView {


	public function show() {
		
		//Sets the timezone to our timezone, otherwise the clock is 2 hours behind
		//TODO: is there a more dynamic way to make this? Cant imagine it works globally, or it is beacuse my c9 server is not in sweden.
		date_default_timezone_set('Europe/Stockholm');
		
		//To get 1st, 2nd, 3rd on date.
		$day = date('jS');
		
		//To get digital time display
		$time = date('H:i:s');
		
		$date = getdate();
		$timeString = "$date[weekday], the $day of $date[month] $date[year], The time is $time"; //$date[hours]:$date[minutes]:$date[seconds]";

		return '<p>' . $timeString . '</p>';
	}
}