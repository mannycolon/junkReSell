<?php
	//connect to database
	include '../util/dbConfig.php';
	global $db;
	//get 'id' of category
  $catID = $_GET['id'];
  //select from the chosen category by matching categoryID
	$stmt = $db->query("SELECT * FROM category");
	$db->exec("DELETE FROM category WHERE categoryID = '$catID'");
	//delete products from category that was deleted
	$stmt = $db->query("SELECT * FROM product");
	$db->exec("DELETE FROM product WHERE categoryID = '$catID'");
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <h2 align="center">Category Deletion Confirmation</h2>
      <div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">
          Deleted category with ID:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $catID; ?></div>
        </div>
      </div>
      <p align="center"><a href="viewcategories.php">Return to Category List</a></p>
      <p align="center"><a href="index.php">Return to Admin Main Page</a></p>
    <main>
  </body>
</html>
