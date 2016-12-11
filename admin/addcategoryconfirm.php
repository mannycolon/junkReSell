<?php
include '../util/dbConfig.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get only the category name first to compare with table
    $category_name = $_POST['category_name'];;
    $bool = true;
    $stmt = $db->query('SELECT * FROM category');

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $table_category = $row['categoryName'];
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
