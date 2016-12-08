<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

		<h1 align="center">Create Admin Account </h1><br>
			<form method="POST" action="createconfirm.php" style="padding-left: 600px; padding-right: 600px">
			<div class="form-group">
				<h3>Full Name:</h3>
				<input type="text" name="fullname" class="form-control" required=""><br>
			</div>
			<div class="form-group">
				<h3>Email:</h3>
				<input type="email" name="email" class="form-control" required><br>
			</div>
			<div class="form-group">
				<h3>Password:</h3>
				<input type="password" name="pass" class="form-control" required><br><br>
			</div>
			<input id="button" type="submit" name="submit" value="Create Account" class="btn btn-primary dropdown-toggle" 
			       data-toggle="dropdown" style="background-color: #29a329; font-size: 20px; border-color:#29a329;">
			</form>

		<br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>
	</body>
</html>

