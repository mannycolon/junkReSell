<?php

    //connect to database
    include '../category/databaseConnect.php';
    global $db;

    //get tables for product
    $queryAdmins = "SELECT *
                     FROM product
                     ORDER by categoryID";
    $result = $db->prepare($queryAdmins);
    $result->execute();
    $products = $result->fetchAll();
    $result->closeCursor();

?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

	<style>
		td
		{
			border-style: inset;
			padding-left: 10px;
			padding-right: 10px;
		}
		table
		{
			width:75%; 
		}
	</style>

	<h2 align="center">List of Products</h2><br>

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
			<!--creates a link which allows admin to edit the product-->
			<td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				<a href="editproduct.php?id=<?php echo $product['abbrvName']; ?>" class="btn btn-default btn-sm" 
					style="background-color:#006699; color:white; border-color:#006699">
          		<span class="glyphicon glyphicon-edit"></span> Edit</a></td>
			<!--creates a link which allows admin to delete the product-->
			<td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				<a href="deleteproduct.php?id=<?php echo $product['abbrvName']; ?>" class="btn btn-default btn-sm" 
					style="background-color:#990000; color:white; border-color:#990000">
          		<span class="glyphicon glyphicon-trash"></span> Delete</a></td>
			</tr>
		<?php endforeach; ?></p>

	</tbody>
	</table>
	<br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>
</body>
</html>

