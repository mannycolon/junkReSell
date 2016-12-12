<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
  <main>
    <form method="POST" action="addcategoryconfirm.php" enctype="multipart/form-data" style="padding-left: 200px; padding-right: 200px">
      <h1 align="center">Add Category </h1><br>
      <div class="form-group">
        <h3>Category:</h3>
        <input type="text" name="category_name" class="form-control" required><br><br>
        <h4>Select image to upload before clicking "Submit":</h4>
        <h5>Please select an image with the same name as the category.</h5>
        <input type="file" name="fileToUpload" id="fileToUpload" required><br>
      </div>
      <input id="button" type="submit" name="submit" value="Submit"
            class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
            style="background-color: #29a329; font-size: 20px; border-color:#29a329;">
    </form><br>
    <p align="center"><a href="index.php">Return to Admin Main Page</a></p>
  </main>
  </body>
</html>
