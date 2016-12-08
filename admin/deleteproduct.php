<?php 
	//connect to database
	include '../cart/dbConfig.php';
	global $db;

	//get 'id' of product when user clicks on product in viewproducts.php
    $productID = $_GET['id'];

    //select from product table and delete the product where id matches
	$query = mysqli_query($db, "SELECT * FROM product");
	mysqli_query($db, "DELETE FROM product WHERE abbrvName = '$productID'");

?>

<html>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

	<h2 align="center">Product Deletion Confirmation</h2>

	<div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">
          Deleted product with Filename:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $productID; ?></div>
        </div>
    </div>

	<p align="center"><a href="viewproducts.php">Return to Product List</a></p>
	<p align="center"><a href="index.php">Return to Admin Main Page</a></p>
</body>
</html>
