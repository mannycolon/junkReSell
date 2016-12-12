<?php
  session_start();
  include '../util/dbConfig.php';

  //get user input from adminlogin.php
  $email = mysql_real_escape_string($_POST['email']);
  $password = mysql_real_escape_string($_POST['password']);
  //Query the users table if there are matching rows equal to $email
  $stmt = $db->query("SELECT * FROM administrators WHERE email='$email'");
  $row_count = $stmt->rowCount();
  $table_users = "";
  $table_password = "";
  $table_firstname = "";
  $table_adminID = "";
  //if there are not returning rows or no existing email
  if($row_count > 0){
    //display all rows from query
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      /*the first email row is passed on to $table_users,
      and so on until the query is finished*/
      $table_users = $row['email'];
      /*the first password row is passed on to $table_password,
      and so on until the query is finished*/
      $table_password = $row['password'];
      $table_firstname = $row['fullName'];
      $table_adminID = $row['adminID'];
    }
    //check if there are any matching fields
    if(($email == $table_users) && ($password == $table_password)){
      if($password == $table_password){
        //set the email as username in a session, this will serve as a global variable
        $_SESSION['admin'] = $email;
        $_SESSION['firstname'] = $table_firstname;
        $_SESSION['adminID'] = $table_adminID;
        //redirects the user to the authenticated home page
        header("location: index.php");
      }
    }else{
      print '<script>alert("Incorrect Password!");</script>';
      //redirects to adminlogin.php
      print '<script>window.location.assign("adminlogin.php");</script>';
    }
  }else{
    print '<script>alert("Incorrect Email!");</script>';
    //redirects to adminlogin.php
    print '<script>window.location.assign("adminlogin.php");</script>';
  }
?>
