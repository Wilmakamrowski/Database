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
    $Title = isset($_POST['Title']) ? $_POST['Title'] : '';
    $FirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
    $SecondName = isset($_POST['SecondName']) ? $_POST['SecondName'] : '';
    $AdressLine1 = isset($_POST['AdressLine1']) ? $_POST['AdressLine1'] : '';
    $PostCode = isset($_POST['PostCode']) ? $_POST['PostCode'] : '';
    $Town = isset($_POST['Town']) ? $_POST['Town'] : '';
    $County = isset($_POST['County']) ? $_POST['County'] : '';
    $Country = isset($_POST['Country']) ? $_POST['Country'] : '';
    $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Insert new record into the Donator table
    $stmt = $pdo->prepare('INSERT INTO Donator VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $Title, $FirstName, $SecondName, $AdressLine1, $PostCode, $Town, $County, $Country, $PhoneNumber, $created]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Donator')?>

<div class="content update">
	<h2>Create Donator</h2>
    <form action="create.php" method="post">
        <label for="id">id</label>    
        <label for="title">Title</label>        
        <input type="text" name="id" placeholder="69" value="auto" id="id">
        <input type="text" name="Title" placeholder="Mr." id="Title">
        <label for="name">Firstname:</label>
        <label for="name">Secondname:</label>
        <input type="text" name="FirstName" placeholder="FirstName" id="FirstName">
        <input type="text" name="SecondName" placeholder="SecondName" id="SecondName">       
        <label for="text">AdressLine1:</label>
        <label for="text">PostCode:</label>        
        <input type="text" name="AdressLine1" placeholder="22 noob street" id="AdressLine1">
        <input type="text" name="PostCode" placeholder="WF8 1RA" id="PostCode">
        <label for="text">Town:</label>       
        <label for="text">County:</label> 
        <input type="text" name="Town" placeholder="Pontefract" id="Town">
        <input type="text" name="County" placeholder="West Yorkshire" id="County">
        <label for="text">Country:</label>
        <label for="text">PhoneNumber:</label>        
        <input type="text" name="Country" placeholder="England" id="Country">
        <input type="text" name="PhoneNumber" placeholder="01922808663" id="PhoneNumber">    
        <label for="created">Created at --- ></label>       
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>