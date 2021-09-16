<?php
	session_start();
	if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

	$conn = mysqli_connect("localhost", "root", "", "posDB");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

	if ($_POST['username']=="")
		header('location:registration.php');
	else
	{
		$sql = "INSERT INTO user (UserName, Password, Email, Phone, Address, DOB, Gender)
			   VALUES ('$_POST[username]', '$_POST[password]', '$_POST[email]',
						'$_POST[phone]', '$_POST[address]', '$_POST[dob]',
						'$_POST[gender]')";
		$sql1 = "INSERT INTO auth (UserName, active)
			   VALUES ('$_POST[username]', '$_POST[auth]')";

		$sqlExist = "select * from user where UserName = '$_POST[username]'";
		$result = mysqli_query($conn, $sqlExist);

		if (mysqli_num_rows($result)==0)
		{
			if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1))
			{
				$_SESSION['Pass'] = "REGISTRATION SUCCESSFUL";
				header('location:registration.php');
			}
			else
			{
				$_SESSION['PassErr'] = "REGISTRATION FAILED";
				header('location:registration.php');
			}
		}
		else
		{
			$_SESSION['PassErr'] = "USER ALREADY EXIST";
			header('location:registration.php');
		}
	}
  mysqli_close($conn);
?>
