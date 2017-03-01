<?php

    include('connection.php');

    $ids    = $_POST['ids'];
    $player = $_POST['player'];
    $rounds_array = Array();

    foreach ($ids as $id) {

        $rounds_query = "SELECT COUNT(*)  FROM courses c " .
            "LEFT JOIN holes h ON " .
            "h.course_id = c.id " .
            "LEFT JOIN scores s ON " .
            "s.hole_id = h.id " .
            "LEFT JOIN players p ON " .
            "p.id = s.player_id " .
            "WHERE c.id = '" . $id . "' AND p.id = '" . $player . "'";

        $rounds_result = mysqli_query($link, $rounds_query);
        $row = mysqli_fetch_array($rounds_result);
        $rounds = $row[0];
        array_push($rounds_array, $rounds);
    }

    echo json_encode($rounds_array);

