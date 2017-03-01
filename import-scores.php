<?php

/*
 * ====================================================
 * Tread Carefully... This can have unexpected results
 * if you don't understand what you are doing.
 * The execution of the import queries is commented
 * out for safety.
 * ====================================================
 */

session_start();
include('connection.php');


$course_query = "SELECT * FROM courses WHERE course_name = 'Buckmeadow';";
$course_result = mysqli_query($link, $course_query);
$row = mysqli_fetch_array($course_result);

$course_id = $row['id'];

$holes_query = "SELECT * FROM holes WHERE course_id = '" . $course_id . "';";
$holes_result = mysqli_query($link, $holes_query);

$holes = Array();
while ($row = mysqli_fetch_array($holes_result)) {
    array_push($holes, $row['id']);
}

$bill = Array();
$ernie = Array();

array_push($bill, array("2014-04-14", "7", "5", "8", "5", "7", "5", "10", "6", "7"));
array_push($bill, array("2014-04-17", "6", "4", "5", "7", "6", "6", "11", "7", "9"));
array_push($bill, array("2014-04-21", "6", "5", "7", "10", "6", "4", "7", "5", "7"));
array_push($bill, array("2014-04-22", "8", "4", "5", "4", "10", "6", "8", "4", "4"));
array_push($bill, array("2014-04-23", "7", "4", "4", "5", "5", "5", "6", "5", "6"));
array_push($bill, array("2014-05-05", "6", "3", "7", "5", "6", "4", "5", "7", "10"));
array_push($bill, array("2014-05-07", "10", "4", "4", "7", "7", "4", "6", "7", "4"));
array_push($bill, array("2014-05-09", "10", "4", "6", "6", "5", "4", "8", "6", "6"));
array_push($bill, array("2014-05-12", "10", "4", "4", "6", "6", "4", "6", "10", "6"));
array_push($bill, array("2014-05-19", "6", "4", "7", "6", "7", "3", "8", "8", "5"));
array_push($bill, array("2014-05-29", "8", "5", "7", "7", "9", "5", "7", "6", "5"));
array_push($bill, array("2014-05-30", "8", "5", "6", "8", "8", "5", "6", "5", "9"));
array_push($bill, array("2014-06-04", "7", "4", "4", "5", "6", "6", "4", "6", "6"));
array_push($bill, array("2014-06-06", "4", "5", "4", "8", "5", "5", "6", "5", "8"));
array_push($bill, array("2014-06-09", "8", "4", "4", "5", "9", "5", "5", "7", "9"));
array_push($bill, array("2014-06-10", "9", "5", "3", "6", "7", "5", "10", "4", "4"));
array_push($bill, array("2014-06-11", "10", "5", "7", "7", "7", "6", "8", "9", "9"));
array_push($bill, array("2014-06-13", "7", "6", "6", "7", "4", "6", "6", "4", "6"));
array_push($bill, array("2014-06-16", "8", "3", "3", "6", "10", "6", "6", "4", "12"));
array_push($bill, array("2014-06-17", "5", "4", "5", "6", "7", "7", "8", "3", "5"));
array_push($bill, array("2014-06-19", "8", "5", "6", "5", "5", "5", "8", "6", "7"));
array_push($bill, array("2014-06-20", "7", "4", "5", "6", "8", "5", "10", "7", "6"));
array_push($bill, array("2014-06-23", "6", "4", "5", "4", "7", "6", "6", "5", "9"));
array_push($bill, array("2014-06-24", "5", "4", "5", "4", "6", "5", "7", "4", "7"));
array_push($bill, array("2014-06-27", "7", "3", "6", "12", "8", "5", "5", "7", "8"));
array_push($bill, array("2014-07-01", "4", "8", "7", "4", "7", "5", "6", "3", "6"));
array_push($bill, array("2014-07-09", "7", "3", "3", "7", "8", "6", "5", "7", "6"));
array_push($bill, array("2014-07-11", "10", "6", "4", "8", "6", "8", "6", "5", "7"));
array_push($bill, array("2014-07-14", "6", "3", "5", "5", "6", "6", "8", "4", "6"));
array_push($bill, array("2014-07-15", "7", "4", "4", "7", "8", "5", "5", "5", "5"));
array_push($bill, array("2014-07-17", "5", "5", "6", "7", "6", "6", "7", "8", "10"));
array_push($bill, array("2014-07-21", "7", "5", "4", "8", "6", "7", "6", "5", "6"));
array_push($bill, array("2014-07-24", "7", "3", "7", "4", "5", "4", "7", "5", "6"));
array_push($bill, array("2014-07-25", "10", "5", "5", "6", "9", "5", "8", "6", "5"));
array_push($bill, array("2014-08-04", "11", "6", "6", "6", "12", "9", "6", "4", "7"));
array_push($bill, array("2014-08-06", "9", "4", "7", "5", "6", "5", "6", "6", "5"));
array_push($bill, array("2014-08-08", "6", "5", "5", "6", "5", "4", "6", "6", "6"));
array_push($bill, array("2014-08-11", "8", "6", "7", "5", "6", "7", "8", "5", "9"));
array_push($bill, array("2014-08-12", "7", "6", "11", "5", "6", "7", "11", "10", "6"));
array_push($bill, array("2014-08-26", "7", "5", "5", "9", "8", "5", "6", "8", "7"));
array_push($bill, array("2014-08-29", "6", "4", "8", "7", "8", "6", "7", "11", "9"));
array_push($bill, array("2014-09-03", "6", "4", "6", "8", "4", "6", "4", "6", "6"));
array_push($bill, array("2014-09-08", "9", "3", "6", "7", "7", "6", "9", "10", "7"));
array_push($bill, array("2014-09-30", "8", "7", "4", "7", "8", "6", "6", "4", "7"));

