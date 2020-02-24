<?php
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>

<div class="content">
    <h1>Welcome <?php echo $user['name']; ?></h1>    
</div>

<?=template_footer()?>