<?php
    //connect to database
    include '../util/dbConfig.php';
    global $db;
    //sets default if no set category_id
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE)
    {
        $category_id = 1;
    }
    // Get all categories and print a list of categories
    $queryAllCategories = 'SELECT * FROM category
                           ORDER BY categoryID';
    $statement2 = $db->prepare($queryAllCategories);
    $statement2->execute();
    $categories = $statement2->fetchAll();
    $statement2->closeCursor();
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

    <main>
	    	<form action="addProductConfirm.php" method="POST" enctype="multipart/form-data"
                	style="padding-left: 200px; padding-right: 200px">
           <h1>Add Product</h1>
	         <h3>Category:</h3>
	          <select name="category_id" class="btn btn-primary dropdown-toggle"
                    type="button" data-toggle="dropdown"
                    style="background-color: #004080; font-size: 20px; border-color:#004080;" required>
            <option disabled selected value></option>
            <?php foreach ($categories as $category) :
                    if ($category['categoryID'] == $product['categoryID']){
                      $selected = 'selected';
                    }else{
                      $selected = '';
                    }
            ?>
            <option style="background-color:white; color:black;"
                    value="<?php echo $category['categoryID']; ?>"<?php echo $selected ?>>
	                   <?php echo htmlspecialchars($category['categoryName']); ?>
            </option>
            <?php endforeach; ?>
       	    </select><br>
	<div class="form-group">
		<h3>Name:</h3>
		<input type="text" name="name" class="form-control" required>
	</div>
	<div class="form-group">
		<h3>Price:</h3>
		<input type="text" name="price" class="form-control" placeholder="0.00" pattern="^\d*(\.\d{2}$)?" required>
	</div>
	<div class="form-group">
		<h3>Quantity:</h3>
		<input type="text" name="quantity" class="form-control" required><br>
	</div>
	<div class="form-group">
		<h3>Description:</h3>
		<textarea rows="10" cols="50" name="description" class="form-control" required></textarea>
	</div>
  <h4>Select image to upload before clicking "Submit":</h4>
  <input type="file" name="fileToUpload" id="fileToUpload" required>
  <input id="button" type="submit" name="submit" value="Submit" class="btn btn-primary dropdown-toggle"
         data-toggle="dropdown" style="background-color: #29a329; font-size: 20px; border-color:#29a329;">
	</form>
	</main>
	<br><p align="center"><a href="index.php">Return to User Main Page</a></p>
    </body>
</html>
