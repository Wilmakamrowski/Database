<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get records from our Item table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM Item ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$Item = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of Item, this is so we can determine whether there should be a next and previous button
$num_Item = $pdo->query('SELECT COUNT(*) FROM Item')->fetchColumn();
?>

<?=template_header('Item')?>

<div class="content read">
	<h2>Amend Item</h2>
	<a href="createItem.php" class="create-Donator">Add Item</a>
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for id..">
    <script src="search.js"></script>
	<table id="myTable">
        <thead>
            <tr>
                <td>id</td>
                <td>ItemName</td>
                <td>Class</td>
                <td>DateRecieved</td>
                <td>DateToReturn</td>
                <td>Description</td>
                <td>LastAssessed</td>
                <td>ItemCondition</td>
                <td>ConditionComments</td>
                <td>idDonator</td>
                <td>idAirCraft</td>
                <td>ItemState</td>
                <td>created</td>                   
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Item as $Item): ?>
            <tr>
                <td><?=$Item['id']?></td>
                <td><?=$Item['ItemName']?></td>
                <td><?=$Item['Class']?></td>
                <td><?=$Item['DateRecieved']?></td>
                <td><?=$Item['DateToReturn']?></td>
                <td><?=$Item['Description']?></td>
                <td><?=$Item['LastAssessed']?></td>
                <td><?=$Item['ItemCondition']?></td>
                <td><?=$Item['ConditionComments']?></td>
                <td><?=$Item['idDonator']?></td>
                <td><?=$Item['ConditionComments']?></td>
                <td><?=$Item['idDonator']?></td>
                <td><?=$Item['created']?></td>
                <td class="actions">
                    <a href="updateItem.php?id=<?=$Item['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deleteItem.php?id=<?=$Item['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="readItem.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_Item): ?>
		<a href="readItem.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>