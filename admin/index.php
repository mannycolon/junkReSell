<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php
    //checks if user is logged in
  if($_SESSION['user']){
  }else{
    //redirect if user is not logged in
    header("location: $app_path");
  }
?>
<?php include '../view/header.php'; ?>
    <main class="nofloat">
      <h2 align="center">Admin Account</h2>
      <h3 align="center" style="color:navy;"> Hello, <?php print "$user"?>!</h3><br>

      <h4 align="center">Choose an option below:</h4>
      <p align="center"><a href="addproduct.php" class="btn btn-info" role="button">Add Product</a>&nbsp
      <a href="addcategory.php" class="btn btn-info" role="button">Add Category</a></p>
      <p align="center"><a href="viewadmins.php" class="btn btn-info" role="button">View Admins</a>&nbsp&nbsp
      <a href="viewusers.php" class="btn btn-info" role="button">View Users</a>&nbsp&nbsp
      <a href="viewproducts.php" class="btn btn-info" role="button">View Products</a>&nbsp&nbsp
      <a href="viewcategories.php" class="btn btn-info" role="button">View Categories</a></p>
    </main>
  </body>
</html>
