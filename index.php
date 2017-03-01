<?php

    $page_title = "Golf Scores";
    include('header.php');

    include('players-query.php');
    include('courses-query.php');
    
	if(empty($_SESSION['username'])):
	
    


    

?>


	<div id="overlay"></div>
	
	<div id="login">
		<h2>Login</h2>
		<form class="form" role="form">
			<div class="form-group center">
				<label class="sr-only" for="email">Email</label>
				<input type="text" class="form-control" id="email" placeholder="Email">
			</div>
			<div class="form-group center">
				<label class="sr-only" for="password">Password</label>
				<input type="password" class="form-control" id="password" placeholder="Password">
			</div>
			<div class="form-group center">
				<input type="button" class="btn btn-primary" value="Login" id="login-button">
			</div>
		</form>
		<div id="invalid-login" class="center">
			Invalid email address and/password.
		</div>
	</div>	
	
	<script>
		
		var login = 0;
		
		$('#login').animate( { left: $( window ).width() / 2 - $('#login').width() / 2 }, 0);	
		$('#login').animate( { top: $( window ).height() / 2 - $('#login').height() }, 1000);	
		
		$('#login-button').click( function() {
			
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var validEmail = regex.test($('#email').val());
			
			if (!validEmail || $('#email').val() == "Email") {
				$('#email').animate( {borderColor: '#df0032'});
				login = false;
			} else {
				login++;
				console.log("login = " + login);
			}
			
			
			if ($('password').val() == "" || $('#email').val() == "Password" || $('#password').val().length < 8) {
				$('#password').animate( {borderColor: '#df0032', color: '#df0032'});
				login = false;
			} else {
				login++;
				console.log("login = " + login);
			}
			
			if(login >= 2) {
				console.log("Entered login");
				$.ajax({
		            type: 'POST',
		            url: 'user-login-action.php',
		            data: { email:$('#email').val(), password:$('#password').val() },
		            
		            success: function (data) {
						
						$('#login').animate( {top: -300 }, 1000);
						$('#overlay').fadeOut(1500).delay(1500).animate(location.reload(),0);
//   						$('#header-nav').html("");


// 						$("#header-nav").load("./menu.php");
// 						$("#header-nav").html('<object data="./menu.php">');
// 						$("#header-nav").load('menu.php');

						
						
		
		            },
// 		            dataType: "json",
		            error: function (data) {
		                console.log("failure " + JSON.stringify(data));
		                $('#invalid-login').fadeIn(1000);
		            }
		    	});
			}
			
		});
		
		$('#email').click( function() {
			$('#email').animate( {borderColor: '#ccc', color: '#555'});
		});
		
		$('#password').click( function() {
			$('#password').animate( {borderColor: '#ccc', color: '#555'});
		});
		
		$('#password').change( function() {
			$('#invalid-login').fadeOut(1000);
		});
		
		

		
	</script>
	
	

<?php
	
	endif;
	
?>

        <div class="row">
            <div class="col-md-3 box"></div>
            <div class="col-md-6 box">
                <h1>Golf Scores</h1>
            </div>
            <div class="col-md-3 box"></div>
        </div>

