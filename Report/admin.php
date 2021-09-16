<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');
  else
  {
    if ($_SESSION['auth'] == "Operator")
      header('location:../Home/index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style.css">

    <title>Product | All Reports</title>
  </head>
  <body>
    <?php
      include '../nav.php';

      $conn = mysqli_connect("localhost", "root", "", "posDB");
      if (!$conn)
        die("Connection failed: " . mysqli_connect_error());

      $sql = mysqli_fetch_assoc(mysqli_query($conn,"select * from user where UserName = '$_POST[user]'"));
      if (isset($_POST['update_operator']))
      {
    ?>

    <div class="container">
      <h1 class="mb-4">Registration Form</h1>
      <form name="Form" action="adminConfigure.php" onsubmit="return validateForm()" method="post">
        <div class="row input-group mb-3">
          <label for="inputUsername3" class="col-sm-2 col-form-label"><b>Username</b></label>
          <div class="col-sm-10">
            <input type="text" class=" form-control text-muted" name="username" value="<?php echo $sql['UserName']; ?>" placeholder="Username" required>
            <small><span class="is-invalid error" id="userErr"></span></small><br>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Email</b></label>
          <div class="col-sm-10">
            <input type="email" class="form-control text-muted" name="email" value="<?php echo $sql['Email']; ?>" placeholder="abc@xyz.com" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputPhone3" class="col-sm-2 col-form-label"><b>Phone</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control text-muted" name="phone" value="<?php echo $sql['Phone']; ?>" placeholder="01XXXXXXXXX" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>Address</b></label>
          <div class="col-sm-10">
            <textarea class="form-control text-muted" name="address" rows="5" cols="40" required><?php echo $sql['Address']; ?></textarea>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>Date of Birth</b></label>
          <div class="col-sm-10">
            <input type="date" class="form-control text-muted" name="dob" value="<?php echo $sql['DOB']; ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>Password</b></label>
          <div class="row g-3 col-sm-10">
            <div class="col">
              <input type="password" class="form-control" name="old-password" value="" placeholder="Old Password" required>
              <small><span class="error" id="oldPassErr"></span></small>
            </div>
            <div class="col">
              <input type="password" class="form-control" name="password" value="" placeholder="New Password" required><br>
              <small><span class="error" id="passErr"></span></small>
            </div>
            <div class="col">
              <input type="password" class="form-control" name="re-password" value="" placeholder="Confirm" required>
              <small><span class="error" id="rePassErr"></span></small>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="checkbox" value="" checked required>
              <label class="form-check-label"><b>I Accept the Terms & Conditions</b></label>
            </div>
          </div>
        </div>

        <div class="d-md-flex justify-content-md-end mb-3">
          <a href="posReport.php" class="btn btn-outline-dark btn-sm mr-sm-2" name="cancel">Go back</a>
          <input type="submit" class="btn btn-outline-success btn-sm" name="update_info" value="UPDATE">
        </div>
      </form>
    </div>

    <?php
      }
      if (isset($_POST['remove_operator']))
      {
        $sqlDelete = "delete from user where UserName='$_POST[user]'";
        $sqlAuthDelete = "delete from auth where UserName='$_POST[user]'";

        if (mysqli_query($conn, $sqlDelete) && mysqli_query($conn, $sqlAuthDelete))
          $_SESSION['Pass'] = "USER DELETED SUCCESSFULLY";
        else
          $_SESSION['PassErr'] = "USER DELETE UNSUCCESSFUL";

        header('location:posReport.php');
      }
      mysqli_close($conn);
    ?>

    <script src="../js/formValidation.js"></script>
    <script src="../Bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../Bootstrap/popper.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
