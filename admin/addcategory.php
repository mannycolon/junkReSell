<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php'; ?>
	<main>
		<h1 align="center">Add Category </h1>
		<form method="POST" action="addcategoryconfirm.php" style="padding-left: 600px; padding-right: 600px">
		<div class="form-group">
			<h3>Category:</h3>
	    		<input type="text" name="category_name" class="form-control" required><br><br>
		</div>
			<input id="button" type="submit" name="submit" value="Submit" class="btn btn-primary dropdown-toggle" 
			       data-toggle="dropdown" style="background-color: #29a329; font-size: 20px; border-color:#29a329;">
		</form>
		
	</main>
	<br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>
    </body>
</html>

