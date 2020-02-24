<?php
include 'AdminFunctions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the AirCraft id exists, for example update.php?id=1 will get the AirCraft with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;          
    $AircraftName = isset($_POST['AircraftName']) ? $_POST['AircraftName'] : '';
    $AirCraftSerialNumber = isset($_POST['AirCraftSerialNumber']) ? $_POST['AirCraftSerialNumber'] : '';
    $AirCraftDetails = isset($_POST['AirCraftDetails']) ? $_POST['AirCraftDetails'] : '';    
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Update the record
    $stmt = $pdo->prepare('UPDATE AirCraft SET id = ?, AircraftName = ?, AirCraftSerialNumber = ?, AirCraftDetails = ?, created = ? WHERE id = ?');
    $stmt->execute([$id, $AircraftName, $AirCraftSerialNumber, $AirCraftDetails, $created, $_GET['id']]);
    $stmt = $pdo->prepare('INSERT INTO AirCraftLog (idAircraft, AircraftName, AirCraftSerialNumber,AirCraftDetails) VALUES (?,?,?,?)');
    $stmt->execute([$id, $AircraftName, $AirCraftSerialNumber, $AirCraftDetails]);
   
   
    $msg = 'Updated Successfully!';
}
// Get the AirCraft from the Donar table
    $stmt = $pdo->prepare('SELECT * FROM AirCraft WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $AirCraft = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$AirCraft) {
        die ('AirCraft doesn\'t exist with that id!');
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('AirCraft')?>

<div class="content update">
	<h2>Update AirCraft #<?=$AirCraft['id']?></h2>   
    <form action="AdminAircraftUpdate.php?id=<?=$AirCraft['id']?>" method="post">
        <label for="id">id</label>    
        <label for="title">AircraftName</label>        
        <input type="text" name="id" placeholder="1" value="<?=$AirCraft['id']?>" id="id">
        <input type="text" name="AircraftName" placeholder="Mr." value="<?=$AirCraft['AircraftName']?>" id="AircraftName">
        <label for="name">AirCraftSerialNumber:</label>
        <label for="name">AirCraftDetails:</label>
        <input type="text" name="AirCraftSerialNumber" placeholder="AirCraftSerialNumber" value="<?=$AirCraft['AirCraftSerialNumber']?>" id="AirCraftSerialNumber">
        <input type="text" name="AirCraftDetails" placeholder="AirCraftDetails" value="<?=$AirCraft['AirCraftDetails']?>" id="AirCraftDetails">                
        <label for="created">Created at --- ></label>       
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($AirCraft['created'])) ?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>