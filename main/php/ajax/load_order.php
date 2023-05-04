<?php
include('../../../php/config.php');

$id = $_POST['id'];

$sql = "SELECT *FROM `order_page` WHERE `orderID` = '$id'";
$result = mysqli_query($link, $sql)->fetch_assoc();

exit(json_encode(array($result)));
