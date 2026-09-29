<?php
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    
					
					
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/Exception.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/PHPMailer.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/SMTP.php');
					

					$query_oat = $this->db->query("SELECT 
								o.order_id
								, o.order_status
								, o.order_package_id
								, o.order_package_name
								, oat.oat_id
								, oat.assessment_type
								, oat.status
								, oatr.q_id
								

								FROM orders o
								LEFT JOIN orders_assessment_type AS oat ON oat.order_id = o.order_id
								LEFT JOIN orders_assessment_type_responses AS oatr ON oatr.oat_id = oat.oat_id
								WHERE o.order_id ='".$order_id."' AND oat.assessment_type = '360 Assessment'");
							
			$result_oat = $query_oat->result_array();
					
					$invalues=array();
					$proceed2=0;
					foreach($_POST as $key=>$value)
					{
						
						if($proceed2==1)
						{
							$invalues[]=$value;
						}
						else if($key=="TemplateName")
						{
							$proceed2=1;
						}
					}
					
echo "Processing, Please wait";	

//print_r($_POST);	

$invalues=explode(",",$_POST["selectedinvitees"]);
			
					
	foreach($invalues as $val)
	{
		if((int)$val > 0)
		{
		$query_user = $this->db->query("select email
														, invite_sent
														, first_name
														, last_name
														, unique_url
														from invited_users
														where id = '".$val."' limit 1");
														

						$row_user = $query_user->row();
						
						if($row_user->invite_sent >= 0)
						{
							$ID=(int)$_POST["ID"];
							$query_user2 = $this->db->query("select Message,Section
														from Mail_messages
														where user_id = '".$this->session->userdata('user_id')."' and ID=".$ID." limit 1");
														

								$row_user2 = $query_user2->result_array();
								
								
								
								if($row_user2[0]["Message"]!="")
								{
									$Message=$row_user2[0]["Message"];
									$Message.="<br>";
									
									
								}
								if($row_user2[0]["Section"]!="")
								{
									$Subject=$row_user2[0]["Section"];
								}
								
								/*
								$message = 'Hi '.$row_user->first_name.',<br>'.$Message.'Click <a href="'.base_url().'assessment/thirdparty_rater/'.$row_user->unique_url.'" target="blank"> here </a> to give assessment.<br><br>Sincerely,<br><br>'.$this->session->userdata('first_name').' '.$this->session->userdata('last_name');
								*/
								
								$Message=$_POST["Message"];
								$Message.="<br>";
								
								$Subject=$_POST["Section"];
								
								$Message=str_replace("[First Name]",$row_user->first_name,$Message);
								
								$Message=str_replace(base_url()."assessment/thirdparty_rater/",base_url().'assessment/thirdparty_rater/'.$row_user->unique_url,$Message);
								
								/*
								$message = $Message.'<br>Click <a href="'.base_url().'assessment/thirdparty_rater/'.$row_user->unique_url.'" target="blank"> here </a> to give assessment.<br>';
								*/
								
								$message = $Message;
								
								$subject = $Subject;
								
								//send smtp mail
						
						
						$MESSAGE1=$message;
						$subject1=$subject;

						$TOEMAIL1=$row_user->email;
						$TONAME1=$row_user->first_name." ".$row_user->last_name;

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
							if (!$mail->Send()) {
								//echo "Mailer Error: " . $mail->ErrorInfo;
								

							} else {
								//echo "Message sent!";
								foreach($result_oat as $val_n)
								{
									$data_detail['oat_id'] = $val_n['oat_id'];
									$data_detail['order_id'] = $order_id;
									$data_detail['r_user_id'] = $val;
									$data_detail['q_id'] = $val_n['q_id'];
									$data_detail['oa_val'] = -99;
									$data_detail['created_date'] = date ("Y-m-d H:i:s");
									$this->db->insert('orders_assessment_type_rater_responses', $data_detail);
								}
								
								$this->db->set('invite_sent', 1 );
								$this->db->where('id', $val);
								$this->db->update('invited_users');
								
							}
							
						}
		}				
	}


?>		
		
<script type='text/javascript'>
function gotopage()
{
	window.top.location='<?php echo base_url();?>thankyou/a360';
}
setTimeout(gotopage, 5000);
</script>