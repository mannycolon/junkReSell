<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php
    //checks if user is logged in
  if($_SESSION['user']){
  }else{
    //redirect if user is not logged in
    header("location: $app_path");
  }
?>
<?php include '../view/header.php'; ?>
    <main class="nofloat">
      <h2>Acount</h2>
      <p> Hello <?php print "$user"?>!</p>
      <!--uploading an image got the product-->
      <form action="fileupload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
      </form>
    </main>
  </body>
</html>
