<?php
include '../../php/config.php';
if (isset($_REQUEST['save'])) {
    $ano = $_REQUEST['ano'];
    $mema = $_REQUEST['stts'];
    $sql = "SELECT * FROM prodstatus WHERE statusName = '$mema'";

    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $statID = trim($row['statID']);
            }
            mysqli_free_result($result);
        } else {
            echo "<p class='lead'><em>No records were found.</em></p>";
        }
    }

    $sql2 = "UPDATE order_page SET statID='$statID' WHERE orderID= '$ano'";

    if (mysqli_query($link, $sql2)) {
        header("location: ../orders.php");
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
} else {
    header("location: ../../error.php");
}
