// execute all code on loading the entire page
// store code / call function from block below
$(document).ready(function(){
  loadDefaults();
});

// validate update password page
function validateUpdatePassword(){
  $("#password-help").html("");
  $("#cpassword-help").html("");

  var pass_reg=/(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$)/;

  if($("#password").val()==""){
    $("#password-help").html("Please enter a password ");
    $("#password").focus();
    return false;
  }

  if(!pass_reg.test($("#password").val())){
    $("#password-help").html("Min 8 chars [1 caps, 1 num, 1 sym]");
    $("#password").focus();
    return false;
  }

  if($("#cpassword").val() == ""){
    $("#cpassword-help").html("Please confirm password ");
    $("#cpassword").focus();
    return false;
  }

  if($("#cpassword").val()!=$("#password").val()){
    $("#cpassword-help").html("Passwords do not match");
    $("#cpassword").focus();
    return false;
  }

  return true;
}


//forgot password form validation
function validateForgotForm(){

  $("#forgot-email-help").html("");
  $("#datepicker-help").html("");
  $("#captcha-help").html("");

  var email_reg=/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;
  var date_reg = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;

  if($("#forgot-email").val()==""){
    $("#forgot-email-help").html("Please enter a email address ");
    $("#forgot-email").focus();
    return false;
  }

  if(!email_reg.test($("#forgot-email").val())){
    $("#forgot-email-help").html("Please enter a valid email address ");
    $("#forgot-email").focus();
    return false;
  }

  if(grecaptcha.getResponse() == ""){
      $("#captcha-help").html("Please select captcha");
      $("#captcha-help").focus();
      return false;
  }

  return true;
}

// Validate verify.php fields
function validateVerificationFields(){
  $("#verify_email-help").html("");
  $("#captcha-help").html("");
  var email_reg=/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;

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

  if(grecaptcha.getResponse() == ""){
      $("#captcha-help").html("Please select captcha");
      $("#captcha-help").focus();
      return false;
  }

  return true; // Field validated
}

$("#signup_email").change(function(){
  if(checkMailExists($(this).val())){
    $("#signup_email-help").html("Email unavailable!");
  }
  else{
    $("#signup_email-help").html("");
  }
});

function checkMailExists(email){
  //var email = $("#email").val();
  var status;
  var filename = "common-ajax.php?action=checkEmailExists&email="+encodeURIComponent(email);
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
  $("#signup_email").val("shrikrishna.shanbhag@intecons.com");
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
  $("#signup_email-help").html(str);
  $("#datepicker-help").html(str);
  $("#mobile-help").html(str);
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

  var email_reg=/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;
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

function calculateAge(birthday) { // birthday is a date
  var dt = new Date(birthday);
  var ageDifMs = Date.now() - dt.getTime();
  var ageDate = new Date(ageDifMs); // miliseconds from epoch
  return Math.abs(ageDate.getUTCFullYear() - 1970);
}

// Handle form submit for Sign-Up form in signup.php

function validateSignUpForm(){

  resetSignupErrors();

  var errorCount = 0;
  var text_reg = /^[a-zA-Z ]*$/;
  var email_reg=/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;
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

  if($("#signup_email").val() == ""){
    $("#signup_email-help").html("Email name cannot be empty");
    $("#signup_email").focus();
    return false;
  }

  if(!email_reg.test($("#signup_email").val())){
    $("#signup_email-help").html("In-correct email format");
    $("#signup_email").focus();
    return false;
  }

  if(checkMailExists($("#signup_email").val())){
    $("#signup_email-help").html("Email already exists!");
    $("#signup_email").focus();
    return false;
  }

  if($('input[name=gender]:checked').length==0){
    $("#gender-help").html("Select your gender");
    return false;
  }

  if($("#datepicker").val() == ""){
    $("#datepicker-help").html("Please select your birth date");
    $("#datepicker").focus();
    return false;
  }

  if(!date_reg.test($("#datepicker").val())){
    $("#datepicker-help").html("In-correct date format");
    $("#datepicker").focus();
    return false;
  }

  if(calculateAge($("#datepicker").val())<18){
    $("#datepicker-help").html("You must be 18 years or older of age");
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

  if(grecaptcha.getResponse() == ""){
      $("#captcha-help").html("Please select captcha");
      $("#captcha-help").focus();
      return false;
  }

  if(!$("#terms").is(":checked",true)){
    $("#terms-help").html("Please accept terms and conditions");
    $("#terms").focus();
    return false;
  }

  return true; // All fields validates, hence submit form
}
