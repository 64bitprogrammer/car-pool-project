<?php
// each page will need following variables defined
$pageTitle = "Sign-Up";
$current_page = "signup";
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
            <h3> Sign-Up </h3><br>
            <div class="row signup-form my-rows">
                <div class="col-sm-2 my-rows"></div>
                <div class="col-sm-8 my-rows">
                    <div class="row my-rows"> <!-- Innermost row for form -->
                        <form method="POST" id="signup-form">
                        <div class="col-sm-6 my-rows">
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="first_name">First Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="first_name" placeholder="First Name">
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="email">Email:</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="password">Password:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="confirm_password">Confirm Password:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div id="widgetId1" class="g-recaptcha" data-sitekey="6LdxHRgUAAAAANbpPOmN15x46x6Yj6VRmInr21Gl"></div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="form-group">
                              <div class="col-sm-offset-0 col-sm-12">
                                <div class="checkbox">
                                  <label><input type="checkbox"> I agree to terms and conditions.</label>
                                </div>
                              </div>
                            </div>
                            <Br><br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="email">Register:</label>
                                <div class="col-sm-10">
                                    <input type="button" class="form-control btn btn-primary" id="signup" value="Sign-Up" placeholder="Enter email">
                                </div>
                            </div>
                            <br><br><br>
                        </div>
                        <!-- Right column for form -->
                        <div class="col-sm-6 my-rows">
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="last_name">Last Name:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                </div>
                            </div>
                        </div> <!-- end of Right column for form -->
                    </div> <!-- end of form row -->
                </div>
                <div class="col-sm-2 my-rows"></div>
            </div> <!-- end of sub parent row -->

        </div> <!-- end of center (parent) column -->

        <div class="col-sm-2 my-rows"></div>
    </div> <!-- end of row -->

</div> <!-- end of container -->
<br><br><br>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php require_once('includes/footer.php'); ?>
