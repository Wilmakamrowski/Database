<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $AircraftName = isset($_POST['AircraftName']) ? $_POST['AircraftName'] : '';
    $AirCraftSerialNumber = isset($_POST['AirCraftSerialNumber']) ? $_POST['AirCraftSerialNumber'] : '';
    $AirCraftDetails = isset($_POST['AirCraftDetails']) ? $_POST['AirCraftDetails'] : '';    
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Insert new record into the AirCraft table
    $stmt = $pdo->prepare('INSERT INTO AirCraft VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $AircraftName, $AircraftName, $AirCraftDetails, $created]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('AirCraft')?>

<div class="content update">
	<h2>Create AirCraft</h2>
    <form action="createAircraft.php" method="post">
        <label for="id">id</label>    
        <label for="AircraftName">AircraftName</label>        
        <input type="text" name="id" placeholder="69" value="auto" id="id">
        <input type="text" name="AircraftName" placeholder="Planey Mcplane face" id="AircraftName">
        <label for="name">AirCraftSerialNumber:</label>
        <label for="name">AirCraftDetails:</label>
        <input type="text" name="AirCraftSerialNumber" placeholder="AirCraftSerialNumber" id="AirCraftSerialNumber">
        <input type="text" name="AirCraftDetails" placeholder="AirCraftDetails" id="AirCraftDetails">      
        <label for="created">Created at --- ></label>       
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>