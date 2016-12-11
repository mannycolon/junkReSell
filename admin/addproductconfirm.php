<?php
  //connect to database
  include '../util/dbConfig.php';
  date_default_timezone_set("America/New_York");

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    //get only the product name first to compare with table
    $product_name = $_POST['name'];
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
      // set the PDO error mode to exception
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // prepare sql and bind parameters
      $stmt = $db->prepare("INSERT INTO product (categoryID, productName, productPrice, productQuantity, abbrvName, description, dateAdded) VALUES (:category_id, :name, :price, :quantity, :fileToUpload, :description, :dateAdded)");
      $stmt->bindParam(':category_id', $category_id);
      $stmt->bindParam(':name', $product_name);
      $stmt->bindParam(':price', $product_price);
      $stmt->bindParam(':quantity', $product_quantity);
      $stmt->bindParam(':fileToUpload', $image_name);
      $stmt->bindParam(':description', $product_description);
      $stmt->bindParam(':dateAdded', $dateAdded);
      //get user input from addproduct.php
      $category_id = $_POST['category_id'];
      $product_name = $_POST['name'];
      $product_price = $_POST['price'];
      $product_quantity = $_POST['quantity'];
      $image_name = basename($_POST['fileToUpload'], '.png'); //removes png file extension from image that was uploaded
      $product_description = $_POST['description'];
      $dateAdded = date("Y-m-d"); //adds current date
      //executes query
      $stmt->execute();
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
