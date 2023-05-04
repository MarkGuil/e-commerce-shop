<?php
session_start();
include 'php/config.php';
$ID = $_SESSION["customerID"];
if ($ID > 0) {
	$sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$ID'");
	$row2  = mysqli_fetch_array($sql2);
} else {
	header("Location: login.php");
}
?>
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

		.form-group>small>b,
		.form-group>label {
			color: rgb(109, 108, 108);
		}
	</style>
</head>

<body>
	<div class="container-fluid" style="background:white; display:flex; flex-wrap:wrap;">
		<div style="flex: 25%; max-width: 100%; margin-left:10%;">
			<a href="usershome.php">
			<img src="images/logo.png" style="height:80px; width:80px; float:left;"><br>
				<h3 class=" text-secondary-emphasis m-0" style="float:left;"><b>AniShop</b></h3>
			</a>
			<h2 clas=" text-secondary-emphasis" style="margin-left:40%;"><b>Profile</b></h2>
		</div>
	</div>
	<div class="container text-black card border" id="opacity" style="max-width: 700px; margin-top:5%;"><br>
		<div class="head py-3" style="height: 100px" align="center">
			<h4><b>Account Details</b></h4>
		</div>

		<form action="php/updatemyaccount.php" method="post" enctype="multipart/form-data">
			<div class="row container">
				<div class="form-group col">
					<small><b>Name</b></small>
					<input class="form-control input-normal" type="text" name="name" value="<?php echo $_SESSION["name"] ?>" style="max-width:100%;" required>
				</div>
			</div>
			<div class="row container mt-3">
				<div class="form-group col  ">
					<small><b>Address</b></small>
					<input class="form-control input-normal" type="text" name="address" value="<?php echo $_SESSION["address"] ?>" style="width: 455px" required>
				</div>
				<div class="form-group col  ">
					<small><b>Zip Code</b></small>
					<input class="form-control input-normal" type="text" name="zipcode" value="<?php echo $_SESSION["postalCode"] ?>" style="width: 120px" required>
				</div>
			</div>
			<div class="row container mt-3">
				<div class="form-group col  ">
					<small><b>Username</b></small>
					<input class="form-control input-normal" type="text" name="username" value="<?php echo $_SESSION["username"] ?>" required>
				</div>
			</div>
			<div class="row container mt-3">
				<div class="form-group col  ">
					<small><b>Phone Number</b></small>
					<input class="form-control input-normal" type="text" name="number" value="<?php echo $_SESSION["phone"] ?>" required>
				</div>
				<div class="form-group col  ">
					<small><b>Email Address</b></small>
					<input class="form-control input-normal" type="email" name="email" value="<?php echo $_SESSION["email"] ?>" required>
				</div>
			</div>
			<div class="row p-3" align="center">
				<div class="col border border-white"><a href="edituser.php" class="bg-danger border text-white mr-5" style=" width: 200px; padding:10px; border-radius:5px; text-decoration: none;">Go Back</a>
					<input class="bg-info border text-white" type="submit" name="save2" value="Save" style="width: 100px; padding:10px; border-radius:5px;">
					<br>
				</div>
			</div>
		</form>

	</div>
</body>

</html>