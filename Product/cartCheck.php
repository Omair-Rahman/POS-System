<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

    $conn = mysqli_connect("localhost", "root", "", "posDB");
    if (!$conn)
  		die("Connection failed: " . mysqli_connect_error());

    if (isset($_POST['add_to_cart']))
    {
      if (isset($_SESSION['cart']))
      {
        $index = count($_SESSION['cart']);
        $_SESSION['cart'][$index] = array(
                                      'Product_ID' => $_POST['sID'],
                                      'Product_Name' => $_POST['sName'],
                                      'Product_Quantity' => $_POST['sQuantity'],
                                      'Product_Price' => $_POST['sPrice']
                                    );
      }
      else
      {
        $_SESSION['cart'][0] = array(
                                  'Product_ID' => $_POST['sID'],
                                  'Product_Name' => $_POST['sName'],
                                  'Product_Quantity' => $_POST['sQuantity'],
                                  'Product_Price' => $_POST['sPrice']
                                );
      }
      $_SESSION['Pass'] = "PRODUCT ADDED IN CART SUCCESSFULLY";
      header('location:sale.php');
    }

    if (isset($_POST['remove_cart']))
    {
      foreach ($_SESSION['cart'] as $array => $value)
      {
        if ($value['Product_ID'] == $_POST['sID'])
        {
          unset($_SESSION['cart'][$array]);
          $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
      }
      $_SESSION['Pass'] = "PRODUCT REMOVED FROM CART SUCCESSFULLY";
      header('location:cart.php');
    }

    if (isset($_POST['drop_product']))
    {
      $sqlDeleteProduct = "delete from product where ID ='$_POST[sID]'";

      if (mysqli_query($conn, $sqlDeleteProduct))
      {
        $_SESSION['Pass'] = "PRODUCT DELETED SUCCESSFULLY";
        $_SESSION['PassErr'] = "PRODUCT ID CAN REUSE FOR NEXT NEW PRODUCT";
      }
      else
        $_SESSION['PassErr'] = "PRODUCT DELETE UNSUCCESSFUL";

      header('location:sale.php');
    }
    mysqli_close($conn);
?>
