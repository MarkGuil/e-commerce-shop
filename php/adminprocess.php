<?php
include 'config.php';
session_start();
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($link,$_REQEUST['username']);
    $password = mysqli_real_escape_string($link,$_REQEUST['password']);
    extract($_POST);
    $sql = mysqli_query($link, "SELECT * FROM user where username='$username' and `password`='$password'");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        $_SESSION["userID"] = $row['userID'];
        $_SESSION["username"] = $row['username'];
        $_SESSION["name"] = $row['name'];
        header("Location: ../main/index.php");
    } else {
        header("Location: adminlogin.php?status=unsuccessful");
        $_SESSION["error"] = "Wrong Username/Password";
    }
}
