<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
    $statID = mysqli_real_escape_string($link,trim($_POST['ano']));
    $statName = mysqli_real_escape_string($link,trim($_POST['code']));

    $sql = "UPDATE `prodstatus` SET `statusName` = '$statName' WHERE `statID` = '$statID'";
    if (!mysqli_query($link, $sql)) {
        die('Error: ' . mysqli_error($link));
    } else {
        header("location: ../statprod.php");
    }
}
