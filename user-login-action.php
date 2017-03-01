<?php
	
	session_start();
	
	include('connection.php');

    $email  	= $_POST['email'];
    $password   = $_POST['password'];

//     error_log("email = " . $email, 0);
//     error_log("password = " . $password, 0);

    $pw_query  = "SELECT password, access FROM players WHERE email = '" . $email . "'";
    $pw_result = mysqli_query($link, $pw_query);
    
    $pw_row = mysqli_fetch_array($pw_result);
    
//     error_log("pw_row = " . print_r($pw_row), 0);
    
	$options[] = [
	    'cost' => 11,
	];
					
						
	$hashedPasswordFromDB = $pw_row['password'];
	$access = $pw_row['access'];
	
// 	error_log("hashedPasswordFromDB = " . $hashedPasswordFromDB, 0);
	
	if (password_verify($password, $hashedPasswordFromDB)) {
// 		error_log("Passwords match");
		$_SESSION['username'] = $email;
		$_SESSION['access'] = $access;
		die("OK");
	} else {
// 		error_log("Passwords do not match");
	    return false;
	}