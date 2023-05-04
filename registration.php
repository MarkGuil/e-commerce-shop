<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
	<title>AniShop</title>
	<link rel="icon" type="jpg/png" href="images/logo.png">
	<style>
		body {
			margin: auto;
			text-decoration: none;
			background: linear-gradient(rgba(24, 255, 355, .6), rgba(136, 14, 79, .9));
			background-attachment: fixed;
			font-family: Arial, Helvetica, sans-serif;
		}

		.form-group>small>b {
			color: rgb(109, 108, 108);
		}
	</style>
</head>

<body>
	<div class="container-fluid" style="background:white; display:flex; flex-wrap:wrap;">
		<div style="flex: 25%; max-width: 100%; margin-left:10%;">
			<a href="index.php">
			<img src="images/logo.png" style="height:80px; width:80px; float:left;"><br>
				<h3 class=" text-secondary-emphasis m-0" style="float:left;"><b>AniShop</b></h3>
			</a>
			<h2 class=" text-secondary-emphasis" style="margin-left:40%;"><b>SIGN UP</b></h2>
		</div>
	</div>
	<div class="container text-black card border" id="opacity" style="max-width: 700px; margin-top:5%;"><br>
		<div class="head py-3" align="center">
			<h4><b>Create Account</b></h4>
		</div>
		<?php
		if (isset($_SESSION["error"])) {
			echo '<div style="color: red; text-align: center;">', $_SESSION["error"], '</div><br>';
			unset($_SESSION["error"]);
		}
		?>
		<form action="php/register_a.php" method="post" enctype="multipart/form-data">
			<div class="row container">
				<div class="form-group col">
					<small><b>Fullname</b></small>
					<input class="form-control input-normal" type="text" name="name" placeholder="First Last" style="max-width:100%;" required>
				</div>
			</div>
			<div class="row container mt-3">
				<div class="form-group col  ">
					<small><b>Address</b></small>
					<input class="form-control input-normal" type="text" name="address" placeholder="Address" required>
				</div>
				<div class="form-group col-sm-12 col-md-4  ">
					<small><b>Zip Code</b></small>
					<input class="form-control input-normal" type="text" name="zipcode" placeholder="(e.g. 2428)" maxlength="4" pattern="\d{4}" required>
				</div>
			</div>
			<div class="row container mt-3">
				<div class="form-group col  ">
					<small><b>Username</b></small>
					<input class="form-control input-normal" type="text" name="username" placeholder="Username" required>
				</div>
				<div class="form-group col-sm-12 col-md-6   ">
					<small><b>Password</b></small>
					<input class="form-control input-normal" type="password" name="password" placeholder="Password" minlength="3" required>
				</div>
			</div>
			<div class="row container mt-3">
				<div class="form-group col  ">
					<small><b>Phone Number</b></small>
					<input class="form-control input-normal" type="text" name="number" placeholder="(e.g. 09XX-XXX-XXXX)" maxlength="11" pattern="^(09|\+639)\d{9}$" required>
				</div>
				<div class="form-group  col-sm-12 col-md-6  ">
					<small><b>Email Address</b></small>
					<input class="form-control input-normal" type="email" name="email" placeholder="(e.g. example@email.com)" required>
				</div>
			</div>
			<div class="row p-3 mt-3" align="center">
				<div class="col border border-white">
					<input class="bg-info border text-white" type="submit" name="save" value="Register" style="width: 200px; padding:10px; border-radius:5px;">
				</div>
			</div>
			<p align="center">
				<small>Have an account? <a href="login.php">Log In</a></small>
			</p>
		</form>

	</div>
</body>

</html>