<!-- Players -->
        <div class="row">
            <div class="col-md-3 box"></div>
            <div class="col-md-3 box">

                <h2>Select Players</h2>
                <form id="getscores" name="getscores" method="get" action="show-scores.php">

                <div id="players-container">

                    <div class="" id="players-group-error">
                        You must choose a player.
                    </div>

                <?php

                    while ($row =  mysqli_fetch_array($players_result)):

                ?>
                    <div class="form-group">

                            <input type="checkbox" name="players[]" id="player<?=$row['id'];?>" value="<?=$row['id'];?>" class="checkbox"  onchange="resetField('players[]'); updateRounds(<?=$row['id'];?>)" >
                            <div class="player">

                    <?php

                        echo($row['name']);
                        $rounds_query = "SELECT COUNT(*) FROM scores WHERE player_id = '" . $row['id'] . "'";
                        $rounds_result = mysqli_query($link, $rounds_query);
                        $rounds_row = mysqli_fetch_array($rounds_result);

                        echo " <span class=\"rounds-number\">(" . $rounds_row[0] / 9 . " Round";
	                    if ( (int)$rounds_row[0] / 9 > 1 ) {
	                    	echo "s"; 	
	                    }
                        echo ")</span>";
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
                <h2>Select Courses</h2>
                <div id="courses-container">

                    <div class="" id="courses-group-error">
                        You must choose a course.
                    </div>

                    <?php

                        $courses_array = Array();
                        while ($row = mysqli_fetch_array($courses_result)):
                            array_push($courses_array, $row['id']);

                    ?>
                        <div class="form-group" id="course<?=$row['id'];?>radio">

                            <input type="radio" name="course" value="<?=$row['id'];?>" class="checkbox"  onchange="resetField('courses');" disabled="disabled" />
                            <div class="player disabled" id ="course-group-<?=$row['id'];?>">

                                <?php

                                    echo($row['course_name']);


                                ?>
                                <span class="rounds-number" id="course<?=$row['id'];?>"></span>
                            </div>
                        </div>
                        <div class="clear"></div>

                    <?php
                        endwhile;
                    ?>
                    </div>

            </div>

            <div class="col-md-3 box"></div>
        </div>

        <div class="row">
            <div class="col-md-3 box"></div>
            <div class="col-md-6 box showscores">
                <div class="form-group">
                    <button id="view_scores" type="submit" class="btn btn-success float">View Scores</button>
                </div>
                </form>
            </div>
            <div class="col-md-3 box"></div>
        </div>

    <script type="text/javascript">

        // global data on courses with activity
        <?php

            foreach ($courses_array as $course):

        ?>
                var course_<?=$course;?>_rounds = 0;
        <?php
            endforeach;
        ?>

        function validate_form() {

            var error = 0;

            var players = document.getElementsByName('players[]');

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

            return error;

        }

        function resetField(field) {
            if (field == "players[]") {
                $( "#players-group-error" ).fadeOut( 1000 );
                $( "#players-container" ).stop(true,false).removeClass('error', {duration:1000});
            } else if (field == "courses") {
                $( "#courses-group-error" ).fadeOut( 1000 );
                $( "#courses-container" ).stop(true,false).removeClass('error', {duration:1000});
            }
        }

        $( "#getscores" ).submit(function( event ) {

            event.preventDefault();

            errorVal = validate_form();


            if (errorVal == 0) {
                document.getscores.submit();
            }
        });

        function updateRounds(player_id) {

            var checkbox = document.getElementById("player" + player_id);

            var ids = new Array();
            <?php

                foreach ($courses_array as $course) :

            ?>

                ids.push(<?=$course;?>);

            <?php
                endforeach;
            ?>

                var request = $.ajax({
                    method: "POST",
                    url: "rounds-query.php",
                    data: {ids: ids, player: player_id},
                    dataType: "html",
                });

                request.success(function (data) {

                    updatePlayerRounds(data, checkbox);

                });
        }


        function updatePlayerRounds(data, checkbox) {

                var jsonData = JSON.parse(data);

                <?php
                    $loop = 0;
                    foreach ($courses_array as $course) :
                ?>

                    var holes = jsonData[<?=$loop;?>];
                    var rounds = holes / 9;

                    if (checkbox.checked)
                        course_<?=$course;?>_rounds += rounds;
                    else
                        course_<?=$course;?>_rounds -= rounds;

                    console.log(course_<?=$course;?>_rounds + " | " + rounds);

                    var roundsTextDivId = "#course<?=$course;?>";// + ids[ii];
                    var courseWrapperDivId = "#course-group-<?=$course;?>";//" + ids[ii];


                    if (course_<?=$course;?>_rounds > 0) {

                        $(courseWrapperDivId).removeClass("disabled");
                        $('#course<?=$course;?>radio input:radio').removeAttr('disabled');
                        var roundslabel;
                        	if(course_<?=$course;?>_rounds > 1) 
                        		roundslabel = "rounds";
                        	else 
                        		roundslabel = "round";
                        
                        $(roundsTextDivId).html("(" + course_<?=$course;?>_rounds + " " + roundslabel + ")");
                        
/*
                        if ( (int)course_<?=$course;?>_rounds > 1 ) {
	                    	$(roundsTextDivId).html("(" + course_<?=$course;?>_rounds + " rounds");
	                    } else {
		                    $(roundsTextDivId).html("(" + course_<?=$course;?>_rounds + " round");
	                    }
						$(roundsTextDivId).html($(roundsTextDivId).html + ")"); 
*/	
                        //echo ")</span>";

                    } else {
                        $(courseWrapperDivId).addClass("disabled");
                        $('#course<?=$course;?>radio input:radio').attr('disabled');
                        $(roundsTextDivId).html("");
                    }


                <?php
                    $loop++;
                    endforeach;
                ?>

        }

    </script>

<?php

    include('footer.php');

?>