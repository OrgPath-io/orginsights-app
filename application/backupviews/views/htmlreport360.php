<link href="<?php echo base_url();?>asset/reports_style.css?d=<?php echo date("His");?>" rel="stylesheet">
<?php
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

$Package="OrgInsights Capabilities<br>360 Feedback Assessment";

?>
<?php include("report_page1.php");?>
<?php include("report_page2.php");?>
<?php include("report_page3.php");?>
<?php include("report_page4.php");?>
<?php include("report360_page5.php");?>
<?php include("report360_page6.php");?>
<?php include("report_page7.php");?>
