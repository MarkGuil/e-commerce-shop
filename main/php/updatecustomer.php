<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
    $customerID = $_REQUEST['ano'];
    $customerName = trim($_POST['code']);
    $address = trim($_POST['address']);
    $postal = trim($_POST['postal']);
    $phone = trim($_POST['number']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);


    $sql1 = mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
    if (mysqli_num_rows($sql1) > 0) {
        echo "<script> alert('Username Already Exists') </script>";
    } else {
        $sql = "UPDATE customer SET `name` = '$customerName', `username` = '$username', `phone` = '$phone', `email` = '$email', `password` = '$pass', `address` = '$address', `postalCode` = '$postal'
WHERE `customerID` = '$customerID'";

        if (!mysqli_query($link, $sql)) {
            die('Error: ' . mysqli_error($link));
        } else {
            header("location: ../customers.php");
        }
    }
}
