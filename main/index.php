<?php
include '../php/config.php';
include '../php/adminprocess.php';
if (isset($_SESSION["userID"])) {
  $ID = $_SESSION["userID"];
  if ($ID > 0) {
    $name = $_SESSION["name"];
  }
} else {
  unset($_SESSION["userID"]);
  unset($_SESSION["name"]);
  unset($_SESSION["username"]);
  unset($_SERVER["password"]);
  header("Location: ../adminlogin.php");
}
$sqlCat = "SELECT * FROM category";
$resultCat = mysqli_query($link, $sqlCat);
$totalCat = mysqli_num_rows($resultCat);

$sqlCust = "SELECT * FROM customer";
$resultCust = mysqli_query($link, $sqlCust);
$totalCust = mysqli_num_rows($resultCust);

$sqlFP = "SELECT p.*  
FROM `product` as p 
INNER JOIN `category` as c 
ON p.category_id = c.category_id 
WHERE p.status = 'featured' ";
$resultFP = mysqli_query($link, $sqlFP);
$totalFP = mysqli_num_rows($resultFP);

$sqlNFP = "SELECT p.*  
        FROM `product` as p 
        INNER JOIN `category` as c 
        ON p.category_id = c.category_id 
        WHERE p.status = '' ";
$resultNFP = mysqli_query($link, $sqlNFP);
$totalNFP = mysqli_num_rows($resultNFP);

$sqlStat = "SELECT * FROM prodstatus";
$resultStat = mysqli_query($link, $sqlStat);
$totalStat = mysqli_num_rows($resultStat);

$sqlORD = "SELECT orderID FROM order_page ORDER BY orderID";
$resultORD = mysqli_query($link, $sqlORD);
$totalORD = mysqli_num_rows($resultORD);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <title>AniShop | Admin</title>
  <link rel="icon" type="jpg/png" href="../images/logo.png">
  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <div class="d-flex flex-nowrap min-vh-100 p-0 m-0">
    <!--begin sidebar -->
    <div class="sidenav d-flex flex-column flex-shrink-0 mt-0 p-3 top-0 bottom-0" style="width: 200px;">
      <div class="p-2 text-center text-light">
        <img src="../images/logo.png" alt="Bootstrap" width="80" height="80">
        <h3>AniShop</h3>
      </div>
      <a href="index.php" class="active d-flex py-3">
        <i class='bx bxs-dashboard fs-4 me-2'></i> <b>Dashboard</b>
      </a>
      <a href="orders.php" class="d-flex py-3">
        <i class='bx bxs-notepad fs-4 me-2'></i> <b>Orders</b>
      </a>
      <a class="d-flex py-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class='bx bxs-package fs-4 me-2'></i> <b class="dropdown-toggle">Products</b>
      </a>
      <div class="collapse" id="collapseExample">
        <div class="card card-body bg-transparent border-0 py-1 pe-0">
          <a href="featured_products.php" class="d-flex py-3">
            <i class='bx bxs-star fs-4 me-2'></i> <b>Featured</b>
          </a>
          <a href="products.php" class="d-flex py-3">
            <i class='bx bx-star fs-4 me-2'></i> <b>Not featured</b>
          </a>
        </div>
      </div>
      <a href="statprod.php" class="d-flex py-3">
        <i class='bx bx-stats fs-4 me-2'></i> <b>Product Status</b>
      </a>
      <a href="categories.php" class="d-flex py-3">
        <i class='bx bxs-category fs-4 me-2'></i> <b>Categories</b>
      </a>
      <a href="customers.php" class="d-flex py-3">
        <i class='bx bxs-user-account fs-4 me-2'></i> <b>Customers</b>
      </a>
    </div>
    <!--end sidebar -->

    <div class="position-relative flex-fill p-0 m-0">

      <!--begin nav -->
      <nav class="container-fluid bg-primary text-white shadow row py-2 px-3 m-0">
        <div class="col p-2">
          <span class="navbar-brand mb-0 h1">Point of Sales</span>
        </div>
        <div class="col d-flex justify-content-end">
          <div class="d-flex py-2 px-3">
            <i class='bx bx-user fs-4 me-2'></i> Welcome: <b> <?php echo $name; ?></b>
          </div>
          <div class="d-flex py-2 px-3">
            <i class='bx bx-calendar fs-4 me-2'> </i><?php echo date("F m Y"); ?>
          </div>
          <a href="php/logout.php" class="text-light d-flex py-2 px-3">
            <i class='bx bx-log-out-circle fs-4 me-2'></i>
            <b>Log Out</b>
          </a>
        </div>

      </nav>
      <!--end nav -->

      <div class="container-fluid px-5 py-2">
        <div id="" class="d-flex fs-2 align-items-center mx-2 py-2 mb-3 border-bottom border-secondary">
          <i class='bx bxs-dashboard me-2'></i> <b>Dashboard</b>
        </div>
        <div class="d-flex justify-content-center">
          <div id="dashboard-links" class="container row text-center">
            <div class="col-sm-12 col-md-3 p-2">
              <a href="orders.php" class="card border border-2 border-secondary rounded h-100 mx-3 pb-5 pt-4">
                <i class='bx bxs-notepad display-3 p-3'></i>
                <h5><?= $totalORD ?></h5>
                <h6 class="m-0 fw-semibold">Orders</h6>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 p-2">
              <a href="featured_products.php" class="card border border-2 border-secondary rounded h-100 mx-3 pb-5 pt-4">
                <i class='bx bxs-package display-3 p-3'></i>
                <h5><?= $totalFP ?></h5>
                <h6 class="m-0 fw-semibold">Featured Products</h6>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 p-2">
              <a href="products.php" class="card border border-2 border-secondary rounded h-100 mx-3 pb-5 pt-4">
                <i class='bx bxs-package display-3 p-3'></i>
                <h5><?= $totalNFP ?></h5>
                <h6 class="m-0 fw-semibold">Non Featured Products</h6>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 p-2">
              <a href="categories.php" class="card border border-2 border-secondary rounded h-100 mx-3 pb-5 pt-4">
                <i class='bx bxs-category display-3 p-3'></i>
                <h5><?= $totalCat ?></h5>
                <h6 class="m-0 fw-semibold">Categories</h6>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 p-2">
              <a href="customers.php" class="card border border-2 border-secondary rounded h-100 mx-3 pb-5 pt-4">
                <i class='bx bxs-user-account display-3 p-3'></i>
                <h5><?= $totalCust ?></h5>
                <h6 class="m-0 fw-semibold">Customers</h6>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 p-2">
              <a href="statprod.php" class="card border border-2 border-secondary rounded h-100 mx-3 pb-5 pt-4">
                <i class='bx bx-stats display-3 p-3'></i>
                <h5><?= $totalStat ?></h5>
                <h6 class="m-0 fw-semibold">Product Status</h3>
              </a>
            </div>
            <div class="col-sm-12 col-md-3 p-2">
              <a href="php/logout.php" class="card border border-2 border-secondary rounded h-100 mx-3 py-5">
                <i class='bx bx-log-out-circle display-3 p-2'></i>
                <h6 class="m-0 fw-semibold">Logout</h6>
              </a>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</body>

</html>