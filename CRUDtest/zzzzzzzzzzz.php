<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the Item id exists, for example update.php?id=1 will get the Item with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;          
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $secondname = isset($_POST['secondname']) ? $_POST['secondname'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $addr1 = isset($_POST['addr1']) ? $_POST['addr1'] : '';
    $town = isset($_POST['town']) ? $_POST['town'] : '';
    $county = isset($_POST['county']) ? $_POST['county'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $Postcode = isset($_POST['Postcode']) ? $_POST['Postcode'] : '';
    $PhoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : '';
    $ServiceNumber  = isset($_POST['$ServiceNumber ']) ? $_POST['$ServiceNumber '] : '';      
    // Update the record
    $stmt = $pdo->prepare('UPDATE Donators  SET id = ?, title = ?, firstname = ?, secondname = ?, surname = ?, addr1 = ?, town = ?,county = ?, country = ?, Postcode = ?, PhoneNumber = ?, $ServiceNumber = ? WHERE id = ?');
    $stmt->execute([$id, $title, $firstname, $secondname, $surname, $addr1, $town, $county, $country, $Postcode, $PhoneNumber, $$ServiceNumber ,  $_GET['id']]);
    // $stmt = $pdo->prepare('INSERT INTO ItemLog (idItem, title, Class, secondname, DateToReturn, Description, LastAssessed, ItemCondition, ConditionComments, Donator_idDonator, AirCraft_idAirCraft, ItemState) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,?)');
    // $stmt->execute([$id, $title, $Class, $DateRecieved, $DateToReturn, $Description, $LastAssessed, $ItemCondition, $ConditionComments, $Donator_idDonator,$AirCraft_idAirCraft, $ItemState]);


    $msg = 'Updated Successfully!';
}
// Get the Item from the Donar table
    $stmt = $pdo->prepare('SELECT * FROM Donators WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $Donators  = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$Donators ) {
        die ('Item doesn\'t exist with that id!');
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Donators  #<?=$Item['id']?></h2>   
    <form action="updateItem.php?id=<?=$Item['id']?>" method="post">
        <label for="id">id</label>    
        <label for="ItemName">title</label>        
        <input type="text" name="id" placeholder="1" value="<?=$Item['id']?>" id="id">
        <input type="text" name="title" placeholder="Mr." value="<?=$Item['title']?>" id="title">
        <label for="name">firstname:</label>
        <label for="name">secondname:</label>
        <input type="text" name="Class" placeholder="firstname" value="<?=$Item['firstname']?>" id="firstname">
        <input type="datetime-local" name="secondname" value="<?=date('Y-m-d\TH:i', strtotime($Item['secondname'])) ?>" id="secondname">
        <label for="name">surname:</label>
        <label for="name">addr1:</label>
        <input type="datetime-local" name="surname" value="<?=date('Y-m-d\TH:i', strtotime($Item['surname'])) ?>" id="surname">
        <input type="text" name="addr1" placeholder="addr1" value="<?=$Item['addr1']?>" id="addr1">       
        <label for="text">town:</label>
        <label for="text">county:</label>        
        <input type="datetime-local" name="town" value="<?=date('Y-m-d\TH:i', strtotime($Item['town'])) ?>" id="town">
        <input type="text" name="county" placeholder="WF8 1RA" value="<?=$Item['county']?>" id="county">
        <label for="text">country:</label>       
        <label for="text">Postcode:</label> 
        <input type="text" name="country" placeholder="Pontefract" value="<?=$Item['country']?>" id="country">
        <input type="text" name="Postcode" placeholder="West Yorkshire" value="<?=$Item['Postcode']?>" id="Postcode">
        <label for="text">PhoneNumber:</label>
        <label for="text">ServiceNumber:</label>        
        <input type="text" name="PhoneNumber" placeholder="England" value="<?=$Item['PhoneNumber']?>" id="PhoneNumber">
        <input type="text" name="ServiceNumber" placeholder="01922808663" value="<?=$Item['ServiceNumber']?>" id="ServiceNumber">          
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>