<?php
    require_once('../util/userSession.php');
    //connect to database
    include '../util/dbConfig.php';
    global $db;
    $userID = $_SESSION['userID'];
    //get tables for product
    $queryUser = "SELECT *
                     FROM product
                     WHERE adminOrUserID='$userID' AND addedBy='user' ORDER by categoryID ";
    $result = $db->prepare($queryUser);
    $result->execute();
    $products = $result->fetchAll();
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
		table{width:75%;}
	</style>
	<h2 align="center">List of Products</h2><br>
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
	<table align="center">
	<tbody>
		<tr>
		  <td style="font-weight: bold;">Category</td>
		  <td style="font-weight: bold;">Name</td>
		  <td style="font-weight: bold;">Filename</td>
		  <td style="font-weight: bold;">Price</td>
		  <td style="font-weight: bold;">Quantity</td>
		  <td style="font-weight: bold;">Description</td>
	    <td style="font-weight: bold;">Date Added</td>
		  <td style="font-weight: bold;">Edit</td>
		  <td style="font-weight: bold;">Delete Product</td>
		</tr>
		<!--display info for each product-->
		<?php foreach ($products as $product) : ?>
			<tr>
			<td><?php echo $product['categoryID']; ?></td>
			<td><?php echo $product['productName']; ?></td>
			<td><?php echo $product['abbrvName']; ?></td>
			<td><?php echo $product['productPrice']; ?></td>
			<td><?php echo $product['productQuantity']; ?></td>
			<td><?php echo $product['description']; ?></td>
			<td><?php echo $product['dateAdded']; ?></td>
			<!--creates a link which allows User to edit the product-->
			<td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				<a href="editProduct.php?id=<?php echo $product['abbrvName']; ?>" class="btn btn-default btn-sm"
					style="background-color:#006699; color:white; border-color:#006699">
          		<span class="glyphicon glyphicon-edit"></span> Edit</a></td>
			<!--creates a link which allows User to delete the product-->
			<td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				<a href="deleteProduct.php?id=<?php echo $product['abbrvName']; ?>" class="btn btn-default btn-sm"
					style="background-color:#990000; color:white; border-color:#990000">
          		<span class="glyphicon glyphicon-trash"></span> Delete</a></td>
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
