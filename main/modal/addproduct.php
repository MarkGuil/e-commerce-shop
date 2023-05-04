<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="php/saveproduct.php" name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label>Product Image: </label>
            <input type="file" class="form-control" name="picture" id="picture" required>
          </div>
          <div class="mb-3">
            <label for="Product-name" class="col-form-label">Product Name:</label>
            <input type="text" class="form-control" name="code" id="Product-name" Required>
            <label for="Category-name" class="col-form-label">Category:</label>
            <?php
            $name = mysqli_query($link, "select * from category");
            echo '<select  name="cat" id="Category-name" class="form-select" >';
            while ($res = mysqli_fetch_assoc($name)) {
              echo '<option value="' . $res['category_id'] . '">';
              echo $res['category_name'];
              echo '</option>';
            }
            echo '</select>';
            ?>
            <hr>
          </div>
          <div class="mb-3">
            <label>Product Description : </label>
            <textarea class="form-control" name="name"> </textarea>
          </div>
          <div class="mb-3">
            <label>Set as Featured : </label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="featured" name="status" id="yes">
              <label class="form-check-label" for="yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" value="" name="status" id="no" checked>
              <label class="form-check-label" for="no">No</label>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label>Product quantity: </label>
                <input class="form-control" type="number" min="0" name="quantity" Required>
              </div>
              <div class="col-sm-12 col-md-6">
                <label>Product price: </label>
                <input class="form-control" type="number" min="0" step="0.01" name="price" Required>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label>Add Voucher: </label>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <small class="text-muted">amount of voucher</small>
                <input class="form-control" type="number" value="" min="0" name="voucher" placeholder="" required>
              </div>
              <div class="col-sm-12 col-md-6">
                <small class="text-muted">voucher value</small>
                <input class="form-control" type="number" value="" min="0" name="voucherval" placeholder="" required>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" value="submit" name="save" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

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