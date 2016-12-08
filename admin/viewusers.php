<?php

    /*Displays the user information available in a
    table. */

    //connect to database
    include '../category/databaseConnect.php';
    global $db;

    //get tables for users
    $queryAdmins = "SELECT *
                     FROM users";
    $result = $db->prepare($queryAdmins);
    $result->execute();
    $users = $result->fetchAll();
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

	<h2 align="center">List of Users</h2><br>

	<table align="center">
	<tbody>
		<tr>
		<td>First Name</td>
		<td>Last Name</td>
		<td>Email</td>
		<td>Delete User Account</td>
		</tr>


		<!--display info for each user-->
		<?php foreach ($users as $user) : ?>
			<tr>
			<td><?php echo $user['firstname']; ?></td>
			<td><?php echo $user['lastname']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<!--creates a link which allows admin to delete the user-->
			<td><a href="deleteuser.php?id=<?php echo $user['email']; ?>">Delete</a></td>
			</tr>
		<?php endforeach; ?></p>

	</tbody>
	</table>
	<br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>
</body>
</html>
