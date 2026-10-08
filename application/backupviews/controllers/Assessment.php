<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends CI_Controller {

	
	
	
	public function thirdparty_rater($unique = '')
	{
		$this->load->library('session');
		if($unique == ''){
			redirect(base_url().'login', 'refresh');
		}
		
		
		
		if($_POST)
		{
			//print_r($_POST);
			foreach($_POST as $key=>$value)
			{
				$data = explode("_",$value);
				//echo $data[0]." ".$data[1];
				//echo "<br>";
				$this->db->set('oa_val', $data[1]);
				$this->db->where('oatrr_id', $data[0]);
				$this->db->update('orders_assessment_type_rater_responses');
				
			}
			
			/*foreach($_POST as $val)
			{
				$data = explode("_",$val);
				
				if(sizeof($data) == 2)
				{
				
					$this->db->set('oa_val', $data[1]);
					$this->db->where('oatrr_id', $data[0]);
					$this->db->update('orders_assessment_type_rater_responses');
					redirect(base_url().'assessment/uselink/'.$unique, 'refresh');
				}
			}*/
			//redirect(base_url(), 'refresh');
		}

		$query_user = $this->db->query("select *
													from invited_users
													where unique_url = '".$unique."' limit 1");
													
		
		
		if($query_user->num_rows() <= 0)
		{
		
			redirect(base_url(), 'refresh');
		}
		
		
		
		$row_user = $query_user->row();
		if($row_user->is_active == 0)
		{
			redirect(base_url().'assessment/intro/'.$unique, 'refresh');
		}
		
		
		
		$query_no_of_q = $this->db->query("SELECT COUNT(*) AS number_of_question
											FROM orders_assessment_type_rater_responses
											WHERE order_id = ".$row_user->order_id." AND r_user_id = ".$row_user->id)->row();
											
		
		$query_no_of_a_given = $this->db->query("SELECT COUNT(*) AS answer_given
											FROM orders_assessment_type_rater_responses
											WHERE order_id = ".$row_user->order_id." AND oa_val > -99 AND r_user_id = ".$row_user->id)->row();
											
		//echo $query_no_of_q->number_of_question;
		//echo $query_no_of_a_given->answer_given;
		
		
		
		if($query_no_of_q->number_of_question == $query_no_of_a_given->answer_given)
		{
			

			redirect(base_url().'assessment/thankyou/'.$unique, 'refresh');
		}
		else if($_POST)
		{
			redirect(base_url().'assessment/uselink/'.$unique, 'refresh');
		}
		
		
		$query_oat = $this->db->query("SELECT 
						o.order_id
						, o.order_status
						, o.order_package_id
						, o.order_package_name
						, oat.oat_id
						, oat.assessment_type
						, oat.status
						, o.b_first_name
						, o.b_last_name

						FROM orders o
						LEFT JOIN orders_assessment_type AS oat ON oat.order_id = o.order_id
						WHERE o.order_id = ".$row_user->order_id." AND oat.assessment_type = '360 Assessment'");
						
						
						
		$result_oat = $query_oat->result_array();
		if($query_oat->num_rows() > 0)
		{
			if($result_oat[0]['order_status'] == 'Ordered')
			{
				$this->db->set('order_status', 'In Process');
				$this->db->where('order_id', $order_id);
				$this->db->update('orders');
			}
		}	
		$data['result_oat'] = $result_oat;


		$query = $this->db->query("SELECT 
									oatr.oatrr_id
									, oatr.q_id AS question_id
									, oatr.oa_val AS answer_id
									,oatr.oat_id
									, q.question
									, GROUP_CONCAT(qoab.oa_id) AS optional_ans_ids
									, c.cat_name
									, cap.cap_name
									, q.general_instruction
									, oatr.order_id
									FROM `orders_assessment_type_rater_responses` oatr
									LEFT JOIN questions AS q ON q.q_id = oatr.q_id
									LEFT JOIN questions_responses AS qoab ON qoab.q_id = oatr.q_id
									LEFT JOIN categories AS c ON c.cat_id = q.cat_id
									LEFT JOIN capabilities AS cap ON cap.cap_id = q.cap_id
									WHERE oatr.oat_id= '".$result_oat[0]['oat_id']."' AND oatr.order_id = '".$row_user->order_id."'
									   AND oatr.r_user_id = '".$row_user->id."'
									GROUP BY oatr.q_id
									ORDER BY oatr.oatrr_id ASC ");
		$i=0;
		foreach ($query->result_array() as $row)
		{
			$selfassessment[$i]['oatrr_id'] = $row['oatrr_id'];
			$selfassessment[$i]['answer_id'] = $row['answer_id'];
			$selfassessment[$i]['question_id'] = $row['question_id'];
			$selfassessment[$i]['cat_name'] = $row['cat_name'];
			$selfassessment[$i]['cap_name'] = $row['cap_name'];
			$selfassessment[$i]['question'] = $row['question'];
			$selfassessment[$i]['general_instruction'] = $row['general_instruction'];
			
			$query_oa = $this->db->query("SELECT 
									a.oa_id, a.answers, q.Score 
									FROM responses a INNER JOIN questions_responses q on a.oa_id=q.oa_id
									where a.oa_id in (".$row['optional_ans_ids'].")");
									
			$res_oa = $query_oa->result_array();
			$selfassessment[$i]['responses'] = $res_oa;
			$i++;
			
		}
		$data['order_id'] = $row_user->order_id;
		$data['unique'] = $unique;
		$data['selfassessment'] = $selfassessment;
		$this->load->view('header');
		$this->load->view('third_party_assessment_later', $data);
		$this->load->view('footer');
	}
	
	
	function intro($unique = '')
	{
		$this->load->library('session');

		if($unique == ''){
			redirect(base_url().'login', 'refresh');
		}
		if($_POST)
		{
			$this->db->set('is_active', 1);
			$this->db->where('unique_url', $unique);
			$this->db->update('invited_users');

			redirect(base_url().'assessment/thirdparty_rater/'.$unique, 'refresh');
		}
		$data['unique'] = $unique;
		$this->load->view('header');
		$this->load->view('intro', $data);
		$this->load->view('footer');
	}


	function thankyou($unique = '')
	{
		$this->load->library('session');

		if($unique == ''){
			redirect(base_url().'login', 'refresh');
		}

		$data['unique'] = $unique;
		$this->load->view('header');
		$this->load->view('thankyou_rater', $data);
		$this->load->view('footer');
	}
	function uselink($unique = '')
	{
		$this->load->library('session');

		if($unique == ''){
			redirect(base_url().'login', 'refresh');
		}

		$data['unique'] = $unique;
		$this->load->view('header');
		$this->load->view('uselink', $data);
		$this->load->view('footer');
	}
}
