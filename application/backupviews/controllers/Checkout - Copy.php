<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	
	public function index()
	{
		$this->load->library('session');
		$this->load->model('Site_usersModel');
		if($_POST)
		{
			try{
				$data=array();
				if($this->input->get_post('package_id') == 1)
				{
					$data['order_total'] = 125.00;
					$data['discount_amount'] = 25.00;
					$data['grand_total'] = 100.00;
					$data['order_package_name'] = '360 Assessment';
				}elseif($this->input->get_post('package_id') == 2)
				{
					$data['order_total'] = 225.00;
					$data['discount_amount'] = 20.00;
					$data['grand_total'] = 205.00;
					$data['order_package_name'] = 'Orginsights Assessment';
				}else{
				
					$data['order_total'] = 275.00;
					$data['discount_amount'] = 30.00;
					$data['grand_total'] = 235.00;
					$data['order_package_name'] = 'Orginsights And 360 Assessment';
				}
				
				$data['b_first_name']			=	$this->session->userdata('first_name');
				$data['b_last_name']			=	$this->session->userdata('last_name');
				$data['email']				=	$this->session->userdata('site_user_name');
				$data['b_address']			=	$this->session->userdata('country');
				$data['b_country']		=	$this->session->userdata('country');
				//$data['contact']			=	trim($this->input->get_post('contact'));
				//$data['gender']			=	trim($this->input->get_post('gender'));
				//$data['city']				=	trim($this->input->get_post('city'));
				//$data['zip_code']			=	trim($this->input->get_post('zip_code'));
				$data['payment_method']			=	'Credit Card';
				$data['transaction_id']			=	'4564564645454';
				$data['order_date']		=	date ("Y-m-d H:i:s");
				$data['order_package_id']			=	$this->input->get_post('package_id');
				$data['order_status']		=	'Ordered';
				$data['user_id']		=	$this->session->userdata('user_id');
				
				$error = '';
				//print_r($data); die();
				
				if($error == '')
				{
					$q = $this->db->insert('orders', $data);
					$order_id = $this->db->insert_id();
					
					//var_dump($row_user);
					$ref_code = Checkout::getRandomString($order_id);
					$this->db->set('unique_order_code', $ref_code);
					$this->db->where('order_id', $order_id);
					$this->db->update('orders');
					
					//
					$this->db->set('ref_code', $ref_code);
					$this->db->where('user_id', $this->session->userdata('user_id'));
					$this->db->update('users');
					$this->session->set_userdata('ref_code',$ref_code);
					//
					
					$data_detail['order_id'] = $order_id;
					$data_detail['created_date']		=	date ("Y-m-d H:i:s");
					$data_detail['status'] = 'Initiate';
						
					if($this->input->get_post('package_id') == 1)
					{
						$data_detail['assessment_type'] = 'Self Assessment';
						$this->db->insert('orders_assessment_type', $data_detail);
						$oat_id = $this->db->insert_id();
						Checkout::insert_oatr($order_id, $oat_id, $data_detail['assessment_type'], $data_detail['created_date']);
						$data_detail['assessment_type'] = '360 Assessment';
						$this->db->insert('orders_assessment_type', $data_detail);
						$oat_id = $this->db->insert_id();
						Checkout::insert_oatr($order_id, $oat_id, $data_detail['assessment_type'], $data_detail['created_date']);
					}elseif($this->input->get_post('package_id') == 2)
					{
						$data_detail['assessment_type'] = 'Self Assessment';
						
						$this->db->insert('orders_assessment_type', $data_detail);
						$oat_id = $this->db->insert_id();
						Checkout::insert_oatr($order_id, $oat_id, $data_detail['assessment_type'], $data_detail['created_date']);
						$data_detail['assessment_type'] = 'OrgInsights Assessment';
						$this->db->insert('orders_assessment_type', $data_detail);
						$oat_id = $this->db->insert_id();
						Checkout::insert_oatr($order_id, $oat_id, $data_detail['assessment_type'], $data_detail['created_date']);
					}else{
					
						$data_detail['assessment_type'] = 'Self Assessment';
						$this->db->insert('orders_assessment_type', $data_detail);
						$oat_id = $this->db->insert_id();
						Checkout::insert_oatr($order_id, $oat_id, $data_detail['assessment_type'], $data_detail['created_date']);
						$data_detail['assessment_type'] = 'OrgInsights Assessment';
						$this->db->insert('orders_assessment_type', $data_detail);
						$oat_id = $this->db->insert_id();
						Checkout::insert_oatr($order_id, $oat_id, $data_detail['assessment_type'], $data_detail['created_date']);
						$data_detail['assessment_type'] = '360 Assessment';
						$this->db->insert('orders_assessment_type', $data_detail);
						$oat_id = $this->db->insert_id();
						Checkout::insert_oatr($order_id, $oat_id, $data_detail['assessment_type'], $data_detail['created_date']);
					}
					//$data_detail['created_date']		=	date ("Y-m-d H:i:s");
					
					
					
				
					redirect(base_url().'register/optional', 'refresh');
					exit();
				}
			}catch(Exception $e){
				$data['status']='FAILURE';
				$data['message']='Error Occured';
			}
		}else{
			
			redirect(base_url());
			
		}
		
	}
	
	public function optional()
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
		$this->load->view('header');
		$this->load->view('register_optional');
		$this->load->view('footer');
	}
	
	
	public function self()
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
		$this->load->view('header');
		$this->load->view('register_self');
		$this->load->view('footer');
	}
	
	public function professional()
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
		$this->load->view('header');
		$this->load->view('register_professional');
		$this->load->view('footer');
	}
	
	public function orginsights()
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
		$this->load->view('header');
		$this->load->view('register_thirdparty');
		$this->load->view('footer');
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
	
	function checkemail()
	{
		$email = trim($this->input->get_post('signup_email'));
		$check_user = $this->Site_usersModel->check_user_existance($email);
				if($check_user !== false)
				{
					echo 'Email Already Exist';
				}else{
					echo 'Email Available';	
				}
	}
	
	
	function insert_oatr($order_id, $oat_id, $oat_type, $created)
	{
		if($oat_type == 'Self Assessment')
		{
			$assessment_type = 'self';
		}elseif($oat_type == 'OrgInsights Assessment'){
			$assessment_type = 'professional';
		}else{
			$assessment_type = 'other rated';
		}
		$query = $this->db->query("SELECT 
									q_id
									FROM questions
									where q_type = '".$assessment_type."' 
									ORDER BY RAND()");
		$res = $query->result_array();
		
		foreach($res as $row)
		{
			$data_detail['oat_id'] = $oat_id;
			$data_detail['order_id'] = $order_id;
			$data_detail['user_id'] = $this->session->userdata('user_id');
			$data_detail['q_id'] = $row['q_id'];
			$data_detail['oa_id'] = 0;
			$data_detail['created_date'] = $created;
			$this->db->insert('orders_assessment_type_responses', $data_detail);
		}
	}
	
}