array_push($ernie, array("2014-04-14", "12", "5", "5", "6", "8", "7", "7", "6", "7"));
array_push($ernie, array("2014-04-17", "8", "5", "6", "7", "7", "5", "7", "6", "9"));
array_push($ernie, array("2014-04-18", "13", "5", "6", "10", "7", "7", "6", "6", "7"));
array_push($ernie, array("2014-04-21", "11", "7", "9", "6", "11", "3", "9", "7", "7"));
array_push($ernie, array("2014-04-22", "6", "3", "4", "7", "7", "9", "7", "7", "8"));
array_push($ernie, array("2014-04-23", "8", "5", "4", "7", "8", "5", "6", "5", "9"));
array_push($ernie, array("2014-04-28", "7", "3", "5", "6", "8", "6", "7", "3", "8"));
array_push($ernie, array("2014-05-01", "9", "4", "5", "7", "7", "6", "8", "6", "5"));
array_push($ernie, array("2014-05-02", "7", "5", "5", "7", "7", "6", "8", "4", "9"));
array_push($ernie, array("2014-05-05", "6", "5", "8", "7", "8", "6", "10", "6", "8"));
array_push($ernie, array("2014-05-07", "8", "5", "6", "7", "7", "5", "7", "10", "6"));
array_push($ernie, array("2014-05-09", "8", "5", "5", "7", "9", "5", "9", "6", "7"));
array_push($ernie, array("2014-05-12", "13", "5", "8", "9", "5", "5", "7", "9", "15"));
array_push($ernie, array("2014-05-15", "11", "5", "5", "7", "7", "7", "8", "6", "8"));
array_push($ernie, array("2014-05-19", "6", "5", "5", "7", "6", "6", "5", "4", "8"));
array_push($ernie, array("2014-05-20", "7", "5", "4", "6", "7", "6", "9", "5", "7"));
array_push($ernie, array("2014-05-22", "10", "5", "5", "6", "8", "7", "9", "7", "6"));
array_push($ernie, array("2014-05-29", "8", "6", "5", "7", "6", "6", "6", "4", "11"));
array_push($ernie, array("2014-05-30", "10", "4", "5", "10", "8", "6", "12", "9", "9"));
array_push($ernie, array("2014-06-03", "8", "6", "6", "8", "10", "7", "8", "6", "9"));
array_push($ernie, array("2014-06-04", "8", "6", "4", "8", "10", "6", "8", "6", "11"));
array_push($ernie, array("2014-06-09", "6", "4", "6", "8", "8", "9", "7", "8", "10"));
array_push($ernie, array("2014-06-11", "9", "6", "5", "8", "8", "8", "10", "7", "11"));
array_push($ernie, array("2014-06-16", "8", "3", "6", "7", "9", "6", "8", "6", "9"));
array_push($ernie, array("2014-06-17", "10", "5", "5", "7", "8", "5", "7", "6", "13"));
array_push($ernie, array("2014-06-20", "10", "4", "5", "7", "9", "6", "9", "4", "7"));
array_push($ernie, array("2014-06-23", "7", "5", "6", "8", "8", "6", "8", "5", "8"));
array_push($ernie, array("2014-06-24", "8", "4", "3", "9", "11", "7", "8", "6", "6"));
array_push($ernie, array("2014-06-27", "11", "7", "6", "8", "9", "7", "7", "8", "11"));
array_push($ernie, array("2014-06-30", "8", "5", "9", "7", "9", "7", "7", "4", "8"));
array_push($ernie, array("2014-07-01", "10", "4", "4", "10", "8", "6", "5", "6", "7"));
array_push($ernie, array("2014-07-09", "9", "5", "6", "8", "9", "4", "9", "6", "18"));
array_push($ernie, array("2014-07-11", "6", "6", "6", "7", "10", "7", "9", "8", "6"));
array_push($ernie, array("2014-07-14", "7", "6", "4", "6", "7", "6", "7", "7", "11"));
array_push($ernie, array("2014-07-17", "8", "5", "4", "7", "8", "5", "9", "7", "7"));
array_push($ernie, array("2014-07-21", "8", "3", "8", "7", "7", "7", "7", "8", "7"));
array_push($ernie, array("2014-07-24", "14", "6", "7", "6", "8", "11", "6", "7", "11"));
array_push($ernie, array("2014-07-25", "8", "5", "7", "6", "8", "7", "9", "8", "11"));
array_push($ernie, array("2014-08-04", "9", "5", "6", "10", "9", "9", "10", "6", "11"));
array_push($ernie, array("2014-08-06", "8", "5", "3", "8", "7", "7", "8", "9", "7"));
array_push($ernie, array("2014-08-08", "8", "5", "6", "6", "9", "4", "8", "5", "5"));
array_push($ernie, array("2014-08-11", "8", "5", "3", "9", "9", "6", "7", "6", "10"));
array_push($ernie, array("2014-08-12", "9", "5", "6", "6", "10", "6", "6", "6", "10"));
array_push($ernie, array("2014-08-18", "8", "5", "6", "13", "7", "6", "5", "7", "7"));
array_push($ernie, array("2014-08-20", "8", "5", "2", "8", "6", "6", "8", "6", "9"));
array_push($ernie, array("2014-08-25", "9", "5", "3", "7", "6", "9", "7", "4", "9"));
array_push($ernie, array("2014-08-26", "7", "6", "7", "8", "9", "5", "7", "8", "7"));
array_push($ernie, array("2014-08-29", "10", "4", "4", "8", "6", "6", "11", "7", "9"));
array_push($ernie, array("2014-09-03", "10", "4", "7", "7", "8", "5", "7", "5", "6"));
array_push($ernie, array("2014-09-03", "10", "8", "6", "7", "8", "7", "9", "5", "8"));
array_push($ernie, array("2014-09-08", "7", "6", "8", "9", "9", "6", "9", "8", "9"));
array_push($ernie, array("2014-09-30", "8", "4", "4", "8", "11", "6", "9", "6", "8"));
array_push($ernie, array("2014-11-11", "7", "5", "4", "8", "7", "4", "6", "7", "9"));
array_push($ernie, array("2014-11-12", "10", "4", "5", "8", "6", "5", "7", "6", "9"));

