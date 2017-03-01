<?php

    $page_title = "Add Scores";
    include('header.php');

    include('players-query.php');
    include('courses-query.php');

    $holes_query = "SELECT * FROM holes h LEFT JOIN courses c ON h.course_id = c.id WHERE c.id = 1";
    $holes_result = mysqli_query($link, $holes_query);

?>

<div class="row">
    <div class="col-md-3 box"></div>
    <div class="col-md-6 box">

        <h1>Add Scores</h1>


    </div>

    <div class="col-md-3 box"></div>
</div>


<!-- Players -->
    <div class="row">
        <div class="col-md-3 box"></div>
        <div class="col-md-3 box">

            <h2>Select Player</h2>
            <form id="add_scores" method="get" action="add-scores-action.php">

                <div id="players-container">

                <div class="" id="players-group-error">
                    You must choose a player.
                </div>

                <?php
                    while ($row = mysqli_fetch_array($players_result)):
                ?>
                    <div class="form-group">

                        <input type="radio" name="player" value="<?=$row['id'];?>" class="checkbox" onchange="resetField('players');" >
                        <div class="player">

                            <?php
                                echo($row['name']);
                            ?>

                        </div>
                    </div>
                    <div class="clear"></div>

                <?php
                    endwhile;
                ?>
                </div>
        </div>

        <div class="col-md-3 box">

<!-- Courses -->
            <h2>Select Course</h2>
            <div id="courses-container">
            <div id="courses-group-error">
                You must select a course.
            </div>
            <?php
                while($row = mysqli_fetch_array($courses_result)):
//                foreach ($courses_result as $course):

            ?>
            <div class="form-group">

                <input type="radio" name="course" value="<?=$row['id'];?>" class="checkbox" onchange="resetField('courses');" >
                <div class="player">

                    <?php

                        echo($row['course_name']);

                    ?>

                </div>
            </div>
            <div class="clear"></div>

            <?php
//                endforeach;
                endwhile;
            ?>
            </div>

        </div>

        <div class="col-md-3 box"></div>
    </div>

<!-- Round Date -->

    <div class="row">
        <div class="col-md-3 box"></div>
        <div class="col-md-6 box">

            <h2>Select Date</h2>

            <script>
                $(function() {
                    $( "#datepicker" ).datepicker();
                });
            </script>
            <div id="date-container">
                <div id="date-group-error">
                    You must select a date.
                </div>
                <div class="float date-label">
                    Date
                </div>
                <div class="form-group float">
                    <input type="text" name="date" id="datepicker" readonly="true" onchange="resetField('datepicker');" value="<?=date('m/d/Y');?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>

        </div>

        <div class="col-md-3 box"></div>
    </div>

<!-- Hole Labels -->
    <div class="row">
        <div class="col-md-3 box"></div>
        <div class="col-md-6 box">
            <h2>Strokes</h2>
            <div class="form-group">
                <div class="float hole-input-label">
                    Hole
                </div>
                <?php
                    for ($ii = 1; $ii <= 9; $ii++):
                ?>
                    <div class="float hole-label">
                        <?=$ii;?>
                    </div>
                <?php
                    endfor;
                ?>
                <div class="float hole-label">
                    Total
                </div>
                <div class-"clear"></div>
            </div>
        </div>
        <div class="col-md-3 box"></div>
    </div>

