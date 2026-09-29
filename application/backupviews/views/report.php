<link href="<?php echo base_url();?>asset/reports_style.css?d=<?php echo date("His");?>" rel="stylesheet">
<?php
$user_id=(int)$this->session->userdata('user_id');


//
$multiplybyP=1;
$displaysign="";
$numberformat=1;
$pdflink=base_url()."orgreport/".(int)$order_id;
if((int)$perccheck==1)
{
	$multiplybyP=20;
	$displaysign="%";
	$numberformat=0;
	$pdflink.="/1";
	
	
?>

<div style="float:right;padding:10px;background:#0b8465;color:#ffffff;">Percentage</div>
<div style="float:right;padding:10px;background:#cccccc;"><a href="<?php echo base_url();?>report/<?php echo (int)$order_id;?>" style="text-decoration:none;color:#000000;">Mean Score</a></div>
<div style="clear:both;"></div>
<?php	
}
else
{
?>
<div style="float:right;padding:10px;background:#cccccc;"><a href="<?php echo base_url();?>report/<?php echo (int)$order_id;?>/1" style="text-decoration:none;color:#000000;">Percentage</a></div>
<div style="float:right;padding:10px;background:#0b8465;color:#ffffff;">Mean Score</div>
<div style="clear:both;"></div>
<?php
}
//


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

?>
<?php include("report_page1.php");?>
<div style="page-break-before:always">&nbsp;</div>
<?php include("report_page2.php");?>
<div style="page-break-before:always">&nbsp;</div>
<?php include("report_page3.php");?>
<div style="page-break-before:always">&nbsp;</div>
<?php include("report_page4.php");?>
<div style="page-break-before:always">&nbsp;</div>
<?php include("report_page5.php");?>
<div style="page-break-before:always">&nbsp;</div>
<?php include("report_page6.php");?>
<div style="page-break-before:always">&nbsp;</div>
<?php 
$Shownext=1;
include("report_page7.php");?>
<div style="display:none;">
<form id="pdfform" method="post" action="<?php echo base_url();?>pdfreport" target="_blank">
<input type="hidden" name="id" value=1>
<textarea name="pdfreport">
<?php
//include("pdfstyles.php");
//echo $abcd;
?>
<?php include("reportpdf_page1.php");?>
<?php //include("reportpdf_page2.php");?>
<?php //include("reportpdf_page4.php");?>
</textarea>
</form>
<form id="pdfform2" method="post" action="<?php echo base_url();?>pdfreport" target="_blank">
<input type="hidden" name="id" value=2>
<textarea name="pdfreport2">
<?php include("reportpdf_page5.php");?>
<?php include("reportpdf_page6.php");?>
<?php include("reportpdf_page7.php");?>
</textarea>
</form>
</div>
<script>
document.getElementById("pdfreportli").style.display=""
//document.getElementById("pdfreportli2").style.display=""
function genpdfreport()
{
	//document.getElementById("pdfform").submit();
	window.open("<?php echo $pdflink;?>","pdfreportwindow")
}
function genpdfreport2()
{
	document.getElementById("pdfform2").submit();
}
</script>
