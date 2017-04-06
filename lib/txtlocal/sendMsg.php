<?php

sendMsg(8147861087);

function sendMsg($to=8660032226,$msg='Message Paramater Not Set'){
    // Account details
  	$username = 'shrikrishna.shanbhag@intecons.com';
  	$hash = 'e96f48a546b0cac491136528aeb9f15b496c68b4b3f6a310fc4d35cb25ad4407';

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

    var_dump($result);
}

?>
