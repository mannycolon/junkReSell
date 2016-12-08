<?php
  
  include '../cart/dbConfig.php';

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $category_name = mysqli_real_escape_string($db, $_POST['category_name']); 

    $bool = true;

    $query = mysqli_query($db, "SELECT * FROM category");

    while($row = mysqli_fetch_array($query))
    {
      $table_category = $row['categoryName'];

      if($category_name == $table_category)
      {
        $bool = false;

        print '<script>alert("Category already exists!");</script>';
        print '<script>window.location.assign("addcategory.php");</script>';
      }

    }

    if($bool)
    {
      mysqli_query($db, "INSERT INTO category (categoryName) VALUES ('$category_name')");
      print '<script>alert("Successully added category!");</script>';
    }
  }
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
      
      <h3 align="center">Category Addition Confirmation</h3>

      <div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Category Name:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $category_name; ?></div>
        </div>
      </div>
      <br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>

  </body>
 
</html>
