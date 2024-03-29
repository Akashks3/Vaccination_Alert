<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `reg` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div> <div class='form'>
                  <h3>don't have an accont</h3><br/>
                  <p class='link'>Click here to <a href='register_process.php'>register now</a>again</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
    <div class="container">
        <img src="https://cdn.create.vista.com/api/media/small/151260614/stock-photo-baby-boy-at-vaccination" alt="" width="500px"height="400px">
    </div>
    <h1 class="login-title">Login</h1>
 <label for="uname"class="input-label"Username>username</label>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
 <label for="psw"class="input-label"Username>password</label>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? 
            <br><br><a href="register_process.php" class="login-button">Registration Now</a></p>
  </form>
<?php
    }
?>
</body>
</html>
