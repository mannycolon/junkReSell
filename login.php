<html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <h2>Login Page</h2>
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="checklogin.php" method="POST">
           Email: <input type="text" name="email" required="required"><br>
           Password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" value="Login"/>
        </form>
    </body>
</html>
