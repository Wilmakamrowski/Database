<?php
include 'AdminLogFunctions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;

// Prepare the SQL statement and get records from our AirCraft table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM AirCraft ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$AirCraft = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of AirCraft, this is so we can determine whether there should be a next and previous button
$num_AirCraft = $pdo->query('SELECT COUNT(*) FROM AirCraft')->fetchColumn();
?>

<?=template_header('AirCraftLog')?>

<div class="content read">
	<h2>Amend Aircraft</h2>
	<a href="AdminAircraftCreate.php" class="create-Donator">Add Aircraft</a>
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for id..">
    <script src="search.js"></script>
	<table id="myTable">
        <thead>
            <tr>
                <td>id</td>
                <td>AircraftName</td>
                <td>AirCraftSerialNumber</td>
                <td>AirCraftDetails</td>
                <td>Created</td>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($AirCraft as $AirCraft): ?>
            <tr>
                <td><?=$AirCraft['id']?></td>
                <td><?=$AirCraft['AircraftName']?></td>
                <td><?=$AirCraft['AirCraftSerialNumber']?></td>
                <td><?=$AirCraft['AirCraftDetails']?></td>
                <td><?=$AirCraft['created']?></td>
                <td class="actions">
                    <a href="updateAircraft.php?id=<?=$AirCraft['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deleteAircraft.php?id=<?=$AirCraft['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="AdminAircraft.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_AirCraft): ?>
		<a href="AdminAircraft.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>