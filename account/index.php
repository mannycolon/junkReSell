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
      <h2 align="center">Account</h2>
      <h3 align="center" style="color:white;"> Hello <?php print "$user"?>!</h3>
      <h4 align="center">Choose an option below:</h4>
      <p align="center">
        <a href="addProduct.php" class="btn btn-info" role="button">Add Product</a>&nbsp
        <a href="viewProducts.php" class="btn btn-info" role="button">View Products</a>&nbsp&nbsp
      </p>
    </main>
  </body>
</html>
