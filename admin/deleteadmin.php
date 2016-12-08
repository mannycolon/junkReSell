<?php 
	/*Deletes admin from database*/

	//connect to database
	include '../cart/dbConfig.php';
	global $db;

	//get 'id' of admin
    $adminID = $_GET['id'];

    //query the admin table
	$query = mysqli_query($db, "SELECT * FROM administrators");

	//delete admin from administrators table	
	mysqli_query($db, "DELETE FROM administrators WHERE email = '$adminID'");

?>

<html>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
<!--Confirm that administrator was deleted.-->

	<h2 align="center">Admin Deletion Confirmation</h2>

	<div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">
          Deleted admin with email:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $adminID; ?></div>
        </div>
    </div>

	<p align="center"><a href="viewadmins.php">Return to Admin List</a></p>
	<p align="center"><a href="index.php">Return to Admin Main Page</a></p>
</body>
</html>

