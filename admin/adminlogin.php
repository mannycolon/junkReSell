<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>
    <main><br/>
        <form class="form-signin" action="checkadminlogin.php" method="POST">
          <h2 class="form-signin-heading">Admin Login Page</h2><br/><br/>
           <input type="email"  placeholder="Email address" class="form-control" name="email" required="required" autofocus><br>
           <input type="password" placeholder="Password" class="form-control" name="password" required="required" /> <br/>
           <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
        </form>
    </main>
  </body>
</html>
