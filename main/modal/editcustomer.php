<?php
include('../../php/config.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = mysqli_query($link, "SELECT * FROM customer WHERE customerID = '$id'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $cusName = $row['name'];
?>
        <form action="php/updatecustomer.php" method="post" enctype="multipart/form-data">
            <center>
                <h4><i class="icon-plus-sign icon-large"></i> Edit Customer Details</h4>
            </center>
            <hr>
            <div id="ac">
                <input type="hidden" value="<?php echo $id; ?>" name="ano" />
                <span>Customer Name : </span><input type="text" value="<?php echo $cusName; ?>" style="width:230px; height:30px;" name="code" Required><br>
                <span>Username : </span><input type="text" value="<?php echo $row['username']; ?>" style="width:230px; height:30px; margin-left:10.8%; margin-top:1%;" name="username" Required><br>
                <span>Phone Number : </span><input type="text" value="<?php echo $row['phone']; ?>" style="width:230px; height:30px; margin-left:2%; margin-top:1%;" placeholder="(e.g. 09XX-XXX-XXXX)" maxlength="11" pattern="^(09|\+639)\d{9}$" name="number" Required><br>
                <span>Email : </span><input type="email" value="<?php echo $row['email']; ?>" placeholder="(e.g. websystech21@gmail.com)" style="width:230px; height:30px; margin-left:18%; margin-top:1%;" name="email" Required><br>
                <span>Password : </span><input type="password" value="<?php echo $row['password']; ?>" minlength="8" style="width:230px; height:30px; margin-left:11.5%; margin-top:1%;" name="password" Required><br>
                <span>Address : </span><input type="text" value="<?php echo $row['address']; ?>" style="width:230px; height:30px; margin-left:14%; margin-top:1%;" name="address" Required><br>
                <span>Postal Code : </span><input type="number" value="<?php echo $row['postalCode']; ?>" style="width:230px; height:30px; margin-left:7%; margin-top:1%;" name="postal" Required><br>
                <hr>
                <div style="text-align:center">
                    <button class="btn btn-success btn-block btn-large" style="width:267px;" name="save">Save</button>
                </div>
            </div>
        </form>
<?php }
} ?>