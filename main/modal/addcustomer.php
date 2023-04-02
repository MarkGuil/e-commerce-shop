<form action="php/savecustomer.php" method="post" enctype="multipart/form-data">
    <center>
        <h4><i class="icon-plus-sign icon-large"></i> Add Customer</h4>
    </center>
    <hr>
    <div id="ac">
        <span>Customer Name : </span><input type="text" style="width:230px; height:30px;" name="code" Required><br>
        <span>Username : </span><input type="text" style="width:230px; height:30px; margin-left:10.8%; margin-top:1%;" name="username" Required><br>
        <span>Phone Number : </span><input type="text" style="width:230px; height:30px; margin-left:2%; margin-top:1%;" placeholder="(e.g. 09XX-XXX-XXXX)" maxlength="11" pattern="^(09|\+639)\d{9}$" name="number" Required><br>
        <span>Email : </span><input type="email" placeholder="(e.g. websystech21@gmail.com)" style="width:230px; height:30px; margin-left:18%; margin-top:1%;" name="email" Required><br>
        <span>Password : </span><input type="password" minlength="8" style="width:230px; height:30px; margin-left:11.5%; margin-top:1%;" name="password" Required><br>
        <span>Address : </span><input type="text" style="width:230px; height:30px; margin-left:14%; margin-top:1%;" name="address" Required><br>
        <span>Postal Code : </span><input type="number" style="width:230px; height:30px; margin-left:7%; margin-top:1%;" name="postal" Required><br>
        <hr>
        <div style="text-align:center">
            <button class="btn btn-success btn-block btn-large" style="width:267px;" name="save">Save</button>
        </div>
    </div>
</form>