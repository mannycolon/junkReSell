<?php 
	/*Deletes user from database*/

	//connect to database
	include '../cart/dbConfig.php';
	global $db;

    $userID = $_GET['id'];

	$query = mysqli_query($db, "SELECT * FROM users");
	
	mysqli_query($db, "DELETE FROM users WHERE email = '$userID'");

?>

<html>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
<!--Confirm that administrator was deleted.-->

	<h2 align="center">User Deletion Confirmation</h2>

	<div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">
          Deleted user with email:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $userID; ?></div>
        </div>
    </div>

	<p align="center"><a href="viewusers.php">Return to Users List</a></p>
	<p align="center"><a href="index.php">Return to Admin Main Page</a></p>
</body>
</html>

