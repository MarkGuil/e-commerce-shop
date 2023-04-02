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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<title>AniShop</title>
	<link rel="icon" type="jpg/png" href="images/logo.png">
	<style>
		body {
			margin: auto;
			text-decoration: none;
			background: linear-gradient(rgba(24, 255, 355, .6), rgba(136, 14, 79, .9));
			background-attachment: fixed;
			font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
		}
	</style>
</head>

<body>
	<div class="container-fluid" style="background:white; display:flex; flex-wrap:wrap;">
		<div style="flex: 25%; max-width: 100%; margin-left:10%;">
			<a href="usershome.php" style="color: black"><img src="images/logo.png" style="height:80px; width:80px; float:left;"><br>
				<h4 style="float:left;"><b>AniShop</b></h4>
			</a>
			<h2 style="margin-left:40%;"><b>Profile</b></h2>
		</div>
	</div>
	<div class="container text-black card border" id="opacity" style="max-width: 700px; margin-top:5%;"><br>
		<div class="head" style="height: 100px" align="center">
			<h1><b>Account Details</b></h1>
		</div>
		<form action="php/updatemyaccount.php" method="post" enctype="multipart/form-data">
			<div class="row container">
				<div class="form-group col"><b>Name</b><input class="form-control input-normal" type="text" name="name" value="<?php echo $_SESSION["name"] ?>" style="max-width:100%;" required>
				</div>
			</div>
			<div class="row container">
				<div class="form-group col  "><b>Address</b><input class="form-control input-normal" type="text" name="address" value="<?php echo $_SESSION["address"] ?>" style="width: 455px" required></div>
				<div class="form-group col  "><b>Zip Code</b><input class="form-control input-normal" type="text" name="zipcode" value="<?php echo $_SESSION["postalCode"] ?>" style="width: 120px" required> </div>
			</div>
			<div class="row container ">
				<div class="form-group col  "><b>Username</b><input class="form-control input-normal" type="text" name="username" value="<?php echo $_SESSION["username"] ?>" required></div>
			</div>
			<div class="row container">
				<div class="form-group col  "><b>Cellphone Number</b><input class="form-control input-normal" type="text" name="number" value="<?php echo $_SESSION["phone"] ?>" required></div>
				<div class="form-group col  "><b>Email Address</b><input class="form-control input-normal" type="email" name="email" value="<?php echo $_SESSION["email"] ?>" required></div>
			</div>
			<div class="row p-3" align="center">
				<!-- <div class="col border border-white" style=" margin-top: 10px;"><a href="edituser.php"class="bg-danger border text-white"style=" width: 200px; padding:10px; border-radius:5px; text-decoration: none;">Go Back</a></div> -->
				<div class="col border border-white"><a href="edituser.php" class="bg-danger border text-white mr-5" style=" width: 200px; padding:10px; border-radius:5px; text-decoration: none;">Go Back</a><input class="bg-info border text-white" type="submit" name="save2" value="Save" style="width: 100px; padding:10px; border-radius:5px;">
					<br>
				</div>
			</div>
		</form>

	</div>
</body>

</html>