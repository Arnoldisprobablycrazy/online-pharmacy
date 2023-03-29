<?php include('../config/constants.php')?>
<html>
    <head>
        <title>Login-Online pharmacy</title>
        <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        } 
        if(isset($_SESSION['no-login-message']))
        {
            echo$_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        
        ?>
        <br><br>
<!--login form starts Here-->
<form action="" method="POST">
    Username:<br><br>
    <input type="text" name="username" placeholder="Enter Your Username"><br>
    Password:<br><br>
    <input type="password" name="password" placeholder="Enter Your Password"><br><br>
    <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
</form>
<!--login form ends-->

        <p class="text-center">Created by <a href ="#">Arnold Maweu</a></p>
</div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    //process for login form
    //1. Get data from login form
      $username=$_POST['username'];
      $password=md5($_POST['password']);
      //2. SQL to check whether the user with username and password exists or not
      $sql= "SELECT* FROM tbl_admin WHERE username='$username' AND password='$password'";
      //3. Execute the Query
      $res =mysqli_query($conn, $sql);
      $count =mysqli_num_rows($res);

      if($count==1)
      {
        //user available and login success
        $_SESSION['login'] ="<div class='success'>Login successful.</div>";
        $_SESSION['user'] =$username;//to chech if user is logged in
        //Redirect to home page
        header('location:'.SITEURL.'admin/');
            }
            else{
                //user not available and login fail
                $_SESSION['login'] ="<div class='error text-center'>wrong username or password.</div>";
                //Redirect to home page
        header('location:'.SITEURL.'admin/login.php');
            }
        }
        ?>