<?php
$totalCART = 0;
if (isset($_SESSION["customerID"])) {
  $sqlCART  = "SELECT `cartID` FROM `cart` WHERE `customerID` = " . $_SESSION["customerID"];
  $resultCART  = mysqli_query($link, $sqlCART);
  $totalCART  = mysqli_num_rows($resultCART);
}
?>
<nav class="navbar bg-body-tertiary pt-1 pb-2 ">
  <div class="container justify-content-end ">
    <div id="menu-right p-0">
      <li class="m-0"><?= $pas; ?> | <?= $log; ?> </li>
    </div>
  </div>
  <div class="container pt-2">
    <a class="navbar-brand text-decoration-none" href="#">
      <h3 class="fw-bold text-secondary m-0">
        <img src="images/logo.png" alt="Bootstrap" width="60" height="60">
        Anishop
      </h3>
    </a>
    <div class="flex-fill ">
      <form method="post" action="php/productResult.php" class="d-flex justify-content-center align-items-center">
        <?php include 'search-form.php'; ?>
        <button type="submit" name="anoNa" class="btn btn-info pb-0 srch h-100">
          <i class='bx bx-search fs-4'></i>
        </button>
      </form>
    </div>
    <a href="<?php echo isset($_SESSION["customerID"]) ? "cart.php" : "login.php" ?>" class="text-muted text-decoration-none  position-relative">
      <i class='bx bxs-cart fs-1'></i>
      <?php if ($totalCART > 0) : ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-light fs-6">
          <small>
            <?= $totalCART  ?>
          </small>
        </span>
      <?php endif ?>
    </a>
  </div>
</nav>