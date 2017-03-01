<?php


    include('connection.php');

    // player = $player
    // course = $course

    $strokes_query = "SELECT s.strokes, p.id, h.hole, h.par, d.date, c.course_name, c.id FROM players p " .
        "LEFT JOIN scores s ON " .
        "p.id = s.player_id " .
        "LEFT JOIN holes h ON " .
        "h.id = s.hole_id " .
        "LEFT JOIN date d ON " .
        "d.id = s.date_id " .
        "LEFT JOIN courses c ON " .
        "h.course_id = c.id " .
        "WHERE p.id = '" . $player . "' AND c.id = '" . $course . "' ORDER BY d.date DESC, h.hole ASC" ;

    $strokes_result = mysqli_query($link, $strokes_query);
//    $error = false;
//    if (0 == count(mysqli_fetch_array($strokes_result)) || $strokes_result == null) {
//        $error = true;
//
//    }

    $shots = Array();
    $dates = Array();
    $pars = Array();

    while ($row = mysqli_fetch_array($strokes_result)) {
        array_push($shots, $row);
    }

    $strokes = 0;
    $best_round = 1000;
    $worst_round = 0;
    $total_scores = 0;
    $rounds = 0;
    //die ("Dates = " . print_r($dates));

//    foreach ($shots as $shot) {
//        echo print_r($shot) . "<br />";
//    }


?>


            <?php

                if (!count($shots)):

            ?>

                <div class="no-data">
                    There are no scores for <?=$player_row['name'];?> for the course at <?=$course_row['course_name'];?>. Perhaps it's time to play a round?
                </div>

            <?php

                else:


                $loop = 0;
                $row = 0;
                
//                while ($row = mysqli_fetch_array($strokes_result)):
                foreach ($shots as $shot):
                
                	if ($row % 2 != 0)
                		$grey = " grey";
                	else
                		$grey = "";
                		
                    if ($loop == 0):

            ?>
                        <div class="clear"></div>
                        <div class="strokes row-lead<?=$grey;?>"><?=$shot['date'];?></div>
            <?php
                        $loop++;
                        $strokes = 0;
                    endif;
            ?>


            <?php

                $style = "strokes" . $grey;

                if ($shot['strokes'] == $shot['par']):
                    $style .= " par";
                elseif ($shot['strokes'] < $shot['par']):
                    $style .= " birdie";
                endif;
            ?>

            <div class="<?=$style;?>" id="<?=$shot['date']?>" data-date="<?=$shot['date']?>" data-hole="<?=$loop;?>" data-player="<?=$player;?>" data-row="<?=$row;?>">

            <?php

                echo($shot['strokes']);
                $strokes += $shot['strokes'];
                $loop++;

            ?>

            </div>

            <?php

                    if ($loop == 10):

                        if ($strokes > $worst_round) {
                            $worst_round = $strokes;
                        }
                        if ($strokes < $best_round) {
                            $best_round = $strokes;
                        }
                        $total_scores += $strokes;
                        $rounds++;
                    ?>
                        <div class="strokes end-of-row<?=$grey;?>" id="total-row-<?=$row;?>"><?=$strokes;?></div>
                        <div class="clear"></div>

                    <?php
                        $loop = 0;
                        $row++;
                    endif;


//                endwhile;
                endforeach;
            ?>




            <div class="clear"></div>

<!-- Average Score -->
            <div class="strokes row-lead avg-score">Average</div>


            <?php


//            $total = 0;

            $holes_query = "SELECT h.id FROM holes h LEFT JOIN courses c ON h.course_id = c.id WHERE c.id = '" . $course . "'";
            $holes_result = mysqli_query($link, $holes_query);
            $holes_array = Array();

            while ($row = mysqli_fetch_array($holes_result)) {
                array_push($holes_array, $row);
            }

            foreach ($holes_array as $hole):

                $avg_query = "SELECT AVG(strokes) FROM scores WHERE hole_id = '" . $hole['id'] . "' AND player_id = '" . $player . "'";
                $avg_result = mysqli_query($link, $avg_query);
                $avg_row = mysqli_fetch_array($avg_result);


                ?>
                <div class="strokes avg-score"><?=number_format(round($avg_row[0],2), 2);?></div>


                <?php
//                    $total += $best_row[0];
                    endforeach;
                ?>

            <div class="strokes avg-score end-of-row"><?=number_format(round($total_scores / $rounds,2), 2);?></div>
            <div class="clear"></div>

<!-- Best Round -->
            <div class="strokes row-lead best-score">Best</div>


            <?php


                $total = 0;

                foreach ($holes_array as $hole):

                    $best_query = "SELECT MIN(strokes) FROM scores WHERE hole_id = '" . $hole['id'] . "' AND player_id = '" . $player . "'";
                    $best_result = mysqli_query($link, $best_query);
                    $best_row = mysqli_fetch_array($best_result);


            ?>
                        <div class="strokes best-score"><?=$best_row[0];?></div>


            <?php

                $total += $best_row[0];
                endforeach;

            ?>

            <div class="strokes best-score end-of-row"><?=$best_round;?></div>
            <div class="clear"></div>

<!-- Worst Round -->
            <div class="strokes row-lead worst-score">Worst</div>


            <?php

                $total = 0;

                foreach ($holes_array as $hole):

                $worst_query = "SELECT MAX(strokes) FROM scores WHERE hole_id = '" . $hole['id'] . "' AND player_id = '" . $player . "'";
                $worst_result = mysqli_query($link, $worst_query);
                $worst_row = mysqli_fetch_array($worst_result);

            ?>

            <div class="strokes worst-score"><?=$worst_row[0];?></div>

            <?php

                $total += $worst_row[0];
                endforeach;

            ?>

            <div class="strokes worst-score end-of-row"><?=$worst_round;?></div>
            <div class="clear"></div>

        <?php
                    endif;
?>

