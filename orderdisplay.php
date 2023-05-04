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
$statusID = 0;
if (isset($_GET["type"]) && $_GET["type"] > 0) {
  $statusID = $_GET["type"];
  $sqlOrder = "SELECT o.* , p.* , s.* 
        FROM `order_page` as o 
        INNER JOIN `product` as p 
        ON o.productID = p.productID 
        INNER JOIN `prodstatus` as s 
        ON o.statID = s.statID 
        WHERE o.customerID = '$customerID' AND o.statID = '$statusID' 
        ORDER BY o.orderID DESC";
  $resultOrder = mysqli_query($link, $sqlOrder);
} else {
  $sqlOrder = "SELECT o.* , p.* , s.* 
              FROM `order_page` as o 
              INNER JOIN `product` as p 
              ON o.productID = p.productID 
              INNER JOIN `prodstatus` as s 
              ON o.statID = s.statID 
              WHERE o.customerID = '$customerID'
              ORDER BY o.orderID DESC";
  $resultOrder = mysqli_query($link, $sqlOrder);
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

  <div class="container px-md-5 pb-4">
    <div class="row py-3 px-md-5 fs-6">
      <!-- Begin ordered products -->
      <h4>My Orders</h4>
      <div class="container p-0 mx-4 my-1 bg-subtle-dark-color">
        <ul class="d-flex m-0 p-0 text-center">
          <li class="p-2 m-0 flex-fill border-bottom <?= $statusID == 0 ? "border-info text-info border-2" : "border-secondary" ?>  ">
            <a href="orderdisplay.php?type=0" class="text-decoration-none">
              All
            </a>
          </li>
          <li class="p-2 m-0 flex-fill border-bottom <?= $statusID == 2 ? "border-info text-info border-2" : "border-secondary" ?> ">
            <a href="orderdisplay.php?type=2" class="text-decoration-none">
              Pending
            </a>
          </li>
          <li class="p-2 m-0 flex-fill border-bottom <?= $statusID == 3 ? "border-info text-info border-2" : "border-secondary" ?> ">
            <a href="orderdisplay.php?type=3" class="text-decoration-none">
              To Ship
            </a>
          </li>
          <li class="p-2 m-0 flex-fill border-bottom <?= $statusID == 4 ? "border-info text-info border-2" : "border-secondary" ?> ">
            <a href="orderdisplay.php?type=4" class="text-decoration-none">
              To Receive
            </a>
          </li>
          <li class="p-2 m-0 flex-fill border-bottom <?= $statusID == 1 ? "border-info text-info border-2" : "border-secondary" ?> ">
            <a href="orderdisplay.php?type=1" class="text-decoration-none">
              Completed
            </a>
          </li>
          <li class="p-2 m-0 flex-fill border-bottom <?= $statusID == 6 ? "border-info text-info border-2" : "border-secondary" ?> ">
            <a href="orderdisplay.php?type=6" class="text-decoration-none">
              Recieved
            </a>
          </li>
          <li class="p-2 m-0 flex-fill border-bottom <?= $statusID == 5 ? "border-info text-info" : "border-secondary" ?> ">
            <a href="orderdisplay.php?type=5" class="text-decoration-none">
              Cancelled
            </a>
          </li>
        </ul>
      </div>
      <?php
      if (mysqli_num_rows($resultOrder) > 0) {
        while ($row = mysqli_fetch_array($resultOrder)) {
          $ProdId = $row['productID'];
          $quantity = $row['quantity'];
          $totalAmount = $row['totalPrice'];
          $stats = $row['statID'];
          $orderId = $row['orderID'];
          $productName = $row['productName'];
          $productImg = $row['picture'];
          $statusName = $row['statusName'];
      ?>
          <div class="container mx-4 my-2 bg-subtle-dark-color">
            <div class="text-end border-bottom border-info pt-3 pb-1 px-4">
              <span class="px-2 py-1 rounded text-success"><?= $statusName ?></span>
            </div>
            <div class="py-2 px-4 border-bottom border-info">
              <div class="d-flex align-items-center justify-content-start">
                <img class="" src="images/<?= $productImg ?>" style="height:90px; width:90px;">
                <div class="flex-fill">
                  <p class="px-3"><?= $productName ?></p>
                  <p class="mx-3">Qty <?= $quantity ?></p>
                </div>
                <div class="d-flex align-items-center">
                  <span class="px-3 align-items-center">Order Total:</span>
                  <h3 class="text-info">₱ <?= $totalAmount ?></h3>
                </div>
              </div>
            </div>
            <div class="py-2 px-3 d-flex justify-content-end">
              <?php if ($row['statID'] == 2) { ?>
                <form action="php/cancelOrder.php" method="post">
                  <button type="submit" name="cancelOrder" value="<?= $orderId ?>" class="btn btn-warning text-decoration-none">Cancel</button>
                </form>
              <?php } ?>
              <?php if ($row['statID'] == 1) { ?>
                <form action="php/receiveOrder.php" method="post">
                  <button type="submit" name="receiveOrder" value="<?= $orderId ?>" class="btn btn-warning text-decoration-none">Item Receive</button>
                </form>
              <?php } ?>
              <a href="orderpage.php?id=<?= $ProdId ?>" class="btn btn-info text-decoration-none ms-2">Buy Again</a>
            </div>
          </div>
        <?php
        }
        mysqli_free_result($resultOrder);
      } else { ?>
        <div class="container mx-4 py-3 my-2 bg-subtle-dark-color">
          <h5 class="m-0">Your order list is empty</h5>
          <div class="mt-3">
            <a href="products.php" class=" px-2">See today's products</a>
          </div>
        </div>
      <?php } ?>

      </tbody>
      </table>
      <!-- end oredered products -->
    </div>
  </div>

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

</body>

</html>