<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the Donator id exists, for example update.php?id=1 will get the Donator with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;          
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
    // Update the record
    $stmt = $pdo->prepare('UPDATE Donator SET id = ?, Title = ?, FirstName = ?, SecondName = ?, AdressLine1 = ?, PostCode = ?, Town = ?, County = ?, Country = ?, PhoneNumber = ?, created = ? WHERE id = ?');
    $stmt->execute([$id, $Title, $FirstName, $SecondName, $AdressLine1, $PostCode, $Town, $County, $Country, $PhoneNumber, $created, $_GET['id']]);
    $stmt = $pdo->prepare('INSERT INTO DonatorLog (idDonator, Title, FirstName, SecondName, AdressLine1, PostCode, Town, County, Country, PhoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $Title, $FirstName, $SecondName, $AdressLine1, $PostCode, $Town, $County, $Country, $PhoneNumber]);
    $msg = 'Updated Successfully!';
}
// Get the Donator from the Donar table
    $stmt = $pdo->prepare('SELECT * FROM Donator WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $Donator = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$Donator) {
        die ('Donator doesn\'t exist with that id!');
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Donator #<?=$Donator['id']?></h2>   
    <form action="update.php?id=<?=$Donator['id']?>" method="post">
        <label for="id">id</label>    
        <label for="title">Title</label>        
        <input type="text" name="id" placeholder="1" value="<?=$Donator['id']?>" id="id">
        <input type="text" name="Title" placeholder="Mr." value="<?=$Donator['Title']?>" id="Title">
        <label for="name">Firstname:</label>
        <label for="name">Secondname:</label>
        <input type="text" name="FirstName" placeholder="FirstName" value="<?=$Donator['FirstName']?>" id="FirstName">
        <input type="text" name="SecondName" placeholder="SecondName" value="<?=$Donator['SecondName']?>" id="SecondName">       
        <label for="text">AdressLine1:</label>
        <label for="text">PostCode:</label>        
        <input type="text" name="AdressLine1" placeholder="22 noob street" value="<?=$Donator['AdressLine1']?>" id="AdressLine1">
        <input type="text" name="PostCode" placeholder="WF8 1RA" value="<?=$Donator['PostCode']?>" id="PostCode">
        <label for="text">Town:</label>       
        <label for="text">County:</label> 
        <input type="text" name="Town" placeholder="Pontefract" value="<?=$Donator['Town']?>" id="Town">
        <input type="text" name="County" placeholder="West Yorkshire" value="<?=$Donator['County']?>" id="County">
        <label for="text">Country:</label>
        <label for="text">PhoneNumber:</label>        
        <input type="text" name="Country" placeholder="England" value="<?=$Donator['Country']?>" id="Country">
        <input type="text" name="PhoneNumber" placeholder="01922808663" value="<?=$Donator['PhoneNumber']?>" id="PhoneNumber">    
        <label for="created">Created at --- ></label>       
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($Donator['created'])) ?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>