<?php
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;
                    
					
					
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/Exception.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/PHPMailer.php');
                    include('/var/www/html/app.orginsights.io/assets/PHPMailer2/src/SMTP.php');
					

$con=$this->db;
?>

<?php
$order_id=(int)$_REQUEST["orderid"];
$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

//echo "ok";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// Get HTML from file
//$html = file_get_contents(__DIR__.'/pdf_templates/page.php');

$this->db->select('user_id');
	$this->db->where('order_id', (int)$order_id);
	$chkorders = $this->db->get('orders', 0, 1);
	$chkordersf=$chkorders->result_array();
	
	$user_id=(int)$chkordersf[0]["user_id"];
	//
	
	$this->db->select('first_name');
	$this->db->select('last_name');
	$this->db->where('user_id', (int)$user_id);
	$chkusers = $this->db->get('users', 0, 1);
	$chkusersf=$chkusers->result_array();
	
	$first_name=$chkusersf[0]["first_name"];
	$last_name=$chkusersf[0]["last_name"];
	$email=$chkusersf[0]["email"];
	
$this->db->select('order_id');
$this->db->select('order_package_id');
$this->db->select('order_date');
$this->db->where('user_id', $user_id);
$this->db->where('order_id', (int)$order_id);
$this->db->order_by("order_id desc");
$query_number_of_orders = $this->db->get('orders', 0, 1);

/*
$query_number_of_orders = $this->db->query("SELECT order_id,order_package_id,order_date from orders where user_id = ".$this->session->userdata('user_id')." and order_id=".(int)$order_id." order by order_id desc limit 0,1");
*/
$query_number_of_orders1f=$query_number_of_orders->result_array();	



$order_id=(int)$query_number_of_orders1f[0]["order_id"];

$users_package1=$query_number_of_orders1f[0]["order_package_id"];
$order_date = $query_number_of_orders1f[0]["order_date"];

if($users_package1==3)
{
	$Package="OrgInsights and 360 Assessment";	
}
else if($users_package1==2)
{
	$Package="OrgInsights Assessment";	
}
else
{
	$Package="360 Assessment";	
}

$Package="OrgInsights Assessment";

//
$multiplybyP=1;
$displaysign="";
$numberformat=1;
if((int)$perccheck==1)
{
	$multiplybyP=20;
	$displaysign="%";
	$numberformat=0;
	
}	

$pdfid=0;
$pdftitle="OrgInsights Assessment";
//echo $pdftitle;

include('/var/www/html/app.orginsights.io/application/views/pdf_templates/pdfpage.php');
//echo $pdftitle;	

//echo __DIR__; die();

//echo $html;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$options = $dompdf->getOptions();

$options->setChroot("/var/www/html/app.orginsights.io/application/views");
//$options->setIsRemoteEnabled(true);
$dompdf->setOptions($options);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'orientation');

// Render the HTML as PDF
$dompdf->render();


$Filename=$first_name."_".$last_name;
$Filename.="_".$Package;
$Filename.="_".date("dMY",$timestamp);
$Filename=str_replace(" ","",$Filename);

$invfilepath=$_SERVER['DOCUMENT_ROOT']."/assets/reports/";
$invfile_fullpath=$invfilepath.$Filename.".pdf";

//PUT FILE IN PATH 
file_put_contents($invfile_fullpath, $dompdf->output());
//END

//send mail
$message="";
$query_referral = $con->query("select * from ReferralCodes where id = '".(int)$_REQUEST["id"]."' limit 1");



if($query_referral->num_rows() > 0)
{
	$row_referral = $query_referral->result_array();
	
	
	$Ref_first_name=$row_referral[0]["first_name"];
	$Ref_last_name=$row_referral[0]["last_name"];
	$Ref_email=$row_referral[0]["email"];
	
	
}

$TOEMAIL1=$Ref_email;
$TONAME1=$Ref_first_name." ".$Ref_last_name;

include("referralmail_include.php");

$Subject="OrgInsights Report Email";

$subject = $Subject;

$subject1=$subject;

$MESSAGE1=$message;

$attachmentname=$first_name."_".$last_name.".pdf";

if($TOEMAIL1!="")
{
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
			
			//$mail->addBCC("support@orginsights.io","support@orginsights.io");
			
			$mail->addAttachment($invfile_fullpath,$attachmentname);

			$mail->Subject = $subject1;
			$mail->isHTML(true);
			$mail->Body    = $MESSAGE1;
			$mail->AltBody = '';
			if (!$mail->Send()) {
			//echo "Mailer Error: " . $mail->ErrorInfo;

			} else {
			echo "<br><br>Email sent!";
	}
}



?>