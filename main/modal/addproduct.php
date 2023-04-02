<form action="php/saveproduct.php" name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
  <center>
    <h4><i class="icon-plus-sign icon-large"></i> Add Product</h4>
  </center>
  <hr>
  <div id="ac">
    <span>Product Name : </span><input type="text" style="width:230px; height:30px;" name="code" Required><br>
    <span>Category : </span>
    <?php
    include('../config.php');
    $name = mysqli_query($link, "select * from category");
    echo '<select  name="cat"  style="width:230px; height:30px; margin-left:9%; margin-top:1%;">';
    while ($res = mysqli_fetch_assoc($name)) {
      echo '<option value="' . $res['category_id'] . '">';
      echo $res['category_name'];
      echo '</option>';
    }
    echo '</select>';
    ?>
    <hr>
    <span>Product Description : </span><textarea style="width:285px; height:60px; margin-left:13%;" name="name"> </textarea><br>
    <span>Set as Featured : </span>
    <input type="radio" value="feautured" id="yes" name="status" /> <label for="yes">Yes</label>
    <input type="radio" value="" id="no" name="status" /> <label for="no">No</label><br>
    <hr>
    <span>Add Voucher: </span><br>
    <input type="number" value="" name="voucher" placeholder="set number of vouchers" required>
    <input type="number" value="" name="voucherval" placeholder="Voucher Value" required>
    <hr>
    <span>Price : </span><input type="number" step="0.01" style="width:230px; height:30px; margin-left:1%;" name="price" Required><br>
    <span>Picture : </span><input type="file" name="picture" id="picture" style="margin-top:1%;" required><br><br>
    <div style="float:right; margin-right:10px;">
      <!-- <button class="btn btn-success btn-block btn-large" style="width:267px;" name = "save">Save</button> -->
      <input type="submit" class="btn btn-success btn-block btn-large" style="width:267px;" value="submit" name="save">
    </div>
  </div>
</form>
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