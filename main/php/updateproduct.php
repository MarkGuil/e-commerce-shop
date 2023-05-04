<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
  $prodID =  mysqli_real_escape_string($link,$_REQUEST['ano']);
  $prodName =  mysqli_real_escape_string($link,$_POST['code']);
  $category =  mysqli_real_escape_string($link,$_POST['cat']);
  $prodDesc =  mysqli_real_escape_string($link,$_POST['name']);
  $quantity =  mysqli_real_escape_string($link,$_POST['quantity']);
  $price =  mysqli_real_escape_string($link,$_POST['price']);
  $location = "location: ../products.php";
  if (isset($_POST['status']) && $_POST['status'] == "featured") {
    $status =  mysqli_real_escape_string($link,$_POST['status']);
    $location = "location: ../featured_products.php";
  } else {
    $status = "";
    $location = "location: ../products.php";
  }
  $voucher = mysqli_real_escape_string($link,$_POST['voucher']);
  $voucherval =  mysqli_real_escape_string($link,$_POST['voucherval']);

  $target_dir = "../../images/";
  $fname = strtotime(date('Y-m-d H:i')) . '_' . $_FILES["picture"]["name"];
  $_fname = mysqli_real_escape_string($link,$fname);
  $target_file = $target_dir . basename($fname);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  if (empty($_FILES['picture']['name'])) {
    $sql = "UPDATE `product` SET `productName` = '$prodName', `category_id` = '$category', `productDescription` = '$prodDesc', `status` = '$status', `price` = '$price', `availableQuantity` = '$quantity', `voucher` = '$voucher', `vouchervalue` = '$voucherval' WHERE productID= '$prodID'";
    if (!mysqli_query($link, $sql)) {
      die('Error: ' . mysqli_error($link));
    }
    header($location);
  }

  // Allow certain file size
  if ($_FILES["picture"]["size"] > 500000) {
    echo "<script> alert('Sorry, your file is too large.') </script>";
  } else {
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      echo "<script> alert('Sorry, only JPG, JPEG, & PNG files are allowed.') </script>";
    } else {
      if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        $sql = "UPDATE `product` SET `productName` = '$prodName', `category_id` = '$category', `productDescription` = '$prodDesc', `picture` = '$_fname', `status` = '$status', `price` = '$price', `voucher` = '$voucher', `vouchervalue` = '$voucherval' WHERE productID= '$prodID'";
        if (!mysqli_query($link, $sql)) {
          die('Error: ' . mysqli_error($link));
        }
        header($location);
      } else {
        echo "<script> alert('Sorry, there was an error uploading your file.') </script>";
      }
    }
  }
}
