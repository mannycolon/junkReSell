<?php
//DB details
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $dbName = 'junkReSell_db';

  //Create connection and select DB
  $db = new mysqli($host, $username, $password, $dbName);

  if ($db->connect_error) {
      die("Cannot connect to database: " . $db->connect_error);
  }
?>