/*
foreach ($ernie as $array) {
    $loop = 0;
    $date_id = "";
    foreach($array as $item) {

        if ($loop == 0) {
            $checkdate_query = "SELECT * FROM date WHERE date = '" . $array[0] . "';";
            $checkdate_result = mysqli_query($link, $checkdate_query);

            $checkdate_row = mysqli_fetch_array($checkdate_result);

            if ($checkdate_row['id'] != "" && $checkdate_row['id'] != null) {
                $date_id = $checkdate_row['id'];
            } else {
                $new_date_query = "INSERT INTO date SET date = '" . $array[0] . "';";

                if (mysqli_query($link, $new_date_query)) {
                    $date_id = mysqli_insert_id($link);
                }
            }
        }

        $loop++;

    }


    $strokes_query = "";

    $query = "INSERT INTO scores (id, hole_id, strokes, player_id, date_id) VALUES ";

    $values = "";

    for ($ii = 1; $ii <= 9; $ii++) {
        $index = $ii - 1;
        $hole = $holes[$index];

        $values .= "('', '" . $hole . "', '" . $array[$index+1] . "', '1', '" . $date_id . "')";

        if ($ii < 9) {
            $values .= ", ";
        }

    }

    $query .= $values;
    $result = mysqli_query($link, $query);
    echo $result;

}
*/