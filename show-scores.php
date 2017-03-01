<?php

    $page_title = "Golf Scores";
    include('header.php');

    $players = $_GET['players'];
    $course = $_GET['course'];
    
    $year = date('Y');
    $endyear = date("Y", strtotime("2012-01-01"));

?>
		<style>
			
			.update {
/*
				border-radius: 18px;
				border-bottom-left-radius: 0px;
				padding: 9px;
				text-align: center;
*/
			}
			
			#update-success {

				display: none;

			}
			
			#round-update {

				display: none;

			}
			
			
			.arrow-div {
				position: absolute;
				background: #bcd096;
				border: 2px solid #77b700;
				padding: 9px;
			}
			.arrow-div:after, .arrow-div:before {
				right: 100%;
				top: 50%;
				border: solid transparent;
				content: " ";
				height: 0;
				width: 0;
				position: absolute;
				pointer-events: none;
			}
			
			.arrow-div:after {
				border-color: rgba(188, 208, 150, 0);
				border-right-color: #bcd096;
				border-width: 10px;
				margin-top: -10px;
			}
			.arrow-div:before {
				border-color: rgba(119, 183, 0, 0);
				border-right-color: #77b700;
				border-width: 13px;
				margin-top: -13px;
			}
			
			.refine-by {
				float: left;
				margin-top: 25px; 
				margin-left: 200px;
			}
			
			.header {
				float: left;
			}
				
		</style>
		
		
		
        <div class="row">
            <div class="col-md-2 box"></div>
            <div class="col-md-8 box">
                <h1>Golf Scores</h1>
            </div>
            <div class="col-md-2 box"></div>
        </div>

<!-- Players -->
        <div class="row">
            <div class="col-md-2 box"></div>
            <div class="col-md-8 box">
				

		        <?php
		
		            foreach($players as $player):
		
		                $player_query = "SELECT p.name FROM players p WHERE p.id = '" . $player . "';";
		                $player_result = mysqli_query($link, $player_query);
		                $player_row = mysqli_fetch_array($player_result);
		
		                $course_query = "SELECT c.course_name FROM courses c WHERE c.id = '" . $course . "';";
		                $course_result = mysqli_query($link, $course_query);
		                $course_row = mysqli_fetch_array($course_result);
		
		                $holes_query = "SELECT * FROM holes h LEFT JOIN courses c ON h.course_id = c.id WHERE c.id = '" . $course . "'";
		                $holes_result = mysqli_query($link, $holes_query);
		
		                $par = 0;
		                $yardage = 0;
		                $hole_count = 0;
		
		                $holes_array = Array();
		
		                while ($row = mysqli_fetch_array($holes_result)) {
		                    array_push($holes_array, $row);
		                }
		
		        ?>
        		
					<div class="header">
	                	<h2><?=$player_row['name'];?> - <?=$course_row['course_name'];?></h2>
					</div>
        	
				
					<div class="refine-by">
						Refine by: 
		                <select name="year" id="year">
			                <?php 
				            	while ($year >= $endyear) :
					        ?>
					        	<option><?=$year;?>		
					        <?php
					            	$year--;
				            	endwhile;  
				            ?>    
		                </select>
	                </div>
					<div class="clear"></div>
				
		
			</div>		
			<div class="col-md-2 box"></div>
		</div>	
			
		<div class="row">
            <div class="col-md-2 box"></div>
            <div class="col-md-8 box">
				
				<div class="arrow-div" id="update-success">Score Update Saved.</div>
				<div class="arrow-div" id="round-update">Round Total Updated.</div>
				
<!-- Holes -->
                <div class="hole-number row-lead"><?=$player_row['name'];?></div>

                <?php
//                    print_r($holes_result);

                    foreach ($holes_array as $hole):
                ?>

                    <div class="hole-number">

                        <?php
                            echo($hole['hole']);
                            $par += $hole['par'];
                        ?>

                    </div>

                    <?php
                    $hole_count++;
                    endforeach;
                ?>


                <div class="hole-number end-of-row">Total</div>

                <div class="clear"></div>


<!-- Yardage -->
                <div class="strokes row-lead hole-info">White</div>

                <?php
                    //print_r($holes_result);
                    //while ($row = mysqli_fetch_array($holes_result)):
                    foreach ($holes_array as $hole):

                ?>
                    <div class="strokes hole-info">

                        <?php
                            echo($hole['yards']);
                            $yardage += $hole['yards'];
                        ?>

                    </div>

                <?php
                    endforeach;
                ?>

                <div class="strokes hole-info end-of-row"><?=$yardage;?></div>

                <div class="clear"></div>


<!-- Par -->
                <div class="strokes row-lead hole-info">Par</div>

                <?php
                    foreach ($holes_array as $hole):
                ?>

                    <div class="strokes hole-info">

                        <?php

                            echo($hole['par']);
                        ?>

                    </div>

                <?php
                    endforeach;
                ?>

                <div class="strokes hole-info end-of-row"><?=$par;?></div>

                <div class="clear"></div>


<!-- Player Strokes -->
                <?php

                    include ('stroke-info.php');

                endforeach;

            ?>
            </div>

            <div class="col-md-2 box"></div>
        </div>



<?php

    include('footer.php');

?>
