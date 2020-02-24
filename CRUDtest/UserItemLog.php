<?php
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>

<body>
<h1>Confirm Your details to continue to admin only zone</h1>
		<form>
			<input type="text" id="username" placeholder="Choose Username">
			<input type="password" id="password" placeholder="Choose Password">
			<button type="button" onclick="getInfo()">Login</button>
		</form>

		<script src="main.js"></script>
	</body>

    <?=template_footer()?>
