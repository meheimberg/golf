<?php

    session_start();
    include('connection.php');

    $player   = $_POST['player'];
    $course   = $_POST['course'];
    $date     = $_POST['date'];
    $strokes  = $_POST['strokes'];


    $holes_query = "SELECT * FROM holes WHERE course_id = '" . $course . "'";
    $holes_result = mysqli_query($link, $holes_query);

    $date_array = explode("/", $date);
    $formatted_date = $date_array[2] . "-" . $date_array[0] . "-" .$date_array[1];
    $formatted_date = $date_array[2] . "-" . $date_array[0] . "-" .$date_array[1];

    $checkdate_query = "SELECT * FROM date WHERE date = '" . $formatted_date . "';";
    $checkdate_result = mysqli_query($link, $checkdate_query);

    $checkdate_row = mysqli_fetch_array($checkdate_result);

    if ($checkdate_row['id'] != "" && $checkdate_row['id'] != null) {
        $date_id = $checkdate_row['id'];
    } else {
        $new_date_query = "INSERT INTO date SET date = '" . $formatted_date . "';";
        //die($new_date_query);
        if (mysqli_query($link, $new_date_query)) {
            $date_id = mysqli_insert_id($link);
        }
    }

    $strokes_query = "";

    $query = "INSERT INTO scores (id, hole_id, strokes, player_id, date_id) VALUES ";

    $values = "";

    $hole_ids = Array();
    while($row = mysqli_fetch_array($holes_result)) {
        array_push($hole_ids, $row['id']);
    }

    for ($ii = 1; $ii <= 9; $ii++) {
        $index = $ii - 1;
        $hole = $hole_ids[$index];

        $values .= "('', '" . $hole . "', '" . $strokes[$index] . "', '" . mysqli_real_escape_string($link, $player) . "', '" . $date_id . "')";

        if ($ii < 9) {
            $values .= ", ";
        }

    }

    $query .= $values;
    $result = mysqli_query($link, $query);

    return $result;

