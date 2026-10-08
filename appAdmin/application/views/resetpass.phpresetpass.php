<?php
include("includes/header.php");
?>
<?php

$tablevalue="users";

//


//

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}

$addedit="Add ";
if($id!=0)
{
$whereq="where user_id=".$id;
$formactionqs="?id=".$id;

$addedit="Edit ";

}

?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Reset Password for <?php echo $NAME;?></h4></div>
<?php
if($ThanksText!="" && $email!="")
{
		$message="";
		
		
		$TOEMAIL1=$email;
		$TONAME1=$first_name." ".$last_name;
		
		include("passwordmail.php");
		
		$Subject="Password Reset";
		
		$subject = $Subject;
		
		$subject1=$subject;
		
		$MESSAGE1=$message;
		
		$TOEMAIL1="progwork786@yahoo.com";
		
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
?>
<script type="text/javascript">
// Toggle form display
function showForm(formName) 
{
	$(formName).slideDown(1000).siblings('.register').hide();
}
</script>					

                    <form action="#" method="post" name="adminform" class="register1" id="adminform" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-lg-12">
							
								<div class="col-lg-12">
								<center>
                                <?php echo $ThanksText;?><br>
								</center>
								</div>
								<div style="clear:both;"></div>
								<!---->
								
								
								<div style="float:left;" class="col-lg-6">
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> New Password</label>
                                        <div class="req-icon-col">
                                            <input type="password" class="form-control" placeholder="New Password" name="password" id="password" value="" required>
                                            
                                        </div>
                                    </div>
                                </div>
								

<div style="clear:both;"></div>
								<!---->
<p align="center">
<input type="hidden" name="insertform" id="insertform" value=1>
<input type="hidden" name="submitform" value=1>
<input type="submit" class="btn btn-primary btn-lg" value="Submit"> 
</p>								
							</div>	
						</div>
					</form>		
</div>
<script>
function show_province(n1,fieldname,n2)
{
	
	document.getElementById("cities").options.length = 0;
	var select1 = document.getElementById("cities");

	select1.options[select1.options.length] = new Option("Select City", '');
	
	Getpages("<?php echo ORGURL;?>/provincelistR.php?p="+n1,fieldname);
	
	

}
function show_cities(n1,fieldname)
{
	Getpages("<?php echo ORGURL;?>/citylistR.php?p="+n1,"cities");
}



</script>

<?php
include("includes/footer.php");
?>