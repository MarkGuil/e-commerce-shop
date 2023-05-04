<?php
include '../../php/config.php';
if (isset($_REQUEST['save'])) {
    $ano = mysqli_real_escape_string($link,$_REQUEST['ano']);
    $statID = mysqli_real_escape_string($link,$_REQUEST['stat']);

    $sql2 = "UPDATE `order_page` SET `statID`='$statID' WHERE `orderID`= '$ano'";

    if (mysqli_query($link, $sql2)) {
        header("location: ../orders.php");
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
} else {
    header("location: ../../error.php");
}
