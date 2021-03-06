<?php
	/*Deletes user from database*/
	//connect to database
	include '../util/dbConfig.php';
	global $db;
	//get 'id' of user when admin clicks on user in viewusers.php
  $userID = $_GET['id'];
  //select from users table and delete the user where id matches
  $stmt = $db->query("SELECT * FROM users");
	$db->exec("DELETE FROM users WHERE email = '$userID'");
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <!--Confirm that user was deleted.-->
      <h2 align="center">User Deletion Confirmation</h2>
      <div class="container" style="padding-left: 400px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">
          Deleted user with email:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $userID; ?></div>
        </div>
      </div>
      <p align="center"><a href="viewusers.php">Return to Users List</a></p>
      <p align="center"><a href="index.php">Return to Admin Main Page</a></p>
    </main>
  </body>
</html>
