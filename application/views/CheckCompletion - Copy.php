<?php
$Completed_1=0;
$Completed_2=0;
$Completed_3=0;

//1
$query_total_q_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment'");
									
							if($query_total_q_s->num_rows() > 0)
							{
								$res_q_s = $query_total_q_s->row();
								$query_total_a_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment' AND oatr.oa_id <> 0");
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
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.assessment_type = 'OrgInsights Assessment'");
													

		
							if($query_total_q_o->num_rows() > 0)
							{
								$res_q_o = $query_total_q_o->row();
								
								$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
														FROM orders_assessment_type_responses oatr
														LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
														WHERE oatr.order_id = '".$row['order_id']."' AND oat.assessment_type = 'OrgInsights Assessment' AND oatr.oa_id <> 0");
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
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.assessment_type = '360 Assessment'");
													

		
		if($query_total_q_o->num_rows() > 0)
		{
			$res_q_o = $query_total_q_o->row();
			
			$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$row['order_id']."' AND oat.assessment_type = '360 Assessment' AND oatr.oa_id <> 0");
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

$isComplete=0;	
if($Completed_1 >= 100 || $Completed_2 >= 100 || $Completed_3 >= 100)
{
	$isComplete=1;
	
}					
?>