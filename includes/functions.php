<?php

function setEmailHash($userId,$conn){
  $status="";
  $email_hash = bin2hex(openssl_random_pseudo_bytes(16,$cstrong));
  // check if usedId exists, if yes - update ,else insert
  if(mysqli_num_rows(mysqli_query($conn,"select * from shri_user_authentication where user_id=$userId"))<=0){
    echo mysqli_error($conn);
    $query = "insert into shri_user_authentication (user_id,email_token) values ($userId,'$email_hash')";
  }
  else{
    $query = "update shri_user_authentication set email_token='$email_hash' where user_id = $userId";
  }

  if(mysqli_query($conn,$query)){
    // Insert/Update successfully
    $status = $email_hash;
  }
  else{
    $status = "error101";//$conn->error;
  }
  return $status;
}

function sendVerificationMail($email,$conn){
  $result = mysqli_query($conn,"select user_id from shri_users where email='$email' and is_deleted='0'");
  $row = mysqli_fetch_assoc($result);
  $emailHash = base64_encode(setEmailHash($row['user_id'],$conn));
  if($emailHash=="error101"){
    die("Error: Technical error while generating security token ");
  }
  $from = "shrikrishna.shanbhag@intecons.com";
  $replyTo = "shrikrishna.shanbhag+replyto@intecons.com";
  $subject = "Activate your account";

  $message = <<<EOT
  <p> Dear {$_POST['first_name']},<br><br>

  Your account has been successfully created. Please click on the link below to
  activate your account.<br><br>

  <a href="http://localhost/carpool/verify.php?email=$email&token=$emailHash">Activate Account</a> <br><br>

  Regards,<br>
  {author}

EOT;
  $status = sendMail($email,'shri@intecons.com','shr@intecons.com',$subject,$message);
  return $status;
}

?>
