<?php
  include '../util/dbConfig.php';

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $category_id = mysql_real_escape_string($_POST['category_id']);
    $product_name = mysql_real_escape_string($_POST['name']);
    $product_price = mysql_real_escape_string($_POST['price']);
    $product_quantity = mysql_real_escape_string($_POST['quantity']);
    $image_name = mysql_real_escape_string($_POST['image']);
    $product_description = mysql_real_escape_string($_POST['description']);
    $dateAdded = mysql_real_escape_string($_POST['date']);
    $bool = true;
    //query the product table
    $stmt = $db->query('SELECT * FROM product');
    //displaying all rows from query
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
    if($bool){
      //inserts the values to table account
      $db->exec("INSERT INTO product (categoryID, productName, productPrice, productQuantity, abbrvName, description, dateAdded)
        VALUES ('$category_id', '$product_name', '$product_price', '$product_quantity', '$image_name', '$product_description', '$dateAdded')");
      //prompt to let user know registration was succesful
      print '<script>alert("Successully added product!");</script>';
    }
  }
?>

<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <h3 style="padding-left: 600px; padding-right: 600px">Product Addition Confirmation</h3>
      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px; color: #000">Category ID:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $category_id; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px; color: #000">Product Name:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_name; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px; color: #000">Product Price:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_price; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px; color: #000">Product Quantity:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_quantity; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px; color: #000">Product Description:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_description; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px; color: #000">Product Added:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $dateAdded; ?></div>
        </div>
      </div>
      <br><p style="padding-left: 700px;"><a href="index.php">Return to Admin Main Page</a></p>
    </main>
  </body>
</html>
