<?php
if(!isset($_REQUEST['id'])){
    header("Location: ../index.php");
}
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
  <main>
    <div class="container">
      <h1>Order Status</h1>
      <p>Your order has submitted successfully. Order ID is #<?php echo $_GET['id']; ?></p>
    </div>
  </body>
</html>
