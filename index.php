<?php
// each page will need following variables defined
$pageTitle = "Home Page";
$current_page = "home";
?>
<?php require_once('includes/header.php'); ?>
<div class="container-fluid">

  <div class="row">

    <div class="col-sm-2 my-rows"></div>

    <div class="col-sm-8 my-rows">
      <div class="mycontainer">
        <?php require_once('includes/slider.php'); ?>
      </div>
      <hr>
      <br>
      <?php require_once('includes/features.php'); ?>
      <hr>
      <br>
      <h3 align="center" id="faq"> Frequently Asked Questions </h3><br>
      <?php require_once('includes/faq.php'); ?>
      <hr>
      <br>
      <?php require_once('includes/contacts.php'); ?>
      <hr>
      <br>
      <?php require_once('includes/about.php'); ?>
    </div> <!-- end of center column -->

    <div class="col-sm-2 my-rows"></div>
  </div> <!-- end of row -->

</div> <!-- end of container -->
<br><br><br>

<?php require_once('includes/footer.php'); ?>