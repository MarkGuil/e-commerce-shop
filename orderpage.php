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
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id =  trim($_GET["id"]);
} else {
  header("location: error.php");
  exit();
}
$vo = 0;
$sql = "SELECT * FROM category";
$sql1 = "SELECT * FROM product WHERE `status` = 'feautured'";
$productorder = "SELECT * FROM product WHERE `productID` = '$id'";
$v = "SELECT * FROM order_page WHERE  `customerID` = '$ID' AND `productID` = '$id'";

if ($res = mysqli_query($link, $v)) {
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_array($res)) {
      $vo = $row['voucher_stat'];
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
  <link rel="stylesheet" href="Styles/style.css" type="text/css">
</head>

<body>

  <div class="header">
    <div id="menu-right">
      <a href='edituser.php'>
        <li>Hi! <?php echo $_SESSION["name"] ?>
      </a> | <a href="php/logout.php">Log out</a></li>
    </div>
    <div style="float:right; margin-top: 40px;">
      <a href="orderdisplay.php">
        <img src="images/cart.png" type="jpg/pgn" style="height:50px; width:50px; float:left; margin-left:10px;"></a><span style="font-size: small; color: rgb(109, 108, 108);">ORDER STATUS</span>
    </div>
    <img src="images/logo.png" type="jpg/pgn" style="height:100px; width:100px; float:left; margin-left:10px;">
    <h3>A N I S H O P</h3>
  </div>
  <!-- Begin menu -->
  <div id="navbar">
    <a href="usershome.php">Home</a>
    <a class="active" href="products.php">Products</a>
    <a href="userscategory.php?id=1">Categories</a>
    <a href="about.php">About</a>
  </div>
  <!-- end menu -->

  <div class="row">
    <!-- Begin orderproducts -->
    <form method="post">
      <div style='display: flex; flex-wrap: wrap; padding: 0 2px;'>
        <!-- Begin imageproduct -->
        <div style="background:white; max-width:25%;" align="center">

          <?php
          if ($result = mysqli_query($link, $productorder)) {
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
                echo "<img src ='images/" . $row['picture'] . "' style = 'max-width:100%;'><br>"; ?>
        </div>
        <!-- end imageproduct -->

        <!-- Begin productdescriptions -->
        <div style="background:white; flex: 10%; margin-left:30px; padding:15px;">
          <span> <?php echo $row['productName']; ?></span>
          <hr>
          <p style="color:grey; font-size:19px;">Description: <?php echo $row['productDescription']; ?></p>
          <p style="color:grey; font-size:19px;">Price: P<?php echo $row['price']; ?></p>
          <p style="color:grey; font-size:19px;">Payment Method: Cash on Delivery</p>
          <hr>

          <input type="hidden" value="<?php echo $row['price']; ?>" id="num2">

          <label style="font-size:19px;">Quantity: </label><input type="number" value="0" style="max-width:20%; padding:10px; font-size:15px;" name="quant" id="test1" oninput="compute();">
          <?php
                $prodOrderId = $row['productID'];
                $voucher = $row['voucher'];
                $te = 1;
                echo '<label style = "font-size:19px;">Vouchers: </label>';
                echo '<select style = "max-width:25%; padding:10px; font-size:15px;" name="vouch" id="vouch" onchange="compute()">';
                if ($voucher > 0) {
                  if ($vo != $te) {

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
                echo '</select><br><br>';
          ?>


          <label style="font-size:19px; ">Total Amount: P </label><input type="text" id="num3" name="total" value="0" style="max-width:20%; padding:10px; font-size:15px;" readonly>
          <!-- <label style = "font-size:15px; margin-left:5px;" id = "num3">0</label> --><br><br>
          <input type="submit" value="Order Product" style="padding:15px; border-radius:5px; cursor:pointer; background:skyblue; font-size:16px;" name="send">

    <?php
              }
              mysqli_free_result($result);
            } else {
              echo "<p class='lead'><em>No records were found.</em></p>";
            }
          } else {
            echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);
          }
    ?>
        </div>
        <!-- end productdescription -->
        <!-- end orderproducts -->

      </div>
    </form>
  </div>
  <?php
  if (isset($_POST['send'])) {
    $quant = $_POST['quant'];
    $price = $_POST['total'];

    if (isset($_POST['vouch'])) {
      $vouchervalue = $_POST['vouch'];
      if ($vouchervalue > 0) {
        $voucher_stat = 1;
        $num = 1;
        $newvoucher = $voucher - $num;
        $productorder = "UPDATE product SET `voucher` = '$newvoucher' WHERE `productID` = '$id'";
        if (!mysqli_query($link, $productorder)) {
          die('Error: ' . mysqli_error($link));
        } else {
        }
      }
    }
    if ($quant > 0) {
      // if($result = mysqli_query($link, $productorder)){
      //   if(mysqli_num_rows($result) > 0){
      //     while($row = mysqli_fetch_array($result)){
      //       $prodOrderId = $row['productID'];
      //       // $price = $row['price'];
      //     }mysqli_free_result($result); 
      //   } else {
      //     echo "<p class='lead'><em>No records were found.</em></p>";
      //   }
      // }

      $custId = $ID;
      $totalPrice = $price;
      $totalAmount = number_format($totalPrice, 2, '.', '');
      $ins = "INSERT INTO order_page (`customerId`, `productID`, `quantity`, `totalPrice`, `statID`, `voucher_stat`) VALUES (?, ?, ?, ?, ?, ?)";

      if ($stmt = mysqli_prepare($link, $ins)) {
        mysqli_stmt_bind_param($stmt, "iiidii", $param_custId, $param_prodId, $param_quantity, $param_total, $param_stat, $param_vouchstat);

        $param_custId = $custId;
        $param_prodId = $prodOrderId;
        $param_quantity = $quant;
        $param_total = $totalAmount;
        $param_stat = 1;
        $param_vouchstat = $voucher_stat;

        if (mysqli_stmt_execute($stmt)) {
          header("location: orderdisplay.php");
          exit();
        } else {
          echo "Something went wrong. Please try again later.";
        }
      }
      mysqli_stmt_close($stmt);
    } else {
      echo "<script> alert('Input Quantity'); </script>";
    }
  }
  ?>

  <div class="row2">
    <!-- Start categories -->
    <div style="text-align:left;">
      <span class="category">Category</span><br>
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

    function compute() {
      const n1 = parseInt(document.getElementById("test1").value);
      const n2 = parseFloat(document.getElementById("num2").value);
      const n3 = parseInt(document.getElementById("num3").value);
      const x = parseInt(document.getElementById("vouch").value);
      if (n1 > -1) {
        var computed = n1 * n2 - x;
        if (computed >= 0) {
          document.getElementById("num3").value = computed;
        } else document.getElementById("num3").value = 0;

      }
    }

    // function discount(){
    //   const n3 = parseInt(document.getElementById("num3").value);
    //   const x = parseInt(document.getElementById("vouch").value);

    //   if (n3!=0) {
    //     var computed = n3-x;
    //     document.getElementById("num3").value = computed;
    //   }
    // }
  </script>
</body>

</html>