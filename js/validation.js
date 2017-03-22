// execute all code on loading the entire page
// store code / call function from block below
$(document).ready(function(){
  loadDefaults();
});

// Validate verify.php fields
function validateVerificationFields(){
  var email_reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;

  if($("#verify_email").val()==""){
    $("#verify_email-help").html("Please enter a email address ");
    $("#verify_email").focus();
    return false;
  }

  if(!email_reg.test($("#verify_email").val())){
    $("#verify_email-help").html("Please enter a valid email address ");
    $("#verify_email").focus();
    return false;
  }

  if(!checkMailExists($("#verify_email").val())){
    $("#verify_email-help").html("No such email registered !");
    $("#verify_email").focus();
    return false;
  }

  return true; // Field validated
}

$("#email").change(function(){
  if(checkMailExists($(this).val())){
    $("#email-help").html("Email unavailable!");
  }
  else{
    $("#email-help").html("");
  }
});

function checkMailExists(email){
  //var email = $("#email").val();
  var status;
  var filename = "common-ajax.php?action=checkEmailExists&email="+email;
  $.ajax({
    url: filename,
    type: 'POST',
    async: false,
    success: function (data, textStatus, xhr){
      if(data=="true"){
        // Email already exists
        status = true;
      }
      else{
        status = false;
      }
    },
    error: function (data, textStatus, xhr){
    }
  });

  return status;
}

// function load defaults registration information
function loadDefaults(){
  $("#first_name").val("Shrikrishna");
  $("#last_name").val("Shanbhag");
  $("#email").val("shrikrishna.shanbhag@intecons.com");
  $("#datepicker").val("1993-11-06");
  $("#mobile").val("9876543210");
  $("#male").prop("checked", true);
  $("#password").val("Admin@123");
  $("#confirm_password").val("Admin@123");
  $('#terms').prop('checked', true);
  $("#recaptcha-anchor").click();
}

// Function to reset signup erros
function resetSignupErrors(str=''){
  $("#first-name-help").html(str);
  $("#last-name-help").html(str);
  $("#email-help").html(str);
  $("#password-help").html(str);
  $("#captcha-help").html(str);
  $("#terms-help").html(str);
}

function resetLoginErrors(str=''){
  $("#email-help").html(str);
  $("#password-help").html(str);
}

// Validate the login form
function validateLoginForm(){
  resetLoginErrors();

  var email_reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;
  var pass_reg=/(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$)/;

  if($("#email").val() == ""){
    $("#email-help").html("Please enter you email address");
    $("#email").focus();
    return false;
  }
  if(!email_reg.test($("#email").val())){
    $("#email-help").html("Please enter a valid email address");
    $("#email").focus();
    return false;
  }
  if($("#password").val() == ""){
    $("#password-help").html("Password cannot be empty");
    $("#password").focus();
    return false;
  }
  if(!pass_reg.test($("#password").val())){
    $("#password-help").html("Min 8 chars [1 caps, 1 num, 1 sym]");
    $("#password").focus();
    return false;
  }

  return true; // login validation successful
}


// Handle form submit for Sign-Up form in signup.php

function validateSignUpForm(){

  resetSignupErrors();

  var errorCount = 0;
  var text_reg = /^[a-zA-Z ]*$/;
  var email_reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;
  var pass_reg=/(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$)/;
  var date_reg = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;
  var mobile_reg = /^([0-9]){10}/;

  if($("#first_name").val() == ""){
    $("#first-name-help").html("First name cannot be empty");
    $("#first_name").focus();
    return false;
  }

  if(!text_reg.test($("#first_name").val())){
    $("#first-name-help").html("Only alphabets allowed");
    $("#first_name").focus();
    return false;
  }

  if($("#last_name").val() == ""){
    $("#last-name-help").html("Last name cannot be empty");
    $("#last_name").focus();
    return false;
  }

  if(!text_reg.test($("#last_name").val())){
    $("#last-name-help").html("Only alphabets allowed");
    $("#last_name").focus();
    return false;
  }

  if($("#email").val() == ""){
    $("#email-help").html("Email name cannot be empty");
    $("#email").focus();
    return false;
  }

  // if(!email_reg.test($("#email").val())){
  //   $("#email-help").html("In-correct email format");
  //   $("#email").focus();
  //   return false;
  // }

  // if(checkMailExists($("#email").val())){
  //   $("#email-help").html("Email already exists!");
  //   $("#email").focus();
  //   return false;
  // }

  if($('input[name=gender]:checked').length==0){
    $("#gender-help").html("Select your gender");
    return false;
  }

  if($("#datepicker").val() == ""){
    $("#datepicker-help").html("Please select a date");
    $("#datepicker").focus();
    return false;
  }

  if($("#mobile").val()==""){
    $("#mobile-help").html("Please enter a mobile number");
    $("#mobile").focus();
    return false;
  }

  if($("#mobile").val()==""){
    $("#mobile-help").html("Please enter a mobile number");
    $("#mobile").focus();
    return false;
  }

  if(!mobile_reg.test($("#mobile").val())){
    $("#mobile-help").html("Please enter a valid mobile number");
    $("#mobile").focus();
    return false;
  }

  if($("#password").val() == ""){
    $("#password-help").html("Password name cannot be empty");
    $("#password").focus();
    return false;
  }

  if(!pass_reg.test($("#password").val())){
    $("#password-help").html("Min 8 chars[1 caps, 1 num, 1 sym]");
    $("#password").focus();
    return false;
  }

  if($("#confirm_password").val() == ""){
    $("#password-help").html("Please confirm password");
    $("#confirm_password").focus();
    return false;
  }

  if(!($("#confirm_password").val() == $("#password").val())){
    $("#password-help").html("Passwords do not match");
    $("#confirm_password").focus();
    return false;
  }

  if(!date_reg.test($("#datepicker").val())){
    $("#datepicker-help").html("In-correct date format");
    $("#datepicker").focus();
    return false;
  }

  // if(grecaptcha.getResponse() == ""){
  //     $("#captcha-help").html("Please select captcha");
  //     $("#captcha-help").focus();
  //     return false;
  // }

  if(!$("#terms").is(":checked",true)){
    $("#terms-help").html("Please accept terms and conditions");
    $("#terms").focus();
    return false;
  }

  return true; // All fields validates, hence submit form
}
