<?php
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
        header("location: account.php");
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
?>
