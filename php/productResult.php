<?php
include 'config.php';
include 'loginProcess.php';
$re = "";
if (isset($_POST["anoNa"])) {
    $productResult = "";
    $re = mysqli_real_escape_string($link,$_REQUEST['reslt']);
    $re = substr($re, -5);
    // Prepare a select statement
    $ly = "SELECT * FROM product WHERE productDescription LIKE ?";

    if ($stmt = mysqli_prepare($link, $ly)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);

        // Set parameters
        $param_term = '%' . $re . '%';

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if (mysqli_num_rows($result) > 0) {
                // Fetch result rows as an associative array
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    
                    $productResult .= "
                    <div class='col-sm-4 col-md-2 p-1' style='height: 280px;'>
                        <div class='px-2 d-flex flex-column card text-center h-100 shadow-sm' onMouseOver='this.style.borderColor=`#1b9397`' onMouseOut='this.style.borderColor=`rgba(0,0,0,.17)`'>
                            <a href='orderpage.php?id=" . $row['productID'] . "' class='stretched-link' ></a>
                            <img src ='images/" . $row['picture'] . "' style = 'height: 150px; width:100%'>
                            <span class='overflow-hidden p-1' style = 'font-size: 14px; text-align: left; color:black; font-weight:600;text-overflow: ellipsis;'>" . $row['productName'] . "</span>
                            <div class='mt-auto'>
                                <span style = 'font-size: 14px; text-align: left; color:#565656'> Price: ₱" . $row['price'] . "</span>
                            </div>
                        </div>
                    </div>";
                }
                mysqli_free_result($result);
            } else {
                $productResult = "<p align = 'center'>No matches found</p>";
            }
        } else {
            $productResult = "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    $_SESSION['productSearched'] = $productResult;
    // Close statement
    mysqli_stmt_close($stmt);
    header("location: ../products.php");
}
