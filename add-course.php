<?php

	$page_title = "Add a Golf Course";
	include('header.php');
	define("HOLES", "18");
	
	$holes = 9;

?>

<div class="row">
    <div class="col-md-2 box"></div>
    <div class="col-md-8 box">

        <h1>Add Courses</h1>

        <div id="coursename-container">

            <div class="" id="coursename-group-error">
                You must enter a course name.
            </div>

        <form id="add_courses" method="post" action="add-course-action.php">

            <div class="form-group">
                <input type="text" id="coursename" name="coursename" placeholder="Course name" class="form-control maxwidth" onchange="resetField('coursename')" />
            </div>
            
            <div class="container">
				<ul>
					<li>
						<input type="radio" id="9holes" name="numholes" onchange="resetField('9holes')" checked="checked" />
						<div class="check"></div>
						<label for="9holes">9 Holes</label>
					</li>
					<li>
						<input type="radio" id="18holes" name="numholes" onchange="resetField('18holes')" />
						<div class="check"></div>
						<label for="18holes">18 Holes</label>
					</li>
				</ul>
			</div>
			

			<div class="container">
				<ul>
					<li>
						<input type="radio" id="golf" name="golftype" onchange="resetField('golf')" checked="checked" />
						<div class="check"></div>
						<label for="golf">Golf</label>
					</li>
					<li>
						<input type="radio" id="minigolf" name="golftype" onchange="resetField('minigolf')" />
						<div class="check"></div>
						<label for="minigolf">Mini Golf</label>
					</li>
				</ul>
			</div>
			
        </div>
    </div>

    <div class="col-md-2 box"></div>
</div>


<!-- Hole Labels -->
<div class="row padme">
<!--     <div class="col-md-2 box"></div> -->
    <div class="col-md-12 box">
        <h2>Strokes</h2>
        <div class="form-group">
            <div class="float hole-input-label">
                Hole
            </div>
            <?php
                for ($ii = 1; $ii <= HOLES; $ii++):
            ?>
            <div class="float hole-label-wide <?php echo($ii > 9 ? 'hideme' : ''); ?>">
                <?=$ii;?>
            </div>
            <?php
                endfor;
            ?>
            <div class-"clear"></div>
        </div>
    </div>
<!--     <div class="col-md-2 box"></div> -->
</div>

<!-- Par -->
<div class="row padme">
<!--     <div class="col-md-2 box"></div> -->
    <div class="col-md-12 box">
        <div class="form-group">
            <div class="float hole-input-label">
                Par
            </div>

            <?php
                for ($ii = 1; $ii <= HOLES; $ii++):
            ?>
            <div class="form-input <?php echo($ii > 9 ? 'hideme' : ''); ?>">
            <?php
                $id = "par_" . $ii;
            ?>
                <input type="text" name="<?=$id;?>"  id="<?=$id;?>" class="par-input" value="" onchange="resetField('<?=$id;?>')" />
            </div>
            <?php
                endfor;
            ?>
            <div class-"clear"></div>
        </div>
    </div>
<!--     <div class="col-md-2 box"></div> -->
</div>

<!-- Yardage -->
<div class="row padme" id="yardage">
<!--     <div class="col-md-2 box"></div> -->
    <div class="col-md-12 box">
        <div class="form-group">
            <div class="float hole-input-label">
                Yards
            </div>

            <?php
                for ($ii = 1; $ii <= HOLES; $ii++):
            ?>
            <div class="form-input <?php echo($ii > 9 ? 'hideme' : ''); ?>">
            <?php
                $id = "yards_" . $ii;
            ?>
                <input type="text" name="<?=$id;?>"  id="<?=$id;?>" class="yards-input" value="" onchange="resetField('<?=$id;?>')" />
            </div>
            <?php
                endfor;
            ?>
            <div class-"clear"></div>
        </div>
    </div>
<!--     <div class="col-md-2 box"></div> -->
</div>

<div class="row">
    <div class="col-md-3 box"></div>
    <div class="col-md-6 box">
        <div class="form-group addcourse">
            <button id="addCourseButton" type="submit" class="btn btn-success addcourse">Add Course</button>
        </div>
        <div id="result" class="result">Foo</div>
    </form>
    </div>

    <div class="col-md-3 box"></div>
