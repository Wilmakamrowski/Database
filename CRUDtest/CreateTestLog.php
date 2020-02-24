<?php
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $test = isset($_POST['test']) ? $_POST['test'] : '';     
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Insert new record into the AirCraft table
    $stmt = $pdo->prepare('INSERT INTO AirCraft VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $name, $test, $created]);
   
    
}
?>
<div class="content update">	
    <form action="createItem.php" method="post">             
        <input type="text" name="id" placeholder="69" value="auto" id="id">
        <input type="text" name="test" placeholder="Mr." id="test">        
        <input type="text" name="AirCraftSerialNumber" placeholder="AirCraftSerialNumber" id="AirCraftSerialNumber">                
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
