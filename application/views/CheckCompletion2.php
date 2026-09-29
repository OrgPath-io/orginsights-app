<?php
$Completed_1=0;
$Completed_2=0;
$Completed_3=0;

//1
$query_total_q_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.q_type = 'self'");
								
								
							if($query_total_q_s->num_rows() > 0)
							{
								$res_q_s = $query_total_q_s->row();
								$query_total_a_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.q_type = 'self' AND oatr.oa_val > -99");
							$res_a_s = $query_total_a_s->row();
							
							if($res_q_s->total_question==0)
							{
								$progress_s1 = 0;
							}
							else
							{
								$progress_s1 = (integer)(($res_a_s->total_answer/$res_q_s->total_question) * 100);
							}
							}else{
								$progress_s1 = 0;
							}	
						
							$Completed_1=$progress_s1;
//							

//2
$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.q_type = 'professional'");
													

		
							if($query_total_q_o->num_rows() > 0)
							{
								$res_q_o = $query_total_q_o->row();
								
								$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
														FROM orders_assessment_type_responses oatr
														LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
														WHERE oatr.order_id = '".$row['order_id']."' AND oat.q_type = 'professional' AND oatr.oa_val > -99");
								$res_a_o = $query_total_a_o->row();
								
								if($res_q_o->total_question==0)
								{
									$progress_s2 = 0;
								}
								else
								{
								$progress_s2 = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
								}
							}else{
								$progress_s2 = 0;
							}
							
						
							$Completed_2=$progress_s2;
//
//3
$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.q_type = 'other rated'");
													

		
		if($query_total_q_o->num_rows() > 0)
		{
			$res_q_o = $query_total_q_o->row();
			
			$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.q_type = 'other rated' AND oatr.oa_val > -99");
			$res_a_o = $query_total_a_o->row();
			
			if($res_q_o->total_question==0)
			{
				$progress_s3 = 0;
			}
			else
			{
			$progress_s3 = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
			}
		}else{
			$progress_s3 = 0;
		}
		
						$Completed_3=$progress_s3;
			//
			
			$PeopleCompleted2=0;
			$PeopleCompleted3=0;
			$InvitedPeople=0;
			$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by = ".$user_id." and order_id=".$row['order_id']." and invite_sent=1 order by id desc");
			$checkinvitedR = $checkinvitedQ->result_array();

			foreach($checkinvitedR as $key=>$value)
			{
				$InvitedPeople++;
				
				$checkcompletedQ = $this->db->query("SELECT * from orders_assessment_type_rater_responses where r_user_id = ".$value["id"]." and  order_id = ".$value["order_id"]." and oa_val=-99 order by order_id desc");
				$checkcompletedR = $checkcompletedQ->result_array();
				
				if($checkcompletedR[0]=="")
				{
					$PeopleCompleted2++;
				}
				
			}
			
			//
			$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
			$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by = ".$user_id." and order_id=".$row['order_id']." and invite_sent=1 and LengthofAssessment!='' order by id limit 0,1");
			$checkinvitedR = $checkinvitedQ->result_array();
			foreach($checkinvitedR as $key=>$value)
			{
				$exp_date1=explode(" ",$value["LengthofAssessment"]." ");
				$exp_date2=explode("-",$exp_date1[0]);
				
				$timestampE=mktime(date('H'), date('i'),date('s'), $exp_date2[1], $exp_date2[2], $exp_date2[0]);
				
				if($timestampE <= $timestamp && $PeopleCompleted2 > 0)
				{
					$PeopleCompleted3=1;
				}
			}
			//
			
			
			
//	
$isComplete=0;
$isComplete360=0;
if($row['order_package_name']=="360 Assessment")
{
	if($PeopleCompleted2 >= $InvitedPeople && $InvitedPeople > 0)
	{
		$isComplete=1;
		$isComplete360=1;
	}
	else if($PeopleCompleted3==1)
	{
		$isComplete=1;
		$isComplete360=1;
	}	
}
else if($row['order_package_name']=="OrgInsights Assessment")
{
	if($Completed_2 >= 100)
	{
		$isComplete=1;
	}	
}
else if($Completed_1 >= 100 && $Completed_2 >= 100)
{
	$isComplete=1;
	
	if($PeopleCompleted2 >= $InvitedPeople && $InvitedPeople > 0)
	{
		$isComplete360=1;
	}
	else if($PeopleCompleted3==1)
	{
		$isComplete360=1;
	}	
	
}	
//echo $Completed_1;				
?>