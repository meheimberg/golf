<?php

    session_start();
    include('connection.php');

    $coursename      = $_POST['course'];
    $par_array       = $_POST['par'];
    $yards_array     = $_POST['yards'];

    $id     = $_SESSION['id'];

    $coursename_query = "INSERT INTO courses SET course_name ='" . mysqli_real_escape_string($link, $coursename) . "'";

    if (mysqli_query($link, $coursename_query)) {
        $course_id = mysqli_insert_id($link);
    }

    $holes_query = "INSERT INTO holes (id, course_id, hole, par, yards) VALUES ";

    $values = "";


    for ($ii = 1; $ii <= 9; $ii++) {
        $index = $ii - 1;
        $hole = $hole_ids[$index];

        $values .= "('', '" . $course_id . "', '" . $ii  . "', '"  . mysqli_real_escape_string($link, $par_array[$index]) . "', '" . mysqli_real_escape_string($link, $yards_array[$index]) . "')";

        if ($ii < 9) {
            $values .= ", ";
        }

    }
    //die($values);
    $holes_query .= $values;

    $result = mysqli_query($link, $holes_query);

    return $result;