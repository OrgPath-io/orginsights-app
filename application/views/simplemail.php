<?php
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    
					
					
                    include('/home/orginsights/public_html/app/assets/PHPMailer/src/Exception.php');
                    include('/home/orginsights/public_html/app/assets/PHPMailer/src/PHPMailer.php');
                    include('/home/orginsights/public_html/app/assets/PHPMailer/src/SMTP.php');
					
					
$MESSAGE="This is a test message to test simple mail from auth smtp";
$TOEMAIL1="shahid@ecnetsolutions.ca";
$TONAME1="Test";

$FROM_Name="Orginsights";
$FROM_Email="dev@ecnetsolutions.ca";	

$subject1="Test Mail";
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
$mail->addReplyTo($frommailemail, $FROM_Name);


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
?>					