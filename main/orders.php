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
  <script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
  <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
  <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="lib/jquery.js" type="text/javascript"></script>
  <script src="src/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage: 'src/loading.gif',
        closeImage: 'src/closelabel.png'
      })
    })
  </script>

  <style>
    .sidenav {
      height: 100%;
      width: 200px;
      top: 0;
      position: fixed;
      z-index: 1;
      left: 0;
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
      margin-left: 250px;
      /* Same as the width of the sidenav */
      padding: 0px 10px;
      margin-top: 10px;
      margin-right: 50px;
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
      display: flex;
      flex-wrap: wrap;
      text-align: center;
      font-size: 15px;
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

    #resultTable {
      border-collapse: separate;
      background-color: #FFFFFF;
      border-spacing: 0;
      max-width: 100%;
    }

    #resultTable {
      color: #666666;
      text-shadow: 0 1px 0 #FFFFFF;
      width: 100%;
      border: 1px solid #999999;
      box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.3);
      margin-top: 13px;
    }

    #resultTable thead tr th {
      background: none repeat scroll 0 0 #EEEEEE;
      color: #222222;
      padding: 10px 14px;
      text-align: left;
      border-top: 0 none;
      font-size: 13px;
    }

    #resultTable tbody tr td {
      font: bold 13px 'Arial';

      text-align: left;
      padding: 10px 14px;
      border-top: 1px solid #999999;
    }

    #resultTable td {
      padding: 7px;
      border: #4e95f4 1px solid;
    }

    #resultTable tr {
      background: #fff;
    }

    #resultTable tr:hover {
      background-color: #ffff99;
    }
  </style>
</head>

