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

    <title>Product | All Reports</title>
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
          <h1 class="mb-4">Operators Details</h1>
        </div>

        <div class="col-lg-8">
          <table class="table table-light table-hover mt-3">
            <thead class="text-center">
              <tr class="text-center">
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Address</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $purchaseTotal = $saleTotal = 0;
      					$conn = mysqli_connect("localhost", "root", "", "posDB");
      					if (!$conn)
      						die("Connection failed: " . mysqli_connect_error());

      					$sql = 'select * from user natural join auth where active="Operator"';
                $result = mysqli_query($conn, $sql);

      					if (mysqli_num_rows($result) > 0)
      					{
      						while($row = mysqli_fetch_assoc($result))
      						{
                    echo  '<tr class="text-center">' .
                            '<td>' . $row['UserName'] . '</td>' .
                            '<td>' . $row['Email'] . '</td>' .
                            '<td>' . $row['Gender'] . '</td>' .
                            '<td>' . $row['Phone'] . '</td>' .
                            '<td>' . $row['Address'] . '</td>';
                    if ($_SESSION['auth'] != "Operator")
                    {
                      echo  '<form class="" action="admin.php" method="post">' .
                              '<td><button name="update_operator" class="btn btn-sm btn-outline-success">UPDATE</button></td>' .
                              '<td><button name="remove_operator" class="btn btn-sm btn-outline-danger">DELETE</button></td>' .
                              '<input type="hidden" name="user" value="' . $row['UserName'] . '">' .
                            '</form>';
                    }
                      echo '</tr>';
      						}
      					}
      					else
      						echo '<p class="btn btn-outline-danger">No result found</p>';


                $sql1 =  mysqli_fetch_assoc(mysqli_query($conn,"select pName from purchase where price = (select max(price) from purchase)"));
                $sql2 =  mysqli_fetch_assoc(mysqli_query($conn,
                          "SELECT sName, COUNT(sID) as idCount FROM sales GROUP BY(sID) ORDER BY idCount DESC LIMIT 1"));

                $sqlPurchase = mysqli_query($conn, "select * from purchase");
                if (mysqli_num_rows($sqlPurchase) > 0)
      						while($row = mysqli_fetch_assoc($sqlPurchase))
                    $purchaseTotal = $purchaseTotal + ($row['pQuantity']*$row['price']);

                $sqlSale = mysqli_query($conn, "select * from sales");
                if (mysqli_num_rows($sqlSale) > 0)
      						while($row = mysqli_fetch_assoc($sqlSale))
                    $saleTotal = $saleTotal + ($row['sQuantity']*$row['sPrice']);
      				?>
            </tbody>
          </table>
        </div>

        <div class="col-lg-4 mt-3">
          <div class="border bg-light rounded p-4">
            <h4 class="text-center mb-5"><b>Profit Details</b></h4>
              <table class="table table-light table-hover mt-3">
                <tbody>
                  <tr class="text-right">
                    <th>Net Profit:</th>
                    <th><?php echo ($saleTotal-$purchaseTotal) . '$'; ?></th>
                  </tr>
                  <tr class="text-right">
                    <th>Total Purchase:</th>
                    <th><?php echo $purchaseTotal . '$'; ?></th>
                  </tr>
                  <tr class="text-right">
                    <th>Total Sale:</th>
                    <th><?php echo $saleTotal . '$'; ?></th>
                  </tr>
                  <tr>
                    <th>Most Expensive Product:</th>
                    <th><?php echo $sql1['pName']; ?></th>
                  </tr>
                  <tr>
                    <th>Most Active Product:</th>
                    <th><?php echo $sql2['sName']; ?></th>
                  </tr>
                </tbody>
              </table>
              <?php mysqli_close($conn); ?>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
              <a href="purchaseReport.php" class="btn btn-outline-info mr-sm-2">Purchase Details</a>
              <a href="saleReport.php" class="btn btn-outline-info">Sale Details</a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <script src="../Bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../Bootstrap/popper.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
