<?php
  //connect to database
  include '../util/dbConfig.php';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get 'id' of category when admin clicks on category in editcategory.php
    $catID = $_GET['id'];
    //user input for new category name
    $category_name = mysql_real_escape_string($_POST['name']);
    //select from the category table and update with new name
    $stmt = $db->query("SELECT * FROM category");
    $db->exec("UPDATE category SET categoryName='$category_name' WHERE categoryID='$catID'");
    print '<script>alert("Successully edited category!");</script>';
  }
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <h3 style="padding-left: 640px; padding-right: 600px">Category Edit Confirmation</h3>
      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Category Name:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $category_name; ?></div>
        </div>
      </div>
      <br><p style="padding-left: 700px;"><a href="index.php">Return to Admin Main Page</a></p>
    </main>
  </body>
</main>
</html>
