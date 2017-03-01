<?php
	
	session_set_cookie_params(0);
    session_start();
    
    if (!$_SESSION['username'] && basename($_SERVER['PHP_SELF']) != "index.php")
		header('Location: index.php');
		
?>
    <!doctype html>
    <html>
    <head>
        <title><?=$page_title;?></title>

        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

		<link href="css/custom.css" rel="stylesheet"/>
        <link href="styles.css" media="screen"  rel="stylesheet" />
        <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		
		 
        <script src="js/jquery-1.11.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    </head>

    <body>

<?php
    include('connection.php');
?>

    <div id="header-nav">
		<?php include('menu.php'); ?>	
    </div>
    
    
    <div id="container">
