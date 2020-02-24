<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;

// Prepare the SQL statement and get records from our Test table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM Test ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$Test = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of Test, this is so we can determine whether there should be a next and previous button
$num_Test = $pdo->query('SELECT COUNT(*) FROM Test')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Amend test</h2>	
	<table>
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>test</td>
                <td>created</td>                               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Test as $Test): ?>
            <tr>
                <td><?=$Test['id']?></td>
                <td><?=$Test['name']?></td>
                <td><?=$Test['test']?></td>               
                <td><?=$Test['created']?></td>
                <td class="actions">
                    <a href="updateTest.php?id=<?=$Test['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deleteAircraft.php?id=<?=$Test['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="readAircraft.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_Test): ?>
		<a href="readAircraft.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>