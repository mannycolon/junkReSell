<?php
  //connect to database
  include '../util/dbConfig.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get 'id' of product when admin clicks on product in editproduct.php
    $productID = $_GET['id'];
    //admin input for new produt details
    $category_id = mysql_real_escape_string($_POST['category_id']);
    $product_name = mysql_real_escape_string($_POST['name']);
    $product_price = mysql_real_escape_string($_POST['price']);
    $product_quantity = mysql_real_escape_string($_POST['quantity']);
    $image_name = mysql_real_escape_string($_POST['image']);
    $product_description = mysql_real_escape_string($_POST['description']);
    $dateAdded = mysql_real_escape_string($_POST['date']);
    //select from product table and update details with user input
    $stmt = $db->query("SELECT * FROM product");
    $db->exec("UPDATE product SET categoryID=$category_id, productName='$product_name',
              productPrice='$product_price', productQuantity='$product_quantity',
              abbrvName='$image_name', description='$product_description',
              dateAdded='$dateAdded' WHERE abbrvName='$productID'");
    //prompt to let user know edit was succesful
    print '<script>alert("Successully edited product!");</script>';
  }
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <h3 style="padding-left: 640px; padding-right: 600px">Product Edit Confirmation</h3>
      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Category ID:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $category_id; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Name:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_name; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Price:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_price; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Quantity:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_quantity; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Description:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_description; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Added:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $dateAdded; ?></div>
        </div>
      </div>
      <br><p style="padding-left: 700px;"><a href="index.php">Return to Admin Main Page</a></p>
    </main>
  </body>
</main>
</html>
