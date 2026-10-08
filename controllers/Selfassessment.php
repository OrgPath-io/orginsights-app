<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selfassessment extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
	}
	
	public function index($order_id = 0)
	{
		
	
		if($_POST)
		{
			
			
			foreach($_POST as $val)
			{
				$data = explode("_",$val);
				//echo sizeof($data);
				if(sizeof($data) == 2)
				{
					$this->db->set('oa_val', $data[1]);
					$this->db->where('oatr_id', $data[0]);
					$this->db->update('orders_assessment_type_responses');
				}
			}
			
			
//set status
$query_total_a_s = $this->db->query("SELECT oatr.oatr_id 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'self' AND oatr.oa_val = -99");
$res_a_s = $query_total_a_s->row();	

if($res_a_s > 0)
{
	$this->db->query("Update orders set SelfAssessmentStatus=0 WHERE order_id = '".$order_id."'");
}	
else
{
	$this->db->query("Update orders set SelfAssessmentStatus=1 WHERE order_id = '".$order_id."'");
}	
//set status						
			
			//Get order package and redirect accordingly
			$Nextpage="";

			$query_oat = $this->db->query("SELECT * FROM orders WHERE order_id = '".$order_id."'");
			$result_oat = $query_oat->result_array();
			$order_package_id=(int)$result_oat[0]['order_package_id'];

			if($order_package_id==1)
			{
				$Nextpage="selfassessment/thirdparty/".$order_id;
				
				$query_oat = $this->db->query("SELECT oatr.* FROM orders_assessment_type_responses oatr
												LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
												WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val > -99 and oat.q_type = 'other rated' order by oatr.oatr_id");
				if($query_oat->num_rows() == 0)
				{
					$Nextpage="register/orginsights/".$order_id;
				}									
			}
			else if($order_package_id==2 || $order_package_id==3)
			{
				$Nextpage="selfassessment/professional/".$order_id;
				
				$query_oat = $this->db->query("SELECT oatr.* FROM orders_assessment_type_responses oatr
												LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
												WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val > -99 and oat.q_type = 'professional' order by oatr.oatr_id");
				if($query_oat->num_rows() == 0)
				{
					$Nextpage="register/professional/".$order_id;
				}									
			}


			$query_oat = $this->db->query("SELECT oatr.* FROM orders_assessment_type_responses oatr
												LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
												WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val = -99 and oat.q_type = 'self' order by oatr.oatr_id");
												
											
			if($query_oat->num_rows() > 0)
			{
				$Nextpage="";
			}
			//end order package check
			
			
			redirect(base_url().$Nextpage, 'refresh');
			
		}
		if($order_id == 0){
			redirect(base_url(), 'refresh');
		}
		$query_oat = $this->db->query("SELECT 
						o.order_id
						, o.order_status
						, o.order_package_id
						, o.order_package_name
						, oat.oat_id
						, oat.assessment_type
						, oat.status

						FROM orders o
						LEFT JOIN orders_assessment_type AS oat ON oat.order_id = o.order_id
						WHERE o.order_id = ".$order_id." AND oat.assessment_type = 'Self Assessment'");
						
							
		$result_oat = $query_oat->result_array();
		
		
		
		if($query_oat->num_rows() > 0)
		{
			if($result_oat[0]['order_status'] == 'Ordered')
			{
				$this->db->set('order_status', 'In Process');
				$this->db->where('order_id', $order_id);
				$this->db->update('orders');
			}
			
			if($result_oat[0]['status'] == 'Initiate')
			{
				redirect(base_url().'register/self/'.$order_id, 'refresh');
			}
		}	
		$data['result_oat'] = $result_oat;
		//
									
		
		
		//$res_q = $query->result();
		/*
		$query = $this->db->query("SELECT 
									oatr.oatr_id
									, oatr.q_id AS question_id
									, oatr.oa_val AS answer_id
									,oatr.oat_id
									, q.question
									, GROUP_CONCAT(qoab.oa_id) AS optional_ans_ids
									, c.cat_name
									, cap.cap_name
									, q.general_instruction
									, oatr.order_id
									FROM `orders_assessment_type_responses` oatr
									LEFT JOIN questions AS q ON q.q_id = oatr.q_id
									LEFT JOIN questions_responses AS qoab ON qoab.q_id = oatr.q_id
									LEFT JOIN categories AS c ON c.cat_id = q.cat_id
									LEFT JOIN capabilities AS cap ON cap.cap_id = q.cap_id
									WHERE oatr.oat_id= '".$result_oat[0]['oat_id']."' AND oatr.order_id = '".$order_id."'
									GROUP BY oatr.q_id
									ORDER BY oatr.oatr_id ASC ");
									*/
									
		$query = $this->db->query("SELECT 
									oatr.oatr_id
									, oatr.q_id AS question_id
									, oatr.oa_val AS answer_id
									,oatr.oat_id
									, q.question
									, GROUP_CONCAT(qoab.oa_id) AS optional_ans_ids
									, c.cat_name
									, cap.cap_name
									, q.general_instruction
									, oatr.order_id
									FROM `orders_assessment_type_responses` oatr
									LEFT JOIN questions AS q ON q.q_id = oatr.q_id
									LEFT JOIN questions_responses AS qoab ON qoab.q_id = oatr.q_id
									LEFT JOIN categories AS c ON c.cat_id = q.cat_id
									LEFT JOIN capabilities AS cap ON cap.cap_id = q.cap_id
									WHERE q.q_type='self' and oatr.order_id = '".$order_id."'
									GROUP BY oatr.q_id
									ORDER BY oatr.oatr_id ASC ");								
		
			
								
		$i=0;
		foreach ($query->result_array() as $row)
		{
			$selfassessment[$i]['oatr_id'] = $row['oatr_id'];
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
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment' AND oatr.oa_val <> -99");
			$res_a_s = $query_total_a_s->row();
			$progress_s = (integer)(($res_a_s->total_answer/$res_q_s->total_question) * 100);
		}else{
			$progress_s = 0;
		}
		
		
		$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment'");
													

		
		if($query_total_q_o->num_rows() > 0)
		{
			$res_q_o = $query_total_q_o->row();
			
			$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment' AND oatr.oa_val <> -99");
			$res_a_o = $query_total_a_o->row();
			$progress_o = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
		}else{
			$progress_o = 0;
		}
		
		$data['progress_s'] = $progress_s;
		$data['progress_o'] = $progress_o;
		$data['order_id'] = $order_id;
		$data['selfassessment'] = $selfassessment;
		$this->load->view('header');
		$this->load->view('self_assessment', $data);
		$this->load->view('footer');
	}
	
	public function optional()
	{
		$this->load->view('header');
		$this->load->view('register_optional');
		$this->load->view('footer');
	}
	
	public function professional($order_id = 0)
	{
		
		if($_POST)
		{
			//var_dump($_POST);
			//die();
			foreach($_POST as $val)
			{
				$data = explode("_",$val);
				//echo sizeof($data);
				if(sizeof($data) == 2)
				{
					$this->db->set('oa_val', $data[1]);
					$this->db->where('oatr_id', $data[0]);
					$this->db->update('orders_assessment_type_responses');
				}
			}
			
//set status
$query_total_a_s = $this->db->query("SELECT oatr.oatr_id 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'professional' AND oatr.oa_val = -99");
$res_a_s = $query_total_a_s->row();	

if($res_a_s > 0)
{
	$this->db->query("Update orders set OrgInsightsStatus=0 WHERE order_id = '".$order_id."'");
}	
else
{
	$this->db->query("Update orders set OrgInsightsStatus=1 WHERE order_id = '".$order_id."'");
}	
//set status									
			
			//Get order package and redirect accordingly
			$Nextpage="";

			$query_oat = $this->db->query("SELECT * FROM orders WHERE order_id = '".$order_id."'");
			$result_oat = $query_oat->result_array();
			$order_package_id=(int)$result_oat[0]['order_package_id'];

			if($order_package_id==3)
			{
				$Nextpage="selfassessment/thirdparty/".$order_id;
				
				$query_oat = $this->db->query("SELECT oatr.* FROM orders_assessment_type_responses oatr
												LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
												WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val > -99 and oat.q_type = 'other rated' order by oatr.oatr_id");
				if($query_oat->num_rows() == 0)
				{
					$Nextpage="register/orginsights/".$order_id;
				}									
			}
			else if($order_package_id==2)
			{
				$Nextpage="thankyou/orginsights";
												
			}


			$query_oat = $this->db->query("SELECT oatr.* FROM orders_assessment_type_responses oatr
												LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
												WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val = -99 and oat.q_type = 'professional' order by oatr.oatr_id");
												
											
			if($query_oat->num_rows() > 0)
			{
				$Nextpage="";
			}
			
			//echo $Nextpage; die();
			//end order package check
			
			redirect(base_url().$Nextpage, 'refresh');
		}
		if($order_id == 0){
			redirect(base_url(), 'refresh');
		}
		$query_oat = $this->db->query("SELECT 
						o.order_id
						, o.order_status
						, o.order_package_id
						, o.order_package_name
						, oat.oat_id
						, oat.assessment_type
						, oat.status

						FROM orders o
						LEFT JOIN orders_assessment_type AS oat ON oat.order_id = o.order_id
						WHERE o.order_id = ".$order_id." AND oat.assessment_type = 'OrgInsights Assessment'");
						
		$result_oat = $query_oat->result_array();
		if($query_oat->num_rows() > 0)
		{
			if($result_oat[0]['order_status'] == 'Ordered')
			{
				$this->db->set('order_status', 'In Process');
				$this->db->where('order_id', $order_id);
				$this->db->update('orders');
			}
			
			if($result_oat[0]['status'] == 'Initiate')
			{
				redirect(base_url().'register/professional/'.$order_id, 'refresh');
			}
		}	

		$data['result_oat'] = $result_oat;
		//
		
		
		//$res_q = $query->result();
		/*
		$query = $this->db->query("SELECT 
									oatr.oatr_id
									, oatr.q_id AS question_id
									, oatr.oa_val AS answer_id
									,oatr.oat_id
									, q.question
									, GROUP_CONCAT(qoab.oa_id) AS optional_ans_ids
									, c.cat_name
									, cap.cap_name
									, q.general_instruction
									, q.show_type
									, oatr.order_id
									FROM `orders_assessment_type_responses` oatr
									LEFT JOIN questions AS q ON q.q_id = oatr.q_id
									LEFT JOIN questions_responses AS qoab ON qoab.q_id = oatr.q_id
									LEFT JOIN categories AS c ON c.cat_id = q.cat_id
									LEFT JOIN capabilities AS cap ON cap.cap_id = q.cap_id
									WHERE oatr.oat_id= '".$result_oat[0]['oat_id']."' AND oatr.order_id = '".$order_id."'
									GROUP BY oatr.q_id
									ORDER BY oatr.oatr_id ASC ");
									*/
		$query = $this->db->query("SELECT 
									oatr.oatr_id
									, oatr.q_id AS question_id
									, oatr.oa_val AS answer_id
									,oatr.oat_id
									, q.question
									, GROUP_CONCAT(qoab.oa_id) AS optional_ans_ids
									, c.cat_name
									, cap.cap_name
									, q.general_instruction
									, q.show_type
									, oatr.order_id
									FROM `orders_assessment_type_responses` oatr
									LEFT JOIN questions AS q ON q.q_id = oatr.q_id
									LEFT JOIN questions_responses AS qoab ON qoab.q_id = oatr.q_id
									LEFT JOIN categories AS c ON c.cat_id = q.cat_id
									LEFT JOIN capabilities AS cap ON cap.cap_id = q.cap_id
									WHERE  q.q_type='professional' and oatr.order_id = '".$order_id."'
									GROUP BY oatr.q_id
									ORDER BY oatr.oatr_id ASC ");								
		$i=0;
		foreach ($query->result_array() as $row)
		{
			$selfassessment[$i]['oatr_id'] = $row['oatr_id'];
			$selfassessment[$i]['answer_id'] = $row['answer_id'];
			$selfassessment[$i]['question_id'] = $row['question_id'];
			$selfassessment[$i]['cat_name'] = $row['cat_name'];
			$selfassessment[$i]['cap_name'] = $row['cap_name'];
			$selfassessment[$i]['question'] = $row['question'];
			$selfassessment[$i]['show_type'] = $row['show_type'];
			$selfassessment[$i]['general_instruction'] = $row['general_instruction'];


			if("*".$row['optional_ans_ids']."*"=="**")
			{
			}
			else	
			{
			$query_oa = $this->db->query("SELECT 
									a.oa_id, a.answers, q.Score 
									FROM responses a INNER JOIN questions_responses q on a.oa_id=q.oa_id
									where a.oa_id in (".$row['optional_ans_ids'].")");
									
			$res_oa = $query_oa->result_array();
			$selfassessment[$i]['responses'] = $res_oa;
			}
			$i++;
			
		}
		
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
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment' AND oatr.oa_val <> -99");
			$res_a_s = $query_total_a_s->row();
			$progress_s = (integer)(($res_a_s->total_answer/$res_q_s->total_question) * 100);
		}else{
			$progress_s = 0;
		}
		
		
		$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment'");
													

		
		if($query_total_q_o->num_rows() > 0)
		{
			$res_q_o = $query_total_q_o->row();
			
			$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment' AND oatr.oa_val <> -99");
			$res_a_o = $query_total_a_o->row();
			$progress_o = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
		}else{
			$progress_o = 0;
		}
		
		$data['progress_s'] = $progress_s;
		$data['progress_o'] = $progress_o;
		
		$data['order_id'] = $order_id;
		$data['selfassessment'] = $selfassessment;
		
		$this->load->view('header');
		$this->load->view('professional_assessment', $data);
		$this->load->view('footer');
	}
	
	public function thirdparty($order_id=0)
	{
		if($order_id == 0){
			redirect(base_url(), 'refresh');
		}
		
		
		if($_POST)
		{
			$this->load->library('email');
			//var_dump($_POST);
			
			$query_oat = $this->db->query("SELECT 
								o.order_id
								, o.order_status
								, o.order_package_id
								, o.order_package_name
								, oat.oat_id
								, oat.assessment_type
								, oat.status
								, oatr.q_id
								

								FROM orders o
								LEFT JOIN orders_assessment_type AS oat ON oat.order_id = o.order_id
								LEFT JOIN orders_assessment_type_responses AS oatr ON oatr.oat_id = oat.oat_id
								WHERE o.order_id ='".$order_id."' AND oat.assessment_type = '360 Assessment'");
							
			$result_oat = $query_oat->result_array();
			
			foreach($_POST as $val)
			{
				$data_inv = explode("_",$val);
				//echo sizeof($data_inv);
				//die();
				
					$query_user = $this->db->query("select email
													, invite_sent
													, first_name
													, last_name
													, unique_url
													from invited_users
													where id = '".$val."' limit 1");
													

					$row_user = $query_user->row();
					
					if($row_user->invite_sent == 0)
					{
						$config = array();
						$config['protocol'] = 'smtp';
						$config['smtp_host'] = 'mail.authsmtp.com';
						$config['smtp_user'] = 'ac74887';
						$config['smtp_pass'] = 'YaImamMahdi12';
						$config['smtp_port'] = 25;
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						
						
						$this->email->from('dev@ecnetsolutions.ca', 'ECNet Dev');
						$this->email->to($row_user->email);
						//$this->email->cc('another@another-example.com');
						//$this->email->bcc('them@their-example.com');

						$this->email->subject('360 Assessment for '.$row_user->first_name.' '.$row_user->last_name);
						$this->email->message('click <a href="'.base_url().'assessment/thirdparty_rater/'.$row_user->unique_url.'" target="blank"> here </a> to give assessment.');
						
						//echo ('click <a href="'.base_url().'assessment/thirdparty_rater/'.$row_user->unique_url.'" target="blank"> here </a> to give assessment.');
						//die();

						$this->email->send();
						foreach($result_oat as $val_n)
						{
							$data_detail['oat_id'] = $val_n['oat_id'];
							$data_detail['order_id'] = $order_id;
							$data_detail['r_user_id'] = $val;
							$data_detail['q_id'] = $val_n['q_id'];
							$data_detail['oa_val'] = -99;
							$data_detail['created_date'] = date ("Y-m-d H:i:s");
							$this->db->insert('orders_assessment_type_rater_responses', $data_detail);
						}
						
						$this->db->set('invite_sent', 1 );
						$this->db->where('id', $val);
						$this->db->update('invited_users');
					}
			}
			//echo ('click <a href="'.base_url().'assessment/thirdparty_rater/'.$row_user->unique_url.'" target="blank"> here </a> to give assessment.');
			//die();
			
			
			redirect(base_url()."thankyou/a360", 'refresh');
		}
		
		$query_oat = $this->db->query("SELECT 
						o.order_id
						, o.order_status
						, o.order_package_id
						, o.order_package_name
						, oat.oat_id
						, oat.assessment_type
						, oat.status

						FROM orders o
						LEFT JOIN orders_assessment_type AS oat ON oat.order_id = o.order_id
						WHERE o.order_id = ".$order_id."  AND oat.assessment_type = '360 Assessment'");
						
		$result_oat = $query_oat->result_array();
		if($query_oat->num_rows() > 0)
		{
			if($result_oat[0]['order_status'] == 'Ordered')
			{
				$this->db->set('order_status', 'In Process');
				$this->db->where('order_id', $order_id);
				$this->db->update('orders');
			}
			if($result_oat[0]['status'] == 'Initiate')
			{
				redirect(base_url().'register/orginsights/'.$order_id, 'refresh');
			}
		}	
		$data['result_oat'] = $result_oat;
		
		$query = $this->db->query("SELECT 

									q.q_id AS question_id
									, q.question
									, GROUP_CONCAT(qoab.oa_id) AS optional_ans_ids
									, c.cat_name
									, cap.cap_name
									, q.general_instruction
									FROM questions q
									LEFT JOIN questions_responses AS qoab ON qoab.q_id = q.q_id
									LEFT JOIN categories AS c ON c.cat_id = q.cat_id
									LEFT JOIN capabilities AS cap ON cap.cap_id = q.cap_id
									WHERE q.q_type= 'other rated'
									GROUP BY q.q_id
									ORDER BY RAND() limit 6");
									
		
		
		//$res_q = $query->result();
		$i=0;
		foreach ($query->result_array() as $row)
		{
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
		
		$invited_users = $this->db->query("SELECT id as user_id
										, first_name
										, last_name
										, email
										,order_id
										, invited_by
										FROM invited_users
										WHERE invited_by = '".$this->session->userdata('user_id')."'
										AND order_id = '".$order_id."'");
						
		$result_invited_users = $invited_users->result_array();
		
		
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
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment' AND oatr.oa_val <> -99");
			$res_a_s = $query_total_a_s->row();
			$progress_s = (integer)(($res_a_s->total_answer/$res_q_s->total_question) * 100);
		}else{
			$progress_s = 0;
		}
		
		
		$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment'");
													

		
		if($query_total_q_o->num_rows() > 0)
		{
			$res_q_o = $query_total_q_o->row();
			
			$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment' AND oatr.oa_val <> -99");
			$res_a_o = $query_total_a_o->row();
			$progress_o = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
		}else{
			$progress_o = 0;
		}
		
		$data['progress_s'] = $progress_s;
		$data['progress_o'] = $progress_o;
		
		$data['invited_users'] = $result_invited_users;
		$data['selfassessment'] = $selfassessment;
		$data['order_id'] = $order_id;
		$this->load->view('header');
		$this->load->view('third_party_assessment', $data);
		$this->load->view('footer');
	}
	
	public function thirdparty_rater()
	{
		$this->load->view('header');
		$this->load->view('third_party_assessment_later');
		$this->load->view('footer');
	}
	
	public function show_invited_people($order_id=0)
	{
		if($order_id == 0){
			redirect(base_url(), 'refresh');
		}
		
		
		$div_count = 1;
		$counter = 1;
		$div_id = 1;
		//echo count($selfassessment);
		$state = false;
		$state_count = 0;
		
		$invited_users = $this->db->query("SELECT id as user_id
										, first_name
										, last_name
										, email
										,order_id
										, invited_by
										FROM invited_users
										WHERE invited_by = '".$this->session->userdata('user_id')."'
										AND order_id = '".$order_id."'");
						
		$result_invited_users = $invited_users->result_array();
		foreach($result_invited_users as $row)
		{
			if($div_count == 1)
			{
				
				
				echo '<div class="col-6 col-sm-6 col-md-3">';
			}
			echo '<input type="checkbox" id="c_'.$counter.'" name="c_'.$counter.'" value="'.$row['user_id'].'"><label for="c_'.$counter.'"><span></span>'.$row['first_name'].' '.$row['last_name'].'</label>';
	
			if($div_count >= 3 || $counter >= count($result_invited_users))
			{
				echo '</div>';

				$div_id++;
			}
			$div_count++;
		
			if($div_count >3 )
			{
				$div_count = 1;
			}
			$counter++;
		}

	}
	
	public function close_invite_user($order_id=0)
	{
		$this->db->query("Update invited_users set isOpen=0 where order_id = '".$order_id."'");
		
	
		$data['order_id'] = $order_id;
		$this->load->view('header');
		$this->load->view('closedassessment', $data);
		$this->load->view('footer');
	}
	
	public function add_invite_user($order_id=0)
	{
		
		if($order_id == 0)
		{
			echo 0;
			return false;
		}
		if($_POST)
		{
			$query_user = $this->db->query("select id
													from invited_users
													where email = '".trim($this->input->get_post('email'))."' and order_id = '".$order_id."' limit 1");
			if($query_user->num_rows() > 0)
			{
				echo 0;
				//return false;
			}else{
				$data['FrequencyofReminders']			=	trim($this->input->get_post('FrequencyofReminders'));
				$data['LengthofAssessment']			=	trim($this->input->get_post('LengthofAssessment'));
				
				$data['first_name']			=	trim($this->input->get_post('first_name'));
				$data['last_name']			=	trim($this->input->get_post('last_name'));
				$data['email']				=	trim($this->input->get_post('email'));
				$data['where_work_together']				=	trim($this->input->get_post('wwt'));
				$data['is_this_a_mentor']				=	trim($this->input->get_post('mentor'));
				$data['is_this_person_a_peer']				=	trim($this->input->get_post('peer'));
				$data['order_id']				=	$order_id;
				$data['invited_by']				=	$this->session->userdata('user_id');
				
				$q = $this->db->insert('invited_users', $data);
				
				$query_user = $this->db->query("select id
														from invited_users
														where email = '".$data['email']."' and order_id = '".$order_id."' limit 1");
				$row_user = $query_user->row();
				$ref_code = Selfassessment::getRandomString($row_user->id);
				$this->db->set('unique_url', $ref_code);
				$this->db->where('id', $row_user->id);
				$this->db->update('invited_users');
				
				$this->session->set_userdata('postedname',$data['first_name']." ".$data['last_name']);
				
				echo 1;
				return true;
				
			}
													
			
		}
		return false;
	}
	
	
	function getRandomString($id=0) {

        //$validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890";
		$validCharacters = "1234567890";
        $validCharNumber = strlen($validCharacters);

     

        $result = "";

     

        for ($i = 0; $i < 5; $i++) {

            $index = mt_rand(0, $validCharNumber - 1);

            $result .= $validCharacters[$index];

        }

     	//$result = $result.time();
		$result = $result.$id;
		
		$validCharacters = "ABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890";
		$validCharNumber = strlen($validCharacters);
		
		for ($i = 0; $i < 5; $i++) {

            $index = mt_rand(0, $validCharNumber - 1);

            $result .= $validCharacters[$index];

        }

        return $result;

    }
}
