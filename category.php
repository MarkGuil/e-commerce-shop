<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AniShop</title>
  <link rel="icon" type="jpg/png" href="images/logo.png">
  <link rel="stylesheet" href="Styles/style.css" type="text/css">
</head>
<?php
require_once "php/config.php";
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id =  trim($_GET["id"]);
} else {
  header("location: error.php");
  exit();
}
$sql = "SELECT * FROM category";
$cat = mysqli_query($link, "SELECT * FROM category WHERE `category_id` = '$id'");
$category =  mysqli_fetch_array($cat);
$sql1 = "SELECT * FROM product WHERE `category_id` = '$id'";
?>

<body>
  <div class="header">
    <div id="menu-right">
      <li>
        <a href="registration.php">Sign up</a> |
        <a href="login.php">Sign in</a>
      </li>
    </div>
    <div style="float:right; margin-top: 40px;">
      <a href="login.php">
        <img src="images/cart.png" type="jpg/pgn" style="height:50px; width:50px; float:left; margin-left:10px;">
      </a>
      <span style="font-size: small; color: rgb(109, 108, 108); font-weight: 600;">ORDER STATUS</span>
    </div>
    <img src="images/logo.png" type="jpg/pgn" style="height:100px; width:100px; float:left; margin-left:10px;">
    <h3>A N I S H O P</h3>
  </div>
  <!-- Begin menu -->
  <div id="navbar">
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a class="active" href="category.php?id=1">Categories</a>
    <a href="about.php">About</a>
  </div>
  <!-- end menu -->

  <div class="row2">
    <!-- Start categories -->
    <div style="text-align:left;">
      <span class="category" style="font-weight: 600; letter-spacing: 1.5px">Category</span>
      <br>
      <?php
      if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 2px;'>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<a href='category.php?id=" . $row['category_id'] . "' style = 'cursor: pointer; flex: 10%; padding: 0 2px; text-align:center; background:white; border: 1px solid #1b9397; border-radius:5px; margin-top:5px;'>";
            echo "<img src ='images/" . $row['picture'] . "' style = 'height: 70px; width:70px'><br>";
            echo "<span style = 'font-size: 13px; text-align: left; color:black; font-weight: 600;'>" . $row['category_name'] . "</span>";
            echo "</a>";
      ?>&nbsp;<?php
            }
            echo "</div>";
            mysqli_free_result($result);
          } else {
            echo "<p class='lead'><em>No records were found.</em></p>";
          }
        } else {
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
              ?>
    </div>
    <!-- end categories -->
  </div>


  <!-- Start products -->
  <div class="row3">
    <div style="text-align:left;">
      <b><span class="category" style="font-weight: 600; letter-spacing: 1.5px"><?php if (is_array($category)) {
                                                                                  echo $category['category_name'];
                                                                                } ?></span></b>
      <hr>
      <?php
      if ($result = mysqli_query($link, $sql1)) {
        if (mysqli_num_rows($result) > 0) {
          echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 1px;'>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<a href = 'login.php' style = 'flex: 20%; padding: 0 2px; text-align:center; background:white; border: 1px solid #1b9397; border-radius:5px; margin-top:5px;'>";
            echo "<img src ='images/" . $row['picture'] . "' style = 'height: 200px; width:200px'><br>";
            echo "<span style = 'font-size: 14px; text-align: left; color:black; font-weight:600;'>" . $row['productName'] . "</span><br>";
            echo "<span style = 'font-size: 14px; text-align: left; color:black; color:#565656'> Price: P" . $row['price'] . "</span>";
            echo "</a>";
      ?>&nbsp;<?php
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
  <!--footer-->
  <div class="row4">
    <div class="row5">
      <span style="font-size:20px; float:left; color:white;">ABOUT ANISHOP</span><br>
      <img src="images/logo.png" style="float:left; height:150px; width:150px; background:white; margin-right:10px;">
      <p style="font-size:12px;">You can be confident when you're shopping online with AniShop. Our Secure online shopping website encrypts your personal and financial information to ensure your order information is protected.We use industry standard 128-bit encryption. Our Secure online shopping website locks all critical information passed from you to us, such as personal information, in an encrypted envelope, making it extremely difficult for this information to be intercepted.</p>
    </div>
    <!-- <div class="row6">
      <span style="font-size:20px; float:left; color:white;">SOCIALS</span><br>
      <li style="padding:2px;"><a href="#" title="Facebook"><img src="images/social-icon1.png" alt="Facebook" />&nbsp;<span style="color:black;">Facebook</span><span class="cl">&nbsp;</span></a></li>
      <li style="padding:2px;"><a href="#" title="Twitter"><img src="images/social-icon2.png" alt="Twitter" />&nbsp;<span style="color:black;">Twitter</span><span class="cl">&nbsp;</span></a></li>
    </div> -->
    <div class="row7">
      <span style="font-size:20px; float:left; color:white;">INFORMATION</span><br>
      <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="#" title="Privacy Policy"><span style="color:black;">Privacy Policy</span></a></li>
      <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="#" title="Contact Us"><span style="color:black;">Contact Us</span></a></li>
      <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="registration.php" title="Sign Up"><span style="color:black;">Sign Up</span></a></li>
      <li style="width: 157px; padding-left: 6px; margin-left: -6px; display: block; line-height: 28px; text-decoration: none;"><a href="login.php" title="Log In"><span style="color:black;">Log In</span></a></li>
    </div>
  </div>
  <div class="row8">
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