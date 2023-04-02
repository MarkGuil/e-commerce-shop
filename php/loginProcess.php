<?php
session_start();
if(isset($_POST['login']))
{
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    extract($_POST);
    include 'config.php';
    $sql=mysqli_query($link,"SELECT * FROM customer where username='$username' and `password`='$password'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["customerID"] = $row['customerID'];
        $_SESSION["username"]=$row['username'];
        $_SESSION["name"]=$row['name'];
        $_SESSION["phone"] = $row['phone'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["password"] = $row['password'];
        $_SESSION["address"] = $row['address'];
        $_SESSION["postalCode"] = $row['postalCode'];
        header("Location: usershome.php"); 
    }
    else
    {
        header("Location: login.php?status=unsuccessful");
        $_SESSION["error"] = "Wrong Username/Password";
    }
}
