<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

    <main>
      <form action="register.php" method="POST" style="text-align: center; padding-left: 100px; padding-right: 100px">
      <div class="row"><br/>
        <h1 style="text-align: center">Registration Page</h1><br/><br/>
        <div class="col-sm-4 col-md-4">
          <h2>Account Information</h2><br/><br/>
          <input class="form-control" type="text" name="email"
                 required="required" placeholder="Email address"><br>
          <input class="form-control" type="password" name="password"
                 required="required" placeholder="Password"/> <br/>
          <input class="form-control" type="text" name="firstname"
                  required="required" placeholder="First Name"/> <br/>
          <input class="form-control" type="text" name="lastname"
                 required="required" placeholder="Last Name"/> <br/>
        </div>
        <div class="col-sm-4 col-md-4">
        <h2>Shipping Address</h2><br/><br/>
          <input class="form-control" type="text" name="address"
                 required="required" placeholder="Address"/> <br/>
          <input class="form-control" type="text" name="city"
                 required="required" placeholder="City"/> <br/>
          <input class="form-control" type="text" name="state"
                 required="required" placeholder="State"/> <br/>
          <input class="form-control" type="text" name="zipcode"
                 required="required" placeholder="Zip Code"/> <br/>
          <input class="form-control" type="text" name="phone"
                 required="required" placeholder="Phone Number"/> <br/>
        </div>
        <div class="col-sm-4 col-md-4">
        <h2>Billing Address</h2>
          <input type='checkbox' onclick='handleClick(this);' name="useShipping">
                  Use shipping address<br/><br/>
          <input class="billing" type="text" name="billingaddress"
                 required placeholder="Address"/><br/>
          <input class="billing" type="text" name="billingcity"
                 required placeholder="City"/> <br/>
          <input class="billing" type="text" name="billingstate"
                 required placeholder="State"/> <br/>
          <input class="billing" type="text" name="billingzipcode"
                 required placeholder="Zip Code"/> <br/>
          <input class="billing" type="text" name="billingphone"
                 required placeholder="Phone Number"/> <br/>
        </div>
      </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">
          Register
        </button>
      </form>
      <script>
          function handleClick(){
            var cells = document.getElementsByClassName("billing");
            for (var i = 0; i < cells.length; i++) {
              cells[i].required = false;
            }
          }
      </script>
    </body>
</html>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //to be saved in the users table in the db
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $firstname = mysql_real_escape_string($_POST['firstname']);
    $lastname = mysql_real_escape_string($_POST['lastname']);
    //the variables below will be saved in the addresses table in the db
    $address = mysql_real_escape_string($_POST['address']);
    $city = mysql_real_escape_string($_POST['city']);
    $state = mysql_real_escape_string($_POST['state']);
    $zipcode = mysql_real_escape_string($_POST['zipcode']);
    $phone = mysql_real_escape_string($_POST['phone']);
    //get billing address if use shipaddress not selected
    $billAddress = mysql_real_escape_string($_POST['billingaddress']);
    $billCity = mysql_real_escape_string($_POST['billingcity']);
    $billState = mysql_real_escape_string($_POST['billingstate']);
    $billZipcode = mysql_real_escape_string($_POST['billingzipcode']);
    $billPhone = mysql_real_escape_string($_POST['billingphone']);
    $bool = true;

    // include database configuration file
    include '../util/dbConfig.php';

    //Query the users table
    $stmt = $db->query("SELECT * FROM users");
    //displaying all row from query
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      /*the first email row is passed on to $table_users,
      and so on until the query is finished */
      $table_users = $row['email'];
      //checks if there are any matching fields
      if($email == $table_users){
        $bool = false;
        //Prompt the user that the email has been previously used
        print '<script>alert("Email has been taken!");</script>';
        //redirects to register.php
        print '<script>window.location.assign("register.php");</script>';
      }
    }
    if($bool){
      //inserts the values to table users
      $db->exec("INSERT INTO users (email, password, firstname, lastname) VALUES ('$email', '$password', '$firstname', '$lastname')");
      $stmt = $db->query("SELECT * FROM users");
      //displaying all row from query
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $userID = $row['userID'];
      }
      $db->exec("INSERT INTO addresses (userID, address, city, state, zipCode, phone) VALUES ('$userID', '$address', '$city', '$state', '$zipcode', '$phone')");
      $stmt = $db->query("SELECT * FROM addresses WHERE userID='$userID'");
      //displaying all row from query
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $shipAddressID = $row['addressID'];
      }
      //use shipping address as billing address
      if($_POST['useShipping']){
        $billingAddressID = $shipAddressID;
      }else{
        $db->exec("INSERT INTO addresses (userID, address, city, state, zipCode, phone) VALUES ('$userID', '$billAddress', '$billCity', '$billState', '$billZipcode', '$billPhone')");
        $stmt = $db->query("SELECT * FROM addresses WHERE userID='$userID'");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $billingAddressID = $row['addressID'];
        }
      }
      $db->exec("UPDATE users SET shipAddressID = '$shipAddressID' WHERE userID='$userID'");
      $db->exec("UPDATE users SET billingAddressID = '$billingAddressID' WHERE userID='$userID'");
      //prompt to let user know registration was succesful
      print '<script>alert("Successully registered!");</script>';
      //redirects to register.php
      print '<script>window.location.assign("index.php");</script>';
    }
    //logging in user automatically
    session_start();
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    // include database configuration file
    include '../util/dbConfig.php';

    $stmt = $db->query("SELECT * FROM users WHERE email='$email'");
    $row_count = $stmt->rowCount();
    $table_users = "";
    $table_password = "";
    $table_firstname = "";
    $table_userID = "";
    //if there are not returning rows or no existing email
    if($row_count > 0){
      //display all rows from query
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        /*the first email row is passed on to $table_users,
        and so on until the query is finished*/
        $table_users = $row['email'];
        /*the first password row is passed on to $table_password,
        and so on until the query is finished*/
        $table_password = $row['password'];
        $table_firstname = $row['firstname'];
        $table_userID = $row['userID'];
      }
      //check if there are any matching fields
      if(($email == $table_users) && ($password == $table_password)){
        if($password == $table_password){
          //set the email as username in a session, this will serve as a global variable
          $_SESSION['user'] = $email;
          $_SESSION['firstname'] = $table_firstname;
          $_SESSION['userID'] = $table_userID;
          //redirects the user to the authenticated home page
          header("location: index.php");
        }
      }else{
        print '<script>alert("Incorrect Password!");</script>';
        //redirects to login.php
        print '<script>window.location.assign("login.php");</script>';
      }
    }else{
      print '<script>alert("Incorrect Email!");</script>';
      //redirects to login.php
      print '<script>window.location.assign("login.php");</script>';
    }
  }
?>
