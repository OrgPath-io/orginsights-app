<?php

if(isset($dontchecklogin) && (int)$dontchecklogin==1)
{	
$whereq="user_id > 0"; 
}
else
{
$user_id=(int)$this->session->userdata('user_id');
$whereq="user_id = ".$this->session->userdata('user_id');
}

$query_number_of_orders = $this->db->query("SELECT user_id,order_id,order_package_id,order_date from orders where ".$whereq." and order_id=".(int)$order_id." and order_package_id > 1 order by order_id desc limit 0,2");
$query_number_of_orders1f=$query_number_of_orders->result_array();	


$user_id=(int)$query_number_of_orders1f[0]["user_id"];
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


include('industry_report.php');


//echo $html;
?>
