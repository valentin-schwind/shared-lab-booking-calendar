<?php	
	try {
		require "php/db_config.php";  

		$stmt = $bdd->prepare("SELECT * FROM events");
		$stmt->execute(); 
		//$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$ics_contents = "BEGIN:VCALENDAR\n"; 
		$ics_contents .= "VERSION:2.0\n"; 
		$ics_contents .= "PRODID:PHP\n"; 
		$ics_contents .= "METHOD:PUBLISH\n"; 
		$ics_contents .= "X-WR-CALNAME:Schedule\n"; # Change the timezone as well daylight settings if need be 
		$ics_contents .= "X-WR-TIMEZONE:Germany/Berlin\n"; 
		$ics_contents .= "BEGIN:VTIMEZONE\n"; 
		$ics_contents .= "TZID:Germany/Berlin\n";
		$ics_contents .= "BEGIN:DAYLIGHT\n"; 
		$ics_contents .= "TZOFFSETFROM:-0500\n"; 
		$ics_contents .= "TZOFFSETTO:-0400\n"; 
		$ics_contents .= "DTSTART:20070311T020000\n"; 
		$ics_contents .= "RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=2SU\n"; 
		$ics_contents .= "TZNAME:EDT\n"; 
		$ics_contents .= "END:DAYLIGHT\n"; 
		$ics_contents .= "BEGIN:STANDARD\n"; 
		$ics_contents .= "TZOFFSETFROM:-0400\n";
		$ics_contents .= "TZOFFSETTO:-0500\n";
		$ics_contents .= "DTSTART:20071104T020000\n";
		$ics_contents .= "RRULE:FREQ=YEARLY;BYMONTH=11;BYDAY=1SU\n";
		$ics_contents .= "TZNAME:EST\n";
		$ics_contents .= "END:STANDARD\n";
		$ics_contents .= "END:VTIMEZONE\n";

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($results as $schedule_details) {
			$id            = $schedule_details['id'];
			$start_date    = explode(" ", $schedule_details['start'])[0];
			$start_time    = explode(" ", $schedule_details['start'])[1];
			$end_date      = explode(" ", $schedule_details['end'])[0];
			$end_time      = explode(" ", $schedule_details['end'])[1];
			$location      = $schedule_details['room'];
			$category      = $schedule_details['className'];
			$name          = $schedule_details['title']; 
			$description   = $schedule_details['workstation'];

			# Remove '-' in $start_date and $end_date
			$estart_date   = str_replace("-", "", $start_date);
			$eend_date     = str_replace("-", "", $end_date);

			# Remove ':' in $start_time and $end_time
			$estart_time   = str_replace(":", "", $start_time);
			$eend_time     = str_replace(":", "", $end_time);

			# Replace some HTML tags
			$name          = str_replace("&lt;br&gt;", "\\n",   $name);
			$name          = str_replace("&amp;amp;", "&amp;",    $name);
			$name          = str_replace("&amp;rarr;", "--&gt;", $name);
			$name          = str_replace("&amp;larr;", "&lt;--", $name);
			$name          = str_replace(",", "\\,",      $name);
			$name          = str_replace(";", "\\;",      $name);

			$location      = str_replace("&lt;br&gt;", "\\n",   $location);
			$location      = str_replace("&amp;amp;", "&amp;",    $location);
			$location      = str_replace("&amp;rarr;", "--&gt;", $location);
			$location      = str_replace("&amp;larr;", "&lt;--", $location);
			$location      = str_replace(",", "\\,",      $location);
			$location      = str_replace(";", "\\;",      $location);

			$description   = str_replace("&lt;br&gt;", "\\n",   $description);
			$description   = str_replace("&amp;amp;", "&amp;",    $description);
			$description   = str_replace("&amp;rarr;", "--&gt;", $description);
			$description   = str_replace("&amp;larr;", "&lt;--", $description);
			$description   = str_replace("&lt;em&gt;", "",      $description);
			$description   = str_replace("&lt;/em&gt;", "",     $description);

			# Change TZID if need be
			$ics_contents .= "BEGIN:VEVENT\n";
			$ics_contents .= "DTSTART;TZID=Germany/Berlin"     . $estart_date . "T". $estart_time . "\n";
			$ics_contents .= "DTEND:"       . $eend_date . "T". $eend_time . "\n";
			$ics_contents .= "DTSTAMP:"     . date('Ymd') . "T". date('His') . "Z\n";
			$ics_contents .= "LOCATION:"    . $location . "\n";
			$ics_contents .= "DESCRIPTION:" . $description . "\n";
			$ics_contents .= "SUMMARY:"     . $name . "\n";
			$ics_contents .= "UID:"         . $id . "\n";
			$ics_contents .= "SEQUENCE:0\n";
			$ics_contents .= "END:VEVENT\n";
		}
		
		$ics_contents .= "END:VCALENDAR\n";

		
		echo $ics_contents;
	} catch(PDOException $e) {
		echo $e->getMessage();
	} finally { 
		$bdd = null;
	}
?>


	