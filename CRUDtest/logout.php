<?php
session_start();
session_destroy();

include('header.php');
?>
<div class="wrapper text-center">
    <h1>You Are Now Logged Out</h1>
    <p>Click <a href="check.php">here</a> to log back in.</p>
</div>
<?php include('footer.php'); ?>