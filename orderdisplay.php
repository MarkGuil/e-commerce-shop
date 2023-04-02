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
$sql = "SELECT * FROM category";
$sql1 = "SELECT * FROM product WHERE `status` = 'feautured'";
$sql2 = "SELECT * FROM order_page WHERE `customerID` = '$ID'";
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
      <li>Hi! <?php echo $_SESSION["name"] ?> | <a href="php/logout.php">Log out</a></li>
    </div>
    <div style="float:right; margin-top: 40px;">
      <a class="active" href="orderdisplay.php">
        <img src="images/cart.png" type="jpg/pgn" style="height:50px; width:50px; float:left; margin-left:10px;">
      </a>
      <span style="font-size: small; color: rgb(109, 108, 108);">ORDER STATUS</span>
    </div>
    <img src="images/logo.png" type="jpg/pgn" style="height:100px; width:100px; float:left; margin-left:10px;">
    <h3>A N I S H O P</h3>
  </div>
  <!-- Begin menu -->
  <div id="navbar">
    <a href="usershome.php">Home</a>
    <a href="products.php">Products</a>
    <a href="userscategory.php?id=1">Categories</a>
    <a href="about.php">About</a>
  </div>

  <!-- end menu -->
  <div class="row">
    <div class="col-1" style="font-size:15px; display: flex; flex-wrap: wrap; padding: 0 2px;">
      <!-- Begin ordered products -->
      <?php
      if ($result = mysqli_query($link, $sql2)) {
        if (mysqli_num_rows($result) > 0) {
          echo "<table style = 'flex: 100%; margin-top:5px; border: 1px solid grey; background:white; flex-wrap: wrap; text-align:center;'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Product Image</th>";
          echo "<th>Product Name</th>";
          echo "<th>Quantity</th>";
          echo "<th>Total Price</th>";
          echo "<th>Status</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          while ($row = mysqli_fetch_array($result)) {
            $ProdId = $row['productID'];
            $quan = $row['quantity'];
            $totalAm = $row['totalPrice'];
            $stats = $row['statID'];
            $orderId = $row['orderID'];

            $sql3 = "SELECT * FROM product WHERE `productID` = '$ProdId'";
            $sql4 = "SELECT * FROM prodstatus WHERE `statID` = '$stats'";
            if ($result1 = mysqli_query($link, $sql3)) {
              if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_array($result1)) {
                  $Prodname = $row['productName'];
                  $prodImg = $row['picture'];

                  if ($result2 = mysqli_query($link, $sql4)) {
                    if (mysqli_num_rows($result2) > 0) {
                      while ($row = mysqli_fetch_array($result2)) {
                        $statsName = $row['statusName'];

                        echo "<tr>";
                        echo "<td><img src = 'images/" . $prodImg . "' style = 'height:100px; width:100px;'></td>";
                        echo "<td>" . $Prodname . "</td>";
                        echo "<td>" . $quan . "</td>";
                        echo "<td><p>P " . $totalAm . "</p></td>";
                        echo "<td><p style = 'color:blue;'>" . $statsName . "</p></td>";
                        echo "</tr>";
                      }
                      mysqli_free_result($result2);
                    } else {
                      echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                  }
                }
                mysqli_free_result($result1);
              } else {
                echo "<p class='lead'><em>No records were found.</em></p>";
              }
            }
          }
          echo "</tbody>";
          echo "</table>";
          mysqli_free_result($result);
        } else {
          echo "<p class='lead'><em>No records were found.</em></p>";
        }
      }
      ?>
      <!-- end oredered products -->
    </div>
  </div>

  <div class="row2">
    <!-- Start categories -->
    <div style="text-align:left;">
      <span class="category">Category</span>
      <br>
      <?php
      if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 2px;'>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<a href='userscategory.php?id=" . $row['category_id'] . "' style = 'cursor: pointer; flex: 10%; padding: 0 2px; text-align:center; background:white; border: 1px solid #1b9397; border-radius:5px; margin-top:5px;'>";
            echo "<img src ='images/" . $row['picture'] . "' style = 'height: 70px; width:70px'><br>";
            echo "<span style = 'font-size: 13px; text-align: left; color:black;'>" . $row['category_name'] . "</span>";
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
      <b><span class="category">Featured Products</span></b>
      <hr>
      <?php
      if ($result = mysqli_query($link, $sql1)) {
        if (mysqli_num_rows($result) > 0) {
          echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 1px;'>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<a href='orderpage.php?id=" . $row['productID'] . "' style = 'flex: 20%; padding: 0 2px; text-align:center; background:white; border: 1px solid #1b9397; border-radius:5px; margin-top:5px;'>";
            echo "<img src ='images/" . $row['picture'] . "' style = 'height: 200px; width:200px'><br>";
            echo "<span style = 'font-size: 14px; text-align: left; color:black;'>" . $row['productName'] . "</span><br>";
            echo "<span style = 'font-size: 14px; text-align: left; color:black;'> Price: P" . $row['price'] . "</span>";
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
  <script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {
        slideIndex = 1
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
  </script>
</body>

</html>