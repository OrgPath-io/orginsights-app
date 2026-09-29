<?php
include("connection.php");

$cnt=0;
$checkreponsesQ2 = $con->query("SELECT * from orders_assessment_type_responses where oa_val=-99 and oa_id > 0 order by oatr_id limit 0,50");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	$checkreponsesQ3 = $con->query("SELECT * from questions_responses where oa_id = ".$checkreponsesR2["oa_id"]." and q_id = ".$checkreponsesR2["q_id"]." order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	$Score="0";
	if($checkreponsesR3!="")
	{
		$Score=$checkreponsesR3["Score"];
	}
	
	$query="Update orders_assessment_type_responses set oa_val=".$Score." where oatr_id=".$checkreponsesR2["oatr_id"];
	
	//echo $query;
	$con->query($query);
	
	$cnt++;
}
echo "ok".$cnt;
?>