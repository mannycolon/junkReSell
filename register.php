<html>
    <head>
        <title>Registration Page</title>
    </head>
    <body>
        <h1>Registration Page</h1>
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="register.php" method="POST">
          <h2>Account Information</h2>
           E-mail: <input type="text" name="email" required="required"><br>
           password: <input type="password" name="password" required="required" /> <br/>
           First Name: <input type="text" name="firstname" required="required" /> <br/>
           Last Name: <input type="text" name="lastname" required="required" /> <br/>
           <h2>Shipping Address</h2>
           Address: <input type="text" name="address" required="required" /> <br/>
           City: <input type="text" name="city" required="required" /> <br/>
           State: <input type="text" name="state" required="required" /> <br/>
           Zip Code: <input type="text" name="zipcode" required="required" /> <br/>
           Phone: <input type="text" name="phone" required="required" /> <br/>
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $firstname = mysql_real_escape_string($_POST['firstname']);
    $lastname = mysql_real_escape_string($_POST['lastname']);

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
  }
?>
