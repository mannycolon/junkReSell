<?php
  //connect to database
  include '../util/dbConfig.php';
  date_default_timezone_set("America/New_York");
  //uploading image

  if($_FILES["fileToUpload"]["size"] > 0){
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          //File is an image
          $uploadOk = 1;
      } else {
          print '<script>alert("File is not an image.");</script>';
          $uploadOk = 0;
      }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
      print '<script>alert("Sorry, file already exists.");</script>';
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
      print '<script>alert("Sorry, your file is too large.");</script>';
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
      print '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      print '<script>alert("Sorry, your file was not uploaded.");</script>';
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          //The file has been uploaded.
      } else {
          print '<script>alert("Sorry, there was an error uploading your file.");</script>';
      }
    }
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get 'id' of product when User clicks on product in editproduct.php
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
    $image_name = basename($_FILES["fileToUpload"]["name"], '.png');
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
      <center>
      <h3 style="text-align: center">Product Edit Confirmation</h3>
      <div class="container">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Category ID:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $category_id; ?></div>
        </div>
      </div>

      <div class="container">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Name:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_name; ?></div>
        </div>
      </div>

      <div class="container">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Price:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_price; ?></div>
        </div>
      </div>

      <div class="container">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Quantity:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_quantity; ?></div>
        </div>
      </div>

      <div class="container">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Description:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $product_description; ?></div>
        </div>
      </div>

      <div class="container">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Product Added:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $dateAdded; ?></div>
        </div>
      </div>
      <br><p style="padding-left: 700px;"><a href="index.php">Return to User Main Page</a></p>
      <center>
    </main>
  </body>
</main>
</html>
