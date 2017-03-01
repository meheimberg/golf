<?php

    $players_query = "SELECT * FROM players p ORDER BY p.name ASC";
    $players_result = mysqli_query($link, $players_query);

