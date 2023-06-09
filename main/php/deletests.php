<?php
include '../../php/config.php';
if (isset($_GET["id"]) && !empty($_GET["id"])) {

    $sql = "DELETE FROM prodstatus WHERE statID = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET['id']);
        if (mysqli_stmt_execute($stmt)) {
            header("location: ../statprod.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    if (empty(trim($_GET["id"]))) {
        header("location: ../../error.php");
        exit();
    }
}
