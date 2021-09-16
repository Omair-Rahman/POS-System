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

		<title>Products</title>
	</head>
	<body>
		<?php include '../nav.php'; ?>

		<div class="container">
			<?php
        if (isset($_SESSION['Pass']))
        {
          echo '<div class="alert alert-success" role="alert">' . $_SESSION['Pass'] . '</div>';
          unset($_SESSION['Pass']);
        }
      ?>
			<h1 class="mb-4">Available Product</h1>
			<a href="purchase.php" class="btn btn-outline-dark btn-lg mb-3 mr-3">Add Product</a>
			<a href="sale.php" class="btn btn-outline-dark btn-lg mb-3">Sale Product</a>

			<form class="" action="" method="post" enctype="multipart/form-data">
				<?php
					$conn = mysqli_connect("localhost", "root", "", "posDB");
					if (!$conn)
						die("Connection failed: " . mysqli_connect_error());

					$sql = "select * from product";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0)
					{
						echo '<div class="row row-cols-1 row-cols-md-4 g-4">';
						while($row = mysqli_fetch_assoc($result))
						{
						  echo '<div class="col mt-3">' .
						 					'<div class="card">' .
						 						'<img src="data:pImg;base64,'. base64_encode($row['Img']) .'" class="card-img-top" alt="Img" width="250" height="170">' .
						 						'<div class="card-body">' .
						 							'<h5 class="card-title">' .  $row["Name"] . '</h5>' .
						 						'</div>' .
												'<div class="card-footer">' .
													'<small class="btn btn-outline d-flex justify-content-center ml-3">' . '<b>Regular Price: ' . $row["tPrice"] . '$</b></small>' .
													'<small class="btn btn-outline d-flex justify-content-center ml-3">' . '<b>Available Quantity: ' . $row["Number"] . '</b></small>' .
												'</div>' .
						     			'</div>' .
						   			'</div>';
						}
						echo '</div>';
					}
					else
						echo '<div class="alert alert-danger" role="alert">NO RESULT FOUND</div>';

					mysqli_close($conn);
				?>
			</form>
		</div>

		<script src="../Bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../Bootstrap/popper.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
