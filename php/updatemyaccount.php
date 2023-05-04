<?php
session_start();
include('config.php');
if (isset($_POST['save2'])) {
    $customerID = $_SESSION["customerID"];
    $customerName = mysqli_real_escape_string($link,trim($_POST['name']));
    $address = mysqli_real_escape_string($link,trim($_POST['address']));
    $postal = mysqli_real_escape_string($link,trim($_POST['zipcode']));
    $phone = mysqli_real_escape_string($link,trim($_POST['number']));
    $username = mysqli_real_escape_string($link,trim($_POST['username']));
    $email = mysqli_real_escape_string($link,trim($_POST['email']));

    $sql2 = "UPDATE `customer` SET `name` = '$customerName', `username` = '$username', `phone` = '$phone', `email` = '$email', `address` = '$address', `postalCode` = '$postal' WHERE `customerID` = '$customerID'";

    if (!mysqli_query($link, $sql2)) {
        die('Error: ' . mysqli_error($link));
    } else {
        $_SESSION["username"] = $username;
        $_SESSION["name"] = $customerName;
        $_SESSION["phone"] = $phone;
        $_SESSION["email"] = $email;
        $_SESSION["address"] = $address;
        $_SESSION["postalCode"] = $postal;

        $_SESSION['status'] = "Successfully updated your account details.";
        header("location: ../edituser.php");
    }
}




if (isset($_POST['updatePassword'])) {
    $customerID = $_SESSION["customerID"];
    $password = mysqli_real_escape_string($link,trim($_POST['newPass3']));
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $sql2 = "UPDATE `customer` SET `password` = '$hash_password' WHERE `customerID` = '$customerID'";

    if (!mysqli_query($link, $sql2)) {
        die('Error: ' . mysqli_error($link));
    } else {
        $_SESSION["password"] = $hash_password;
        $_SESSION['status'] = "Successfully updated your password.";
        header("location: ../edituser.php");
    }
}
