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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="  https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>AniShop</title>
    <link rel="icon" type="jpg/png" href="images/logo.png">
    <style>
        body {
            margin: auto;
            text-decoration: none;
            background: linear-gradient(rgba(24, 255, 355, .6), rgba(136, 14, 79, .9));
            background-attachment: fixed;
            font-family: Arial, Helvetica, sans-serif;
        }

        .form-group>small>b,
        .form-group>label {
            color: rgb(109, 108, 108);
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="background:white; display:flex; flex-wrap:wrap;">
        <div style="flex: 25%; max-width: 100%; margin-left:10%;">
            <a href="usershome.php">
                <img src="images/logo.png" style="height:80px; width:80px; float:left;"><br>
                <h4 class=" text-secondary-emphasis m-0" style="float:left;"><b>AniShop</b></h4>
            </a>
            <h2 class=" text-secondary-emphasis" style="margin-left:40%;"><b>Profile</b></h2>
        </div>
    </div>
    <div class="container text-black card border" id="opacity" style="max-width: 700px; margin-top:5%;"><br>
        <div class="head py-3" align="center">
            <h4><b>Account Details</b></h4>
        </div>
        <?php if (isset($_SESSION['status'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show mx-2" role="alert">
                <?= $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form action="edituserdetails.php" method="post" enctype="multipart/form-data">
            <div class="row container">
                <div class="form-group col">
                    <small><b>Name</b></small>
                    <input class="form-control input-normal" type="text" name="name" value="<?php echo $_SESSION["name"] ?>" style="max-width:100%;" readonly>
                </div>
            </div>
            <div class="row container mt-3">
                <div class="form-group col  ">
                    <small><b>Address</b></small>
                    <input class="form-control input-normal" type="text" name="address" value="<?php echo $_SESSION["address"] ?>" style="width: 455px" readonly>
                </div>
                <div class="form-group col  ">
                    <small><b>Zip Code</b></small>
                    <input class="form-control input-normal" type="text" name="zipcode" value="<?php echo $_SESSION["postalCode"] ?>" style="width: 120px" readonly>
                </div>
            </div>
            <div class="row container mt-3">
                <div class="form-group col  ">
                    <small><b>Username</b></small>
                    <input class="form-control input-normal" type="text" name="username" value="<?php echo $_SESSION["username"] ?>" readonly>
                </div>
                <div class="form-group col  ">
                    <small><b>Password</b></small>
                    <input class="form-control input-normal" type="password" name="password" value="<?php echo $_SESSION["password"] ?>" readonly>
                </div>
                <div class="form-group col  " style="margin-top: 22px;">
                    <button type="button" class="bg-info border text-white" data-bs-toggle="modal" data-bs-target="#myModal" style="  width: 150px; padding:8px; border-radius:5px; text-decoration: none;">Change Password</button>
                </div>
            </div>
            <div class="row container mt-3">
                <div class="form-group col  ">
                    <small><b>Phone Number</b></small>
                    <input class="form-control input-normal" type="text" name="number" value="<?php echo $_SESSION["phone"] ?>" readonly>
                </div>
                <div class="form-group col  ">
                    <small><b>Email Address</b></small>
                    <input class="form-control input-normal" type="email" name="email" value="<?php echo $_SESSION["email"] ?>" readonly>
                </div>
            </div>
            <div class="row p-3" align="center">
                <div class="col border border-white">
                    <input class="bg-info border text-white" type="submit" name="save" value="Edit Profile" style="width: 200px; padding:10px; border-radius:5px;">
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
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <form action="php/updatemyaccount.php" method="post">
                    <div class="modal-body bg-light text-dark">
                        <div class="form-group">
                            <label for="">Current Password</label>
                            <input type="password" class="form-control" name="currentPass" required>
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input id="newPass1" type="password" class="form-control" name="newPass3" required>
                        </div>
                        <div class="form-group">
                            <label for="">Re-Enter New Password</label>
                            <input id="newPass2" type="password" class="form-control" name="newPass4" required>
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