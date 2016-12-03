<?php
//start the session
session_start();
//checks if user is logged in
if($_SESSION['user']){
  $user = $_SESSION['user'];
}
?>
