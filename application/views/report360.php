<?php


require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

//echo "ok";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// Get HTML from file
//$html = file_get_contents(__DIR__.'/pdf_templates/page.php');
if((int)$this->session->userdata('appAdminadminlog') > 0)
{
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
}
else
{
$user_id=(int)$this->session->userdata('user_id');
$first_name=$this->session->userdata('first_name');
$last_name=$this->session->userdata('last_name');
}


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

$Package="360 Assessment";

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

$pdfid=1;
$pdftitle="360 Assessment";
//echo $pdftitle;

$completedIDS="0";
$PeopleInvited=0;
$PeopleCompleted=0;
$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by = ".$user_id." and order_id=".$order_id." and invite_sent=1 order by id desc");
$checkinvitedR = $checkinvitedQ->result_array();

foreach($checkinvitedR as $key=>$value)
{
	$PeopleInvited++;
	
	$checkcompletedQ = $this->db->query("SELECT * from orders_assessment_type_rater_responses where r_user_id = ".$value["id"]." and  order_id = ".$value["order_id"]." and oa_val = -99 order by order_id desc");
	$checkcompletedR = $checkcompletedQ->result_array();
	
	if($checkcompletedR[0]=="")
	{
		$PeopleCompleted++;
		
		$completedIDS.=",".$value["id"];
	}
	
}

include('pdf_templates/pdfpage360.php');
//echo $pdftitle;

//echo $html;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$options = $dompdf->getOptions();

$options->setChroot(__DIR__);
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

if($stream==1)
{
// Output the generated PDF to Browser
$dompdf->stream($Filename);
}
else
{
?>
<script>
window.location.href="<?php echo base_url();?>downloadpdf/?filename=<?php echo $Filename;?>";
</script>
<?php
}
?>

