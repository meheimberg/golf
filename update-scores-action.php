<?php

    include('connection.php');

    $player_id  = $_POST['player'];
    $course     = $_POST['course'];
    $date       = $_POST['date'];
    $hole       = $_POST['hole'];
    $strokes    = $_POST['strokes'];


    // get date id

    $date_query  = "SELECT * FROM date WHERE date = '" . $date . "'";
    $date_result = mysqli_query($link, $date_query);
    
    $hole_query  = "SELECT id FROM holes WHERE course_id = '" . $course . "' AND hole = '" . $hole . "' LIMIT 1";
    $hole_result = mysqli_query($link, $hole_query);
    $hole_array  = mysqli_fetch_array($hole_result);
    $hole_id 	 = $hole_array['id'];

    $date_ids_array = Array();
    $date_id_array = Array();
    $date_id = "";

    while($row = mysqli_fetch_array($date_result)) {
        array_push($date_ids_array, $row);
    }

    if (count($date_ids_array) > 1) {
        return false;
    } else {
        $date_id_array = $date_ids_array['0'];
        $date_id = $date_id_array['id'];

       //die("\$player_id = " . $player_id . " : course = " . $course . " : hole = " . $hole . " : strokes = " . $strokes . " : date = " . $date_id);


        $strokes_query = "UPDATE scores SET strokes = " . $strokes . " WHERE hole_id = " . $hole_id . " AND player_id = " . $player_id . " AND date_id = " . $date_id . " LIMIT 1";
        $strokes_result = mysqli_query($link, $strokes_query);

        die($strokes_result);


    }


