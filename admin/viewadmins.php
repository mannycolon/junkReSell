<?php

    /*Displays the admin information available in a
    table. */

    //connect to database
    include '../category/databaseConnect.php'; 
    global $db;

    //get tables for admin
    $queryAdmins = "SELECT *
                     FROM administrators";
    $result = $db->prepare($queryAdmins);
    $result->execute();
    $admins = $result->fetchAll();
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
			padding-left: 600px; 
		}
	</style>

	<h2 align="center">List of Administrators</h2><br>

	<table align="center">
	<tbody>
		<tr>
		<td>Full Name</td>
		<td>Email</td>
		<td>Delete Admin Account</td>
		</tr>


		<!--display info for each admin-->
		<?php foreach ($admins as $admin) : ?>
			<tr>
			<td><?php echo $admin['fullName']; ?></td>
			<td><?php echo $admin['email']; ?></td>
			<!--creates a link which allows admin to delete the user-->
			<td><a href="deleteadmin.php?id=<?php echo $admin['email']; ?>">Delete</a></td>
			</tr>
		<?php endforeach; ?></p>

	</tbody>
	</table>
	<br><p align="center"><a href="createadmin.php">Create Admin Account</a></p>
	<p align="center"><a href="index.php">Return to Admin Main Page</a></p>

</body>
</html>
