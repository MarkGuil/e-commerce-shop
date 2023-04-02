<?php
session_start();
if (isset($_POST['login'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    extract($_POST);
    include 'config.php';
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
