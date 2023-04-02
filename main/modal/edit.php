<?php
include '../../php/config.php';
$id = $_GET['id'];
$sql = "SELECT * FROM order_page WHERE orderID = '$id'";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $statId = $row['statID'];
            $sql4 = "SELECT * FROM prodstatus WHERE statID = '$statId'";
?>
            <form action="php/updatestatus.php" method="post">
                <center>
                    <h4> Edit Product </h4>
                </center>
                <hr>
                <input type="hidden" value="<?php echo $id; ?>" name="ano" />
                <div style="text-align:center;">
                    <span>Product Status : </span>
                    <br>
                    <select name="stts" style="width:265px; height:30px;">
                        <?php
                        $sql1 = "SELECT * FROM prodstatus";
                        if ($result3 = mysqli_query($link, $sql1)) {
                            if (mysqli_num_rows($result3) > 0) {
                                while ($row = mysqli_fetch_array($result3)) {
                                    $statName = $row['statusName'];
                        ?>
                                    <option><?php echo $statName; ?></option>
                        <?php
                                }
                                mysqli_free_result($result3);
                            } else {
                                echo "<p class='lead'><em>No records were found.</em></p>";
                            }
                        }
                        ?>
                    </select>
        <?php
        }
        mysqli_free_result($result);
    } else {
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
}
        ?>
        <br><br>
        <button name="save" class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
            </form>
            </div>
            </form>