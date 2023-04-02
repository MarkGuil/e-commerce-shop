<?php
    session_start();
    unset($_SESSION["customerID"]);
    unset($_SESSION["name"]);
    unset($_SESSION["username"]);
    unset($_SERVER["password"]);
    header("Location:index.php");
