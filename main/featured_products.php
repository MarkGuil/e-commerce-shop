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
    $_SESSION['limitFP'] = $_POST['limitOption'];
    header('location: featured_products.php');
}
$limit = isset($_SESSION['limitFP']) ? $_SESSION['limitFP'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql1 = "SELECT p.* , c.category_name 
          FROM `product` as p 
          INNER JOIN `category` as c 
          ON p.category_id = c.category_id 
          WHERE p.status = 'featured'
          ORDER BY p.productID ASC
          LIMIT $start, $limit";
$resultprod = mysqli_query($link, $sql1);

$sql2 = "SELECT p.*  
          FROM `product` as p 
          INNER JOIN `category` as c 
          ON p.category_id = c.category_id 
          WHERE p.status = 'featured' ";
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
                    <a href="featured_products.php" class="active d-flex py-3">
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

            <div class="main mb-3">
                <div class="d-flex fs-2 align-items-center mx-2 py-2 mb-3 border-bottom border-secondary">
                    <i class='bx bxs-dashboard me-2'></i> <b>Dashboard / Products - featured</b>
                </div>

                <div class="px-5">
                    <a href="index.php" style="cursor: pointer; padding:5px; padding-left:20px; padding-right:20px; align-text:center; border:1px solid grey; border-radius:5px;">Back</a>

                    <div style="text-align:center; margin-top:-25px; font-size:18px;">
                        Total Number of Product/s:
                        <font color="green" style="font:bold 22px 'Aleo';"><?php echo $totalPages; ?>
                            <a href="products.php">
                                <img src="../images/refresh.png" id="refresh" style="height:20px; width:20px; margin-top:-5px;">
                            </a>
                        </font>
                        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
                    </div>
                    <hr>
                    <span><b>Featured Products</b></span>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-8">
                            <div aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link <?php if ($previous <= 0) echo 'disabled' ?>" href="featured_products.php?page=<?= $previous ?>">Previous</a>
                                    </li>
                                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li class="page-item">
                                            <a class="page-link <?php if ($page == $i) echo 'active' ?>" href="featured_products.php?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor ?>
                                    <li class="page-item">
                                        <a class="page-link <?php if ($next > $pages) echo 'disabled' ?>" href="featured_products.php?page=<?= $next ?>">Next</a>
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
                    <table class=" hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
                        <thead style="font-size:14px;">
                            <tr>
                                <th width="18%"> Product Name </th>
                                <th width="15%"> Category </th>
                                <th width="25%"> ProductDescription </th>
                                <th width="12%"> Picture </th>
                                <th width="7%"> Price </th>
                                <th> Quantity </th>
                                <th width="10%"> Voucher </th>
                                <th width="8%"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $sql1 = "SELECT * FROM product WHERE `status` = 'feautured'";
                            // if ($result = mysqli_query($link, $sql1)) {
                            if (mysqli_num_rows($resultprod) > 0) {
                                while ($row = mysqli_fetch_array($resultprod)) {
                                    $prodID = $row['productID'];
                                    $prodName = $row['productName'];
                                    $catID = $row['category_id'];
                                    $category = $row['category_name'];
                                    $prodDesc = $row['productDescription'];
                                    $prodImg = "../images/" . $row['picture'];
                                    $price = $row['price'];
                                    $aQuantity = $row['availableQuantity'];
                                    $voucher = $row['voucher'];
                                    $voucherval = $row['vouchervalue']; ?>

                                    <tr class="record">
                                        <td><?php echo $prodName; ?></td>
                                        <td><?php echo $category; ?></td>
                                        <td><?php echo $prodDesc; ?></td>
                                        <td style="text-align: center;"><img src="<?php echo $prodImg; ?>" style="height100px; width:100px;"></td>
                                        <td><?php echo "P " . $price; ?></td>
                                        <td><?= $aQuantity ?></td>
                                        <td><?php echo "Availabe voucher: " . $voucher . "<br>Amount: P " . $voucherval ?></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editProductModal" onclick="editProduct('<?php echo $prodID; ?>')">
                                                <img src="../images/edit.png" style="height:20px; width:20px;">
                                            </button>
                                            <hr>
                                            <a href="#" id="<?php echo $prodID ?>" class="delbutton" title="Click to Delete the product">
                                                <img src="../images/delete.png" style="height:20px; width:20px;">
                                            </a>
                                        </td>
                                    </tr>
                            <?php }
                                mysqli_free_result($resultprod);
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No records were found.</tr></td>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'modal/addproduct.php'; ?>
    <?php include 'modal/editprod.php'; ?>
    <script src="js/editProduct.js"></script>

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
                if (confirm("Sure you want to delete this order? There is NO undo!")) {

                    $.ajax({
                        type: "GET",
                        url: "php/deleteprod.php",
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