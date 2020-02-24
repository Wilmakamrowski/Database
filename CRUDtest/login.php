<?php
include 'GuestFunctions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>

<div class="wrapper">
    <form action="check.php" method="post">
        <h1 class="text-center">Login</h1>
        <?php if ( isset( $login_status ) && false == $login_status ) : ?>
        <div class="error">
            <p>Your username and password are incorrect. Try again.</p>
        </div>
        <?php endif; ?>
        <input type="text" class="text" name="username" placeholder="Enter username">
        <input type="password" class="text" name="password" placeholder="Enter password">
        <input type="submit"  value="Submit">        
        <a type="submit" href="Guestindex.php" class="button">GuestLogin</a>

    </form>
</div>

