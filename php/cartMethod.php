<?php
    include 'config.php';
    session_start();
    if(isset($_POST['deleteCart'])) {
        $sql = "DELETE FROM `cart` WHERE `cartID` = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = mysqli_real_escape_string($link,trim($_POST['deleteCart']));
            if (mysqli_stmt_execute($stmt)) {
                header("location: ../cart.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    } 
    
    if(isset($_POST['buyCart'])) {
        $customerID = $_SESSION["customerID"];
        $quant = mysqli_real_escape_string($link,$_POST['quant']);
        $price = mysqli_real_escape_string($link,$_POST['total']);
        $productID = mysqli_real_escape_string($link,$_POST['productID']);
        $cartID = mysqli_real_escape_string($link,$_POST['buyCart']);
        $voucher_stat = 0;
        
        //start update voucher value if user added a voucher
        if (isset($_POST['vouch'])) {
            $vouchervalue = mysqli_real_escape_string($link,$_POST['vouch']);
            if ($vouchervalue > 0) {
                $voucher_stat = 1;
                $sqlUpdateVoucher = "UPDATE `product` SET `voucher` = `voucher` - 1 WHERE `productID` = '$productID'";
                if (!mysqli_query($link, $sqlUpdateVoucher)) {
                die('Error: ' . mysqli_error($link));
                } 
            }
        }
        //end update voucher value if user added a voucher

        //quantity value checker
        if ($quant > 0) {

        //start update product quantity value
        $sqlUpdateQuantity = "UPDATE product SET `availableQuantity` = `availableQuantity` - $quant WHERE `productID` = '$productID'";
        if (!mysqli_query($link, $sqlUpdateQuantity)) {
            die('Error: ' . mysqli_error($link));
        } 
        //end update product quantity value

        $totalAmount = number_format($price, 2, '.', '');
        
        //start insert user order to database
        $ins = "INSERT INTO order_page (`customerId`, `productID`, `quantity`, `totalPrice`, `statID`, `voucher_stat`) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $ins)) {
            mysqli_stmt_bind_param($stmt, "iiidii", $param_custId, $param_prodId, $param_quantity, $param_total, $param_stat, $param_vouchstat);

            $param_custId = $customerID;
            $param_prodId = $productID;
            $param_quantity = $quant;
            $param_total = $totalAmount;
            $param_stat = 2;
            $param_vouchstat = $voucher_stat;

            if (mysqli_stmt_execute($stmt)) {
                
                $sqlUpdateQuantity = "DELETE FROM `cart` WHERE `cartID` = '$cartID'";
                if (!mysqli_query($link, $sqlUpdateQuantity)) {
                    die('Error: ' . mysqli_error($link));
                } 
                header("location: ../orderdisplay.php");
                exit();
            } else {
                header("location: ../orderpage.php?id=$id");
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        header("location: ../orderpage.php?id=$id");
        //end insert user order to database

        } else {
        echo "<script> alert('Input Quantity'); </script>";
        header("location: ../orderpage.php?id=$id");
        }
    } 
