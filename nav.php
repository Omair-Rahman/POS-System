<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="../Home/index.php"><strong id="name">POS System</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link mr-lft-rt-20" href="../Home/index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../Product/allProduct.php">Product</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Purchase
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="../Product/purchase.php">Buy</a>
              <a class="dropdown-item" href="../Product/sale.php">Sale</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../Report/posReport.php">Administrator</a>
					</li>
				</ul>
				<?php
					if ($_SESSION['auth'] != "Operator")
						echo '
						<a class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" href="../Registration/registration.php">Register</a>
						';
					$index = 0;
          if (isset($_SESSION['cart']))
            $index = count($_SESSION['cart']);
				?>
				<a class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" href="../Product/cart.php">
          Cart
          <span class="badge bg-light txt-b"><?php echo $index; ?></span>
        </a>
				<a class="btn btn-outline-success my-2 my-sm-0" href="../Registration/logout.php">Logout</a>
			</div>
		</nav>

    <script src="../js/txtBlink.js"></script>
  </body>
</html>
