<?php
					
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    
                    require '/var/www/html/clients/orginsightapp/PHPMailer/src/Exception.php';
                    require '/var/www/html/clients/orginsightapp/PHPMailer/src/PHPMailer.php';
                    require '/var/www/html/clients/orginsightapp/PHPMailer/src/SMTP.php';
					
?>
<?php
//echo "ok";

include("/var/www/html/clients/orginsightapp/connection.php"); 
/*
define('DB_SERVER_LIVE', "localhost");
define('DB_SERVER_USERNAME_LIVE', "shahidj");
define('DB_SERVER_PASSWORD_LIVE', "Ecnet!786");
define('DB_DATABASE_LIVE', "orginsights");

$con=new mysqli(DB_SERVER_LIVE, DB_SERVER_USERNAME_LIVE, DB_SERVER_PASSWORD_LIVE, DB_DATABASE_LIVE);
*/

$timestampC=mktime(0, 0,0, date('m'), date('d'), date('Y'));

//echo $timestampC;


	$chkRec=$con->query("select *, unix_timestamp(created_date) as created_date from invited_users where isOpen=1 and invite_sent=1 and unix_timestamp(LengthofAssessment) >=".$timestampC);

	while($chkRecr = $chkRec->fetch_array())
	{
		$timestamp=mktime(0, 0,0, date('m',$chkRecr["created_date"]), date('d',$chkRecr["created_date"]), date('Y',$chkRecr["created_date"]));
		
		$diff=($timestampC-$timestamp)/86400;
		
		//echo $diff;
		
		if($diff==(int)$chkRecr["FrequencyofReminders"])
		{
			$chkRec2=$con->query("select * from orders_assessment_type_rater_responses where r_user_id=".$chkRecr["id"]." and order_id=".$chkRecr["order_id"]." and oa_val >=0");
			$chkRecr2 = $chkRec2->num_rows;
			
			if($chkRecr2==0)
			{
				//echo "Sent Mail";
				
				$MESSAGE='click <a href="https://clients.ecnet.dev/orginsightapp/assessment/thirdparty_rater/'.$chkRecr["unique_url"].'" target="blank"> here </a> to give assessment.';
				
				$TOEMAIL1=$chkRecr["email"];
				$TONAME1=$chkRecr["first_name"]." ".$chkRecr["last_name"];
				
				$FROM_Email="dev@ecnetsolutions.ca";
				$FROM_Name="ECNet Dev";
				
					$subject1='360 Assessment Reminder for '.$chkRecr["first_name"].' '.$chkRecr["last_name"];
					$MESSAGE1=$MESSAGE;
					
					$mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Debugoutput = 'html';
                    $mail->Host = "mail.authsmtp.com";
                    $mail->Port = 25;
                    $mail->SMTPAuth = true;
                    $mail->SMTPAutoTLS = false;
                    $mail->SMTPSecure = 'tls'; // To enable TLS/SSL encryption change to 'tls'
                    $mail->AuthType = "CRAM-MD5";
                    $mail->Username = "ac74887";
                    $mail->Password = "YaImamMahdi12";
					
                    $mail->setFrom($FROM_Email, $FROM_Name);
                    $mail->addReplyTo($FROM_Email, $FROM_Name);
                    
					
                    $mail->addAddress($TOEMAIL1, $TONAME1); //(Send the test to yourself)
					
					$mail->Subject = $subject1;
                    $mail->isHTML(true);
                    $mail->Body    = $MESSAGE1;
                    $mail->AltBody = '';
                    
                    if (!$mail->send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                       echo "Message sent!";
                    }
					//end mail sending
			}
			
		}
	
		
	
	}

?>