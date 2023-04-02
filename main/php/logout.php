<?php
    session_start();
    unset($_SESSION["userID"]);
        unset($_SESSION["name"]);
        unset($_SESSION["username"]);
        unset($_SERVER["password"]);
        header("Location: ../../adminlogin.php");
