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
      <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light">
          <h1 class="mb-4">Sale Details</h1>
        </div>

        <div class="col-lg-8">
          <table class="table table-light table-hover mt-3">
            <thead class="text-center">
              <tr class="text-center">
                <th scope="col">Item</th>
                <th scope="col">Product ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Qunatity</th>
                <th scope="col">Product Price</th>
              </tr>
            </thead>
            <tbody>
              <?php
      					$conn = mysqli_connect("localhost", "root", "", "posDB");
      					if (!$conn)
      						die("Connection failed: " . mysqli_connect_error());

      					$sql = "select * from sales order by ID desc";
                $sql1 =  mysqli_fetch_assoc(mysqli_query($conn,
                          "SELECT sName, COUNT(sID) as idCount FROM sales GROUP BY(sID) ORDER BY idCount DESC LIMIT 1"));

      					$result = mysqli_query($conn, $sql);

                $i = $total = $subTotal = 0;
      					if (mysqli_num_rows($result) > 0)
      					{
      						while($row = mysqli_fetch_assoc($result))
      						{
                    echo  '<tr class="text-center">' .
                            '<th scope="row">' . ++$i . '</th>' .
                            '<td>' . $row['sID'] . '</td>' .
                            '<td>' . $row['sName'] . '</td>' .
                            '<td>' . $row['sQuantity'] . '</td>' .
                            '<td>' . $row['sPrice'] . '$</td>' .
                          '</tr>';
                    $total = $total + ($row['sQuantity']*$row['sPrice']);
                    if ($i<=10)
                      $subTotal = $total;
      						}
      					}
      					else
      						echo '<p class="btn btn-outline-danger">No result found</p>';
      				?>
            </tbody>
          </table>
        </div>

        <div class="col-lg-4 mt-3">
          <div class="border bg-light rounded p-4">
            <h4 class="text-center mb-5"><b>Sub Details</b></h4>
            <table>
              <table class="table table-light table-hover mt-3">
                <tbody>
                  <tr class="text-right">
                    <th>All Sale Profit:</th>
                    <th><?php echo $total . '$'; ?></th>
                  </tr>
                  <tr class="text-right">
                    <th>Last 10 Sale Profit:</th>
                    <th><?php echo $subTotal . '$'; ?></th>
                  </tr>
                  <tr></tr>
                  <tr>
                    <th>Most Valuable Product:</th>
                    <th>
                      <?php echo $sql1['sName']; ?>
                    </th>
                  </tr>
                </tbody>
            </table>
            <?php mysqli_close($conn); ?>
          </div>
        </div>

      </div>
    </div>

    <script src="../Bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../Bootstrap/popper.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
