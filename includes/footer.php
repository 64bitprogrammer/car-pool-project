<!-- Footer added here -->
<div class="site-footer" id="site-footer">
    <strong>Carpool.com &copy; All Rights Reserved 2016 - <?=date("Y");?></strong>
</div>
<!-- Javascripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- My custom javascript file  -->
<script src="<?=$base_url?>js/validation.js"></script>

<!-- Datepicker content -->
<?php
$datepickerCode = <<<EOT
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function(){
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        maxDate: "-18y"
    });
});
</script>
EOT;
if($current_page=="signup" || $current_page=="login"){
    echo $datepickerCode;
}
?>
<?php
if($current_page=='signup' || $current_page=='verify' || $current_page=='login'){
    echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
}
?>
<!--body ends -->
</body>
</html>
