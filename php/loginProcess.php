<?php
session_start();
if (isset($_POST['login'])) {
    include 'config.php';
    $username = mysqli_real_escape_string($link,$_REQUEST['username']);
    $password = mysqli_real_escape_string($link,trim($_REQUEST['password']));
    extract($_POST);
    $sql = mysqli_query($link, "SELECT * FROM customer where username='$username' ");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        // $hash = '$2y$10$0JGE//3I3Co.NRWdrqejLO7iasggyJeA9fjj5iFX6W7dnR4XJQbbC';
        // echo $password;
        // if (password_verify($password, $hash)) {
        //     echo 'Password is valid!';
        // } else {
        //     echo 'Invalid password.';
        // }
        if (password_verify($password, $row['password'])) {
            $_SESSION["customerID"] = $row['customerID'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["name"] = $row['name'];
            $_SESSION["phone"] = $row['phone'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["password"] = $row['password'];
            $_SESSION["address"] = $row['address'];
            $_SESSION["postalCode"] = $row['postalCode'];
            header("Location: ../usershome.php");
        } else {
            header("Location: ../login.php?status=unsuccessful");
            $_SESSION["error"] = "Wrong Password";
        }
    } else {
        header("Location: ../login.php?status=unsuccessful");
        $_SESSION["error"] = "Username doesn't exist";
    }
}
