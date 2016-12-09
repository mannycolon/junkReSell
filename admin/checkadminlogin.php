<?php
  session_start();
  include '../cart/dbConfig.php';

  //get user input from adminlogin.php
  $email = mysql_real_escape_string($_POST['email']);
  $password = mysql_real_escape_string($_POST['password']);

  //Query the users table if there are matching rows equal to $email
  $query = mysqli_query($db,"SELECT * FROM administrators WHERE email='$email'");
  //Checks if email exists
  $exists = mysqli_num_rows($query);
  $table_users = "";
  $table_password = "";
  $table_firstname = "";
  //if there are not returning rows or no existing email
  if($exists > 0){
    //display all rows from query
    while($row = mysqli_fetch_assoc($query)){
      /*the first email row is passed on to $table_users,
      and so on until the query is finished*/
      $table_users = $row['email'];
      /*the first password row is passed on to $table_password,
      and so on until the query is finished*/
      $table_password = $row['password'];
      $table_firstname = $row['fullName'];
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
      //redirects to adminlogin.php
      print '<script>window.location.assign("adminlogin.php");</script>';
    }
  }else{
    print '<script>alert("Incorrect Email!");</script>';
    //redirects to adminlogin.php
    print '<script>window.location.assign("adminlogin.php");</script>';
  }
?>

