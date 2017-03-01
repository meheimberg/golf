<?php

    session_start();
    include('connection.php');
//    echo "Arrived";

    $player = $_POST['playername'];
    $id     = $_SESSION['id'];

    $query = "INSERT INTO players SET name ='" . mysqli_real_escape_string($link, $player) . "'";

    $result = mysqli_query($link, $query);

    return $result;