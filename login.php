<html>
    <head>
        <title>Login Page</title>
        <link href="bootstrap/css/signin.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <a href="index.php">Click here to go back</a><br/><br/>
        <form class="form-signin" action="checklogin.php" method="POST">
          <h2 class="form-signin-heading">Login Page</h2>
           <input type="email"  placeholder="Email address" class="form-control" name="email" required="required" autofocus><br>
           <input type="password" placeholder="Password" class="form-control" name="password" required="required" /> <br/>
           <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
        </form>
    </body>
</html>
