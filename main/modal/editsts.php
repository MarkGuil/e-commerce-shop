<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="php/statup.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="" name="ano" id="editStatID" readonly />
                    <div class="mb-3">
                        <label>Status Name: </label>
                        <input type="text" class="form-control" name="code" id="editStat" Required>
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