<?php
  include '../util/dbConfig.php';

  $category_name = $_POST['category_name'];
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
      //changing the target file name to the category name
      $target_file = $target_dir . basename($category_name . ".png");
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          //The file has been uploaded.
      } else {
          print '<script>alert("Sorry, there was an error uploading your file.");</script>';
      }
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $bool = true;
    $stmt = $db->query('SELECT * FROM category');

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $table_category = $row['categoryName'];
      //comparing category name with table
      if($category_name == $table_category){
        $bool = false;
        print '<script>alert("Category already exists!");</script>';
        print '<script>window.location.assign("addcategory.php");</script>';
      }
    }
    if($bool){
      // set the PDO error mode to exception
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // prepare sql and bind parameters
      $stmt = $db->prepare("INSERT INTO category (categoryName) VALUES (:name)");
      $stmt->bindParam(':name', $category_name);
      //get user input from addcategory.php
      $category_name = $_POST['category_name'];
      //executes query
      $stmt->execute();
      print '<script>alert("Successully added category!");</script>';
    }
  }
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <h3 align="center">Category Addition Confirmation</h3>
      <div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Category Name:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $category_name; ?></div>
        </div>
      </div>
      <br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>
    </main>
  </body>
</html>
