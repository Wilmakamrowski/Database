<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the Test id exists, for example update.php?id=1 will get the Test with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;          
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $test = isset($_POST['test']) ? $_POST['test'] : '';    
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Update the record
    $stmt = $pdo->prepare('UPDATE Test SET id = ?, name = ?, test = ?, created = ? WHERE id = ?');
    $stmt->execute([$id, $name, $test, $created, $_GET['id']]);
    $stmt = $pdo->prepare('INSERT INTO TestLog (idTest, name, test) VALUES (?,?,?)');
    $stmt->execute([$id, $name, $test]);

    
    $msg = 'Updated Successfully!';
}
// Get the Donator from the Donar table
    $stmt = $pdo->prepare('SELECT * FROM Test WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $Test = $stmt->fetch(PDO::FETCH_ASSOC);  
    if (!$Test) {
        die ('Test doesn\'t exist with that id!');
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Test #<?=$Test['id']?></h2>   
    <form action="updateTest.php?id=<?=$Test['id']?>" method="post">
        <label for="id">id</label>    
        <label for="name">name</label>        
        <input type="text" name="id" placeholder="1" value="<?=$Test['id']?>" id="id">
        <input type="text" name="name" placeholder="name." value="<?=$Test['name']?>" id="name">
        <label for="name">test</label>            
        <label for="created">Created at --- ></label>  
        <input type="text" name="test" placeholder="1" value="<?=$Test['test']?>" id="test">     
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($Test['created'])) ?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>