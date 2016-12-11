<?php
$activePage = dirname($_SERVER['PHP_SELF']) . "/" . basename($_SERVER['PHP_SELF'], ".php");
?>

<!DOCTYPE html>
<html>
<!-- the head section -->
  <head>
    <title>junkReSell</title>
    <link rel="stylesheet" type="text/css"
          href="<?php echo $app_path ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
                href="<?php echo $app_path ?>assets/css/main.css">
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
              <?php
                //checks if user is logged in
                if (isset($_SESSION['user'])) :
              ?>
              <li>
                <img src="<?php echo $app_path ?>/assets/logo.png" alt="junkReSell Logo" width="100px" align="middle">
              </li>
              <li class="<?= ($activePage == '/junkReSell/index') ? 'active':'';?>">
                <a href="<?php echo $app_path ?>index.php">Home</a>
              </li>
              <li class="<?= ($activePage == '/junkReSell//category/categories') ? 'active':'';?>">
                <a href="<?php echo $app_path ?>/category/categories.php">Categories</a>
              </li>
              <?php elseif(isset($_SESSION['admin'])): $admin = $_SESSION['admin']; ?>
                <li>
                  <img src="<?php echo $app_path ?>/assets/logo.png" alt="junkReSell Logo" width="100px" align="middle">
                </li>
                <li class="<?= ($activePage == '/junkReSell/index') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>index.php">Home</a>
                </li>
                <li class="<?= ($activePage == '/junkReSell//category/categories') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>/category/categories.php">Categories</a>
                </li>
                <li class="<?= ($activePage == '/junkReSell//admin/index') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>/admin/index.php">Hi, <?php echo $admin ?></a>
                </li>
              <?php else: ?>
              <li>
                <img src="<?php echo $app_path ?>/assets/logo.png" alt="junkReSell Logo" width="100px" align="middle">
              </li>
              <li class="<?= ($activePage == '/junkReSell/index') ? 'active':'';?>">
                <a href="<?php echo $app_path ?>index.php">Home</a>
              </li>
              <li class="<?= ($activePage == '/junkReSell//category/categories') ? 'active':'';?>">
                <a href="<?php echo $app_path ?>/category/categories.php">Categories</a>
              </li>
              <li class="<?= ($activePage == '/junkReSell//admin/adminlogin') ? 'active':'';?>">
                <a href="<?php echo $app_path ?>/admin/adminlogin.php">Admin</a>
              </li>
              <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php
                //checks if user is logged in
                if (isset($_SESSION['user'])) :
              ?>
                <li class="<?= ($activePage == '/junkReSell/account/index') ? 'active':'';?>">
                  <?php $user = $_SESSION['firstname'] ?>
                  <a href="<?php echo $app_path ?>account/index.php">Hi, <?php echo $user ?></a>
                </li>
                <li><a href="<?php echo $app_path ?>account/logout.php">Logout</a></li>
              <?php elseif(isset($_SESSION['admin'])): $admin = $_SESSION['admin']; ?>
                <li class="<?= ($activePage == '/junkReSell/account/login') ? 'active':'';?>">
                  <li><a href="<?php echo $app_path ?>account/logout.php">Logout</a></li>
                </li>
                <li class="<?= ($activePage == '/junkReSell/account/register') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>account/register.php">Register</a>
                </li>
              <?php else: ?>
                <li class="<?= ($activePage == '/junkReSell/account/login') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>./account/login.php">Login</a>
                </li>
                <li class="<?= ($activePage == '/junkReSell/account/register') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>account/register.php">Register</a>
                </li>
              <?php endif; ?>
                <li class="<?= ($activePage == '/junkReSell/cart/viewCart') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>cart/viewCart.php">
                    <?php
                      include($_SERVER['DOCUMENT_ROOT'].'/junkReSell/cart/cart.php');
                       $cart = new Cart;
                       $cartNumOfItems = $cart->totalItems();
                    ?>
                    My Cart <span class="badge" id="comparison-count"><?php echo $cartNumOfItems ?></span>
                    </a>
                </li>
                <li class="<?= ($activePage == '/junkReSell/cart/checkout') ? 'active':'';?>">
                  <a href="<?php echo $app_path ?>cart/checkout.php">Checkout</a>
                </li>
            </ul>
         </div>
        </nav>
      </header>
