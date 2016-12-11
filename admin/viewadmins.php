<?php
    /*Displays the admin information available in a
    table. */
    //connect to database
    include '../util/dbConfig.php';
    global $db;
    //get tables for admin
    $queryAdmins = "SELECT *
                     FROM administrators";
    $result = $db->prepare($queryAdmins);
    $result->execute();
    $admins = $result->fetchAll();
    $result->closeCursor();
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

	<style>
		td{
			border-style: inset;
			padding-left: 10px;
			padding-right: 10px;
		}
	  table{padding-left: 600px;}
	</style>
	<h2 align="center">List of Administrators</h2><br>
	<table align="center">
	  <tbody>
		  <tr>
		    <td style="font-weight: bold;">Full Name</td>
		    <td style="font-weight: bold;">Email</td>
		    <td style="font-weight: bold;" align="center">Delete Admin Account</td>
		  </tr>
		  <!--display info for each admin-->
		  <?php foreach ($admins as $admin) : ?>
			<tr>
			  <td><?php echo $admin['fullName']; ?></td>
			  <td><?php echo $admin['email']; ?></td>
			  <!--creates a link which allows admin to delete the user-->
			  <td align="center" style="padding-top: 4px; padding-bottom: 4px;">
				  <a href="deleteadmin.php?id=<?php echo $admin['email']; ?>" class="btn btn-default btn-sm"
					   style="background-color:#990000; color:white; border-color:#990000">
          <span class="glyphicon glyphicon-trash"></span> Delete</a></td>
			</tr>
		  <?php endforeach; ?></p>
	  </tbody>
	</table>
	<br><p align="center"><a href="createadmin.php">Create Admin Account</a></p>
	<p align="center"><a href="index.php">Return to Admin Main Page</a></p>
  </body>
</html>
