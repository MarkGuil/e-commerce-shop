<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="php/updatecategory.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="" name="ano" id="editID" required />
                    <div class="alert alert-warning" role="alert">
                        If you don't want to change the image, please leave the picture empty.
                    </div>
                    <div class="mb-3">
                        <label>Category Name: </label>
                        <input type="text" class="form-control" name="code" id="editCode" Required>
                    </div>
                    <div class="mb-3">
                        <label>Image: </label>
                        <input type="file" class="editPicture form-control" name="picture" id="picture">
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