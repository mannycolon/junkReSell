<!DOCTYPE html>
<html>
<!-- the head section -->
  <head>
    <title>junkReSell</title>
    <link rel="stylesheet" type="text/css"
          href="<?php echo $app_path ?>libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
                href="<?php echo $app_path ?>libs/css/main.css">
    <style>
    body{
      padding-top: 40px;
    }
    </style>
  </head>
  <body>
      <header>
        <!--will need to make this navigation bar standard throughout website-->
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo $app_path ?>index.php">Home</a> </li>
              <li><a href="categories.php">Categories</a></li>
              <li><a href="admin.php">Admin</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php
                //checks if user is logged in
                if (isset($_SESSION['user'])) :
              ?>
                  <li><a href="<?php echo $app_path ?>account/index.php"><?php echo $user ?></a></li>';
                  <li><a href="<?php echo $app_path ?>account/logout.php">Logout</a></li>
              <?php else: ?>
                  <li><a href='./account/login.php'>Login</a> </li>";
              <?php endif; ?>
              <li><a href="<?php echo $app_path ?>account/register.php">Register</a> </li>
              <li><a href="cart.php">My Cart</a> </li>
              <li><a href="checkout.php">Checkout</a> </li>
            </ul>
         </div>
        </nav>
      </header>
