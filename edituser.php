<?php
session_start();
include 'php/config.php';
$ID = $_SESSION["customerID"];
if ($ID > 0) {
    $sql2 = mysqli_query($link, "SELECT * FROM customer where customerID='$ID'");
    $row2  = mysqli_fetch_array($sql2);
} else {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e2c6ab676d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="  https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>AniShop</title>
    <link rel="icon" type="jpg/png" href="images/logo.png">
    <style>
        body {
            margin: auto;
            text-decoration: none;
            background: linear-gradient(rgba(24, 255, 355, .6), rgba(136, 14, 79, .9));
            background-attachment: fixed;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="background:white; display:flex; flex-wrap:wrap;">
        <div style="flex: 25%; max-width: 100%; margin-left:10%;">
            <a href="usershome.php" style="color: black"><img src="images/logo.png" style="height:80px; width:80px; float:left;"><br>
                <h4 style="float:left;"><b>AniShop</b></h4>
            </a>
            <h2 style="margin-left:40%;"><b>Profile</b></h2>
        </div>
    </div>
    <div class="container text-black card border" id="opacity" style="max-width: 700px; margin-top:5%;"><br>
        <div class="head" style="height: 100px" align="center">
            <h1><b>Account Details</b></h1>
        </div>
        <form action="edituserdetails.php" method="post" enctype="multipart/form-data">
            <div class="row container">
                <div class="form-group col"><b>Name</b><input class="form-control input-normal" type="text" name="name" value="<?php echo $_SESSION["name"] ?>" style="max-width:100%;" readonly>
                </div>
            </div>
            <div class="row container">
                <div class="form-group col  "><b>Address</b><input class="form-control input-normal" type="text" name="address" value="<?php echo $_SESSION["address"] ?>" style="width: 455px" readonly></div>
                <div class="form-group col  "><b>Zip Code</b><input class="form-control input-normal" type="text" name="zipcode" value="<?php echo $_SESSION["postalCode"] ?>" style="width: 120px" readonly> </div>
            </div>
            <div class="row container ">
                <div class="form-group col  "><b>Username</b><input class="form-control input-normal" type="text" name="username" value="<?php echo $_SESSION["username"] ?>" readonly></div>
                <div class="form-group col  "><b>Password</b><input class="form-control input-normal" type="password" name="password" value="<?php echo $_SESSION["password"] ?>" readonly></div>
                <div class="form-group col  " style="margin-top: 22px;"><button type="button" class="bg-info border text-white" data-toggle="modal" data-target="#myModal" style="  width: 150px; padding:8px; border-radius:5px; text-decoration: none;">Change Password</button></div>
            </div>
            <div class="row container">
                <div class="form-group col  "><b>Cellphone Number</b><input class="form-control input-normal" type="text" name="number" value="<?php echo $_SESSION["phone"] ?>" readonly></div>
                <div class="form-group col  "><b>Email Address</b><input class="form-control input-normal" type="email" name="email" value="<?php echo $_SESSION["email"] ?>" readonly></div>
            </div>
            <div class="row p-3" align="center">
                <div class="col border border-white"><input class="bg-info border text-white" type="submit" name="save" value="Edit Profile" style="width: 200px; padding:10px; border-radius:5px;">
                    <br>
                </div>
            </div>
        </form>

    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-light">
                    <h4 class="modal-title">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body bg-light text-dark">
                    <form action="updatemyaccount.php" method="post">
                        <div class="form-group">
                            <label for="">Current Password</label><input type="password" class="form-control" name="currentPass" required>
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label><input id="newPass1" type="password" class="form-control" name="newPass3" required>
                        </div>
                        <div class="form-group">
                            <label for="">Re-Enter New Password</label><input id="newPass2" type="password" class="form-control" name="newPass4" required>
                        </div>
                </div>
                <div class="modal-footer bg-light text-dark">
                    <button id="updatePass" class="btn btn-info " type="submit" name="updatePassword">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    const updatePass = document.querySelector('#updatePass')

    updatePass.addEventListener('click', (e) => {
        const newPass1 = document.querySelector('#newPass1').value
        const newPass2 = document.querySelector('#newPass2').value

        if (newPass1 !== newPass2) {
            alert("Password Not Match!")
            e.preventDefault()
        }
    })
</script>