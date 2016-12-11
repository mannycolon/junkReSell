<?php
  session_start();
  if($_SESSION['user']){
  }else{
    //redirect if user is not logged in
    header("location: $app_path");
  }
  $cardFullName = mysql_real_escape_string($_POST['cardFullName']);
  $cardSecurityCode = mysql_real_escape_string($_POST['cvv']);
  $cardNumber = mysql_real_escape_string($_POST['cardNumber']);
  $cardMonth = mysql_real_escape_string($_POST['cardMonth']);
  $cardYear = mysql_real_escape_string($_POST['cardYear']);
  $cardExpires = $cardMonth . "/" . $cardYear;
  $orderID = $_SESSION["orderID"];

  //connecting to the Server
  include '../util/dbConfig.php';

  $query = mysql_query("select * from orders");
  $db->query("UPDATE orders SET cardFullName= '$cardFullName', cardNumber = '$cardNumber',
    cardExpires = '$cardExpires', cvv ='$cardSecurityCode'  WHERE id='$orderID'");
    header("Location: orderSuccess.php?id=$orderID");
?>
