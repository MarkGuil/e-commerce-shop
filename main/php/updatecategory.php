<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
  $catID = mysqli_real_escape_string($link,trim($_REQUEST['ano']));
  $catName = mysqli_real_escape_string($link,trim($_POST['code']));

  if (empty($_FILES['picture']['name'])) {
    $sql = "UPDATE category SET `category_name` = '$catName' WHERE category_id= '$catID'";
    if (!mysqli_query($link, $sql)) {
      die('Error: ' . mysqli_error($link));
    } else {
      header("location: ../categories.php");
    }
  }

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
        $sql = "UPDATE category SET `category_name` = '$catName', `picture` = '$_fname' WHERE category_id= '$catID'";
        if (!mysqli_query($link, $sql)) {
          die('Error: ' . mysqli_error($link));
        } else {
          header("location: ../categories.php");
        }
      } else {
        echo "<script> alert('Sorry, there was an error uploading your file.') </script>";
      }
    }
  }
}
