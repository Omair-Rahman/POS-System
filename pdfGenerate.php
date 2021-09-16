<?php
  session_start();

  require_once __DIR__ . '/vendor/autoload.php';
  $mpdf = new \Mpdf\Mpdf();

  $orderData = "<h1 style=text-align:center;>Order Details</h1><br>";
  $orderData .= '<style>.style{text-align:center;border:1px solid #ADADAD;width:100%}</style>';
  $orderData .= '<table class="style">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Product ID</th>
                      <th>Product Name</th>
                      <th>Product Qunatity</th>
                      <th>Product Price</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>';

  $total = $i = 0;
  $shipment = 5;
  $vat = 0.2;
  foreach ($_SESSION['cart'] as $array => $value)
  {
    $orderData .= '<tr style=text-align:center;>' .
                    '<th>' . ++$i . '</th>' .
                    '<td>' . $value['Product_ID'] . '</td>' .
                    '<td>' . $value['Product_Name'] . '</td>' .
                    '<td>' . $value['Product_Quantity'] . '</td>' .
                    '<td>' . $value['Product_Price'] . '</td>' .
                  '</tr>';
    $total = $total + ($value['Product_Quantity']*$value['Product_Price']);
  }
  $orderData .=   "</tbody>
                </table>";

  $orderData .= '<br><br>
                <h1 style=text-align:center;>Amount Details</h1>

                <h5><b>Payment Method: </b><small>Cash on Delivery</small> <br></h5>

                <h4><small><b>Sub-Total: </b><strong>' . $total . '$</strong></small></h4>
                <h4><small><b>Flat Shipping Rate: </b><strong>' . ($shipment*$i) . '$</strong></small></h4>
                <h4><small><b>VAT: </b><strong>' . (2/100)*$i . '$</strong></small></h4>
                <h4><small><b>Total: </b><strong>' . ($total+((2/100)*$i)+($shipment*$i)) . '$</strong></small></h4>';

  $conn = mysqli_connect("localhost", "root", "", "posDB");
  if (!$conn)
    die("Connection failed: " . mysqli_connect_error());
  $sql =  mysqli_fetch_assoc(mysqli_query($conn,"SELECT UserName,Email,Phone FROM user WHERE UserName='$_SESSION[username]'"));
  $orderData .= '<br><br>
                <h1 style=text-align:center;>Operator Details</h1>

                Name: <b>' . $sql['UserName'] . '</b><br>
                Email: <b>' . $sql['Email'] . '</b><br>
                Phone: <b>' . $sql['Phone'] . '</b><br>';

  $orderData .= '<br><br>
                <h1 style=text-align:center;>---------- THANK YOU FOR VISITING ----------</h1>';

  foreach ($_SESSION['cart'] as $array => $value)
    unset($_SESSION['cart'][$array]);
  mysqli_close($conn);

  $mpdf->WriteHTML($orderData);
  $mpdf->Output('testPDF.pdf','D');
  ?>
