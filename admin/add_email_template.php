<?php
  session_start();
  require_once('validate_admin.php');
  require_once('../includes/db_connect.php');
  $addTemplateMsg = "";

  $pageTitle = "Email Templates";
  $current_page = "templates";

  if(isset($_POST['submit-template'])){
    if(mysqli_query($conn,"insert into shri_carpool_email_templates (email_type,message,from_mail,reply_to,email,password,subject,tags) values ('{$_POST['mail_type']}','{$_POST['message']}','{$_POST['from']}','{$_POST['replyto']}','{$_POST['email']}','{$_POST['password']}','{$_POST['subject']}','{$_POST['tags']}')")){
      $addTemplateMsg =
      "<div class='alert alert-info alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Success!</strong> Email templated added successfully !
      </div>";
    }
    else{
      $addTemplateMsg =
      "<div class='alert alert-danger alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> Could not add template ! ".mysqli_error($conn)."
      </div>";
    }
  }
?>
<?php require_once('../includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('../includes/navbar-admin.php'); ?>
</div>

<div class="container-fluid dashboard-main">
  <div class="row"> <!--row1-->
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <?php
        echo $addTemplateMsg;
        unset($addTemplateMsg);
      ?>
      <div class="panel panel-primary">
        <div class="panel-heading">Add New Email Template</div>
        <div class="panel-body">
          <form method="post">
            <div class="row"> <!--row2 -->
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" name="mail_type" id="mail_type" placeholder="Type_of_mail" />
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" name="from" id="from" placeholder="Email From" />
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" name="email" id="from" placeholder="Enter host email" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="text" name="subject" id="subject" placeholder="Subject of Email" />
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" name="replyto" id="replyto" placeholder="Reply To Email" />
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" name="password" id="password" placeholder="Enter host email password." />
                </div>
              </div>
            </div> <!-- end of row2 -->
            <div class="form-group">
              <textarea class="form-control" rows="5" id="message" name="message" placeholder="Email Content"></textarea>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="tags" name="tags" placeholder="Used Tags" />
              <span class="help-block"> Cover individual tags with braces and seperate them with comma.</span>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button type="reset" class="btn btn-warning" name="rst" id="rst">Reset</button>
            <button type="submit" class="btn btn-primary" name="submit-template" id="submit-template">Save Template</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div> <!-- end of row1-->
</div>

<?php require_once('../includes/footer.php'); ?>
