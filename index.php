<?php
require_once "php/config.php";
session_start();
if (isset($_SESSION["customerID"])) {
  $ID = $_SESSION["customerID"];
  if ($ID > 0) {
    $sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$ID'");
    $row2  = mysqli_fetch_array($sql2);
    $pas = "<a href = 'edituser.php'>Hi! " . $_SESSION["name"] . "</a> | <a href='orderdisplay.php?type=0'>My Order</a>";
    $log = "<a href = 'php/logout.php'>Log out</a>";
    $home = "usershome.php";
    $ctgry = "userscategory.php?id=";
  }
} else {
  unset($_SESSION["customerID"]);
  unset($_SESSION["name"]);
  unset($_SESSION["username"]);
  unset($_SERVER["password"]);
  $pas = "<a href = 'registration.php'>Sign up</a>";
  $log = "<a href = 'login.php'>Sign in</a>";
  $home = "index.php";
  $ctgry = "category.php?id=";
}
$sqlCat = "SELECT * FROM category";
$sql1 = "SELECT * FROM product WHERE `status` = 'featured'";
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AniShop</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <link rel="icon" type="jpg/png" href="images/logo.png">
  <link rel="stylesheet" href="Styles/style.css" type="text/css">
</head>

<body>
  <?php include 'includes/header.php' ?>
  <!-- Begin menu -->
  <div id="navbar" class="z-3">
    <div class="container">
      <a class="active" href="index.php">Home</a>
      <a href="products.php">Products</a>
      <a href="category.php?id=1">Categories</a>
      <a href="about.php">About</a>
    </div>
  </div>
  <!-- end menu -->
  <div class="container position-relative">

    <div class="row1">
      <div id="shopCarousel" class="carousel slide">
        <div class="carousel-indicators">
          <button id="" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="indicator active" aria-current="true" aria-label="Slide 1"></button>
          <button id="" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="indicator " aria-label="Slide 2"></button>
          <button id="" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="indicator " aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div id="" class="mySlides carousel-item active">
            <img src="images/carousel.jpg" class="d-block w-100" height="330px" alt="...">
          </div>
          <div id="" class="mySlides carousel-item ">
            <img src="images/carousel2.jpg" class="d-block w-100" height="330px" alt="...">
          </div>
          <div id="" class="mySlides carousel-item ">
            <img src="images/carousel3.jpg" class="d-block w-100" height="330px" alt="...">
          </div>
        </div>

      </div>
    </div>

    
    <!-- Start categories -->
    <?php include("includes/category.php"); ?>
    <!-- end categories -->
      
    <!-- Start products -->
    <div class="row3">
      <div style="text-align:left;">
        <b>
          <span class="category text-secondary-emphasis" style="font-weight: 600; letter-spacing: 1.5px">Featured Products</span>
        </b>
        <hr>
        <?php
        if ($result = mysqli_query($link, $sql1)) {
          if (mysqli_num_rows($result) > 0) {
            echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 1px;'>";
            while ($row = mysqli_fetch_array($result)) {
              echo "
                <div class='col-sm-4 col-md-2 p-1' style='height: 280px;'>
                  <div class='px-2  d-flex flex-column card text-center h-100 shadow-sm' onMouseOver='this.style.borderColor=`#1b9397`' onMouseOut='this.style.borderColor=`rgba(0,0,0,.17)`'>
                    <a href = 'login.php' class='stretched-link'></a>
                    <img src ='images/" . $row['picture'] . "' style = 'height: 150px; width:100%'>
                    
                    <span class='overflow-hidden p-1' style = 'font-size: 14px; text-align: left; color:black; font-weight:600;text-overflow: ellipsis;'>" . $row['productName'] . "</span>
                    <div class='mt-auto'>
                      <span style = 'font-size: 14px; text-align: left; color:#565656'> Price: ₱" . $row['price'] . "</span>
                    </div>
                  </div>
                </div>";
            }
            echo "</div>";
            mysqli_free_result($result);
          } else {
            echo "<p class='lead'><em>No records were found.</em></p>";
          }
        } else {
          echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);
        }
        mysqli_close($link);
        ?>
      </div>
    </div>
  </div>

  <!--footer-->
  <section class="bg-cyan mt-4">
    <div class="container">
      <div class="row py-4">
        <div class="col-sm-12 col-md-6">
          <span style="font-size:20px; float:left; color:white;">ABOUT ANISHOP</span><br>
          <img src="images/logo.png" class="rounded-circle" style="float:left; height:150px; width:150px; background:white; margin-right:10px;">
          <p style="font-size:12px; ">You can be confident when you're shopping online with AniShop. Our Secure online shopping website encrypts your personal and financial information to ensure your order information is protected.We use industry standard 128-bit encryption. Our Secure online shopping website locks all critical information passed from you to us, such as personal information, in an encrypted envelope, making it extremely difficult for this information to be intercepted.</p>
        </div>
        <div class="col-sm-12 col-md-6">
          <span style="font-size:20px; float:left; color:white;">INFORMATION</span><br>
          <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="#" title="Privacy Policy"><span style="color:black;">Privacy Policy</span></a></li>
          <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="#" title="Contact Us"><span style="color:black;">Contact Us</span></a></li>
          <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="registration.php" title="Sign Up"><span style="color:black;">Sign Up</span></a></li>
          <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="login.php" title="Log In"><span style="color:black;">Log In</span></a></li>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-dark-cyan">
    <div class="row8">
      <div class="row9">
        <p style="font-size:12px;">© AniShop.com. Groups <a href="index.php"><i>
              <font color="fefefe"> Welcome To AniShop Online Anime Shopping Site </font>
            </i></a></p>
        <p style="font-size:12px;">Copyright © 2020 AniShop.com All rights reserved. The information contained in Anishop.com may not be published, broadcast, rewritten, or redistributed without the prior written authority of Anishop.com</p>
      </div>
    </div>
  </footer>
  
  <script src="scripts/navbar.js"></script>
  <script src="scripts/category.js"></script>
  <script src="scripts/carousel.js"></script>
</body>

</html>