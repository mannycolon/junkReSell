<?php
//start the session
session_start();
//checks if user is logged in
if($_SESSION){
  $user = $_SESSION['user'];
}
?>
