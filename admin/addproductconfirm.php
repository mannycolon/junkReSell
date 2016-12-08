<?php

  include '../cart/dbConfig.php';

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $category_id = mysqli_real_escape_string($db, $_POST['category_id']);
    $product_name = mysqli_real_escape_string($db, $_POST['name']);
    $product_price = mysqli_real_escape_string($db, $_POST['price']);
    $product_quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $image_name = mysqli_real_escape_string($db, $_POST['image']);
    $product_description = mysqli_real_escape_string($db, $_POST['description']);
    $dateAdded = mysqli_real_escape_string($db, $_POST['date']);

    $_SESSION['category_id'] = $category_id;  
    $_SESSION['product_name'] = $product_name;  
    $_SESSION['product_price'] = $product_price; 
    $_SESSION['product_quantity'] = $product_quantity;
    $_SESSION['image'] = $image_name;
    $_SESSION['description'] = $product_description;
    $_SESSION['date'] = $dateAdded;

    $bool = true;

    //Query the account table
    $query = mysqli_query($db, "SELECT * FROM product");

    //displaying all rows from query
    while($row = mysqli_fetch_array($query))
    {
      /*the first product row is passed on to $table_products,
      and so on until the query is finished */
      $table_products = $row['productName'];

      //checks if there are any matching fields
      if($product_name == $table_products)
      {
        $bool = false;
        //Tell the user that the product already exists
        print '<script>alert("Product already exists!");</script>';
        //redirects to register.html
        print '<script>window.location.assign("addproduct.php");</script>';
      }

    }

    if($bool)
    {
      //inserts the values to table account
      mysqli_query($db, "INSERT INTO product (categoryID, productName, productPrice, productQuantity, abbrvName, description, dateAdded) 
        VALUES ('$category_id', '$product_name', '$product_price', '$product_quantity', '$image_name', '$product_description', '$dateAdded')");
      //prompt to let user know registration was succesful
      print '<script>alert("Successully added product!");</script>';
    }
  }
?>

<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php'; ?>
  <body>
  
      <h3 style="padding-left: 600px; padding-right: 600px">Product Addition Confirmation</h3>
 
      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Category ID:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $_SESSION['category_id']; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Name:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $_SESSION['product_name']; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Price:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $_SESSION['product_price']; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Quantity:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $_SESSION['product_quantity']; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Description:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $_SESSION['description']; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Added:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $_SESSION['date']; ?></div>
        </div>
      </div>
      <br><p style="padding-left: 700px;"><a href="index.php">Return to Admin Main Page</a></p>
    
  </body>
</main>
</html>
