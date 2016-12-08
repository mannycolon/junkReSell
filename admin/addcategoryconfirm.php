<?php
  
  include '../cart/dbConfig.php';

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    //receives user input for category from form in addcategory.php
    $category_name = mysqli_real_escape_string($db, $_POST['category_name']);

    //save input into session which we can echo in the html
    $_SESSION['category_name'] = $category_name;  

    $bool = true;

    //query the category table
    $query = mysqli_query($db, "SELECT * FROM category");

    //displaying all rows from query
    while($row = mysqli_fetch_array($query))
    {
      /*the first category row is passed on to $table_category,
      and so on until the query is finished */
      $table_category = $row['categoryName'];

      //if a category name that was entered matches one in the database
      if($category_name == $table_category)
      {
        $bool = false;

        //tell the user that the category already exists
        print '<script>alert("Category already exists!");</script>';
        //redirects to addcategory.php
        print '<script>window.location.assign("addcategory.php");</script>';
      }

    }

    //if the category does not exist
    if($bool)
    {
      //insert the value to table category
      mysqli_query($db, "INSERT INTO category (categoryName) VALUES ('$category_name')");
      //prompt to let user know addition was succesful
      print '<script>alert("Successully added category!");</script>';
    }
  }
?>
<?php require_once('../util/main.php'); ?>
<?php include '../view/header.php'; ?>
      
      <h3 align="center">Category Addition Confirmation</h3>

      <div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Category Name:</div>
          <div class="panel-body" style="font-size:18px;"><?php echo $_SESSION['category_name']; ?></div>
        </div>
      </div>
      <br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>

  </body>
 
</html>
