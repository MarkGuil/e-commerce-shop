<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
  $prodName = $_POST['code'];
  $category = $_POST['cat'];
  $prodDesc = $_POST['name'];
  $price = $_POST['price'];
  if (isset($_POST['status'])) {
    $status = $_POST['status'];
  } else {
    $status = "";
  }
  $voucher = $_POST['voucher'];
  $voucherval = $_POST['voucherval'];


  $target_dir = "../../images/";
  $fname = strtotime(date('Y-m-d H:i')) . '_' . $_FILES["picture"]["name"];
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

        $sql = "INSERT INTO product (`productName`, `category_id`, `productDescription`, `picture`, `status`, `price`, `voucher`, `vouchervalue`)
        VALUES ('$prodName', '$category', '$prodDesc', '$fname', '$status', '$price', '$voucher', '$voucherval')";

        if (!mysqli_query($link, $sql)) {
          die('Error: ' . mysqli_error($link));
        }
        header("location: ../products.php");
      } else {
        echo "<script> alert('Sorry, there was an error uploading your file.') </script>";
      }
    }
  }
}
