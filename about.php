<?php
include 'php/config.php';
session_start();
if (isset($_SESSION["customerID"])) {
    $ID = $_SESSION["customerID"];
    if ($ID > 0) {
        $sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$ID'");
        $row2  = mysqli_fetch_array($sql2);
        $pas = "<a href = 'edituser.php'>Hi! " . $_SESSION["name"] . "</a> | <a href='orderdisplay.php?type=0'>My Order</a>";
        $log = "<a href = 'php/logout.php'>Log out</a>";
        $home = "usershome.php";
        $ctgry = "userscategory.php?id=1";
    }
} else {
    unset($_SESSION["customerID"]);
    unset($_SESSION["name"]);
    unset($_SESSION["username"]);
    unset($_SERVER["password"]);
    $pas = "<a href = 'registration.php'>Sign up</a>";
    $log = "<a href = 'login.php'>Sign in</a>";
    $home = "index.php";
    $ctgry = "category.php?id=1";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AniShop</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <title>AniShop</title>
    <link rel="icon" type="jpg/png" href="images/logo.png">
    <link rel="stylesheet" href="Styles/style.css" type="text/css">
</head>

<body>
    <?php include 'includes/header.php' ?>
    <!-- Begin menu -->
    <div id="navbar" class="z-3">
        <div class="container">
            <a href="<?php echo $home; ?>">Home</a>
            <a href="products.php">Products</a>
            <a href="<?php echo $ctgry; ?>">Categories</a>
            <a class="active" href="about.php">About</a>
        </div>
    </div>
    <!-- end menu -->
    <div class="container my-5">

        <div class="row d-flex justify-content-center align-items-center bg-white">
            <div class="bg-white col-sm-12 col-md-7" align="center">
                <!-- Begin content -->
                <div class="container py-3">
                    <h2 align="center"><b>ABOUT ANISHOP</b></h2>
                    <hr>
                    <img src="images/logo.png" class="img-thumbnail border-0" width="250px" height="250px">
                    <p style="font-size:20px; text-align: justify;">You can be confident when you're shopping online with AniShop. Our
                        Secure online shopping website encrypts your personal and financial information to ensure your order information is
                        protected. We use industry standard 128-bit encryption. Our Secure online shopping website locks all critical
                        information passed from you to us, such as personal information, in an encrypted envelope, making it extremely
                        difficult for this information to be intercepted.</p>
                    <hr>
                </div>
                <!-- end content -->
            </div>
        </div>
    </div>


    <!--footer-->
    <section class="bg-cyan mt-5">
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
    <div class="row8" style="max-width:100%;">
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