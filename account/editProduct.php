<?php
  //connect to database
  include '../util/dbConfig.php';
  global $db;
  //get 'id' of product when User clicks on product in viewproducts.php
  $productID = $_GET['id'];
  //select from product table where the id matches
	$query = "SELECT * FROM product
              WHERE abbrvName = '$productID'";
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    //select from categories table to display in drop-down
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
      <form method="POST" action="editProductConfirm.php?id=<?php echo $products[0]['abbrvName']; ?>"
            enctype="multipart/form-data"
            style="padding-left: 200px; padding-right: 200px">
      <!--Drop-down takes on value of category chosen by User-->
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
      <option style="background-color:white; color:black;" value="<?php echo $category['categoryID']; ?>"<?php echo $selected ?>>
       <?php echo htmlspecialchars($category['categoryName']); ?>
      </option>
     <?php endforeach; ?>
     </select><br>
       <!--Allows User to edit the product by echoing the product details stored in the database-->
      <div class="form-group">
        <h3>Name:</h3>
        <input type="text" name="name" class="form-control"
              value="<?php echo $products[0]['productName']; ?>" required><br>
      </div>
      <div class="form-group">
        <h3>Price:</h3>
        <input type="text" name="price" class="form-control" placeholder="0.00" pattern="^\d*(\.\d{2}$)?"
               value="<?php echo $products[0]['productPrice']; ?>" required><br>
      </div>
      <div class="form-group">
        <h3>Quantity:</h3>
        <input type="text" name="quantity" class="form-control"
               value="<?php echo $products[0]['productQuantity']; ?>" required><br><br>
      </div>
      <div class="form-group">
	       <h3>Description:</h3>
	       <textarea rows="10" cols="50" name="description"
                   class="form-control" required>
                   <?php echo $products[0]['description']; ?>
         </textarea>
      </div>
      <h4>Select image to upload before clicking "Submit":</h4>
      <input type="file" name="fileToUpload" id="fileToUpload"><br>
      <input id="button" type="submit" name="submit" value="Submit"
             class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
             style="background-color: #29a329; font-size: 20px; border-color:#29a329;">
      </form><br><br>
      <p align="center"><a href="index.php">Return to User Main Page</a></p>
    </main>
  </body>
</html>
