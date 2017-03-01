<?php

    include('connection.php');

    $date_query  = "SELECT * FROM date ORDER BY id";
    $date_result = mysqli_query($link, $date_query);
    
    

    
    $scores_query = "SELECT * FROM scores LIMIT 10000";
    $scores_result = mysqli_query($link, $scores_query);

    die(print_r($scores_result));
    
	$loop = 0;
	
	while($row = mysqli_fetch_array($scores_result)) {

		$date_query = "SELECT id, date from date WHERE id = " . $row['date_id'] . " LIMIT 0,5000";
		$date_result = mysqli_query($link, $date_query);	
		
		$loop = $loop + 1;
		
		while ($inner_row = mysqli_fetch_array($date_result)) {
	
			echo($loop . " : date = " . $inner_row['date'] . "<br />");		
	
			$update_scores_query = "UPDATE scores SET real_date = '" . $inner_row['date'] . "' WHERE date_id = " . $inner_row['id'];
			$update_scores_result = mysqli_query($link, $update_scores_query);

		}	
		
	}
	
	// 2052 IS NULL
	// 1944 IS NOT NULL
	// 3996
	