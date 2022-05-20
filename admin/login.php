<?php include('../config/constants.php'); ?>  
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css" type="text/css">
    <title>Login</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php
  if(isset($_SESSION['login']))
  {
      echo $_SESSION['login']; //Display session
      unset($_SESSION['login']); //Remove session
  }
  if(isset($_SESSION['no-login']))
  {
      echo $_SESSION['no-login']; //Display session
      unset($_SESSION['no-login']); //Remove session
  }
  ?>
  <br><br>
    <!-- login form starts here -->

    <form action="" method="POST" class="text-center">
    Username:<br>
    <input type="text" name="username" placeholder="Enter Username"><br><br>
    Password:<br>
    <input type="password" name="password" placeholder="Enter Password"><br><br>

    <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
    <p class="text-center">Created by - <a href="https://www.facebook.com/">Dhoju Sagar</a></p>

    </form>

    <!-- login form ends here -->
    </div>
    
</body>
</html>

<?php

// check whether submit button is clicked
if(isset($_POST['submit']))
{
    // process for login
    // get data from login form
    // $username= $_POST["username"];
    // $password= md5($_POST["password"]);
        $username = mysqli_real_escape_string($conn ,$_POST['username']);
        $raw_password = md5($_POST["password"]);
        $password = mysqli_real_escape_string($conn, $raw_password);


    // check whether current id password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // execute query
    $res = mysqli_query($conn ,$sql);

    // check whether data availabe or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        // user available
        $_SESSION['login'] = "<div class='success'>Logged in successfully</div>";
        $_SESSION['user'] = $username; //to check whether user is logged in or not
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        // not available
        $_SESSION['login'] = "<div class='error text-center'>Login failed</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
}

?>