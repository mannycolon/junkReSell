<?php
  include '../util/dbConfig.php';
  global $db;
	//get 'id' of category when admin clicks on category in viewcategories.php
  $catID = $_GET['id'];
  //select from categories table
	$query = "SELECT * FROM category
              WHERE categoryID = '$catID'";
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <h1 style="padding-left: 740px; padding-right: 740px">Edit Category </h1><br>
      <form method="POST" action="editcategoryconfirm.php?id=<?php echo $categories[0]['categoryID']; ?>"
            style="padding-left: 600px; padding-right: 600px">
      <!--Allows admin to edit the name by echoing the category name stored in the database-->
      <div class="form-group">
        <h3>Category Name:</h3>
        <input type="text" name="name" class="form-control" value="<?php echo $categories[0]['categoryName']; ?>" required><br>
      </div>
        <input id="button" type="submit" name="submit" value="Submit" class="btn btn-primary dropdown-toggle"
              data-toggle="dropdown" style="background-color: #29a329; font-size: 20px; border-color:#29a329;">
      </form><br>
      <p align="center"><a href="index.php">Return to Admin Main Page</a></p>
    </main>
  </body>
</html>
