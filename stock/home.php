<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>LUCCIANO'S</title>
	<link rel="shortcut icon" href="img/lucianos_black.ico">
	<!-- Bootstrap 4.5 CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/home.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
	<!-- Sweet Alerts -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

	<!-- Start PHP Session -->
	<?php session_start(); ?>

	<!-- Navigation -->
	<nav class="navbar bg-light navbar-light navbar-expand-lg">
		<div class="container">

			<a href="home.php" class="navbar-brand"><img src="img/luccianos_icon.png" alt="Logo" title="Logo"></a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" 
				data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="home.php" class="nav-link active">Home</a></li>
					<li class="nav-item"><a href="categories.php" class="nav-link">Categories</a></li>
					<li class="nav-item"><a href="products.php" class="nav-link">Products</a></li>
					<?php if($_SESSION['is_admin']) { 
						echo '<li class="nav-item"><a href="users.php" class="nav-link">Users</a></li>';	
					} ?>
					<li class="nav-item"><button type="button" class="btn btn-danger" id="log-out">Log Out</button>
				</ul>
			</div>

		</div>
	</nav>
	<!-- End Navigation -->


	<!-- Image Carousel -->

	<div id="carousel" class="carousel slide" data-ride="carousel" 
		data-interval="650000">

		<!-- Carousel Content -->
		<div class="carousel-inner">

			<div class="carousel-item active">
				<img src="img/stock2.jpg" alt="" class="w-100">
				<div class="carousel-caption">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-8 bg-custom d-none d-md-block py-3 px-0">
								<h1>Hey There</h1>
								<h3 class="pb-3"><?=$_SESSION['username']?>!</h3>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- End Carousel Content -->

	</div>
	<!-- End Image Carousel -->

	<!-- Three Column Section -->
	
	<div class="container">
		<div class="row my-5">

			<div class="col-md-6">
				<h4 class="my-4">Profile</h4>
				<div class="border-top border-primary w-25 my-3"></div>
				<h5 class="my-2">E-mail: </h5>
				<p><?=$_SESSION['email']?></p>
				<h5 class="my-2">Username: </h5>
				<p><?=$_SESSION['username']?></p>
			</div>

		</div>
	</div>
	
	<!-- End Three Column Section -->

	<!-- Start Socket -->
	<div class="socket text-light text-center py-3">
		<p>&copy; <a href="#" target="_blank">Lucciano's</a></p>
	</div>
	<!-- End Socket -->

	<!-- Script Source Files -->

	<!-- jQuery -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<!-- Bootstrap 4.5 JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Font Awesome -->
	<script src="js/all.min.js"></script>

	<!-- End Script Source Files -->

	<!-- Scripts -->
	<script>

		$(document).ready(function() {

			// Log out button
			$(document).on("click", "#log-out", function(){
				$.ajax({
					type: 'GET',
					url: 'logout_.php',
					success: function(data) {

						Swal.fire({
						'title': 'Successful',
						'text': data,
						'icon': 'success'
						})

						window.location='index.php'
					},
					error: function(data) {
						Swal.fire({
						'title': 'Error',
						'text': 'Error in log out.',
						'icon': 'error'
						})
					}
				});
			});

		});

	</script>
</body>
</html>