<!-- <form action="php/savecategory.php" method="post" enctype="multipart/form-data">
    <center>
        <h4><i class="icon-plus-sign icon-large"></i> Add Category</h4>
    </center>
    <hr>
    <div id="ac">
        <span>Category Name : </span><input type="text" style="width:230px; height:30px;" name="code" Required><br>
        <span>Picture : </span><input type="file" name="picture" id="picture" style="margin-top:1%;" required><br><br>
        <hr>
        <div style="text-align:center">
            <button class="btn btn-success btn-block btn-large" style="width:267px;" name="save">Save</button>
        </div>
    </div>
</form> -->

<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="php/savecategory.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label>Category Name: </label>
            <input type="text" class="form-control" name="code" Required>
          </div>
          <div class="mb-3">
            <label>Image: </label>
            <input type="file" class="form-control" name="picture" id="picture" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-success btn-block btn-large" name="save">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>