</div>

<script type="text/javascript">

            function validate_form() {


                var error = 0;

                var course = document.getElementById('coursename');

                if (course.value == "" || !course.value) {
                    error++;
                    $( "#coursename-group-error").hide().fadeIn( 1000 );
                    $("#coursename-container").stop(true,false).addClass('error', {duration:1000});
                }


                for (var ii = 1; ii <= <?php echo $holes; ?>; ii++ ) {

                    var field = document.getElementById("par_"+ii);

                    if (field.value == "" || field.value == null || field.value < 1) {

                        error++;

                        $( "#"+field.id ).stop(true,false).addClass('error', {duration:1000});

                    }
                }

                 for (var ii = 1; ii <= 9; ii++ ) {

                    var field = document.getElementById("yards_"+ii);

                    if (field.value == "" || field.value == null || field.value < 1) {

                        error++;

                        $( "#"+field.id ).stop(true,false).addClass('error', {duration:1000});

                    }
                }

                return error;

            }

            function resetField(field) {
                if (field == "coursename") {
                    $( "#coursename-group-error" ).fadeOut( 1000 );
                    $( "#coursename-container" ).stop(true,false).removeClass('error', {duration:1000});
                } else {
                    $( "#"+field ).stop(true,false).removeClass('error', {duration:1000});
                }
            }

            function resetForm() {

                var coursename = document.getElementById('coursename');
                coursename.value = "";

                for (var ii = 1; ii <= $holes; ii++) {
                    document.getElementById("par_" + ii.toString()).value = '';
                }

                for (var ii = 1; ii <= $holes; ii++) {
                    document.getElementById("yards_" + ii.toString()).value = '';
                }
            }

            //$("#addplayerButton").click(function(event) {
            $( "#add_courses" ).submit(function( event ) {

                event.preventDefault();
				errorVal = validate_form();

				if (errorVal == 0) {

                    var coursename = document.getElementById('coursename').value;

                    var parArray = new Array();
                    for (var ii = 0; ii < $holes; ii++) {

                        parArray[ii] = document.getElementById("par_"+(ii + 1)).value;

                    }

                    var yardsArray = new Array();
                    for (var ii = 0; ii < $holes; ii++) {

                        yardsArray[ii] = document.getElementById("yards_"+(ii + 1)).value;

                    }

                    var $form = $( this ), url = $form.attr( "action" );

                    var posting = $.post( url, { course: coursename, par: parArray, yards: yardsArray} );

                    posting.done(function( data ) {
                        $( "#result" ).empty().append( "Course added successfully");
                        $( "#result").hide().fadeIn( 1000 ).delay( 3000 ).fadeOut( 1000 );
                        resetForm();
                    });

                    posting.fail(function( data ) {
                        $( "#result" ).empty().append( "Not good..." );
                        $( "#result").hide().fadeIn( 1000 );
                    });
                }
            });
            
            $('#18holes').click(function(){
	            console.log("#18holes clicked");
	        	$('.hideme').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0},1000);
				<?php $holes = 18; ?>
				$('#18holes').unbind('click', function() { return false; });
				$("#9holes").bind('click', function() { return true; });
				
            });
            
            $('#9holes').click(function(){
	            console.log("#9holes clicked");
	        	$('.hideme').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0.0},1000);
				<?php $holes = 9; ?>
				$('#9holes').unbind('click', function() { return false; });
				$("#18holes").bind('click', function(){ return true; });
				
            });
            
            $('#golf').click(function(){
	        	$('#yardage').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0},1000);
	        	$('#golf').unbind('click');
				$("#minigolf").bind('click', function(){ return false; });
            });
            
            $('#minigolf').click(function(){
	        	$('#yardage').css({opacity: 1.0, visibility: "visible"}).animate({opacity: 0.0},1000);
	        	$('#minigolf').unbind('click');
				$("#golf").bind('click', function(){ return false; });
            });
			
			
            
            

        </script>

<?php

include('footer.php');

?>