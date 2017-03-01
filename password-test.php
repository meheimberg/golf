<?php

    $page_title = "Golf Scores";
    include('header.php');

    include('players-query.php');
    include('courses-query.php');

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
            <div class="col-md-6 box">

                <h2>Password Testerator</h2>
                

                <div id="players-container">

                	<div class="form-group">

                            
                    	<div class="player">

                    <?php

                        

                        $pw_query = "SELECT password FROM players WHERE id = '4'";
                        $pw_result = mysqli_query($link, $pw_query);
                        
//                         echo "result = " . print_r($pw_result) . "<br />";
                        
                        $pw_row = mysqli_fetch_array($pw_result);

// 						echo "result = " . $pw_row[0];
						
						// Get the password from the database and compare it to a variable (for example post)
						
						
						
						
						$options = [
						    'cost' => 11,
						];
					
						
						$passwordFromPost = "Jeepster!918";
						
						echo "localHash = " . $passwordFromPost . "<br />";
						
						$hashedPasswordFromDB = $pw_row[0];
						
						echo "dbHash = " . $hashedPasswordFromDB. "<br />";
						
						if (password_verify($passwordFromPost, $hashedPasswordFromDB)) {
						    echo 'Password is valid!';
						} else {
						    echo 'Invalid password.';
						}
						

                        
                    ?>

                        </div>
                    </div>
                    <div class="clear"></div>

                </div>

            </div>

            <div class="col-md-3 box">

<!-- Courses -->
                



        </div>

    
<?php

//     include('footer.php');

?>