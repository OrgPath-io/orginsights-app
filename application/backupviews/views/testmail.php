<?php
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    
					
					
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/Exception.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/PHPMailer.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/SMTP.php');
					
$MESSAGE1="This is a test mail";
$subject1="Testing SMTP MAIL";

$TOEMAIL1="shahid@ecnetsolutions.ca";
$TONAME1="Tester";

$FROM_Email="info@orginsights.io";
$FROM_Name="Orginsights";		

					
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
						$mail->Username = "ac78416";
						$mail->Password = "grab-vixen-wreak-wi";
						
						//print_r($_POST);
						//echo "<br>";
						
						
						
						
						$mail->setFrom($FROM_Email, $FROM_Name);
						$mail->addReplyTo($FROM_Email, $FROM_Name);
						
						
						
						$mail->addAddress($TOEMAIL1, $TONAME1);
						
						$mail->Subject = $subject1;
						$mail->isHTML(true);
						$mail->Body    = $MESSAGE1;
						$mail->AltBody = '';
						
						//$result = $mail->Send();
//echo $result;
//echo "here";
						if (!$mail->Send()) {
							echo "Mailer Error: " . $mail->ErrorInfo;
							

						} else {
							echo "Message sent!";
							
						}


?>						
