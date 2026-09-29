<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}
	
	public function index()
	{
		$this->load->library('session');
		$this->load->model('Site_usersModel');
		if($this->session->userdata('user_id')){
				redirect(base_url());
			}
		$error = '';	
		if($_POST)
		{
			try{
				$data=array();
				$data['email']				=	trim($this->input->get_post('email'));
				$data['password']			=	trim($this->input->get_post('password'));
				
				
				
				$error = '';
				if($error == '')
				{
				
					$this->db->select('user_id');
					$this->db->select('first_name');
					$this->db->select('last_name');
					$this->db->select('email');
					$this->db->select('country_id');
					$this->db->select('ref_code');
					$this->db->select('password');
					$this->db->select('display_code');
					$this->db->select('DirectEntry');
					
					$this->db->where('email', $data['email']);
					$this->db->where('is_active', 1);
					
					$query_user=$this->db->get('users', 0, 1);
				
					/*
					$query_user = $this->db->query("select user_id
													, first_name
													, last_name
													, email
													, country_id
													, ref_code
													, password
													, display_code
													from users
													where email = '".$data['email']."' limit 1");
					*/										
													
													
													
					if($query_user->num_rows() > 0)
					{
						$row_user = $query_user->row();
						$data['password'] = md5($data['password']);
						
						if($data['password'] == $row_user->password)
						{
							
							$this->db->select('country');	
							$this->db->where('id', $row_user->country_id);
							$query_user2=$this->db->get('countries', 0, 1);
							
							/*
							$query_user2 = $this->db->query("select country
													from countries
													where id = '".$row_user->country_id."' limit 1");
							*/						
													
													
							$Countryname="";								
							if($query_user2->num_rows() > 0)
							{
								$row_user2 = $query_user2->row();
								
								$Countryname=$row_user2->country;
								
							}	
							
							//
							$this->db->where('CountryID', $row_user->country_id);
							$query_user2=$this->db->get('currencycodes', 0, 1);
							
							/*
							$query_user2 = $this->db->query("select * from currencycodes where CountryID = '".$row_user->country_id."' limit 1");
							*/
													
													
							if($query_user2->num_rows() > 0)
							{
								$row_user2 = $query_user2->row();
							
								$this->session->set_userdata('UserCurrency',$row_user2->CurrencyCode);
								
								$this->session->set_userdata('ConvertRate',$row_user2->ShouldConvert);
								
							}
							//
							
							//echo $row_user->user_id; die();
							
							//var_dump($row_user);
							$this->session->set_userdata('user_auth','1');
							$this->session->set_userdata('site_user_name',$row_user->email);	
							$this->session->set_userdata('first_name',$row_user->first_name);
							$this->session->set_userdata('last_name',$row_user->last_name);	
							
							$this->session->set_userdata('full_name',$row_user->first_name.' '.$row_user->last_name);	
							$this->session->set_userdata('user_id',$row_user->user_id);
							$this->session->set_userdata('country',$Countryname);
							
							$this->session->set_userdata('display_code',$row_user->display_code);
							
							$this->session->set_userdata('DirectEntry',$row_user->DirectEntry);
							
							//
							$refcode=$row_user->ref_code;
							
							$this->db->where('ReferralCode', $refcode);
							$checkReferralCodesQ=$this->db->get('ReferralCodes');
							$checkReferralCodes=$checkReferralCodesQ->row_array();
							
							if($refcode=="ORG22TSTFREE")
							{
								$this->session->set_userdata('ref_code',$refcode);
								$this->session->set_userdata('ref_code_type','percentage');
								$this->session->set_userdata('ref_code_value','100');
							}
							else if($refcode=="ORG22TSTTEN")
							{
								$this->session->set_userdata('ref_code',$refcode);
								$this->session->set_userdata('ref_code_type','value');
								$this->session->set_userdata('ref_code_value','10');
							}
							else if($checkReferralCodes!="" && $refcode!="")
							{
								$this->session->set_userdata('ref_code',$refcode);
								$this->session->set_userdata('ref_code_type',$checkReferralCodes['ReferralType']);
								$this->session->set_userdata('ref_code_value',$checkReferralCodes['ReferralValue']);
							}
							else if($refcode!="")
							{
								$this->session->set_userdata('ref_code',$refcode);
								$this->session->set_userdata('ref_code_type','percentage');
								$this->session->set_userdata('ref_code_value','30');
							}
							//
							
							
							redirect(base_url(), 'refresh');
							exit();
						}else{
							$error = 'incorrect Email / Password!';
						}
					}else{
						$error = 'Email does not exist!';
					}
				}
			}catch(Exception $e){
				$data['status']='FAILURE';
				$data['message']='Error Occured';
			}
		}else{
			if($this->session->userdata('user_id')){
				redirect(base_url());
			}
		}
		
		$data['error'] = $error;
		$this->load->view('header');
		$this->load->view('login', $data);
		$this->load->view('footer');
	}
	
	
	
	
}