<!-- Strokes -->
    <div class="row">
        <div class="col-md-3 box"></div>
        <div class="col-md-6 box">
            <div class="form-group">
                <div class="float hole-input-label">
                    Strokes
                </div>

                <?php
                    for ($ii = 1; $ii <= 9; $ii++):
                ?>
                <div class="form-input">
                    <?php

                        $id = "hole" . $ii;

                    ?>
                    <input type="text" name="<?=$ii;?>"  id="<?=$id;?>" class="hole-input" pattern="\d*" value="" onchange="resetField('<?=$id;?>')" />
                </div>
                <?php
                    endfor;
                ?>
                <div class="float hole-label" id ="total-strokes">
                    0
                </div>
                <div class-"clear"></div>
            </div>
        </div>
        <div class="col-md-3 box"></div>
    </div>

    <div class="row">
        <div class="col-md-3 box"></div>
        <div class="col-md-6 box addscores">
            <div class="form-group">
                <button type="submit" class="btn btn-success addscores">Add Scores</button>
            </div>
            </form>

            <div id="result"></div>

        </div>
        <div class="col-md-3 box"></div>
    </div>

        <script type="text/javascript">

            function validate_form() {

                var error = 0;

                var players = document.getElementsByName('player');

                for (var i = 0, length = players.length; i < length; i++) {
                    var radioVal = false;
                    if (players[i].checked) {
                        radioVal = true;
                        break;
                    }
                }

                if (radioVal == false) {
                    error++;
                    $( "#players-group-error").hide().fadeIn( 1000 );
                    $("#players-container").stop(true,false).addClass('error', {duration:1000});
                }

                var courses = document.getElementsByName('course');

                for (var i = 0, length = courses.length; i < length; i++) {
                    var courseVal = false;
                    if (courses[i].checked) {
                        courseVal = true;
                        break;
                    }
                }

                if (courseVal == false) {
                    error++;
                    $( "#courses-group-error").hide().fadeIn( 1000 );
                    $("#courses-container").stop(true,false).addClass('error', { duration:1000 });
                }

                var date = document.getElementById('datepicker');

                if (date.value == "" || date.value == null) {
                    error++;
                    $( "#date-group-error").hide().fadeIn( 1000 );
                    $("#date-container").stop(true,false).addClass('error', { duration:1000 });
                }

                for (var ii = 1; ii <= 9; ii++ ) {

                    var field = document.getElementById("hole"+ii);

                    if (field.value == "" || field.value == null || field.value < 1) {

                        error++;

                        $( "#"+field.id ).stop(true,false).addClass('error', {duration:1000});

                    }
                }

                return error;

            }

            function resetField(field) {
                if (field == "players") {
                    $( "#players-group-error" ).fadeOut( 1000 );
                    $( "#players-container" ).stop(true,false).removeClass('error', {duration:1000});
                } else if (field == "courses") {
                    $( "#courses-group-error" ).fadeOut( 1000 );
                    $( "#courses-container" ).stop(true,false).removeClass('error', {duration:1000});
                } else if (field == "datepicker") {
                    $( "#date-group-error" ).fadeOut( 1000 );
                    $( "#date-container" ).stop(true,false).removeClass('error', {duration:1000});
                } else {
                    $( "#"+field ).stop(true,false).removeClass('error', {duration:1000});
                    updateTotalStrokes();
                }
            }

            function updateTotalStrokes() {

                var totalStrokes = 0;
                for (ii = 1; ii < 10; ii++) {

                    var value =  parseInt($( "#hole"+ii ).val());
                    if (!isNaN(value))
                        totalStrokes = totalStrokes + value;

                }
                $( "#total-strokes" ).text(totalStrokes);

            }


            function resetForm() {

                var courses = document.getElementsByName('course');
                for (var ii = 0; ii < courses.length; ii++) {
                    courses[ii].checked = false;
                }

                var players = document.getElementsByName('player');
                for (var ii = 0; ii < players.length; ii++) {
                    players[ii].checked = false;
                }

                for (var ii = 1; ii <= 9; ii++) {
                    document.getElementById("hole" + ii.toString()).value = '';
                }
            }

            //$("#addplayerButton").click(function(event) {
            $( "#add_scores" ).submit(function( event ) {

                event.preventDefault();

                //$.post("add_player_action.php", {$("#playername").val()} );

                errorVal = validate_form();


                if (errorVal == 0) {

                    var players = document.getElementsByName('player');

                    for (var i = 0, length = players.length; i < length; i++) {
                        var playerid = 0;
                        if (players[i].checked) {
                            playerid = players[i].value;
                            break;
                        }
                    }

                    var courses = document.getElementsByName('course');

                    for (var i = 0, length = courses.length; i < length; i++) {
                        var courseid = 0;
                        if (courses[i].checked) {
                            courseid = courses[i].value;
                            break;
                        }
                    }

                    var dateval = document.getElementById('datepicker').value;

                    var strokesarray = new Array();
                    for (var ii = 0; ii < 9; ii++) {

                        strokesarray[ii] = document.getElementById("hole"+(ii + 1)).value;

                    }

                    var $form = $( this ), url = $form.attr( "action" );

                    var posting = $.post( url, { player: playerid, course: courseid, date: dateval, strokes: strokesarray} );
//
                    // Put the results in a div
                    posting.done(function( data ) {
                        $( "#result" ).empty().append( "Scores added successfully." );
//                        $( "#playername").val("");
                        $( "#result").hide().fadeIn( 1000 ).delay( 3000 ).fadeOut( 1000 );
                        resetForm();
                    });

                    posting.fail(function( data ) {
                        $( "#result" ).empty().append( "Not good..." );
                        $( "#result").hide().fadeIn( 1000 );
                    });
                }
            });

        </script>

<?php

    include('footer.php');

?>