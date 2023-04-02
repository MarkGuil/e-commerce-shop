<?php
include('../../php/config.php');
if (isset($_POST['save'])) {
    $statName = trim($_POST['code']);

    $sql = "INSERT INTO prodstatus (`statusName`)
    VALUES ('$statName')";

    if (!mysqli_query($link, $sql)) {
        die('Error: ' . mysqli_error($link));
    } else {
        header("location: ../statprod.php");
    }
}
