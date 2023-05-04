<?php
    include 'config.php';
    session_start();
    if(isset($_POST['receiveOrder'])) {
        $orderId = mysqli_real_escape_string($link,$_POST['receiveOrder']);

        $sqlUpdateOrderStat = "UPDATE `order_page` SET `statID` = '6' WHERE `orderID` = '$orderId'";
        if (!mysqli_query($link, $sqlUpdateOrderStat)) {
            die('Error: ' . mysqli_error($link));
        } 

        header("location: ../orderdisplay.php?type=6");
    } 