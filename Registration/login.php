<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/loginStyle.css">

    <style>
      body{background-image: url("../Media/LoginIndex.jpg");}
    </style>

    <title>Form | Signin</title>
  </head>
  <body>
    <form class="box" action="auth.php" method="post">
      <h1>Login</h1>
      <input type="text" name="username" value="" placeholder="Username" required><br>
      <input type="password" name="password" value="" placeholder="Password" required><br>
      <?php
        if (isset($_SESSION['PassErr']))
        {
          echo '<div class="alert alert-light bg mt-2 mb-2" role="alert">' . $_SESSION['PassErr'] . '</div>';
          unset($_SESSION['PassErr']);
        }
      ?>
      <input type="submit" name="signin" value="Login">
    </form>
  </body>
</html>
