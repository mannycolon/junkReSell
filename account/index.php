<html>
  <head>
    <title>junkReSell</title>
  </head>
  <?php
  //start the session
  session_start();
  //checks if user is logged in
  if($_SESSION['user']){
  }else{
    //redirect if usr is not logged in
    header("location: index.php");
  }
  //assigns user value
  $user = $_SESSION['user'];
  ?>
  <body>
    <h2>Acount</h2>
    <p> Hello <?php print "$user"?>!</p>
    <a href="logout.php">logout</a>

    <!--uploading an image got the product-->
    <form action="fileupload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
  </body>
</html>
