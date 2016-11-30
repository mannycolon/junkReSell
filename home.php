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
    <h2>Home</h2>
    <p> Hello <?php print "$user"?>!</p>
    <a href="logout.php">logout</a>
  </body>
</html>
