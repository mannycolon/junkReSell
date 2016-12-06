<?php
$link = mysqli_connect("localhost", "root", "", "junkReSell_db");

// Check connection
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $category_id = mysqli_real_escape_string($link, $_POST['category_id']);
    $product_name = mysqli_real_escape_string($link, $_POST['name']);
    $product_price = mysqli_real_escape_string($link, $_POST['price']);
    $product_quantity = mysqli_real_escape_string($link, $_POST['quantity']);
    $product_description = mysqli_real_escape_string($link, $_POST['description']);
    $dateAdded = mysqli_real_escape_string($link, $_POST['date']);

    $_SESSION['category_id'] = $category_id;  
    $_SESSION['product_name'] = $product_name;  
    $_SESSION['product_price'] = $product_price; 
    $_SESSION['product_quantity'] = $product_quantity;
    $_SESSION['image'] = $image_name;
    $_SESSION['description'] = $product_description;
    $_SESSION['date'] = $dateAdded;

    $bool = true;

    //Query the account table
    $query = mysqli_query($link, "select * from product");

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
      mysqli_query($link, "INSERT INTO product (categoryID, productName, productPrice, productQuantity, abbrvName, description, dateAdded) VALUES ('$category_id', '$product_name', '$product_price', '$product_quantity', '$image_name' '$product_description', '$dateAdded')");
      //prompt to let user know registration was succesful
      print '<script>alert("Successully added product!");</script>';
    }
  }
?>

<?php include '../view/header.php'; ?>
  <body>
  
      <h1>Product Addition Confirmation </h1><br>
      <h4>Category ID:</h4>
      <?php echo $_SESSION['category_id']; ?><br>
      <h4>Product Name:</h4>
      <?php echo $_SESSION['product_name']; ?><br>
      <h4>Product Price:</h4>
      <?php echo $_SESSION['product_price']; ?><br>
      <h4>Product Quantity:</h4>
      <?php echo $_SESSION['product_quantity']; ?><br>  
      <h4>Product Description:</h4>
      <?php echo $_SESSION['description']; ?><br>
       <h4>Product Added:</h4>
      <?php echo $_SESSION['date']; ?><br>
    
  </body>
</main>
</html>