<?php
include("RecaptchaKeys.php");
	
	$RecaptchaConfirmed=0;
	if(isset($_POST['g-recaptcha-response'])) {
	   // RECAPTCHA SETTINGS
	   $captcha = $_POST['g-recaptcha-response'];
	   $ip = $_SERVER['REMOTE_ADDR'];
	   $key = $RecaptchaSecret;
	   $url = 'https://www.google.com/recaptcha/api/siteverify';

	   // RECAPTCH RESPONSE
	   //$recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
	   
	   $ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
				'secret='.$key.'&response='.$captcha.'&remoteip='.$ip);

	// In real life you should use something like:
	// curl_setopt($ch, CURLOPT_POSTFIELDS, 
	//          http_build_query(array('postvar1' => 'value1')));

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close ($ch);
	   
	   $data = json_decode($server_output);
	   
	   //echo $captcha;
	   //var_dump($data);

	   if(isset($data->success) &&  $data->success === true) {
		$RecaptchaConfirmed=1;
	   }
	   else {
		  //die('Your account has been logged as a spammer, you cannot continue!');
	   }
	 }
?>	 