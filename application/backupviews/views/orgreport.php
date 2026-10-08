<?php


require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

//echo "ok";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// Get HTML from file
//$html = file_get_contents(__DIR__.'/pdf_templates/page.php');

$user_id=(int)$this->session->userdata('user_id');


$query_number_of_orders = $this->db->query("SELECT order_id,order_package_id,order_date from orders where user_id = ".$this->session->userdata('user_id')." and order_id=".(int)$order_id." order by order_id desc limit 0,1");
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
$pdftitle="Orginsights Assessment";
//echo $pdftitle;

include('pdf_templates/pdfpage.php');
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


$Filename=$this->session->userdata('first_name')."_".$this->session->userdata('last_name');
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


?>
