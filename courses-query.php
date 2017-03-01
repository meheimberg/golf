<?php

    $courses_query = "SELECT * FROM courses c ORDER BY c.course_name ASC";
    $courses_result = mysqli_query($link, $courses_query);

