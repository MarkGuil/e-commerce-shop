<div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="php/updatestatus.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="" name="ano" id="editOrderID" readonly />
                    <div class="mb-3">
                        <label for="Status-name" class="col-form-label">Status:</label>
                        <?php 
                            $name = mysqli_query($link, "SELECT * FROM `prodstatus`"); 
                        ?>
                        <select  name="stat" id="edit_status_name" class="form-select">
                        <?php
                            while ($res = mysqli_fetch_assoc($name)) {
                            echo '<option value="' . $res['statID'] . '">';
                            echo $res['statusName'];
                            echo '</option>';
                            }
                            echo '</select>';
                        ?>
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