<?php
//Start session
session_start();
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
			<a href="index.php" style="color: black">
				<img src="images/logo.png" style="height:80px; width:80px; float:left;"><br>
				<h4 style="float:left;"><b>AniShop</b></h4>
			</a>
			<h2 style="margin-left:40%;"><b>LOG IN</b></h2>
		</div>
	</div>
	<div class="container text-black card border" id="opacity" style="max-width: 700px; margin-top:5%;"><br>
		<div class="head" style="height: 100px" align="center">
			<h5><b>Log in as admin</b></h5>
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
			<div class="row container">
				<div class="form-group col"><b>Username</b><input class="form-control input-normal" type="text" name="username" placeholder="Username" required></div>
				<div class="form-group col"><b>Password</b><input class="form-control input-normal" type="password" name="password" placeholder="Password" minlength="8" required></div>
			</div>
			<div class="row p-3" align="center">
				<div class="col border border-white"><input class="bg-info border text-white" type="submit" name="login" value="Log In" style="width: 200px; padding:10px; border-radius:5px;">
					<br>
				</div>
			</div>
		</form>
	</div>
</body>

</html>