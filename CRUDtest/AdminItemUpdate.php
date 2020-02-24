<?php
include 'AdminFunctions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the Item id exists, for example update.php?id=1 will get the Item with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;          
    $ItemName = isset($_POST['ItemName']) ? $_POST['ItemName'] : '';
    $Class = isset($_POST['Class']) ? $_POST['Class'] : '';
    $DateRecieved = isset($_POST['DateRecieved']) ? $_POST['DateRecieved'] : '';
    $DateToReturn = isset($_POST['DateToReturn']) ? $_POST['DateToReturn'] : '';
    $Description = isset($_POST['Description']) ? $_POST['Description'] : '';
    $LastAssessed = isset($_POST['LastAssessed']) ? $_POST['LastAssessed'] : '';
    $ItemCondition = isset($_POST['ItemCondition']) ? $_POST['ItemCondition'] : '';
    $ConditionComments = isset($_POST['ConditionComments']) ? $_POST['ConditionComments'] : '';
    $Donator_idDonator = isset($_POST['idDonator']) ? $_POST['idDonator'] : '';
    $AirCraft_idAirCraft = isset($_POST['idAirCraft']) ? $_POST['idAirCraft'] : '';
    $ItemState = isset($_POST['ItemState']) ? $_POST['ItemState'] : '';    
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Update the record
    $stmt = $pdo->prepare('UPDATE Item SET id = ?, ItemName = ?, Class = ?, DateRecieved = ?, DateToReturn = ?, Description = ?, LastAssessed = ?,ItemCondition = ?, ConditionComments = ?, idDonator = ?, idAirCraft = ?, ItemState = ?, created = ? WHERE id = ?');
    $stmt->execute([$id, $ItemName, $Class, $DateRecieved, $DateToReturn, $Description, $LastAssessed, $ItemCondition, $ConditionComments, $Donator_idDonator,$AirCraft_idAirCraft, $ItemState, $created, $_GET['id']]);
    $stmt = $pdo->prepare('INSERT INTO ItemLog (idItem, ItemName, Class, DateRecieved, DateToReturn, Description, LastAssessed, ItemCondition, ConditionComments, Donator_idDonator, AirCraft_idAirCraft, ItemState) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?)');
    $stmt->execute([$id, $ItemName, $Class, $DateRecieved, $DateToReturn, $Description, $LastAssessed, $ItemCondition, $ConditionComments, $Donator_idDonator,$AirCraft_idAirCraft, $ItemState]);


    $msg = 'Updated Successfully!';
}
// Get the Item from the Donar table
    $stmt = $pdo->prepare('SELECT * FROM Item WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $Item = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$Item) {
        die ('Item doesn\'t exist with that id!');
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('Item')?>

<div class="content update">
	<h2>Update Item #<?=$Item['id']?></h2>   
    <form action="AdminItemUpdate.php?id=<?=$Item['id']?>" method="post">
        <label for="id">id</label>    
        <label for="ItemName">ItemName</label>        
        <input type="text" name="id" placeholder="1" value="<?=$Item['id']?>" id="id">
        <input type="text" name="ItemName" placeholder="Mr." value="<?=$Item['ItemName']?>" id="ItemName">
        <label for="name">Class:</label>
        <label for="name">DateRecieved:</label>
        <input type="text" name="Class" placeholder="Class" value="<?=$Item['Class']?>" id="Class">
        <input type="datetime-local" name="DateRecieved" value="<?=date('Y-m-d\TH:i', strtotime($Item['DateRecieved'])) ?>" id="DateRecieved">
        <label for="name">DateToReturn:</label>
        <label for="name">Description:</label>
        <input type="datetime-local" name="DateToReturn" value="<?=date('Y-m-d\TH:i', strtotime($Item['DateToReturn'])) ?>" id="DateToReturn">
        <input type="text" name="Description" placeholder="Description" value="<?=$Item['Description']?>" id="Description">       
        <label for="text">LastAssessed:</label>
        <label for="text">ItemCondition:</label>        
        <input type="datetime-local" name="LastAssessed" value="<?=date('Y-m-d\TH:i', strtotime($Item['LastAssessed'])) ?>" id="LastAssessed">
        <input type="text" name="ItemCondition" placeholder="WF8 1RA" value="<?=$Item['ItemCondition']?>" id="ItemCondition">
        <label for="text">ConditionComments:</label>       
        <label for="text">Donator_idDonator:</label> 
        <input type="text" name="ConditionComments" placeholder="Pontefract" value="<?=$Item['ConditionComments']?>" id="ConditionComments">
        <input type="text" name="idDonator" placeholder="West Yorkshire" value="<?=$Item['idDonator']?>" id="idDonator">
        <label for="text">AirCraft_idAirCraft:</label>
        <label for="text">ItemState:</label>        
        <input type="text" name="idAirCraft" placeholder="England" value="<?=$Item['idAirCraft']?>" id="idAirCraft">
        <input type="text" name="ItemState" placeholder="01922808663" value="<?=$Item['ItemState']?>" id="ItemState">    
        <label for="created">Created at --- ></label>       
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($Item['created'])) ?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>