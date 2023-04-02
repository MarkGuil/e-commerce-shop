<?php
include('../../php/config.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = mysqli_query($link, "SELECT * FROM category WHERE category_id = '$id'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $catName = $row['category_name'];
?>
        <form action="php/updatecategory.php" method="post" enctype="multipart/form-data">
            <center>
                <h4><i class="icon-plus-sign icon-large"></i> Edit Category</h4>
            </center>
            <hr>
            <div id="ac">
                <input type="hidden" value="<?php echo $id; ?>" name="ano" />
                <span>Category Name : </span><input type="text" style="width:230px; height:30px;" name="code" value="<?php echo $catName; ?>" Required><br>
                <hr>
                <span>Picture : </span><input type="file" name="picture" id="picture" style="margin-top:1%;" required><br><br>
                <div style="float:right; margin-right:10px;">
                    <button class="btn btn-success btn-block btn-large" style="width:267px;" name="save">Save</button>
                </div>
            </div>
        </form>

<?php }
}
?>