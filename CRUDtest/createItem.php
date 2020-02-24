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
    $ItemName = isset($_POST['ItemName']) ? $_POST['ItemName'] : '';
    $Class = isset($_POST['Class']) ? $_POST['Class'] : '';
    $DateRecieved = isset($_POST['DateRecieved']) ? $_POST['DateRecieved'] : date('Y-m-d H:i:s');
    $$DateToReturn = isset($_POST['DateToReturn']) ? $_POST['DateToReturn'] : date('Y-m-d H:i:s');
    $Description = isset($_POST['Description']) ? $_POST['Description'] : '';
    $$LastAssessed = isset($_POST['LastAssessed']) ? $_POST['LastAssessed'] : date('Y-m-d H:i:s'); 
    $ItemCondition = isset($_POST['ItemCondition']) ? $_POST['ItemCondition'] : '';
    $ConditionComments = isset($_POST['ConditionComments']) ? $_POST['ConditionComments'] : '';
    $Donator_idDonator = isset($_POST['Donator_idDonator']) ? $_POST['Donator_idDonator'] : '';   
    $AirCraft_idAirCraft = isset($_POST['AirCraft_idAirCraft']) ? $_POST['AirCraft_idAirCraft'] : '';
    $ItemState = isset($_POST['ItemState']) ? $_POST['ItemState'] : '';          
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Insert new record into the AirCraft table
    $stmt = $pdo->prepare('INSERT INTO Item VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $ItemName, $Class, $DateRecieved, $DateToReturn, $Description, $LastAssessed, $ItemCondition, $ConditionComments, $Donator_idDonator, $AirCraft_idAirCraft, $ItemState, $created]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Item')?>

<div class="content update">
	<h2>Create Item</h2>
    <form action="createItem.php" method="post">
        <label for="id">id</label>    
        <label for="ItemName">ItemName</label>        
        <input type="text" name="id" placeholder="69" value="auto" id="id">
        <input type="text" name="ItemName" placeholder="Mr." id="ItemName">
        <label for="name">Class:</label>
        <label for="name">DateRecieved:</label>
        <input type="text" name="Class" placeholder="Class" id="Class">
        <input type="datetime-local" name="DateRecieved" value="<?=date('Y-m-d\TH:i')?>" id="DateRecieved">  
        <label for="name">DateToReturn:</label>
        <label for="name">Description:</label>
        <input type="datetime-local" name="DateToReturn" value="<?=date('Y-m-d\TH:i')?>" id="DateToReturn">
        <input type="text" name="Description" placeholder="Description" id="Description"> 
        <label for="name">LastAssessed:</label>
        <label for="name">ItemCondition:</label>
        <input type="datetime-local" name="LastAssessed" value="<?=date('Y-m-d\TH:i')?>" id="LastAssessed">
        <input type="text" name="ItemCondition" placeholder="ItemCondition" id="ItemCondition">
        <label for="name">ConditionComments:</label>
        <label for="name">Donator_idDonator:</label>  
        <input type="text" name="ConditionComments" placeholder="ConditionComments" id="ConditionComments">
        <input type="text" name="Donator_idDonator" placeholder="Donator_idDonator" id="Donator_idDonator">
        <label for="name">AirCraft_idAirCraft:</label>  
        <label for="name">ItemState:</label>
        <input type="text" name="AirCraft_idAirCraft" placeholder="AirCraft_idAirCraft" id="AirCraft_idAirCraft">
        <input type="text" name="ItemState" placeholder="ItemState" id="ItemState">          
        <label for="created">Created at --- ></label>       
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>