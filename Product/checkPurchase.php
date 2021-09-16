<?php
	session_start();
	if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

	$conn = mysqli_connect("localhost", "root", "", "posDB");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

	if ($_FILES["pImage"]["tmp_name"]!="")
		$image = addslashes(file_get_contents($_FILES["pImage"]["tmp_name"]));

	$sqlExist = "select * from product where ID = '$_POST[pID]'";
	$result = mysqli_query($conn, $sqlExist);

	if (mysqli_num_rows($result)==0)
	{
		$sql = "INSERT INTO purchase (pID, pName, pImg, pQuantity, price)
			   VALUES ('$_POST[pID]', '$_POST[pName]', '$image',
						'$_POST[pQuantity]', '$_POST[pPrice]')";

		$sqlProduct = "INSERT INTO product (ID, Name, Img, Number, tPrice)
			   VALUES ('$_POST[pID]', '$_POST[pName]', '$image',
						'$_POST[pQuantity]', '$_POST[pPrice]')";

		if (mysqli_query($conn, $sql) && mysqli_query($conn, $sqlProduct))
		{
			$_SESSION['Pass'] = "PRODUCT ADDED SUCCESSFULLY";
			header('location:allProduct.php');
		}
	 	else
		{
			$_SESSION['PassErr'] = "PRODUCT ADD UNSUCCESSFUL";
			header('location:purchase.php');
		}
	}
	else
	{
		$sqlNameExist = "select * from product where Name = '$_POST[pName]'";
		$resultExist = mysqli_query($conn, $sqlNameExist);

		if (mysqli_num_rows($resultExist))
		{
			$sqlin = "INSERT INTO purchase (pID, pName, pImg, pQuantity, price)
				   VALUES ('$_POST[pID]', '$_POST[pName]', '',
							'$_POST[pQuantity]', '$_POST[pPrice]')";

			$sqlUpdate = "update product
										set Number=Number+'$_POST[pQuantity]', tPrice='$_POST[pPrice]'
										where ID = '$_POST[pID]' and Name = '$_POST[pName]'";
			if (mysqli_query($conn, $sqlUpdate) && mysqli_query($conn, $sqlin))
			{
				$_SESSION['Pass'] = "PRODUCT ADDED SUCCESSFULLY";
				header('location:allProduct.php');
			}
		}
		else
		{
			$_SESSION['PassErr'] = "PRODUCT ADD UNSUCCESSFUL";
			header('location:purchase.php');
		}
	}
  mysqli_close($conn);
?>
