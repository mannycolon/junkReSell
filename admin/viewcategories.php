<?php

    //connect to database
    include '../category/databaseConnect.php';
    global $db;

    //get tables for categories
    $queryAdmins = "SELECT *
                     FROM category
                     ORDER by categoryID";
    $result = $db->prepare($queryAdmins);
    $result->execute();
    $categories = $result->fetchAll();
    $result->closeCursor();

?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

	<style>
		td
		{
			border-style: inset;
			padding-left: 10px;
			padding-right: 10px;
		}
		table
		{
			width:30%; 
		}
	</style>

	<h2 align="center">List of Categories</h2><br>

	<table align="center">
	<tbody>
		<tr>
		<td style="font-weight: bold;">ID</td>
		<td style="font-weight: bold;">Name</td>
		<td style="font-weight: bold;" align="center">Edit</td>
		<td style="font-weight: bold;" align="center">Delete Category</td>
		</tr>


		<!--display info for each category-->
		<?php foreach ($categories as $category) : ?>
			<tr>
			<td><?php echo $category['categoryID']; ?></td>
			<td><?php echo $category['categoryName']; ?></td>
			<!--creates a link which allows admin to edit the category-->
			<td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				<a href="editcategory.php?id=<?php echo $category['categoryID']; ?>" class="btn btn-default btn-sm" 
					style="background-color:#006699; color:white; border-color:#006699">
          		<span class="glyphicon glyphicon-edit"></span> Edit</a></td>
			<!--creates a link which allows admin to delete the category-->
			<td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				<a href="deletecategory.php?id=<?php echo $category['categoryID']; ?>" class="btn btn-default btn-sm" 
					style="background-color:#990000; color:white; border-color:#990000">
          		<span class="glyphicon glyphicon-trash"></span> Delete</a></td>
			</tr>
		<?php endforeach; ?></p>

	</tbody>
	</table>
	<br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>
</body>
</html>

