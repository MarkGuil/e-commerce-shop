<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
    $customerName = mysqli_real_escape_string($link,trim($_POST['code']));
    $address = mysqli_real_escape_string($link,trim($_POST['address']));
    $postal = mysqli_real_escape_string($link,trim($_POST['postal']));
    $phone = mysqli_real_escape_string($link,trim($_POST['number']));
    $username = mysqli_real_escape_string($link,trim($_POST['username']));
    $email = mysqli_real_escape_string($link,trim($_POST['email']));
    $pass = mysqli_real_escape_string($link,trim($_POST['codpassworde']));

    $hash_password = password_hash($pass, PASSWORD_DEFAULT);
    
    $sql1 = mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
    if (mysqli_num_rows($sql1) > 0) {
        echo "<script> alert('Username Already Exists') </script>";
    } else {
        $sql = "INSERT INTO customer (`name`, `username`, `phone`, `email`, `password`, `address`, `postalCode`)
    VALUES ('$customerName', '$username', '$phone', '$email', '$hash_password', '$address', '$postal')";

        if (!mysqli_query($link, $sql)) {
            die('Error: ' . mysqli_error($link));
        } else {
            header("location: ../customers.php");
        }
    }
}
