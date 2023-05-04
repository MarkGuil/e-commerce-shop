<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
    $customerID = mysqli_real_escape_string($link,$_REQUEST['ano']);
    $customerName = mysqli_real_escape_string($link,trim($_POST['code']));
    $address = mysqli_real_escape_string($link,trim($_POST['address']));
    $postal = mysqli_real_escape_string($link,trim($_POST['postal']));
    $phone = mysqli_real_escape_string($link,trim($_POST['number']));
    $username = mysqli_real_escape_string($link,trim($_POST['username']));
    $email = mysqli_real_escape_string($link,trim($_POST['email']));
    $pass = mysqli_real_escape_string($link,trim($_POST['password']));

    $hash_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql1 = mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
    if (mysqli_num_rows($sql1) > 0) {
        echo "<script> alert('Username Already Exists') </script>";
    } else {
        $sql = "UPDATE customer SET `name` = '$customerName', `username` = '$username', `phone` = '$phone', `email` = '$email', `password` = '$hash_password', `address` = '$address', `postalCode` = '$postal'
WHERE `customerID` = '$customerID'";

        if (!mysqli_query($link, $sql)) {
            die('Error: ' . mysqli_error($link));
        } else {
            header("location: ../customers.php");
        }
    }
}
