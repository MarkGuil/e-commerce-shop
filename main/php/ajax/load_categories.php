<?php
include('../../../php/config.php');

$id = $_POST['id'];

$sql = "SELECT *FROM `category` WHERE `category_id` = '$id'";
$result = mysqli_query($link, $sql)->fetch_assoc();

exit(json_encode(array($result)));
