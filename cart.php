<?php
session_start();
include 'php/config.php';
$customerID = $_SESSION["customerID"];
if ($customerID > 0) {
  $sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$customerID'");
  $row2  = mysqli_fetch_array($sql2);
} else {
  header("Location: login.php");
}
if (isset($_SESSION["customerID"])) {
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
$i = 0;

$sqlOrder = "SELECT c.* , p.* , s.* 
        FROM `cart` as c 
        INNER JOIN `product` as p 
        ON c.productID = p.productID 
        INNER JOIN `prodstatus` as s 
        ON c.statID = s.statID 
        WHERE c.customerID = '$customerID'
        ORDER BY c.cartID ASC";
$resultOrder = mysqli_query($link, $sqlOrder);

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

  <div class="container px-md-5 pb-4">
    <div class="row py-3 px-md-5 fs-6">
      <!-- Begin ordered products -->
      <h4>Shopping Cart</h4>
      <div class="container mx-4 my-1">
        <!-- Begin cart products -->
        <?php
        if (mysqli_num_rows($resultOrder) > 0) { ?>
          <div class="row  border-bottom border-info text-muted py-2 mb-3 bg-subtle-dark-color">
            <div class="col py-2 px-3 flex-grow-1">Product</div>
            <div class="col-2 py-2 px-3 text-center">Quantity</div>
            <div class="col-2 py-2 px-3 text-center">Total Price</div>
            <div class="col-2 py-2 px-3 text-center">Action</div>
          </div>
          <?php
          while ($row = mysqli_fetch_array($resultOrder)) {
            $i++;
            $calcAmount = $row['quantity'] * $row['price'];
          ?>
            <form method="post" action="php/cartMethod.php">
              <div class="row border-bottom border-info text-dark py-2 bg-subtle-dark-color">
                <div class="col py-2 px-3 ">
                  <div class="d-flex">
                    <img src="images/<?= $row['picture'] ?>" style="height:100px; width:100px;" class="me-2">
                    <span>
                      <?= $row['productName'] ?>
                    </span>
                  </div>
                </div>
                <div class="col-2 py-2 px-3 text-center">
                  <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <?php if ($row['availableQuantity'] > 0) { ?>
                      <input class="form-control" type="number" value="<?= $row['quantity'] ?>" min="0" max="<?= $row['availableQuantity'] ?>" name="quant" id="test1<?= $i ?>" oninput="compute(<?= $i ?>);">
                    <?php } else {
                      echo "out of stack";
                    }
                    ?>
                  </div>
                </div>
                <div class="col-2 py-2 px-3 text-center">
                  <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <input type='hidden' value="<?= $row['productID'] ?>" name="productID" readonly>
                    <input type='hidden' value="<?= $row['price'] ?>" id='num2<?= $i ?>' readonly>
                    <input type='hidden' id='num3<?= $i ?>' name='total' value='<?= $calcAmount ?>' readonly>
                    <p class='m-0'>₱ <span id='totalAmount<?= $i ?>'><?= $calcAmount ?></span></p>
                  </div>
                </div>
                <div class="col-2 py-2 px-3">
                  <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <button class="mx-2 btn btn-link text-danger text-decoration-none" type="submit" name="deleteCart" value="<?= $row['cartID'] ?>">
                      <i class="bx bx-trash fs-3"></i>
                    </button>
                    <button class="btn btn-info mx-2" type="submit" name="buyCart" value="<?= $row['cartID'] ?>">
                      Check Out
                    </button>
                  </div>
                </div>
              </div>
              <div class="row border-bottom border-info text-secondary py-2 mb-3 bg-subtle-dark-color">
                <div class="col-auto">
                  <select class="form-select" name="vouch" id="vouch<?= $i ?>" onchange="compute(<?= $i ?>)">
                    <?php
                    if ($row['voucher'] > 0) {
                      if ($row['voucher_stat'] != 1) {
                        echo '<option value="0">Select</option>';
                        echo '<option value="' . $row['vouchervalue'] . '"> P' . $row['vouchervalue'] . " off |" . $row['voucher'] . ' remaining</option>';
                      } else {
                        echo '<option value="0">You have used available voucher</option>';
                      }
                    } else {
                      echo '<option value="0">No Vouchers Available</option>';
                    } ?>
                  </select>
                </div>
                <div class="col-auto">
                  <span id="voucherText<?= $i ?>" class="fs-6 text-danger"></span>
                </div>
              </div>
            </form>
          <?php } ?>


        <?php mysqli_free_result($resultOrder);
        } else { ?>
          <div class="container py-3 bg-subtle-dark-color">
            <h5 class="m-0">Your shopping cart is empty</h5>
            <div class="mt-3">
              <a href="products.php" class=" px-2">See today's products</a>
            </div>
          </div>
        <?php } ?>
        <!-- end cart -->

      </div>
    </div>
  </div>

  <section class="bg-dark shadow">
    <div class="container">

    </div>
  </section>

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
  <script src="scripts/cartTotal.js"></script>


</body>

</html>