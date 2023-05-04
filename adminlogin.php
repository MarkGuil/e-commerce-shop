<?php
//Start session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script><title>AniShop</title>
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
				<h3 class=" text-body-tertiary m-0" style="float:left;"><b>AniShop</b></h3>
			</a>
			<h2 class="text-body-tertiary" style="margin-left:40%;"><b>LOG IN</b></h2>
		</div>
	</div>
	<div class="container text-black card border" id="opacity" style="max-width: 500px; margin-top:5%;"><br>
		<div class="head py-3"  align="center">
			<h4><b>Log in as admin</b></h4>
			<span>or</span>
			<a href="login.php" style="text-decoration:none;">
				<h6><b>user</b></h6>
			</a>
		</div>
		<?php
		if (isset($_SESSION["error"])) {
			echo '<div style="color: red; text-align: center;">', $_SESSION["error"], '</div><br>';
			unset($_SESSION["error"]);
		}
		?>
		<form action="php/adminprocess.php" method="post">
			<div class="row container pt-2">
				<div class="form-group col">
					<small><b>Username</b></small>
					<input class="form-control input-normal" type="text" name="username" placeholder="Username" required>
				</div>
			</div>
			<div class="row container pt-3">
				<div class="form-group col">
					<small><b>Password</b></small>
					<input class="form-control input-normal" type="password" name="password" placeholder="Password" minlength="8" required>
				</div>
			</div>
			<div class="row p-3 mt-3" align="center">
				<div class="col border border-white">
					<input class="bg-info border text-white" type="submit" name="login" value="Log In" style="width: 200px; padding:10px; border-radius:5px;">
				</div>
			</div>
		</form>
	</div>
</body>

</html>