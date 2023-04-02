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
			<a href="index.php" style="color: black"><img src="images/logo.png" style="height:80px; width:80px; float:left;"><br>
				<h4 style="float:left;"><b>AniShop</b></h4>
			</a>
			<h2 style="margin-left:40%;"><b>SIGN UP</b></h2>
		</div>
	</div>
	<div class="container text-black card border" id="opacity" style="max-width: 700px; margin-top:5%;"><br>
		<div class="head" style="height: 100px" align="center">
			<h1><b>Registration Form</b></h1>
		</div>
		<form action="php/register_a.php" method="post" enctype="multipart/form-data">
			<div class="row container">
				<div class="form-group col"><b>Name</b><input class="form-control input-normal" type="text" name="name" placeholder="Enter your Name" style="max-width:100%;" required>
				</div>
			</div>
			<div class="row container">
				<div class="form-group col  "><b>Address</b><input class="form-control input-normal" type="text" name="address" placeholder="Address" style="width: 455px" required></div>
				<div class="form-group col  "><b>Zip Code</b><input class="form-control input-normal" type="text" name="zipcode" placeholder="(e.g. 2428)" maxlength="4" pattern="\d{4}" style="width: 120px" required> </div>
			</div>
			<div class="row container">
				<div class="form-group col  "><b>Username</b><input class="form-control input-normal" type="text" name="username" placeholder="Username" required></div>
				<div class="form-group col  "><b>Password</b><input class="form-control input-normal" type="password" name="password" placeholder="Password" minlength="8" required></div>
			</div>
			<div class="row container">
				<div class="form-group col  "><b>Cellphone Number</b><input class="form-control input-normal" type="text" name="number" placeholder="(e.g. 09XX-XXX-XXXX)" maxlength="11" pattern="^(09|\+639)\d{9}$" required></div>
				<div class="form-group col  "><b>Email Address</b><input class="form-control input-normal" type="email" name="email" placeholder="(e.g. websystech21@gmail.com)" required></div>
			</div>
			<div class="row p-3" align="center">
				<div class="col border border-white"><input class="bg-info border text-white" type="submit" name="save" value="Register" style="width: 200px; padding:10px; border-radius:5px;">
					<br>
				</div>
			</div>
			<p align="center">Have an account? <a href="login.php">Log In</a></p>
		</form>

	</div>
</body>

</html>