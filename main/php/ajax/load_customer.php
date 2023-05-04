<?php
include('../../../php/config.php');

$id = $_POST['id'];

$sql = "SELECT *FROM `customer` WHERE `customerID` = '$id'";
$result = mysqli_query($link, $sql)->fetch_assoc();

exit(json_encode(array($result)));
