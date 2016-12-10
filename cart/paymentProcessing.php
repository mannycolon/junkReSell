<?php
  session_start();
  $cardFullName = mysql_real_escape_string($_POST['cardFullName']);
  $cardSecurityCode = mysql_real_escape_string($_POST['cvv']);
  $cardNumber = mysql_real_escape_string($_POST['cardNumber']);
  $cardMonth = mysql_real_escape_string($_POST['cardMonth']);
  $cardYear = mysql_real_escape_string($_POST['cardYear']);
  $cardExpires = $cardMonth . "/" . $cardYear;
  $orderID = $_SESSION["orderID"];

  //connecting to the Server
  mysql_connect("localhost", "root", "") or die(mysql_error());
  //connecting to database
  mysql_select_db("junkReSell_db") or die("cannot connect to login database");
  $query = mysql_query("select * from orders");

  mysql_query("UPDATE orders SET cardFullName= '$cardFullName', cardNumber = '$cardNumber',
    cardExpires = '$cardExpires', cvv ='$cardSecurityCode'  WHERE id='$orderID'");
    header("Location: orderSuccess.php?id=$orderID");

?>
