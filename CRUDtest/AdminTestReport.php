<?php
include 'AdminFunctions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;

// Prepare the SQL statement and get records from our Donator table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT Donator.id, Donator.FirstName, Donator.SecondName, Donator.PostCode, Donator.PhoneNumber, Item.ItemName, Item.DateRecieved, Item.DateToReturn, Item.Description, Item.ItemCondition FROM Item, Donator WHERE Item.idDonator = Donator.id ORDER BY Item.id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$TestReport = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of Donator, this is so we can determine whether there should be a next and previous button
$num_Test = $pdo->query('SELECT COUNT(*) FROM TestReport')->fetchColumn();
?>

<?=template_header('Receipts')?>

<div class="content read">
	<h2>Amend Receipts</h2>	
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for id..">
    <script src="search.js"></script>
	<table id="myTable">
        <thead>
            <tr>
                <td>id</td>
                <td>FirstName</td>
                <td>SecondName</td>
                <td>PostCode</td>
                <td>PhoneNumber</td>
                <td>ItemName</td>
                <td>DateRecieved</td>
                <td>DateToReturn</td>
                <td>Description</td>                
                <td>ItemCondition</td>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($TestReport as $TestReport): ?>
            <tr>
                <td><?=$TestReport['id']?></td>                
                <td><?=$TestReport['FirstName']?></td>
                <td><?=$TestReport['SecondName']?></td>                
                <td><?=$TestReport['PostCode']?></td>               
                <td><?=$TestReport['PhoneNumber']?></td>
                <td><?=$TestReport['ItemName']?></td>
                <td><?=$TestReport['DateRecieved']?></td>
                <td><?=$TestReport['DateToReturn']?></td>
                <td><?=$TestReport['Description']?></td>
                <td><?=$TestReport['ItemCondition']?></td>                
                <td class="actions">                    
                    <a href="delete.php?id=<?=$TestReport['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="AdminTestReport.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_Donator): ?>
		<a href="AdminTestReport.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>