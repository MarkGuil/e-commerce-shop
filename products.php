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
$sql1 = "SELECT * FROM product";
$sql = "SELECT * FROM category";
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
    <a class="active" href="products.php">Products</a>
    <a href="<?php echo $ctgry; ?>1">Categories</a>
    <a href="about.php">About</a>
  </div>
  <!-- end menu -->
  <style>
    .srch:hover {
      border-radius: 10px;
    }
  </style>
  <!-- Begin search -->
  <div align="center">
    <form method="post">
      <?php
      include 'search-form.php';
      ?>
      <button type="submit" name="anoNa" style="cursor:pointer; padding: 0px 10px; background:white;  border: 1px solid grey;" class="srch"><img src="images/search.png" style="height:30px; width:36px;" /></button>
    </form>
  </div>
  <!-- end search -->


  <div class="row">
    <div class="col-1">
      <!-- Begin searchresult -->
      <?php
      $re = "";
      if (isset($_POST["anoNa"])) {
        $re = $_REQUEST["reslt"];
        $re = substr($re, -5);
        // Prepare a select statement
        $ly = "SELECT * FROM product WHERE productDescription LIKE ?";

        if ($stmt = mysqli_prepare($link, $ly)) {
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_term);

          // Set parameters
          $param_term = '%' . $re . '%';

          // Attempt to execute the prepared statement
          if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
              // Fetch result rows as an associative array
              echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 1px;'>";
              while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
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
              echo "<p align = 'center'>No matches found</p>";
            }
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
        }

        // Close statement
        mysqli_stmt_close($stmt);
      }
              ?>
      <!-- end slideshow -->
    </div>
  </div>

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
            echo "<a href='" . $ctgry . $row['category_id'] . "' style = 'cursor: pointer; flex: 10%; padding: 0 2px; text-align:center; background:white; border: 1px solid #1b9397; border-radius:5px; margin-top:5px;'>";
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
      <b><span class="category" style="font-weight: 600; letter-spacing: 1.5px">Products</span></b>
      <hr>
      <?php
      if ($result = mysqli_query($link, $sql1)) {
        if (mysqli_num_rows($result) > 0) {
          echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 1px;'>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<a href='orderpage.php?id=" . $row['productID'] . "' style = 'flex: 20%; padding: 0 2px; text-align:center; background:white; border: 1px solid #1b9397; border-radius:5px; margin-top:5px;'>";
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
</body>

</html>