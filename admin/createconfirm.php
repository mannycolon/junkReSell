<?php
  //connect to database
  include '../util/dbConfig.php';
  global $db;
  //receives user input from form in createadmin.php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get only the email first to compare with table
    $email_address = $_POST['email'];
    $bool = true;
    $stmt = $db->query("SELECT * FROM administrators");
    //displaying all rows from query
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      /*the first email row is passed on to $table_email,
      and so on until the query is finished */
      $table_email = $row['email'];
      //checks if there are any matching fields
      if($email_address == $table_email){
        $bool = false;
        //tell the user that the email has been taken
        print '<script>alert("Email has already been used!");</script>';

        print '<script>window.location.assign("createadmin.php");</script>';
      }
    }
    //if there are no conflicts of email
    if($bool){
      // set the PDO error mode to exception
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // prepare sql and bind parameters
      $stmt = $db->prepare("INSERT INTO administrators (fullName, email, password) 
        VALUES (:fullname, :email, :password)");
      $stmt->bindParam(':fullname', $full_name);
      $stmt->bindParam(':email', $email_address);
      $stmt->bindParam(':password', $password);
      //get user input 
      $full_name = $_POST['fullname'];
      $email_address = $_POST['email'];
      $password = $_POST['pass'];
      //executes query
      $stmt->execute();
      //prompt to let user know creation was succesful
      print '<script>alert("Successully created account!");</script>';
    }
  }
?>
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main>
      <h3 style="padding-left: 640px; padding-right: 600px">Admin Account Confirmation</h3>
      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Full Name:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $full_name; ?></div>
        </div>
      </div>

      <div class="container" style="padding-left: 300px;">
        <div class="panel panel-default" style="width:50%;">
          <div class="panel-heading" style="background-color: #4d79ff; color: white; font-size:18px;">Email:</div>
          <div class="panel-body" style="font-size:18px; color: #000"><?php echo $email_address; ?></div>
        </div>
      </div>

      <br><p style="padding-left: 700px;"><a href="createadmin.php">Return to Create Admin Account</a></p>
      <p style="padding-left: 700px;"><a href="index.php">Return to Admin Main Page</a></p>
    </main>
  </body>
</html>
