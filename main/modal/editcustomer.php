<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="php/updatecustomer.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <input type="hidden" value="" name="ano" id="customerID" />
          <div class="mb-3">
            <label>Customer Name: </label>
            <input type="text" class="form-control" name="code" id="customername" Required>
          </div>
          <div class="mb-3">
            <label>Username: </label>
            <input type="text" class="form-control" name="username" id="username" Required>
          </div>
          <div class="mb-3">
            <label>Phone Number: </label>
            <input type="text" class="form-control" maxlength="11" pattern="^(09|\+639)\d{9}$" name="number" id="number" Required>
          </div>
          <div class="mb-3">
            <label>Email: </label>
            <input type="email" class="form-control" name="email" id="email" Required>
          </div>
          <div class="mb-3">
            <label>Password: </label>
            <input type="password" class="form-control" minlength="3" name="password" id="password" Required>
          </div>
          <div class="mb-3">
            <label>Address: </label>
            <input type="text" class="form-control" name="address" id="address" Required>
          </div>
          <div class="mb-3">
            <label>Postal Code: </label>
            <input type="text" class="form-control" name="postal" id="postal" maxlength="4" pattern="\d{4}" Required>
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