<?php
require_once "config.php";

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($link,trim($_REQUEST['name']));
    $address = mysqli_real_escape_string($link,trim($_REQUEST['address']));
    $zipcode = mysqli_real_escape_string($link,trim($_REQUEST['zipcode']));
    $username = mysqli_real_escape_string($link,trim($_REQUEST['username']));
    $password = mysqli_real_escape_string($link,trim($_REQUEST['password']));
    $number = mysqli_real_escape_string($link,trim($_REQUEST['number']));
    $email = mysqli_real_escape_string($link,trim($_REQUEST['email']));
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = mysqli_query($link, "SELECT * FROM customer WHERE username='$username'");
    if (mysqli_num_rows($sql) > 0) {
        header("Location: ../registration.php?status=unsuccessful");
        $_SESSION["error"] = "Username Already Exists";
        exit;
    } else {
        $sql = "INSERT INTO customer (`name`, `username`, `phone`, `email`, `password`, `address`, `postalCode`) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_name, $param_username, $param_phone, $param_email, $param_password, $param_address, $param_postalCode);

            $param_name = $name;
            $param_username = $username;
            $param_phone = $number;
            $param_email = $email;
            $param_password = $hash_password;
            $param_address = $address;
            $param_postalCode = $zipcode;

            if (mysqli_stmt_execute($stmt)) {
                header("location: ../login.php?status=success");
                exit();
            } else {
                header("Location: ../registration.php?status=unsuccessful");
                $_SESSION["error"] = "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
