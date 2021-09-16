<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

    $conn = mysqli_connect("localhost", "root", "", "posDB");
    if (!$conn)
  		die("Connection failed: " . mysqli_connect_error());

    if (!isset($_SESSION['cart']))
    {
      $_SESSION['PassErr'] = "CART IS EMPTY!!!";
      header('location:sale.php');
    }
    else
    {
      $sqlExist = (mysqli_query($conn,"select * from product"));
      $true = true;
      $err = "";
      $Total_price = 0;

      foreach ($_SESSION['cart'] as $array => $value)
      {
        while($row = mysqli_fetch_assoc($sqlExist))
        {
          if ($row['Number']<$value['Product_Quantity'] && $row['ID']==$value['Product_ID'])
          {
            $true = false;
            $err .= 'YOU REQUIRE QUANTITY CROSS THE QUANTITY LIMIT FOR THE PRODUCT "<strong>' . $value['Product_Name'] . '</strong>"<br>';
          }
        }
      }
      foreach ($_SESSION['cart'] as $array => $value)
      {
        $Total_price = $value['Product_Price'] + $_POST['flat-Shipping-rate'] + $_POST['vat'];
        if ($true)
        {
          $sql = "INSERT INTO sales (sID, sName, sQuantity, sPrice)
               VALUES ('$value[Product_ID]', '$value[Product_Name]','$value[Product_Quantity]', '$Total_price')";

          $sqlUpdate = "update product
   										set Number=Number-'$value[Product_Quantity]'
   										where ID = '$value[Product_ID]' and Name = '$value[Product_Name]'";

          if (mysqli_query($conn, $sqlUpdate) && mysqli_query($conn, $sql))
            include '../pdfGenerate.php';
        }
      }
      mysqli_close($conn);
      if (!$true)
      {
        $err .= "<br>PLEASE <strong>REMOVE</strong> THE PRODUCT FROM CART AND <strong>ADD</strong> AGAIN WITH THE AVAILABLE QUANTITY...";
        $_SESSION['PassErr'] = $err;
        header('location:cart.php');
      }
      else
      {
        $_SESSION['PassErr'] = "CART IS EMPTY!!!";
        header('location:sale.php');
      }
    }
?>
