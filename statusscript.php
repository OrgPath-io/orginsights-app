<?php
include("connection.php");

//Country
$checkreponsesQ2 = $con->query("SELECT * from orders order by order_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	$order_id=$checkreponsesR2["order_id"];
	
	if($checkreponsesR2["order_package_id"] > 1)
	{
	
	
		//self
		$checkreponsesQ3 = $con->query("SELECT oatr.oatr_id 
										FROM orders_assessment_type_responses oatr
										LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
										WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'self' AND oatr.oa_val = -99");
		$checkreponsesR3 = $checkreponsesQ3->num_rows;
		
		if($checkreponsesR3==0)
		{
			$con->query("Update orders set SelfAssessmentStatus=1 WHERE order_id = '".$order_id."'");
		}
		
		//professional
		$checkreponsesQ3 = $con->query("SELECT oatr.oatr_id 
										FROM orders_assessment_type_responses oatr
										LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
										WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'professional' AND oatr.oa_val = -99");
		$checkreponsesR3 = $checkreponsesQ3->num_rows;
		
		if($checkreponsesR3==0)
		{
			$con->query("Update orders set OrgInsightsStatus=1 WHERE order_id = '".$order_id."'");
		}
		
		echo $order_id."<br>";
	}
	
	
	
}
?>