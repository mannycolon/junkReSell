<?php
    require_once('../util/userSession.php');
    //connect to database
    include '../util/dbConfig.php';
    global $db;
    $orderID = $_GET['id'];
    $userID = $_SESSION['userID'];
    //get tables for product
    $queryUser = "SELECT *
                     FROM orderItems
                     WHERE orderID='$orderID' ORDER by id ";
    $result = $db->prepare($queryUser);
    $result->execute();
    $orderItems = $result->fetchAll();
    $result->closeCursor();

?>
<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php'; ?>

	<style>
		td{
			border-style: inset;
			padding-left: 10px;
			padding-right: 10px;
		}
		table{width:75%; background-color: #fff; color: #000}
	</style>
	<h2 align="center">List of Order Items for order number <?php echo $orderID; ?></h2><br>
	<table align="center">
	<tbody>
		<tr>
		  <td style="font-weight: bold;">Product</td>
		  <td style="font-weight: bold;">Price</td>
		  <td style="font-weight: bold;">Quantity</td>
		</tr>
		<!--display  items for order-->
		<?php foreach ($orderItems as $orderItem) : ?>
			<tr>

        <?php
          $productID = $orderItem['productID'];
          $queryUser = "SELECT *
                        FROM product
                        WHERE productID='$productID'";
          $result = $db->prepare($queryUser);
          $result->execute();
          $productInfo = $result->fetchAll();
          $result->closeCursor();
        ?>
			  <td><?php echo $productInfo[0]['productName']; ?></td>
			  <td><?php echo $productInfo[0]['productPrice']; ?></td>
        <td><?php echo $orderItem['quantity']; ?></td>
			</tr>
		<?php endforeach; ?></p>
	</tbody>
  </table><br>
  <table style="background-color: #000" align="center">
    <tbody>
      <tr>
        <td style="border-style: none; padding-left: 0px">
          <a href="index.php" class="btn btn-success btn-block">
            <i class="glyphicon glyphicon-menu-left"></i>Return to User Main Page
          </a>
        </td>
        <td style="border-style: none; padding-right: 0px">
          <a href="viewOrders.php" class="btn btn-success btn-block">
            <i class="glyphicon glyphicon-menu-left"></i>Return to Orders Page 
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>
