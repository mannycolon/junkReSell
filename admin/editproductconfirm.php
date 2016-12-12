<?php
  //connect to database
  include '../util/dbConfig.php';
  date_default_timezone_set("America/New_York");

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get 'id' of product when admin clicks on product in editproduct.php
    $productID = $_GET['id'];
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prepare sql and bind parameters
    $stmt = $db->prepare("UPDATE product SET categoryID=:category_id, productName=:name, productPrice=:price,
            productQuantity=:quantity, abbrvName=:fileToUpload, description=:description, 
            dateAdded=:dateAdded WHERE abbrvName='$productID'");
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':name', $product_name);
    $stmt->bindParam(':price', $product_price);
    $stmt->bindParam(':quantity', $product_quantity);
    $stmt->bindParam(':fileToUpload', $image_name);
    $stmt->bindParam(':description', $product_description);
    $stmt->bindParam(':dateAdded', $dateAdded);
    //get user input from editproduct.php
    $category_id = $_POST['category_id'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $product_quantity = $_POST['quantity'];
    $image_name = basename($_POST['fileToUpload'], '.png'); //removes png file extension from image
    $product_description = $_POST['description'];
    $dateAdded = date("Y-m-d"); //adds current date
    //executes query
    $stmt->execute();
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
