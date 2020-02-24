<?php
include 'AdminFunctions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the Aircraft ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM AirCraft WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $AirCraft = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$AirCraft) {
        die ('Aircraft doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM AirCraft WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the AirCraft!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: AdminAircraft.php');
            exit;
        }
    }
} else {
    die ('No ID specified!');
}
?>

<?=template_header('AirCraft')?>

<div class="content delete">
	<h2>Delete AirCraft #<?=$AirCraft['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete AirCraft #<?=$AirCraft['id']?>?</p>
    <div class="yesno">
        <a href="AdminAircraftDelete.php?id=<?=$AirCraft['id']?>&confirm=yes">Yes</a>
        <a href="AdminAircraftDelete.php?id=<?=$AirCraft['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>