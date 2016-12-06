<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

    <main>
      <form action="register.php" method="POST" style="text-align: center; padding-left: 100px; padding-right: 100px">
      <div class="row">
        <h1 style="text-align: center">Registration Page</h1>
        <div class="col-sm-4 col-md-4">
          <h2>Account Information</h2>
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
        <h2>Shipping Address</h2>
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
          <input class="form-control" type="text" name="billingaddress"
                 required="required" placeholder="Address"/> <br/>
          <input class="form-control" type="text" name="billingcity"
                 required="required" placeholder="City"/> <br/>
          <input class="form-control" type="text" name="billingstate"
                 required="required" placeholder="State"/> <br/>
          <input class="form-control" type="text" name="billingzipcode"
                 required="required" placeholder="Zip Code"/> <br/>
          <input class="form-control" type="text" name="billingphone"
                 required="required" placeholder="Phone Number"/> <br/>
        </div>
      </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">
          Register
        </button>
      </form>
    </body>
</html>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $firstname = mysql_real_escape_string($_POST['firstname']);
    $lastname = mysql_real_escape_string($_POST['lastname']);
    //TODO integrate the below variables with database
    $address = mysql_real_escape_string($_POST['address']);
    $city = mysql_real_escape_string($_POST['city']);
    $state = mysql_real_escape_string($_POST['state']);
    $zipcode = mysql_real_escape_string($_POST['zipcode']);
    $phone = mysql_real_escape_string($_POST['phone']);

    echo "email account entered is " . $email . "<br/>";
    echo "password  entered is " . $password;

    $bool = true;

    //connecting to the Server
    mysql_connect("localhost", "root", "") or die(mysql_error());
    //connecting to database
    mysql_select_db("junkReSell_db") or die("cannot connect to login database");
    //Query the users table
    $query = mysql_query("select * from users");
    //displaying all row from query
    while($row = mysql_fetch_array($query)){
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
      mysql_query("INSERT INTO users (email, password, firstname, lastname) VALUES ('$email', '$password', '$firstname', '$lastname')");
      //prompt to let user know registration was succesful
      print '<script>alert("Successully registered!");</script>';
      //redirects to register.php
      print '<script>window.location.assign("register.php");</script>';
    }
    //logging in user automatically
    session_start();
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    //connecting to server
    mysql_connect("localhost", "root", "") or die(mysql_error());
    //connect to database
    mysql_select_db("junkReSell_db") or die("cannot connect to database");
    //Query the users table if there are matching rows equal to $email
    $query = mysql_query("SELECT * FROM users WHERE email='$email'");
    //Checks if email exists
    $exists = mysql_num_rows($query);
    $table_users = "";
    $table_password = "";
    //if there are not returning rows or no existing email
    if($exists > 0){
      //display all rows from query
      while($row = mysql_fetch_assoc($query)){
        /*the first email row is passed on to $table_users,
        and so on until the query is finished*/
        $table_users = $row['email'];
        /*the first password row is passed on to $table_password,
        and so on until the query is finished*/
        $table_password = $row['password'];
      }
      //check if there are any matching fields
      if(($email == $table_users) && ($password == $table_password)){
        if($password == $table_password){
          //set the email as username in a session, this will serve as a global variable
          $_SESSION['user'] = $email;
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
