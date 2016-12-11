<?php
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
    }
    //check if there are any matching fields
    if(($email == $table_users) && ($password == $table_password)){
      if($password == $table_password){
        //set the email as username in a session, this will serve as a global variable
        $_SESSION['user'] = $email;
        $_SESSION['firstname'] = $table_firstname;
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
?>
