<?php
include 'php/config.php';
include 'php/loginProcess.php';
if (isset($_SESSION["customerID"])) {
  $ID = $_SESSION["customerID"];
  if ($ID > 0) {
    $sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$ID'");
    $row2  = mysqli_fetch_array($sql2);
    $pas = "<a href = 'edituser.php'>Hi! " . $_SESSION["name"] . "</a>";
    $log = "<a href = 'php/logout.php'>Log out</a>";
    $home = "usershome.php";
    $ctgry = "userscategory.php?id=1";
  }
} else {
  unset($_SESSION["customerID"]);
  unset($_SESSION["name"]);
  unset($_SESSION["username"]);
  unset($_SERVER["password"]);
  $pas = "<a href = 'registration.php'>Sign up</a>";
  $log = "<a href = 'login.php'>Sign in</a>";
  $home = "index.php";
  $ctgry = "category.php?id=1";
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AniShop</title>
  <link rel="icon" type="jpg/png" href="images/logo.png">
  <link rel="stylesheet" href="Styles/style.css" type="text/css">
</head>

<body>
  <div class="header">
    <div id="menu-right">
      <li><?php echo $pas; ?> | <?php echo $log; ?> </li>
    </div>
    <div style="float:right; margin-top: 40px;">
      <a href="orderdisplay.php">
        <img src="images/cart.png" type="jpg/pgn" style="height:50px; width:50px; float:left; margin-left:10px;"></a><span style="font-size: small; color: rgb(109, 108, 108); font-weight: 600;">ORDER STATUS</span>
    </div>
    <img src="images/logo.png" type="jpg/pgn" style="height:100px; width:100px; float:left; margin-left:10px;">
    <h3>A N I S H O P</h3>
  </div>
  <!-- Begin menu -->
  <div id="navbar">
    <a href="<?php echo $home; ?>">Home</a>
    <a href="products.php">Products</a>
    <a href="<?php echo $ctgry; ?>">Categories</a>
    <a class="active" href="about.php">About</a>
  </div>
  <!-- end menu -->

  <div class="row" style="background:white;">
    <div class="col-1" align="center">
      <!-- Begin content -->
      <div style=" margin: 1%;
    padding: 10px;
    border-radius: 5px;
    flex: 100%; 
    max-width: 50%; 
    padding: 0 2px;">
        <h2 align="center"><b>ABOUT ANISHOP</b></h2>
        <hr>
        <img src="images/logo.png" style="float:right; max-width:50%; background:white; margin-left:10%;">
        <p style="font-size:20px; text-align: justify;">You can be confident when you're shopping online with AniShop. Our Secure online shopping website encrypts your personal and financial information to ensure your order information is protected.We use industry standard 128-bit encryption. Our Secure online shopping website locks all critical information passed from you to us, such as personal information, in an encrypted envelope, making it extremely difficult for this information to be intercepted.</p>
        <hr>
      </div>
      <!-- end content -->
    </div>
  </div>

  <div class="row" style="background:white;">
    <div class="col-1" align="center">
      <!-- Begin content -->
      <div style=" margin: 1%;
    padding: 10px;
    border-radius: 5px;
    flex: 100%; 
    max-width: 50%; 
    padding: 0 2px;">
        <h4><b>ABOUT THE PROJECT DEVELOPER</b></h4>
        <hr>
        <p style="font-size:15px; color:blue;">Mark Guilang</p>
        <hr>
      </div>
      <!-- end content -->
    </div>
  </div>
  <br><br>
  <!--footer-->
  <div class="row8" style="max-width:100%;">
    <div class="row9">
      <p style="font-size:12px;">© AniShop.com. Groups <a href="index.php"><i>
            <font color="fefefe"> Welcome To AniShop Online Anime Shopping Site </font>
          </i></a></p>
      <p style="font-size:12px;">Copyright © 2020 AniShop.com All rights reserved. The information contained in Anishop.com may not be published, broadcast, rewritten, or redistributed without the prior written authority of Anishop.com</p>
    </div>
  </div>

  <script>
    window.onscroll = function() {
      myFunction()
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    }
  </script>
</body>

</html>