<?php
session_start();
include 'php/config.php';
if (isset($_SESSION["customerID"])) {
  $customerID = $_SESSION["customerID"];
  if ($customerID > 0) {
    $sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$customerID'");
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

if (isset($_SESSION["customerID"])) {
$customerID = $_SESSION["customerID"];

  if ($customerID > 0) {
    $sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$customerID'");
    $row2  = mysqli_fetch_array($sql2);
  } else {
    header("Location: login.php");
  }
} else {
  header("Location: login.php");
}
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id =  trim($_GET["id"]);
} else {
  header("location: error.php");
  exit();
}
$userVouchStat = 0;
$sqlCat = "SELECT * FROM category";
$sqlStat = "SELECT * FROM product WHERE `status` = 'featured'";
$sqlProduct = "SELECT * FROM product WHERE `productID` = '$id'";
$v = "SELECT * FROM order_page WHERE  `customerID` = '$customerID' AND `productID` = '$id'";

$productRES = mysqli_query($link, $sqlProduct);
$statRES = mysqli_query($link, $sqlStat);

if ($res = mysqli_query($link, $v)) {
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_array($res)) {
      $userVouchStat = $row['voucher_stat'];
    }
    mysqli_free_result($res);
  } else {
    // echo "<p class='lead'><em>No records were found.</em></p>";
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AniShop</title>
  <link rel="icon" type="jpg/png" href="images/logo.png">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="Styles/style.css" type="text/css">
</head>

<body>


  <?php include 'includes/header.php'; ?>
  <!-- Begin menu -->
  <div id="navbar" class="z-3">
    <div class="container">
      <a href="usershome.php">Home</a>
      <a class="" href="products.php">Products</a>
      <a href="userscategory.php?id=1">Categories</a>
      <a href="about.php">About</a>
    </div>
  </div>
  <!-- end menu -->
  <div class="container">
    <div class="row py-3 ">
      <!-- Begin orderproducts -->
      <form method="post" action="php/addProduct.php">
        <div class="row g-3 px-4">
          <!-- Begin imageproduct -->
          <div class="col-sm-12 col-md-5" align="center">

            <?php
              if (mysqli_num_rows($productRES) > 0) {
                while ($row = mysqli_fetch_array($productRES)) {
                  echo "<img src ='images/" . $row['picture'] . "' style = 'max-width:100%;' class='border p-3'><br>"; ?>
          </div>
          <!-- end imageproduct -->

          <!-- Begin productdescriptions -->
          <div class="col-sm-12 col-md-7 px-4">
            <span> <?= $row['productName']; ?></span>
            <hr>
            <div class="row">
              <div class="col-sm-12 col-md-7 col-lg-8 ">
                <p style="color:grey; font-size:19px;">Description: <?= $row['productDescription']; ?></p>
                <p style="color:grey; font-size:19px;">Payment Method: Cash on Delivery</p>
              </div>
              <div class="col-sm-12 col-md-5 col-lg-4 d-flex justify-content-center align-items-center">
                <h1>₱ <?= $row['price']; ?></h1>
              </div>
            </div>
            <hr>
            <input type="hidden" value="<?= $id ?>" name="productID">
            <input type="hidden" value="<?= $row['price']; ?>" id="num2">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label style="font-size:19px;">Quantity: </label>
              </div>
              <div class="col-auto">
                <input class="form-control" type="number" value="0" min="0" max="<?= $row['availableQuantity'] ?>" name="quant" id="test1" oninput="compute();" required>
              </div>
              <div class="col-auto">
                <p id="" class="form-text m-0">
                  <small>
                    <?= $row['availableQuantity'] ?> available
                  </small>
                </p>
              </div>
            </div>
            <?php
                  $prodOrderId = $row['productID'];
                  $voucher = $row['voucher'];
            ?>
            <div class="row g-3 align-items-center mt-1">
              <div class="col-auto">
                <label style="font-size:19px;">Vouchers: </label>
              </div>
              <div class="col-auto">
                <select class="form-select" name="vouch" id="vouch" onchange="compute()">
                  <?php
                  if ($voucher > 0) {
                    if ($userVouchStat != 1) {

                      echo '<option value="0">Select</option>';
                      echo '<option value="' . $row['vouchervalue'] . '"> P' . $row['vouchervalue'] . " off |" . $row['voucher'] . ' remaining</option>';
                    } else {
                      echo '<option value="0">You have used available voucher</option>';
                      $voucher_stat = 1;
                    }
                  } else {
                    $voucher_stat = 0;
                    echo '<option value="0">No Vouchers Available</option>';
                  }
                  echo '</select>';
                  ?>
              </div>
              <div class="col-auto">
                <span id="voucherText" class="fs-6 text-danger"></span>
              </div>
            </div>
            <div class="border mt-4 pt-2 pb-2 px-4">
              <?php if ($row['availableQuantity'] == 0) { ?>
                <div class="flex">
                  <small class="">Out of stock</small>
                  <input type="button" value="Order Product" class="btn btn-info float-end px-5 py-2" name="" disabled>
                </div>
              <?php } else { ?>
                <div class="d-flex flex-sm-column flex-md-row">
                  <label class="me-auto " style="font-size:19px; ">Total Amount: ₱ <span id="totalAmount">0</span></label>
                  <input type="hidden" id="num3" name="total" value="0"  readonly>
                  <button type="submit" value="orderproduct" class="btn btn-info float-end px-5 py-2" name="send">Order Product</button>
                  <button type="submit" value="addtocart" class="btn btn-warning float-end px-5 py-2 me-1" name="send">Add to Cart</button>
                </div>
              <?php } ?>
            </div>
      <?php
                }
                mysqli_free_result($productRES);
              } else {
                echo "<p class='lead'><em>No records were found.</em></p>";
              }
      ?>
          </div>
          <!-- end productdescription -->
          <!-- end orderproducts -->

        </div>
      </form>
    </div>

    <!-- Start categories -->
    <?php include("includes/category.php"); ?>
    <!-- end categories -->


    <!-- Start products -->
    <div class="row3">
      <div style="text-align:left;">
        <b><span class="category text-secondary-emphasis">Featured Products</span></b>
        <hr>
        <?php
          if (mysqli_num_rows($statRES) > 0) {
            echo "<div style = 'display: flex; flex-wrap: wrap; padding: 0 1px;'>";
            while ($row = mysqli_fetch_array($statRES)) {
              echo "
              <div class='col-sm-4 col-md-2 p-1' style='height: 280px;'>
                  <div class='px-2  d-flex flex-column card text-center h-100 shadow-sm' onMouseOver='this.style.borderColor=`#1b9397`' onMouseOut='this.style.borderColor=`rgba(0,0,0,.17)`'>
                    <a href = 'orderpage.php?id=" . $row['productID'] . "' class='stretched-link'></a>
                    <img src ='images/" . $row['picture'] . "' style = 'height: 150px; width:100%'>
                    
                    <span class='overflow-hidden p-1' style = 'font-size: 14px; text-align: left; color:black; font-weight:600;text-overflow: ellipsis;'>" . $row['productName'] . "</span>
                    <div class='mt-auto'>
                      <span style = 'font-size: 14px; text-align: left; color:#565656'> Price: ₱" . $row['price'] . "</span>
                    </div>
                  </div>
                </div>";
            }
            echo "</div>";
            mysqli_free_result($statRES);
          } else {
            echo "<p class='lead'><em>No records were found.</em></p>";
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
        </div>
      </div>
    </div>
  </section>
  <div class="row8">
    <div class="row9">
      <p style="font-size:12px;">© AniShop.com. Groups <a href="index.php"><i>
            <font color="fefefe"> Welcome To AniShop Online Anime Shopping Site </font>
          </i></a></p>
      <p style="font-size:12px;">Copyright © 2020 AniShop.com All rights reserved. The information contained in Anishop.com may not be published, broadcast, rewritten, or redistributed without the prior written authority of Anishop.com</p>
    </div>
  </div>

  
  <script src="scripts/navbar.js"></script>
  <script src="scripts/category.js"></script>
  <script src="scripts/productTotal.js"></script>
  <script>
    var validNumber = new RegExp(/^\d*\.?\d*$/);
    var lastValid = document.getElementById("test1").value;

    function validateNumber(elem) {
      if (validNumber.test(elem.value)) {
        lastValid = elem.value;
        compute();
      } else {
        elem.value = lastValid;
      }
    }
  </script>
</body>

</html>