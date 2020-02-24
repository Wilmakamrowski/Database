<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'cs2s.yorkdc.net';
    $DATABASE_USER = 'william.hill1';
    $DATABASE_PASS = '#William1';
    $DATABASE_NAME = 'williamhill1_will';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to database!');
    }
}
function template_header($guest) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$guest</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>YAM GUEST DATABASES</h1>
            <a href="Guestindex.php"><i class="fas fa-home"></i>Home</a>
            <a href="GuestDonator.php"><i class="fas fa-hand-holding-usd"></i>Donator</a>
            <a href="GuestAircraft.php"><i class="fas fa-rocket"></i>Aircraft</a>
            <a href="GuestItem.php"><i class="fas fa-gift"></i>Item</a>            
    	</div>
    </nav>
EOT;
}


function template_footer() {
echo <<<EOT
<style>
         .button {
         background-color: #32CD32;
         border: none;
         color: white;
         padding: 20px 34px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 20px;
         margin: 4px 2px;
         cursor: pointer;
         }
      </style>
   </head>
    <div>
    <a href="login.php" class="button">Click Here to Login</a>
    </div>
   
</html>
EOT;
}
?>