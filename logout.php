<?php
    session_start();
    //remove's value of $_SESSION['']
    session_destroy();
    //redirect it to index page.
    header("location:index.php");
?>
