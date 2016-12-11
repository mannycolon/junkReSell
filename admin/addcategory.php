<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
	<main>
	   <h1 align="center">Add Category </h1><br>
	      <form action="../account/fileupload.php" method="post" enctype="multipart/form-data" 
                	style="padding-left: 600px; padding-right: 600px">
            	<h4>Select image to upload before clicking "Submit":</h4>
                <h5>Please select an image with the same name as the category.</h5>
            	<input type="file" name="fileToUpload" id="fileToUpload"><br>
            	<input type="submit" value="Upload Image" name="submit" style="color:black;">
              </form>
	      <form method="POST" action="addcategoryconfirm.php" style="padding-left: 600px; padding-right: 600px">
		 <div class="form-group">
		 <h3>Category:</h3>
	    	 <input type="text" name="category_name" class="form-control" required><br><br>
		 </div>
	         <input id="button" type="submit" name="submit" value="Submit" class="btn btn-primary dropdown-toggle" 
			data-toggle="dropdown" style="background-color: #29a329; font-size: 20px; border-color:#29a329;">
	      </form>
	</main>
	<br><p align="center"><a href="index.php">Return to Admin Main Page</a></p>
    </body>
</html>



