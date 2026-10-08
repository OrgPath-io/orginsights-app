<?php
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    
					
					
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/Exception.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/PHPMailer.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/SMTP.php');
					

$query_u = $this->db->query("SELECT invu.*,u.first_name as Candidatename FROM invited_users invu
												LEFT JOIN users AS u ON u.user_id = invu.invited_by
												WHERE invu.unique_url = '".$unique."'");
$query_uR = $query_u->result_array();		
$Candidatename=$query_uR[0]["Candidatename"];										

$order_id=$query_uR[0]["order_id"];
$invited_by=$query_uR[0]["invited_by"];

//echo $order_id;
//echo "<br>";
//echo $invited_by;

//
$PeopleCompleted2=0;
			$PeopleCompleted3=0;
			$InvitedPeople=0;
			$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by = ".$invited_by." and order_id=".$order_id." and invite_sent=1 order by id desc");
			$checkinvitedR = $checkinvitedQ->result_array();

			foreach($checkinvitedR as $key=>$value)
			{
				$InvitedPeople++;
				
				$checkcompletedQ = $this->db->query("SELECT * from orders_assessment_type_rater_responses where r_user_id = ".$value["id"]." and  order_id = ".$value["order_id"]." and oa_val=-99 order by order_id desc");
				$checkcompletedR = $checkcompletedQ->result_array();
				
				if($checkcompletedR[0]=="")
				{
					$PeopleCompleted2++;
				}
				
			}
			
			//
			$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
			$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by = ".$invited_by." and order_id=".$order_id." and invite_sent=1 and LengthofAssessment!='' order by id limit 0,1");
			$checkinvitedR = $checkinvitedQ->result_array();
			foreach($checkinvitedR as $key=>$value)
			{
				$exp_date1=explode(" ",$value["LengthofAssessment"]." ");
				$exp_date2=explode("-",$exp_date1[0]);
				
				$timestampE=mktime(date('H'), date('i'),date('s'), $exp_date2[1], $exp_date2[2], $exp_date2[0]);
				
				if($timestampE <= $timestamp && $PeopleCompleted2 > 0)
				{
					$PeopleCompleted3=1;
				}
			}
			//
			
$isComplete360=0;			
if($PeopleCompleted2 >= $InvitedPeople && $InvitedPeople > 0)
{
	$isComplete360=1;
}
else if($PeopleCompleted3==1)
{
	$isComplete360=1;
}	

if($isComplete360==1)
{
	$query_user = $this->db->query("select user_id
													, first_name
													, last_name
													, email
													, country_id
													, ref_code
													, password
													, display_code
													from users
													where user_id = '".$invited_by."' limit 1");
	if($query_user->num_rows() > 0)
	{
		$row_user = $query_user->row();													

	$message = 'Hi '.$row_user->first_name.',<br><br>Your 360 assessment has been completed by the Invitees.<br><br>You can view the report by accessing the dashboard under Generate Report<br><br>Link: https://app.orginsights.io/login<br><br>Sincerely,<br><br>Orglnsights Team<br><img src="https://app.orginsights.io/asset/images/logo.png"><br>http://orginsights.io';	
	
		$message.="<br>";
		
		$Subject="Your 360 assessment is complete";
		
		$subject = $Subject;
		
		$MESSAGE1=$message;
		$subject1=$subject;
		
		$TOEMAIL1=$row_user->email;
		$TONAME1=$row_user->first_name." ".$row_user->last_name;
		
		//Email config
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
		//end config
		$mail->setFrom($FROM_Email, $FROM_Name);
		$mail->addReplyTo($FROM_Email, $FROM_Name);
		
		$mail->addAddress($TOEMAIL1, $TONAME1);
		
		$mail->Subject = $subject1;
		$mail->isHTML(true);
		$mail->Body    = $MESSAGE1;
		$mail->AltBody = '';
		if (!$mail->Send()) {
			//echo "Mailer Error: " . $mail->ErrorInfo;
			
		} else {
			//echo "Message sent!";
			}
	}		
	
}
?>
<div class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 text-center">
				<div class="mb-4"><img src="<?php echo base_url();?>asset/images/handshake.png" alt=""></div>
				<div class="mb-5">
					<h3>Thank You!</h3>
					<p align="left">Thank you for providing feedback for <?php echo $Candidatename;?>. The feedback you have provided is invaluable in helping them identify key areas of strength they can leverage more, as well as weaknesses they should focus on developing. Your feedback is confidential and only accessible to the candidate.</p>
				</div>

				

				<div class="text-center btn-div pt-4">
					<a href="<?php echo base_url();?>register" class="btn btn-secondary">Register to do your own assessment</a>
				</div>
			</div>
		</div>
	</div>
</div>
