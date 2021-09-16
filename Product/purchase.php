<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style.css">

    <title>Product | Purchase</title>
  </head>
  <body>
    <?php include '../nav.php'; ?>

    <div class="container">
      <h1 class="mb-4">Purchase Product</h1>
      <?php
        if (isset($_SESSION['PassErr']))
        {
          echo '<div class="alert alert-danger" role="alert">' . $_SESSION['PassErr'] . '</div>';
          unset($_SESSION['PassErr']);
        }
      ?>
      <form class="" action="checkPurchase.php" method="post" enctype="multipart/form-data">
        <div class="row input-group mb-3">
          <label for="inputID" class="col-sm-2 col-form-label"><b>Product ID</b></label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="pID" value="" placeholder="Product ID" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputName" class="col-sm-2 col-form-label"><b>Product Name</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="pName" value="" placeholder="Product Name" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputImage" class="col-sm-2 col-form-label"><b>Product Image</b></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" name="pImage" value="" placeholder="Product Image">
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputQuantity" class="col-sm-2 col-form-label"><b>Product Quantity</b></label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="pQuantity" value="" placeholder="Product Quantity" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputPrice" class="col-sm-2 col-form-label"><b>Product Price</b></label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="pPrice" value="" placeholder="Product Price"required>
          </div>
        </div>

        <div class="d-md-flex justify-content-md-end mb-3">
          <input type="submit" class="btn btn-outline-dark btn-lg" name="buy" value="Purchase">
        </div>
      </form>
    </div>

    <script src="../Bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../Bootstrap/popper.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
