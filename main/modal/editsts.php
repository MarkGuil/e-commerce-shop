<?php
include('../../php/config.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = mysqli_query($link, "SELECT * FROM prodstatus WHERE statID = '$id'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $statName = $row['statusName'];
?>
        <form action="php/statup.php" method="post" enctype="multipart/form-data">
            <center>
                <h4><i class="icon-plus-sign icon-large"></i> Edit Status</h4>
            </center>
            <hr>
            <div id="ac">
                <input type="hidden" value="<?php echo $id; ?>" name="ano" />
                <span>Status Name : </span><input type="text" style="width:230px; height:30px;" name="code" value="<?php echo $statName; ?>" Required><br><br>
                <div style="text-align:center;">
                    <button class="btn btn-success btn-block btn-large" style="width:267px;" name="save">Save</button>
                </div>
            </div>
        </form>
<?php }
}
?>