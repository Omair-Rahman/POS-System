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

    <div class="container mt-5">
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
      ?>
      <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light">
          <h1 class="mb-4">Order Details</h1>
        </div>

        <div class="col-lg-9">
          <table class="table table-light table-hover mt-3">
            <thead class="text-center">
              <tr class="text-center">
                <th scope="col">Item</th>
                <th scope="col">Product ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Qunatity</th>
                <th scope="col">Product Price</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $total = $i = 0;
                $shipment = 5;
                $vat = 0.2;
                if (isset($_SESSION['cart']))
                {
                  foreach ($_SESSION['cart'] as $array => $value)
                  {
                    echo  '<tr class="text-center">' .
                            '<th scope="row">' . ++$i . '</th>' .
                            '<td>' . $value['Product_ID'] . '</td>' .
                            '<td>' . $value['Product_Name'] . '</td>' .
                            '<td>' . $value['Product_Quantity'] . '</td>' .
                            '<td>' . $value['Product_Price'] . '</td>' .
                            '<form class="" action="cartCheck.php" method="post">' .
                              '<td><button name="remove_cart" class="btn btn-sm btn-outline-danger">REMOVE</button></td>' .
                              '<input type="hidden" name="sID" value="' . $value['Product_ID'] . '">' .
                            '</form>' .
                          '</tr>';
                    $total = $total + ($value['Product_Quantity']*$value['Product_Price']);
                  }
                }
              ?>
            </tbody>
          </table>
        </div>

        <div class="col-lg-3 mt-3">
          <div class="border bg-light rounded p-4">
            <h4 class="text-center mb-5"><b>Amount Details</b></h4>

            <h6 class="test-left"><b>Payment Method</b></h6>
            <div class="form-check">
              <input class="form-check-input ml-1" type="radio" checked>
              <small><label class="form-check-label ml-4 mb-4">Cash on Delivery</label></small>
            </div>
            <h5 class="text-right"><small><b>Sub-Total: </b><?php echo '<strong>' . $total . '$</strong>'; ?></small></h5>
            <h5 class="text-right"><small><b>Flat Shipping Rate: </b><?php echo '<strong>' . ($shipment*$i) . '$</strong>'; ?></small></h5>
            <h5 class="text-right"><small><b>VAT: </b><?php echo '<strong>' . (2/100)*$i . '$</strong>'; ?></small></h5>
            <h5 class="l-up text-right"><small><b>Total: </b><?php echo '<strong>' . ($total+((2/100)*$i)+($shipment*$i)) . '$</strong>'; ?></small></h5>

            <form class="" action="confirmPurchase.php" method="post">
              <button type="submit" class="btn btn-outline-info btn-block mt-4" name="button">Buy Now</button>
              <input type="hidden" name="sub-total" value="<?php echo $total; ?>">
              <input type="hidden" name="flat-Shipping-rate" value="<?php echo $shipment; ?>">
              <input type="hidden" name="vat" value="<?php echo $vat; ?>">
            </form>
          </div>
        </div>

      </div>
    </div>

    <script src="../Bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../Bootstrap/popper.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
