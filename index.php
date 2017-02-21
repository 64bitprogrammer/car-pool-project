<?php
// each page will need following variables defined
$pageTitle = "Home Page";
$current_page = "home";
?>

<?php require_once('includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
<?php require_once('includes/navbar.php'); ?>
</div>

<div class="container-fluid">

  <div class="row">

    <div class="col-sm-2 my-rows"></div>

    <div class="col-sm-8 my-rows">
      <div class="mycontainer">
        <?php require_once('includes/slider.php'); ?>
      </div>
      <hr>
      <br>
      <div class="row">
          <div class="col-sm-4 show-panel">
            <h3 align="center" class="spl-header"> Easy To Use </h3>
            <p><img src="images/1.png" width="270" height="300" align="center"></p>
          </div>
          <div class="col-sm-4 show-panel">
            <h3 align="center" class="spl-header"> Save Fuel </h3>
            <p><img src="images/1.png" width="270" height="300" align="center"></p>
          </div>
          <div class="col-sm-4 show-panel">
            <h3 align="center" class="spl-header"> Go Green </h3>
            <p><img src="images/1.png" width="270" height="300" align="center"></p>
          </div>
      </div>
    </div>

    <div class="col-sm-2 my-rows"></div>
  </div> <!-- end of row -->

</div> <!-- end of container -->
<br><br><br>

<?php require_once('includes/footer.php'); ?>