<?php
    require_once('../util/userSession.php');
    //connect to database
    include '../util/dbConfig.php';
    global $db;
    $userID = $_SESSION['userID'];
    //get tables for product
    $queryUser = "SELECT *
                     FROM orders
                     WHERE userID='$userID' ORDER by id ";
    $result = $db->prepare($queryUser);
    $result->execute();
    $orders = $result->fetchAll();
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
	<h2 align="center">List of Orders</h2><br>
	<table align="center">
	<tbody>
		<tr>
		  <td style="font-weight: bold;">Order ID</td>
		  <td style="font-weight: bold;">Total Price</td>
		  <td style="font-weight: bold;">Payment Information</td>
		  <td style="font-weight: bold;">Billing Address</td>
		  <td style="font-weight: bold;">Shipping Address</td>
	    <td style="font-weight: bold;">Order Date</td>
		  <td style="font-weight: bold;">View Order Items</td>
		</tr>
		<!--display info for each product-->
		<?php foreach ($orders as $order) : ?>
			<tr>
			<td><?php echo $order['id']; ?></td>
			<td><?php echo $order['total_price']; ?></td>
			<td>
        <?php echo $order['cardFullName'];?><br>
        <span style="font-weight: bold; color: #23527c">Card Number:</span>
        <?php echo $order['cardNumber'];?><br>
        <span style="font-weight: bold; color: #23527c">Expiration Date:</span>
        <?php echo $order['cardExpires'];?>
      </td>

      <!--getting billing address information -->
      <?php
        $billAddressID = $order['billingAddressID'];
        $queryUser = "SELECT *
                       FROM addresses
                       WHERE userID='$userID' AND addressID='$billAddressID'";
        $result = $db->prepare($queryUser);
        $result->execute();
        $billAddress = $result->fetchAll();
        $result->closeCursor();
      ?>
			<td>
          <?php echo $billAddress[0]['address'] . ", <br>" . $billAddress[0]['city'] . ", "
                     . $billAddress[0]['state'] . ", " . $billAddress[0]['zipCode']; ?>
      </td>
       <!--getting billing address information -->
      <?php
        $shipAddressID = $order['shipAddressID'];
        $queryUser = "SELECT *
                      FROM addresses
                      WHERE userID='$userID' AND addressID='$shipAddressID'";
        $result = $db->prepare($queryUser);
        $result->execute();
        $shipAddress = $result->fetchAll();
        $result->closeCursor();
      ?>
			<td>
        <?php echo $shipAddress[0]['address'] . ", <br>" . $shipAddress[0]['city'] . ", "
                     . $shipAddress[0]['state'] . ", " . $shipAddress[0]['zipCode']; ?>
			<td>
        <?php echo $order['created']; ?>
      </td>
			<!--creates a link which allows User to view the products in the order-->
			<td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				<a href="viewOrderItems.php?id=<?php echo $order['id']; ?>" class="btn btn-default btn-sm"
					style="background-color:#006699; color:white; border-color:#006699">
          		<span class="glyphicon glyphicon-list-alt"></span> View Items</a></td>
			</tr>
		<?php endforeach; ?></p>
	</tbody>
  </table><br>
  <table style="background-color: #000" align="center">
    <tbody>
      <tr>
        <td style="border-style: none; padding-left: 0px; padding-right: 0px;">
          <a href="index.php" class="btn btn-success btn-block" style="width: 50%">
            <i class="glyphicon glyphicon-menu-left"></i>Return to User Main Page
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</body>
</html>