<body>
  <!--begin top -->
  <div class="container-fluid bg-primary text-white" style="padding:8px; padding-left:200px;">
    <span class="navbar-brand mb-0 h1" style="margin-left:20px;">Point of Sales</span>
    <span style="margin-left:39%; margin-right:10px;">
      <img src="../images/admin.png" style="height:25px; width:25px;">&nbsp;&nbsp;Welcome: <b><?php echo $name; ?></b>
    </span>
    <img src="../images/calendar.png" style="height:25px; width:25px;">&nbsp;&nbsp;<?php echo date("l jS \, F Y"); ?>
    <a href="php/logout.php">
      <span style="margin-right:30px; margin-left:10px;">
        <img src="../images/logout.png" style="height:25px; width:25px;">&nbsp;&nbsp;<b>Log Out</b>
      </span>
    </a>
  </div>
  <!--end top -->
  <!--begin sidebar -->
  <div class="sidenav"><br>
    <a href="index.php"><img src="../images/admin.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Dashboard</b></a>
    <a href="orders.php" class="active"><img src="../images/order.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Orders</b></a>
    <a href="products.php"><img src="../images/prod.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Products</b></a>
    <a href="statprod.php"><img src="../images/order.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Product Status</b></a>
    <a href="categories.php"><img src="../images/cat.png" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Categories</b></a>
    <a href="customers.php"><img src="../images/cu.jpg" style="height:30px; width:30px;">&nbsp;&nbsp;<b>Customers</b></a>

  </div>
  <!--end sidebar -->

  <div class="main">
    <div id="example2">
      <img src="../images/das.png" style="height:35px; width:35px; ">&nbsp;&nbsp;<h3><b>Dashboard / Orders</b></h3>
    </div>
    <a href="index.php" style="cursor: pointer; padding:5px; padding-left:20px; padding-right:20px; align-text:center; border:1px solid grey; border-radius:5px;">Back</a>
    <?php
    $sql = "SELECT orderID FROM order_page ORDER BY orderID";
    if ($result = mysqli_query($link, $sql)) {
      $rowcount = mysqli_num_rows($result);
      mysqli_free_result($result);
    }
    ?>
    <div style="text-align:center; margin-top:-25px; font-size:18px;">
      Total Number of Order/s: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount; ?><a href="orders.php"> <img src="../images/refresh.png" id="refresh" style="height:20px; width:20px; margin-top:-5px;"></a></font>
    </div>
    <hr>
    <table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
      <thead style="font-size:14px;">
        <tr>
          <th width="16%"> Customer Name </th>
          <th width="15%"> Email </th>
          <th width="18%"> Address </th>
          <th width="8%"> Postal Code </th>
          <th width="18%"> Product Name </th>
          <th width="5%"> Qty </th>
          <th width="5%"> Voucher Used </th>
          <th width="8%"> Total Price </th>
          <th width="20%"> Status </th>
          <th width="8%"> Action </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql1 = "SELECT * FROM order_page";
        if ($result = mysqli_query($link, $sql1)) {
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              $orderID = $row['orderID'];
              $cusID = $row['customerID'];
              $proID = $row['productID'];
              $quantity = $row['quantity'];
              $total = $row['totalPrice'];
              $statId = $row['statID'];
              $voucherstat = $row['voucher_stat'];

              $sql2 = "SELECT * FROM customer WHERE customerID = '$cusID'";
              $sql3 = "SELECT * FROM product WHERE productID = '$proID'";
              $sql4 = "SELECT * FROM prodstatus WHERE statID = '$statId'";

              if ($result1 = mysqli_query($link, $sql2)) {
                if (mysqli_num_rows($result1) > 0) {
                  while ($row = mysqli_fetch_array($result1)) {
                    $custName = $row['name'];
                    $email = $row['email'];
                    $address = $row['address'];
                    $postal = $row['postalCode'];
                  }
                  mysqli_free_result($result1);
                } else {
                  echo "<p class='lead'><em>No records were found.</em></p>";
                }
              }

              if ($result2 = mysqli_query($link, $sql3)) {
                if (mysqli_num_rows($result2) > 0) {
                  while ($row = mysqli_fetch_array($result2)) {
                    $prodName = $row['productName'];
                  }
                  mysqli_free_result($result2);
                } else {
                  echo "<p class='lead'><em>No records were found.</em></p>";
                }
              }

              if ($result3 = mysqli_query($link, $sql4)) {
                if (mysqli_num_rows($result3) > 0) {
                  while ($row = mysqli_fetch_array($result3)) {
                    $statName = $row['statusName'];
                  }
                  mysqli_free_result($result3);
                } else {
                  echo "<p class='lead'><em>No records were found.</em></p>";
                }
              }
        ?>
              <tr class="record">
                <td><?php echo $custName; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $postal; ?></td>
                <td><?php echo $prodName; ?></td>
                <td><?php echo $quantity; ?></td>
                <td><?php echo $voucherstat; ?></td>
                <td><?php echo $total; ?></td>
                <td>
                  <a rel="facebox" title="Click to edit the status" href="modal/edit.php?id=<?php echo $orderID; ?>" style="color:blue;">
                    <?php echo $statName; ?>
                    <img src="../images/edit.png" style="height:12px; width:12px;">
                  </a>
                </td>
                <td>
                  <a href="#" id="<?php echo $orderID ?>" class="delbutton" title="Click to Delete the order"><img src="../images/delete.png" style="height30px; width:30px;"></a>
                </td>
              </tr>
        <?php
            }
            echo "</tbody>";
            echo "</table>";
            mysqli_free_result($result);
          } else {
            echo "<p class='lead'><em>No records were found.</em></p>";
          }
        }
        ?>
  </div>

  <script type="text/javascript">
    $(function() {


      $(".delbutton").click(function() {

        //Save the link in a variable called element
        var element = $(this);

        //Find the id of the link that was clicked
        var del_id = element.attr("id");

        //Built a url to send
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this order? There is NO undo!")) {

          $.ajax({
            type: "GET",
            url: "php/delete.php",
            data: info,
            success: function() {

            }
          });
          $(this).parents(".record").animate({
              backgroundColor: "#fbc7c7"
            }, "fast")
            .animate({
              opacity: "hide"
            }, "slow");

        }

        return false;

      });

    });
  </script>
</body>

</html>