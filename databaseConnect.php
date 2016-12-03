<?php
//Connect to database
$dsn = 'mysql:host=localhost;dbname=junkresell_db';
$username = 'root';
$password = '';

try 
{
    $db = new PDO($dsn, $username, $password);
} 
catch (PDOException $e) 
{
    $error_message = $e->getMessage();
    echo '<p>Not connected to database</p>';
    exit();
}

?>