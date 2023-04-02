<?php
include '../php/config.php';
include '../php/adminprocess.php';
if (isset($_SESSION["userID"])) {
  $ID = $_SESSION["userID"];
  if ($ID > 0) {
    $name = $_SESSION["name"];
  }
} else {
  unset($_SESSION["userID"]);
  unset($_SESSION["name"]);
  unset($_SESSION["username"]);
  unset($_SERVER["password"]);
  header("Location: ../adminlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <title>AniShop | Admin</title>
  <link rel="icon" type="jpg/png" href="../images/logo.png">
  <style>
    .sidenav {
      height: 100%;
      width: 200px;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      background-color: rgb(29, 194, 216);
      overflow-x: hidden;
      padding-top: 20px;
      box-shadow: 2px 0px #888888;
    }

    .sidenav a {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      font-size: 16px;
      color: white;
      display: block;
    }

    .sidenav a:hover {
      color: black;
      background: white;
    }

    .active {
      background-color: rgb(22, 156, 173);
    }

    .main {
      margin-left: 230px;
      /* Same as the width of the sidenav */
      padding: 0px 10px;
      margin-top: 10px;
    }

    #example2 {
      padding: 5px 15px;
      margin-bottom: 20px;
      box-shadow: 0px 10px 40px rgb(29, 194, 216) inset;
      border-radius: 5px;
      display: flex;
      flex-wrap: wrap;
    }

    #btns {
      margin: 3% 13% 0% 13%;
      display: flex;
      flex-wrap: wrap;
      text-align: center;
      padding: 20px;
      font-size: 25px;
    }

    a {
      text-decoration: none;
      color: black;
    }

    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }

      .sidenav a {
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <!--begin top -->
  <div class="container-fluid bg-primary text-white" style="padding:8px; padding-left:200px;">
    <span class="navbar-brand mb-0 h1" style="margin-left:20px;">Point of Sales</span>
    <span style="margin-left:39%; margin-right:10px;"><img src="../images/admin.png" style="height:25px; width:25px;">&nbsp;&nbsp;Welcome: <b><?php echo $name; ?></b></span>
    <img src="../images/calendar.png" style="height:25px; width:25px;">&nbsp;&nbsp;<?php echo date("l jS \, F Y"); ?>
    <a href="php/logout.php"><span style="margin-right:30px; margin-left:10px;"><img src="../images/logout.png" style="height:25px; width:25px;">&nbsp;&nbsp;<b>Log Out</b></span></a>
  </div>
  <!--end top -->
  <!--begin sidebar -->
  <div class="sidenav"><br>
    <a href="index.php" class="active"><img src="../images/admin.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Dashboard</b></a>
    <a href="orders.php"><img src="../images/order.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Orders</b></a>
    <a href="products.php"><img src="../images/prod.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Products</b></a>
    <a href="statprod.php"><img src="../images/order.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Product Status</b></a>
    <a href="categories.php"><img src="../images/cat.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Categories</b></a>
    <a href="customers.php"><img src="../images/cu.jpg" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Customers</b></a>
  </div>
  <!--end sidebar -->

  <div class="main">
    <div id="example2">
      <img src="../images/das.png" style="height:35px; width:35px;">&nbsp;&nbsp;<h3><b>Dashboard</b></h3>
    </div>
    <h1 style="margin-top:2%; text-align: center; font-family: times-new-roman;"><b>AniShop</b></h1>
    <div id="btns">
      <a href="orders.php" style="cursor: pointer; flex: 30%; text-align:center; margin-top:10px; background:white; border: 1px solid #1b9397; border-radius:5px; box-shadow: 1px 5px 0px #888888; padding-top:10px;">
        <img src="../images/order.png" style="height:40px; width:40px;">
        <p>Orders</p>
      </a>&nbsp;&nbsp;
      <a href="products.php" style="cursor: pointer; flex: 30%; text-align:center; margin-top:10px; background:white; border: 1px solid #1b9397; border-radius:5px; box-shadow: 1px 5px 0px #888888; padding-top:10px;">
        <img src="../images/prod.png" style="height:40px; width:40px;">
        <p>Products</p>
      </a>&nbsp;&nbsp;
      <a href="categories.php" style="cursor: pointer; flex: 30%; text-align:center; margin-top:10px; background:white; border: 1px solid #1b9397; border-radius:5px; box-shadow: 1px 5px 0px #888888; padding-top:10px;">
        <img src="../images/cat.png" style="height:40px; width:40px;">
        <p>Categories</p>
      </a>
      <a href="customers.php" style="cursor: pointer; flex: 30%; text-align:center; margin-top:15px; background:white; border: 1px solid #1b9397; border-radius:5px; box-shadow: 1px 5px 0px #888888; padding-top:10px;">
        <img src="../images/cu.jpg" style="height:40px; width:40px;">
        <p>Customers</p>
      </a>&nbsp;&nbsp;
      <a href="statprod.php" style="cursor: pointer; flex: 30%; text-align:center; margin-top:15px; background:white; border: 1px solid #1b9397; border-radius:5px; box-shadow: 1px 5px 0px #888888; padding-top:10px;">
        <img src="../images/order.png" style="height:40px; width:40px;">
        <p>Product Status</p>
      </a>&nbsp;&nbsp;
      <a href="php/logout.php" style="cursor: pointer; flex: 30%; text-align:center; margin-top:15px; background:white; border: 1px solid #1b9397; border-radius:5px; box-shadow: 1px 5px 0px #888888; padding-top:10px;">
        <img src="../images/logout.png" style="height:40px; width:40px;">
        <p>Logout</p>
      </a>
    </div>
  </div>
</body>

</html>