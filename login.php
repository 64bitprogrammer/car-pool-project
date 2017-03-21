<?php
// each page will need following variables defined
$pageTitle = "Login";
$current_page = "login";
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
        <div class="row">
          <div class="col-sm-3 my-rows">
          </div>

          <div class="col-sm-6 my-rows">
            <h3> Login </h3>
            <form action="" class="login-form " id="login-form">
            <br><br><br>
            <div class="form-group">
              <label class="control-label col-sm-2 sr-only" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Enter email">
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
              <label class="control-label col-sm-2 sr-only" for="pwd">Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password">
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
              <div class="col-sm-offset-0 col-sm-10">
                <div class="checkbox">
                  <label><input type="checkbox"> Remember me</label>
                </div>
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
              <div class="col-sm-offset-0 col-sm-10">
                <label><a class="" id="forgot-password"> Forgot Password </a></label>
                <button type="submit" class="btn btn-primary col-sm-offset-1">Login</button>
              </div>
            </div>
            <br>
            </form>
          </div>

          <div class="col-sm-3 my-rows">
          </div>

        </div>

    </div> <!-- end of center column -->

    <div class="col-sm-2 my-rows"></div>
  </div> <!-- end of row -->

</div> <!-- end of container -->
<br><br><br>

<?php require_once('includes/footer.php'); ?>
