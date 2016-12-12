<?php
  require_once('../util/userSession.php');
  //connect to database
  include '../util/dbConfig.php';
  global $db;
  //get 'id' of product when user clicks on product in viewproducts.php
  $productID = $_GET['id'];
  $userID = $_SESSION['userID'];
  //select from product table and delete the product where id matches
  $stmt = $db->query("SELECT *
                      FROM product
                      WHERE adminOrUserID='$userID' AND addedBy='user'");
  $db->exec("DELETE FROM product WHERE abbrvName = '$productID'");
?>

<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php'; ?>
   <main>
    <h2 align="center">Product Deletion Confirmation</h2>
    <div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">
          Deleted product with Filename:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $productID; ?></div>
        </div>
    </div>
    <p align="center"><a href="viewproducts.php">Return to Product List</a></p>
    <p align="center"><a href="index.php">Return to User Main Page</a></p>
   <main>
  </body>
</html>
