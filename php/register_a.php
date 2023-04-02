<?php
require_once "config.php";

if(isset($_POST['save'])){
    $name = trim($_REQUEST['name']);
    $address = trim($_REQUEST['address']);
    $zipcode = trim($_REQUEST['zipcode']);
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);
    $number = trim($_REQUEST['number']);
    $email = trim($_REQUEST['email']);

$sql =mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
if(mysqli_num_rows($sql)>0)
{
    echo "Username Already Exists"; 
	exit;
}else{
    $sql = "INSERT INTO customer (`name`, `username`, `phone`, `email`, `password`, `address`, `postalCode`) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ssssssi", $param_name, $param_username, $param_phone, $param_email, $param_password, $param_address, $param_postalCode);
        
        $param_name = $name;
        $param_username = $username;
        $param_phone = $number;
        $param_email = $email;
        $param_password = $password;
        $param_address = $address;
        $param_postalCode = $zipcode;
        
        if(mysqli_stmt_execute($stmt)){
            header("location: login.php?status=success");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
     
    mysqli_stmt_close($stmt);
}
mysqli_close($link);
}
