<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

  $conn = mysqli_connect("localhost", "root", "", "posDB");
  if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

  $sql = mysqli_fetch_assoc(mysqli_query($conn,"select * from user where UserName = '$_POST[username]'"));

  if (isset($_POST['update_info']))
  {
    if ($_POST['old-password']!=$sql['Password'])
      $_SESSION['PassErr'] = "Password Incorrect";
    else
    {
      $sqlUpdate = "update user
                  set Password='$_POST[password]', Email='$_POST[email]', Phone='$_POST[phone]', Address='$_POST[address]', DOB='$_POST[dob]'
                  where UserName='$_POST[username]'";

      mysqli_query($conn, $sqlUpdate);
      $_SESSION['Pass'] = "USER DETAILS UPDATED";
    }
    header('location:posReport.php');
  }
  mysqli_close($conn);
?>
