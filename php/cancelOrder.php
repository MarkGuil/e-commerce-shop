<?php
    include 'config.php';
    session_start();
    if(isset($_POST['cancelOrder'])) {
        $orderId = mysqli_real_escape_string($link,$_POST['cancelOrder']);

        $sqlUpdateOrderStat = "UPDATE `order_page` SET `statID` = '5' WHERE `orderID` = '$orderId'";
        if (!mysqli_query($link, $sqlUpdateOrderStat)) {
            die('Error: ' . mysqli_error($link));
        } 

        header("location: ../orderdisplay.php?type=5");
    } 