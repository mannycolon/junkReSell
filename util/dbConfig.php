<?php
  //DB details
  //Create connection and select DB
  try {
    $db = new PDO('mysql:host=localhost;dbname=junkReSell_db', 'junkReSell', 'junkReSellpass');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
  }

?>
