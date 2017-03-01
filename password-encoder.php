<?php

	$options = [
	    'cost' => 11,
	];

	echo "Ernie:\t\t"    . password_hash("usma1967", PASSWORD_BCRYPT, $options)."\n<br />";
	echo "Mark:\t\t"     . password_hash("Jeepster!918", PASSWORD_BCRYPT, $options)."\n<br />";
	echo "Jonathan:\t"   . password_hash("LegoMan1014", PASSWORD_BCRYPT, $options)."\n<br />";
	echo "Bill:\t"       . password_hash("PulledPork825", PASSWORD_BCRYPT, $options)."\n<br />";
	echo "Dana:\t"       . password_hash("FinestKind712", PASSWORD_BCRYPT, $options)."\n<br />";
// 	echo "Steve:"    . password_hash("fsc1993", PASSWORD_DEFAULT)."\n<br />";
// 	echo "Marla:"    . password_hash("fsc1993", PASSWORD_DEFAULT)."\n<br />";


// $hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $options);

// Now insert it (with login or whatever) into your database, use mysqli or pdo!
// Get the password hash:

// Get the password from the database and compare it to a variable (for example post)
// $passwordFromPost = $_POST['password'];
/*
$hashedPasswordFromDB = $hash;

if (password_verify($passwordFromPost, $hashedPasswordFromDB)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
*/




?>