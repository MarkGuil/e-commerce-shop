<?php
session_start();
include('config.php');
if(isset($_POST['updatePassword'])){
    $customerID = $_SESSION["customerID"];
    $password = trim($_POST['newPass3']);


    // $sql1 =mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
    // if(mysqli_num_rows($sql1)>0)
    // {
    //     echo "<script> alert('Username Already Exists') </script>"; 
    // }else{
$sql2 = "UPDATE customer SET `password` = '$password' WHERE `customerID` = '$customerID'";

if (!mysqli_query($link,$sql2))
{
die('Error: ' . mysqli_error($link));
}else{
    $_SESSION["password"]=$password;
    header("location: login.php");
}
    }
