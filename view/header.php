<?php
$activePage = dirname($_SERVER['PHP_SELF']) . "/" . basename($_SERVER['PHP_SELF'], ".php");
?>

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
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <ul class="nav navbar-nav">
              <li class="<?= ($activePage == '/junkReSell/index') ? 'active':'';?>">
                <a href="<?php echo $app_path ?>index.php">Home</a>
              </li>
              <li><a href="categories.php">Categories</a></li>
              <li><a href="admin.php">Admin</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php
                //checks if user is logged in
                if (isset($_SESSION['user'])) :
              ?>
                  <li class="<?= ($activePage == '/junkReSell/account/index') ? 'active':'';?>">
                    <a href="<?php echo $app_path ?>account/index.php"><?php echo $user ?></a>
                  </li>
                  <li><a href="<?php echo $app_path ?>account/logout.php">Logout</a></li>
              <?php else: ?>
                  <li class="<?= ($activePage == '/junkReSell/account/login') ? 'active':'';?>">
                    <a href="<?php echo $app_path ?>./account/login.php">Login</a>
                  </li>
              <?php endif; ?>
                  <li class="<?= ($activePage == '/junkReSell/account/register') ? 'active':'';?>">
                    <a href="<?php echo $app_path ?>account/register.php">Register</a>
                  </li>
                  <li class="<?= ($activePage == '/junkReSell/cart/index') ? 'active':'';?>">
                    <a href="<?php echo $app_path ?>cart/index.php">My Cart</a>
                  </li>
                  <li class="<?= ($activePage == '/junkReSell/checkout/index') ? 'active':'';?>">
                    <a href="<?php echo $app_path ?>checkout/index.php">Checkout</a>
                  </li>
            </ul>
         </div>
        </nav>
      </header>
