<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
  $prodName = mysqli_real_escape_string($link,trim($_POST['code']));
  $category = mysqli_real_escape_string($link,trim($_POST['cat']));
  $prodDesc = mysqli_real_escape_string($link,trim($_POST['name']));
  $quantity = mysqli_real_escape_string($link,trim($_POST['quantity']));
  $price = mysqli_real_escape_string($link,trim($_POST['price']));
  $location = "location: ../products.php";
  if (isset($_POST['status']) && $_POST['status'] == "featured") {
    $status = mysqli_real_escape_string($link,trim($_POST['status']));
    $location = "location: ../featured_products.php";
  } else {
    $location = "location: ../products.php";
    $status = "";
  }
  $voucher = mysqli_real_escape_string($link,trim($_POST['voucher']));
  $voucherval = mysqli_real_escape_string($link,trim($_POST['voucherval']));


  $target_dir = "../../images/";
  $fname = strtotime(date('Y-m-d H:i')) . '_' . $_FILES["picture"]["name"];
  $_fname = mysqli_real_escape_string($link,$fname);
  $target_file = $target_dir . basename($fname);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Allow certain file size
  if ($_FILES["picture"]["size"] > 500000) {
    echo "<script> alert('Sorry, your file is too large.') </script>";
  } else {
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      echo "<script> alert('Sorry, only JPG, JPEG, & PNG files are allowed.') </script>";
    } else {
      if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {

        $sql = "INSERT INTO product (`productName`, `category_id`, `productDescription`, `picture`, `status`, `price`, `availableQuantity`, `voucher`, `vouchervalue`)
        VALUES ('$prodName', '$category', '$prodDesc', '$_fname', '$status', '$price', '$quantity', '$voucher', '$voucherval')";

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
