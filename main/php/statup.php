<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
    $statID = $_REQUEST['ano'];
    $statName = $_POST['code'];

    $sql = "UPDATE prodstatus SET `statusName` = '$statName' WHERE `statID` = '$statID'";
    if (!mysqli_query($link, $sql)) {
        die('Error: ' . mysqli_error($link));
    } else {
        header("location: ../statprod.php");
    }
}
