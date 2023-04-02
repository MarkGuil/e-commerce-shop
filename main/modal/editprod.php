<?php
include('../../php/config.php');
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = mysqli_query($link, "SELECT * FROM product WHERE productID = '$id'");
  while ($row = mysqli_fetch_assoc($sql)) {
    $prodID = $row['productID'];
    $prodName = $row['productName'];
    $prodDesc = $row['productDescription'];
    $price = $row['price'];
    $voucher = $row['voucher'];
    $voucherval = $row['vouchervalue'];

?>
    <form action="php/updateproduct.php" name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
      <center>
        <h4><i class="icon-plus-sign icon-large"></i> Edit Product</h4>
      </center>
      <hr>
      <div id="ac">
        <input type="hidden" value="<?php echo $id; ?>" name="ano" />
        <span>Product Name : </span><input type="text" style="width:230px; height:30px;" name="code" value="<?php echo $prodName; ?>" Required><br>
        <span>Category : </span>
        <?php
        $name = mysqli_query($link, "select * from category");
        echo '<select  name="cat"  style="width:230px; height:30px; margin-left:9%; margin-top:1%;">';
        while ($res = mysqli_fetch_assoc($name)) {
          echo '<option value="' . $res['category_id'] . '" ' . ($row['category_id'] == $res['category_id'] ? "selected" : '') . '>';
          echo $res['category_name'];
          echo '</option>';
        }
        echo '</select>';
        ?>
        <hr>
        <span>Product Description : </span><textarea style="width:285px; height:60px; margin-left:13%;" name="name"><?php echo $prodDesc; ?></textarea><br>
        <span>Set as Featured : </span>
        <input type="radio" value="feautured" id="yes" name="status" /> <label for="yes">Yes</label>
        <input type="radio" value="" id="no" name="status" /> <label for="no">No</label><br>
        <hr>
        <span>Voucher: </span><br>
        <input type="number" value="<?php echo $voucher; ?>" name="voucher" placeholder="set number of vouchers" required>
        <input type="number" value="<?php echo $voucherval; ?>" name="voucherval" placeholder="Voucher Value" required>
        <hr>
        <span>Price : </span><input type="number" step="0.01" style="width:230px; height:30px; margin-left:1%;" name="price" value="<?php echo $price; ?>" Required><br>
        <span>Picture : </span><input type="file" name="picture" id="picture" style="margin-top:1%;" required><br><br>
        <div style="float:right; margin-right:10px;">
          <button class="btn btn-success btn-block btn-large" style="width:267px;" name="save">Save</button>
        </div>
      </div>
    </form>


<?php }
}
?>
<script>
  function validateForm() {
    var x = document.forms["myForm"]["voucher"].value;
    var y = document.forms["myForm"]["voucherval"].value;
    if (x > 0 && y == 0) {
      alert("Sorry, your voucher details is incomplete");
      return false;
    } else if (y > 0 && x == 0) {
      alert("Sorry, your voucher details is incomplete");
      return false;
    } else if (y > 0 && x > 0) {
      return true;
    } else {
      return true;
    }
  }
</script>