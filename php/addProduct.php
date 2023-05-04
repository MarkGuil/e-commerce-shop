<?php
  session_start();
  include 'config.php';
  if(isset($_POST['send']) && $_POST['send'] == 'orderproduct') {
    $customerID = $_SESSION["customerID"];
    $quant = mysqli_real_escape_string($link,$_POST['quant']);
    $price = mysqli_real_escape_string($link,$_POST['total']);
    $id = mysqli_real_escape_string($link,$_POST['productID']);
    $voucher_stat = 0;
    
    //start update voucher value if user added a voucher
    if (isset($_POST['vouch'])) {
      $vouchervalue = mysqli_real_escape_string($link,$_POST['vouch']);
      if ($vouchervalue > 0) {
        $voucher_stat = 1;
        $sqlUpdateVoucher = "UPDATE `product` SET `voucher` = `voucher` - 1 WHERE `productID` = '$id'";
        if (!mysqli_query($link, $sqlUpdateVoucher)) {
          die('Error: ' . mysqli_error($link));
        } 
      }
    }
    //end update voucher value if user added a voucher

    //quantity value checker
    if ($quant > 0) {

      //start update product quantity value
      $sqlUpdateQuantity = "UPDATE `product` SET `availableQuantity` = `availableQuantity` - $quant WHERE `productID` = '$id'";
      if (!mysqli_query($link, $sqlUpdateQuantity)) {
        die('Error: ' . mysqli_error($link));
      } 
      //end update product quantity value

      $totalAmount = number_format($price, 2, '.', '');
      
      //start insert user order to database
      $ins = "INSERT INTO `order_page` (`customerId`, `productID`, `quantity`, `totalPrice`, `statID`, `voucher_stat`) VALUES (?, ?, ?, ?, ?, ?)";
      if ($stmt = mysqli_prepare($link, $ins)) {
        mysqli_stmt_bind_param($stmt, "iiidii", $param_custId, $param_prodId, $param_quantity, $param_total, $param_stat, $param_vouchstat);

        $param_custId = $customerID;
        $param_prodId = $id;
        $param_quantity = $quant;
        $param_total = $totalAmount;
        $param_stat = 2;
        $param_vouchstat = $voucher_stat;

        if (mysqli_stmt_execute($stmt)) {
          header("location: ../orderdisplay.php");
          exit();
        } else {
          header("location: ../orderpage.php?id=$id");
          echo "Something went wrong. Please try again later.";
        }
      }
      mysqli_stmt_close($stmt);
      header("location: ../orderpage.php?id=$id");
      //end insert user order to database

    } else {
      echo "<script> alert('Input Quantity'); </script>";
      header("location: ../orderpage.php?id=$id");
    }
  } 

  if(isset($_POST['send']) && $_POST['send'] == 'addtocart') {
    $customerID = $_SESSION["customerID"];
    $quant = mysqli_real_escape_string($link,$_POST['quant']);
    $price = mysqli_real_escape_string($link,$_POST['total']);
    $id = mysqli_real_escape_string($link,$_POST['productID']);
    $totalAmount = number_format($price, 2, '.', '');

    //quantity value checker
    if ($quant > 0) {
      $ins = "INSERT INTO `cart` (`customerId`, `productID`, `quantity`, `totalPrice`, `statID`) VALUES (?, ?, ?, ?, ?)";
      if ($stmt = mysqli_prepare($link, $ins)) {
        mysqli_stmt_bind_param($stmt, "iiidi", $param_custId, $param_prodId, $param_quantity, $param_total, $param_stat);

        $param_custId = $customerID;
        $param_prodId = $id;
        $param_quantity = $quant;
        $param_total = $totalAmount;
        $param_stat = 2;

        if (mysqli_stmt_execute($stmt)) {
          header("location: ../cart.php");
          exit();
        } else {
          echo "Something went wrong. Please try again later.";
          header("location: ../orderpage.php?id=$id");
        }
      }
      mysqli_stmt_close($stmt);
      header("location: ../orderpage.php?id=$id");
    } else {
      header("location: ../orderpage.php?id=$id");
      echo "<script> alert('Input Quantity'); </script>";
    }
  }
  ?>