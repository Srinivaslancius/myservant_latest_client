<?php
//if($_SERVER['REQUEST_METHOD'] == 'POST')
//{
	
 $booking_start_time          = "10:00";			// The time of the first slot in 24 hour H:M format  
 $booking_end_time            = "18:00"; 			// The time of the last slot in 24 hour H:M format  
 $booking_frequency           = 60;   			// The slot frequency per hour, expressed in minutes.  	

echo "
	<div id='outer_booking'><h2>Available Slots</h2>


	<table width='400' border='0' cellpadding='2' cellspacing='0' id='booking'>
		";
				

		// Create $slots array of the booking times
		for($i = strtotime($booking_start_time); $i<= strtotime($booking_end_time); $i = $i + $booking_frequency * 60) {
			$slots[] = date("g:i A", $i);  
		}			
				
		//echo "<pre>"; print_r($slots); die;
		// Loop through $this->bookings array and remove any previously booked slots
		// Close if
		
				
		
		// Loop through the $slots array and create the booking table
		$last_key = end(array_keys($slots));
		foreach($slots as $i => $start) {			

			// Calculate finish time
			if ($i == $last_key) {
		        // last element
		    } else {
		        // not last element
		        $finish_time = strtotime($start) + $booking_frequency * 60; 
		        echo "
				<tr>\r\n
					<td>" . $start . " - " . date("g:i A", $finish_time) . "</td>\r\n				
				</tr>";
		    }

			
		
			
		
		} // Close foreach			
	
		
//}
?>