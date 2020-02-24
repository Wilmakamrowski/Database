<?php
include 'AdminFunctions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the Donator ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM Donator WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $Donator = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$Donator) {
        die ('Donator doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM Donator WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the Donator!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: AdminDonator.php');
            exit;
        }
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('Donator')?>

<div class="content delete">
	<h2>Delete Donator #<?=$Donator['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete Donator #<?=$Donator['id']?>?</p>
    <div class="yesno">
        <a href="AdminDonatorDelete.php?id=<?=$Donator['id']?>&confirm=yes">Yes</a>
        <a href="AdminDonatorDelete.php?id=<?=$Donator['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>