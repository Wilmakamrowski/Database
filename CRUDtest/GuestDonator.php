<?php
include 'GuestFunctions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;

// Prepare the SQL statement and get records from our Donator table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM Donator ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$Donator = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of Donator, this is so we can determine whether there should be a next and previous button
$num_Donator = $pdo->query('SELECT COUNT(*) FROM Donator')->fetchColumn();
?>

<?=template_header('Guest Access')?>

<div class="content read">
	<h2> View Donators</h2>
	<!-- <a href="create.php" class="create-Donator">Add Donator</a> -->
	<table>
        <thead>
            <tr>
                <td>id</td>
                <td>Title</td>
                <td>FirstName</td>
                <td>SecondName</td>
                <!-- <td>AdressLine1</td>
                <td>PostCode</td>
                <td>Town</td>
                <td>County</td> -->
                <td>Country</td>
                <!-- <td>PhoneNumber</td>
                <td>Created</td>                 -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Donator as $Donator): ?>
            <tr>
                <td><?=$Donator['id']?></td>
                <td><?=$Donator['Title']?></td>
                <td><?=$Donator['FirstName']?></td>
                <td><?=$Donator['SecondName']?></td>
                <!-- <td><?=$Donator['AdressLine1']?></td>
                <td><?=$Donator['PostCode']?></td>
                <td><?=$Donator['Town']?></td>
                <td><?=$Donator['County']?></td> -->
                <td><?=$Donator['Country']?></td>
                <!-- <td><?=$Donator['PhoneNumber']?></td>
                <td><?=$Donator['created']?></td> -->
                <!-- <td class="actions">
                    <a href="update.php?id=<?=$Donator['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$Donator['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="GuestDonator.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_Donator): ?>
		<a href="GuestDonator.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>