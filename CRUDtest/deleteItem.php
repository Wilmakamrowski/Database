<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the Item ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM Item WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $Item = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$Item) {
        die ('Item doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM Item WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the Item!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: readItem.php');
            exit;
        }
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Item #<?=$Item['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete Item #<?=$Item['id']?>?</p>
    <div class="yesno">
        <a href="deleteItem.php?id=<?=$Item['id']?>&confirm=yes">Yes</a>
        <a href="deleteItem.php?id=<?=$Item['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>