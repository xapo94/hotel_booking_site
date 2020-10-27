<?php

require __DIR__.'/../boot/boot.php';

use Hotel\User;

if (!empty(User::getCurrentUserId())){
  header('Location: /collegelink/public/index.php'); die;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex,nofollow">
        <title>Register-Log in Page</title>
        <style type="text/css">
            body {
                background: #fff;
            }
        </style>
        <script src="assets/jquery-3.5.1.min.js"></script>
        <script src="assets/js/register.js"></script>
        <script src="assets/js/form_valid.js"></script>
    </head>
    <body>
        <div class="container">
        <header class="header">
          <div class="topnav">
            <p class="main-logo">Hotels</p>
            <div class="topnav-right">
              <a href="http://localhost/collegelink/public/index.php"><i class="fas fa-home"></i>Home</a>
            </div>
          </div>
          <div class="clear"></div>
        </header>
        </div>
        <main>
          <div class="container2">
            <form action="actions/register.php" method="post" class="register-form">
              <h2>Sign Up</h2>
              <p>Please fill in this form to create an account.</p>

              <div class="username">
                <h3><b>Username</b></h3>
                <input type="text" placeholder="Enter Your Username" name="name" required>
              </div>
              <div class="email">
                <h3><b>Email</b></h3>
                <input type="text" id="email" placeholder="Enter Your Email" name="email" required>
                <p class="inform error-mail">Must be a valid e-mail address!</p>
              </div>
              <div class="password">
                <h3><b>Password</b></h3>
                <input type="password" id="password" placeholder="Enter Your Password" name="password" required>
                <p class="inform error-password">Password must be more than 4 characters!</p>
              </div>
              <div class="form-button">
                <button name="button" class="button" type="submit">Register</button>
              </div>
            </form>
            <p class="sign-in-message">Already have an Account? <button class="sign_in" id="sign_in">Sign in!</button></p>
            <form class="form-sign-in" id="form-sign-in" action="actions/login.php" method="post">
              <h2>Sign In</h2>
              <div class="email">
                <h3><b>Email</b></h3>
                <input type="text" placeholder="Enter Your Email" name="email_login" required>
              </div>
              <div class="password">
                <h3><b>Password</b></h3>
                <input type="password" placeholder="Enter Your Password" name="password_login" required>
              </div>
              <div class="form-button-sign-in">
                <button name="button" class="button" type="submit">Sign in</button>
              </div>
            </form>
          </div>
        </main>
        <footer class="footer"><p>(c) Copyright CollegeLink 2020</p></footer>
        <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
        <link rel="stylesheet" href="register.css" type="text/css" />
    </body>
</html>
