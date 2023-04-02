<?php
session_start();
include('config.php');
if(isset($_POST['save2'])){
    $customerID = $_SESSION["customerID"];
    $customerName = trim($_POST['name']);
    $address = trim($_POST['address']);
    $postal = trim($_POST['zipcode']);
    $phone = trim($_POST['number']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    // $password = trim($_SESSION['password']);


    // $sql1 =mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
    // if(mysqli_num_rows($sql1)>0)
    // {
    //     echo "<script> alert('Username Already Exists') </script>"; 
    // }else{
$sql2 = "UPDATE customer SET `name` = '$customerName', `username` = '$username', `phone` = '$phone', `email` = '$email', `address` = '$address', `postalCode` = '$postal' WHERE `customerID` = '$customerID'";

if (!mysqli_query($link,$sql2))
{
die('Error: ' . mysqli_error($link));
}else{
        $_SESSION["username"]=$username;
        $_SESSION["name"]=$customerName;
        $_SESSION["phone"] = $phone;
        $_SESSION["email"] = $email;
        $_SESSION["address"] = $address;
        $_SESSION["postalCode"] = $postal;
    header("location: edituser.php");
}
}




if(isset($_POST['updatePassword'])){
    $customerID = $_SESSION["customerID"];
    $password = trim($_POST['newPass3']);

    // $sql1 =mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
    // if(mysqli_num_rows($sql1)>0)
    // {
    //     echo "<script> alert('Username Already Exists') </script>"; 
    // }else{
$sql2 = "UPDATE customer SET `password` = '$password2' WHERE `customerID` = '$customerID'";

if (!mysqli_query($link,$sql2))
{
die('Error: ' . mysqli_error($link));
}else{
    $_SESSION["password"]=$password2;
    header("location: edituser.php");
}
}
