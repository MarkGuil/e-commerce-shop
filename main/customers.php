<?php
include '../php/config.php';
session_start();
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

if (isset($_POST["limitOption"])) {
  $_SESSION['limitCUST'] = $_POST['limitOption'];
  header('location: customers.php');
}
$limit = isset($_SESSION['limitCUST']) ? $_SESSION['limitCUST'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql1 = "SELECT * FROM customer LIMIT $start, $limit";
$resultprod = mysqli_query($link, $sql1);

$sql2 = "SELECT * FROM customer";
$resultprod2 = mysqli_query($link, $sql2);

$totalPages = mysqli_num_rows($resultprod2);
$pages = ceil($totalPages / $limit);

$previous = $page - 1;
$next = $page + 1;
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
  <script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
  <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="lib/jquery.js" type="text/javascript"></script>
  <script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage: 'src/loading.gif',
        closeImage: 'src/closelabel.png'
      })
    })
  </script>
  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <!--begin top -->

  <!--end top -->
  <div class="d-flex flex-nowrap min-vh-100 p-0 m-0">
    <!--begin sidebar -->
    <div class="sidenav d-flex flex-column flex-shrink-0 mt-0 p-3 top-0 bottom-0" style="width: 200px;">
      <div class="p-2 text-center text-light">
        <img src="../images/logo.png" alt="Bootstrap" width="80" height="80">
        <h3>AniShop</h3>
      </div>
      <a href="index.php" class="d-flex py-3">
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
      <a href="categories.php" class=" d-flex py-3">
        <i class='bx bxs-category fs-4 me-2'></i> <b>Categories</b>
      </a>
      <a href="customers.php" class="active d-flex py-3">
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

      <div class="main mb-3">
        <div class="d-flex fs-2 align-items-center mx-2 py-2 mb-3 border-bottom border-secondary">
          <i class='bx bxs-dashboard me-2'></i> <b>Dashboard / Customers</b>
        </div>
        <div class="px-5">

          <a href="index.php" style="cursor: pointer; padding:5px; padding-left:20px; padding-right:20px; align-text:center; border:1px solid grey; border-radius:5px;">Back</a>

          <div style="text-align:center; margin-top:-25px; font-size:18px;">
            Total Number of Customer:
            <font color="green" style="font:bold 22px 'Aleo';">
              <?php echo $totalPages; ?>
              <a href="customers.php">
                <img src="../images/refresh.png" id="refresh" style="height:20px; width:20px; margin-top:-5px;">
              </a>
            </font>
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Add Customer</button>
          </div>
          <hr>
          <span><b>Customer's Detail</b></span>

          <div class="row mt-3">
            <div class="col-sm-12 col-md-8">
              <div aria-label="...">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link <?php if ($previous <= 0) echo 'disabled' ?>" href="customers.php?page=<?= $previous ?>">Previous</a>
                  </li>
                  <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <li class="page-item">
                      <a class="page-link <?php if ($page == $i) echo 'active' ?>" href="customers.php?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php endfor ?>
                  <li class="page-item">
                    <a class="page-link <?php if ($next > $pages) echo 'disabled' ?>" href="customers.php?page=<?= $next ?>">Next</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <form action="#" id="limitForm" method="post">
                <select id="limitOption" name="limitOption" class="form-select justify-content-end" aria-label="Default select example">
                  <option disabled selected>Limit of records</option>
                  <?php foreach ([10, 25, 50, 100, 250, 500] as $optLimit) : ?>
                    <option <?php if ($limit == $optLimit) echo "selected" ?> value="<?= $optLimit ?>">
                      <?= $optLimit ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </form>
            </div>
          </div>

          <table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead style="font-size:14px;">
              <tr>
                <th width="5%"><b> # </b></th>
                <th width="15%"> Customer Name </th>
                <th width="15%"> Address </th>
                <th width="8%"> Postal Code </th>
                <th width="10%"> Phone Number </th>
                <th width="10%"> Username </th>
                <th width="15%"> Email </th>
                <th width="10%"> Password </th>
                <th width="5%"> Action </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ctr = 0;
              if (mysqli_num_rows($resultprod) > 0) {
                while ($row = mysqli_fetch_array($resultprod)) {
                  $ctr++;
                  $customerID = $row['customerID'];
                  $customerName = $row['name'];
                  $Address = $row['address'];
                  $postal = $row['postalCode'];
                  $phone = $row['phone'];
                  $username = $row['username'];
                  $email = $row['email'];
                  $pass = $row['password'];

              ?>
                  <tr class="record">
                    <td><?php echo $ctr; ?></td>
                    <td><?php echo $customerName; ?></td>
                    <td><?php echo $Address; ?></td>
                    <td><?php echo $postal; ?></td>
                    <td><?php echo $phone; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo str_repeat('*', strlen($pass)); ?></td>
                    <td style="text-align: center;">
                      <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editCustomerModal" onclick="editCustomer('<?php echo $customerID; ?>')">
                        <img src="../images/edit.png" style="height:20px; width:20px;">
                      </button>
                      <hr>
                      <a href="#" id="<?php echo $customerID ?>" class="delbutton" title="Click to Delete customer">
                        <img src="../images/delete.png" style="height:20px; width:20px;">
                      </a>
                    </td>
                  </tr>
              <?php
                }
                mysqli_free_result($resultprod);
              } else {
                echo "<tr><td colspan='9' class='text-center'>No records were found.</tr></td>";
              }

              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <?php include 'modal/addcustomer.php'; ?>
  <?php include 'modal/editCustomer.php'; ?>
  <script src="js/editCustomer.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#limitOption").change(function() {
        $("#limitForm").submit();
        // alert(this.value);
      });
    });

    $(function() {

      $(".delbutton").click(function() {

        //Save the link in a variable called element
        var element = $(this);

        //Find the id of the link that was clicked
        var del_id = element.attr("id");

        //Built a url to send
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this user? There is NO undo!")) {

          $.ajax({
            type: "GET",
            url: "php/deletecustomer.php",
            data: info,
            success: function() {

            }
          });
          $(this).parents(".record").animate({
              backgroundColor: "#fbc7c7"
            }, "fast")
            .animate({
              opacity: "hide"
            }, "slow");

        }

        return false;

      });

    });
  </script>
</body>

</html>