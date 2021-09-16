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

    <title>Product | Sale</title>
  </head>
  <body>
    <?php include '../nav.php'; ?>

    <div class="container mb-5">
      <h1 class="mb-4">Sale Product</h1>
      <?php
        if (isset($_SESSION['PassErr']))
        {
          echo '<div class="alert alert-danger" role="alert">' . $_SESSION['PassErr'] . '</div>';
          unset($_SESSION['PassErr']);
        }
        if (isset($_SESSION['Pass']))
        {
          echo '<div class="alert alert-success" role="alert">' . $_SESSION['Pass'] . '</div>';
          unset($_SESSION['Pass']);
        }

        $conn = mysqli_connect("localhost", "root", "", "posDB");
        if (!$conn)
          die("Connection failed: " . mysqli_connect_error());

        $sql = "select * from product";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
        {
          echo '<div class="row row-cols-1 row-cols-md-4 g-4 mt-3">';
          while($row = mysqli_fetch_assoc($result))
          {
            echo '<form class="" action="cartCheck.php" method="post">' .
                    '<div class="col mt-3">' .
                      '<div class="card">' .
                        '<img src="data:pImg;base64,'. base64_encode($row['Img']) .'" class="card-img-top" alt="Img" width="250" height="170">' .
                        '<div class="card-body">' .
                          '<h5 class="card-title">' .  $row["Name"] . '</h5>' .
                        '</div>' .
                        '<div class="input-group input-group-sm mb-3">' .
                          '<input type="number" class="form-control ml-3" id="sQnt" name="sQuantity" value="1">' .
                          '<button type="submit" name="add_to_cart" class="btn btn-info btn-sm ml-3 mr-3 mb-3">Add To Cart</button>' .
                          '<input type="hidden" name="sID" value="' . $row['ID'] . '">' .
                          '<input type="hidden" name="sName" value="' . $row['Name'] . '">' .
                          '<input type="hidden" name="sPrice" value="' . $row['tPrice'] . '">' .
                        '</div>';
                        if ($_SESSION['auth'] != "Operator")
                        {
                          echo  '<div class="card-footer">' .
                                  '<button type="submit" name="drop_product" class="btn btn-outline-danger btn-sm">Drop Product</button>' .
												         '</div>';
                        }
                      echo '</div>' .
                    '</div>' .
                  '</form>';
          }
          echo '</div>';
        }
        else
          echo '<div class="alert alert-danger" role="alert">NO RESULT FOUND</div>';

        mysqli_close($conn);
      ?>
    </div>

    <script src="../js/addQuantity.js"></script>
    <script src="../Bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../Bootstrap/popper.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
