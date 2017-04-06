<?php

// function to send message.
function sendMsg($to=8660032226,$msg='Message Paramater Not Set'){
    // Account details
  	$username = 'shrikrishna.shanbhag@intecons.com';
  	$hash = '96f48a546b0cac491136528aeb9f15b496c68b4b3f6a310fc4d35cb25ad4407';
    // [todo] hash incorrect add e at start

  	// Message details
  	$numbers = array($to);
  	$sender = urlencode('TXTLCL');
  	$message = rawurlencode($msg);

  	$numbers = implode(',', $numbers);

  	// Prepare data for POST request
  	$data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

  	// Send the POST request with cURL
  	$ch = curl_init('http://api.textlocal.in/send/');
  	curl_setopt($ch, CURLOPT_POST, true);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  	$response = curl_exec($ch);
  	curl_close($ch);

    $result = json_decode($response,true);

    if($result['status']=='success'){
      $myfile = fopen("success.txt", "w") or die("Unable to open file!");
      fwrite($myfile, ":".var_dump($result).":");
      return true;
    }
    else{
      // [todo] set error flags properly read $result['errors']['message'] & $result['errors']['code']
      //echo "<".$result['errors'][0]['message'].">";
      $myfile = fopen("error.txt", "w") or die("Unable to open file!");
      fwrite($myfile, ":".$result['errors'][0]['message'].":");

      // Invalid credential error
      if($result['errors'][0]['code']==3)
        return true;

      return false;
    }
}

// function to generate alerts
function createAlert($type,$message,$note=''){
  if($type == "success"){
    $alertType = "alert-success";
    if($note=='')
      $note = "Success! ";
  }
  else if($type == "warning"){
    $alertType = "alert-warning";
    if($note=='')
      $note = "Note! ";
  }
  else if($type == "info"){
    $alertType = "alert-info";
    if($note=='')
      $note = "Info! ";
  }
  else{
    $alertType = "alert-danger";
    if($note=='')
      $note = "Error! ";
  }

  $alertBox = <<<EOT
  <div class='alert $alertType alert-dismissable'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>$note</strong> $message
  </div>
EOT;

  return $alertBox;
}

// function to send recovery code
function sendRecoveryMail($userId,$conn){
  global $base_url;
  $result = mysqli_query($conn,"select * from shri_carpool_users where user_id=$userId and is_deleted='0'");
  if(mysqli_num_rows($result)==1){
    $recovery_code = md5(rand(720,1280));
    $encode = base64_encode($recovery_code);
    $user = base64_encode($userId);

    $row = mysqli_fetch_assoc($result);
    if(mysqli_query($conn,"update shri_carpool_users set recovery_token='$recovery_code' where user_id=$userId and is_deleted='0'")){
      $from = "shrikrishna.shanbhag@intecons.com";
      $replyTo = "shrikrishna.shanbhag+replyto@intecons.com";
      $subject = "Carpool Account password recovery";

      $message = <<<EOT
      <p> Dear {$row['first_name']},<br><br>

      This mail is in response to the request you created for password reset. Please click on the link below to
      reset your account password.<br><br>

      <a href="{$base_url}updatePassword.php?user=$user&token=$encode">Reset Password</a> <br><br>

      Regards,<br>
      Team Carpool</p>

EOT;
      $status = sendMail($row['email'],$from,$replyTo,$subject,$message);
      return $status;
    }
    else{
      $status = "Error in updating recovery email !";
    }

  }
  else{
    // Error finding account
    $status = "Error finding the specified account !";
  }

  return $status;
}

function setEmailHash($userId,$conn){
  $status="";
  //[todo] try enabling openssl support in server
  //$email_hash = bin2hex(openssl_random_pseudo_bytes(16,$cstrong));
  $email_hash = md5(rand(1080,1920));
  // check if usedId exists, if yes - update ,else insert
  if(mysqli_num_rows(mysqli_query($conn,"select * from shri_carpool_users where user_id=$userId and is_deleted='0'"))==1){
    $query = "update shri_carpool_users set email_token='$email_hash' where user_id = $userId";
  }
  else{
    die("Cannot create token, Account doesnt exist !");
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
  global $base_url;

  $result = mysqli_query($conn,"select user_id,first_name from shri_carpool_users where email='$email' and is_deleted='0'");
  $row = mysqli_fetch_assoc($result);
  $emailHash = base64_encode(setEmailHash($row['user_id'],$conn));
  if($emailHash=="error101" || $emailHash==""){
    die("Error: Technical error while generating security token ");
  }
  $from = "shrikrishna.shanbhag@intecons.com";
  $replyTo = "shrikrishna.shanbhag+replyto@intecons.com";
  $subject = "Activate your account";
  $encodedMail = urlencode($email);
  $message = <<<EOT
  <p> Dear {$row['first_name']},<br><br>

  Your account has been successfully created. Please click on the link below to
  activate your account.<br><br>

  <a href="{$base_url}verify.php?email=$encodedMail&token=$emailHash">Activate Account</a> <br><br>

  Regards,<br>
  Team Carpool</p>

EOT;
  $status = sendMail($email,$from,$replyTo,$subject,$message);
  return $status;
}

?>
