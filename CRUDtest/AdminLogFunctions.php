<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'cs2s.yorkdc.net';
    $DATABASE_USER = 'william.hill1';
    $DATABASE_PASS = '#///';
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
    		<h1>YAM ADMIN DATABASES</h1>
            <a href="AdminLogIndex.php"><i class="fas fa-home"></i>Home</a>
            <a href="AdminDonatorLog.php"><i class="fas fa-hand-holding-usd"></i>Donator Log</a>
            <a href="AdminAircraftLog.php"><i class="fas fa-rocket"></i>Aircraft Log</a>
            <a href="AdminItemLog.php"><i class="fas fa-gift"></i>Item Log</a>
            <a href="Adminindex.php"><i class="fas fa-table"></i>Databases</a>            
    	</div>
    </nav>
EOT;
}


function template_footer() {
echo <<<EOT
<style>
         .button {
         background-color: #c91c44;
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
    <a href="logout.php" class="button">Click Here to Logout</a>
    </div>
   
</html>
EOT;
}
?>
