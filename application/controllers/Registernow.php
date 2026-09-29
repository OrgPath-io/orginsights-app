<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registernow extends CI_Controller {

	public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}
	
	public function index()
	{
		$this->load->library('session');
		$this->load->model('Site_usersModel');
		$error = '';
		if($_POST)
		{
			try{
				$data=array();
				$data['first_name']			=	trim($this->input->get_post('first_name'));
				$data['last_name']			=	trim($this->input->get_post('last_name'));
				$data['email']				=	trim($this->input->get_post('email'));
				$data['password']			=	trim($this->input->get_post('password'));
				$data['via_code']			=	trim($this->input->get_post('referral'));
				$data['country_id']		=	trim($this->input->get_post('country'));
				//$data['contact']			=	trim($this->input->get_post('contact'));
				//$data['gender']			=	trim($this->input->get_post('gender'));
				//$data['city']				=	trim($this->input->get_post('city'));
				//$data['zip_code']			=	trim($this->input->get_post('zip_code'));
				$data['signup_via']			=	'system';
				$data['created_date']		=	date ("Y-m-d H:i:s");
				$data['DirectEntry']		=	1;
				
				$error = '';
				if($data['first_name'] == ''){
					$error .='First Name is missing. <br/>';
				}
				if($data['last_name'] == ''){
					$error .='Last Name is missing. <br/>';
				}
				if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$data['email'])) {
					$error .= "Invalid email format";
				}
				
				if($data['password'] == '' && $data['password'] != trim($this->input->get_post('confirm_password')) ){
					$error .='Please Enter a valid Password. <br/>';
				}else{
					
					if((int)$this->input->get_post('self')==1)
					{
						$data['password'] = md5($data['password']);
					}
					else
					{
						//$data['password'] = $data['password'];
					}
					
					
				}
				
				if($data['country_id'] == ''){
					$error .='Country is missing. <br/>';	
				}
				
				
				
				if($error == '')
				{
					$check_user = $this->Site_usersModel->check_user_existance($data['email']);
					if($check_user !== false)
					{
						$error .='Email Already Exist! <br/>';
					}
				}
				
				$ref_code = trim($this->input->get_post('referral'));
				
				if($ref_code!="" && $error == '')
				{
					$query_referral = $this->db->query("select *
												from ReferralCodes
												where ReferralCode = '".$ref_code."' limit 1");
												
												
						$referralCodeID="";								
						if($query_referral->num_rows() > 0)
						{
							$this->session->set_userdata('ref_code',$ref_code);
							$this->session->set_userdata('ref_code_type','percentage');
							$this->session->set_userdata('ref_code_value','100');
						
							$row_referral = $query_referral->row();
							
							$referralCodeID=(int)$row_referral->id;
							
						}
						else
						{
							$error .='Invalid Referral Code <br/>';
						}
				}
				else
				{
					$error .='Referral Code Required<br/>';
				}
				
				if($error == '')
				{
					$q = $this->db->insert('users', $data);
					
					
					
					$query_user = $this->db->query("select user_id
													, first_name
													, last_name
													, email
													, country_id
													, ref_code
													, DirectEntry
													from users
													where email = '".$data['email']."' limit 1");
													

					$row_user = $query_user->row();
					
					//
					$data=array();
							$data['referralCodeID'] = (int)$referralCodeID;
							$data['userID'] = (int)$row_user->user_id;

							$this->db->insert('ReferralCodeUses', $data);
					//
					
					$query_user2 = $this->db->query("select country
													from countries
													where id = '".$row_user->country_id."' limit 1");
													
													
							$Countryname="";								
							if($query_user2->num_rows() > 0)
							{
								$row_user2 = $query_user2->row();
								
								$Countryname=$row_user2->country;
								
							}
					
					//var_dump($row_user);
					//$ref_code = Register::getRandomString($row_user->user_id);
					$display_code = Registernow::getRandomString($row_user->user_id);
					
					
					
					$this->db->set('ref_code', $ref_code);
					$this->db->set('display_code', $display_code);
					$this->db->where('user_id', $row_user->user_id);
					$this->db->update('users');
					
					$this->session->set_userdata('user_auth','1');
					$this->session->set_userdata('site_user_name',$row_user->email);	
					$this->session->set_userdata('first_name',$row_user->first_name);
					$this->session->set_userdata('last_name',$row_user->last_name);	
					
					$this->session->set_userdata('full_name',$row_user->first_name.' '.$row_user->last_name);	
					$this->session->set_userdata('user_id',$row_user->user_id);
					$this->session->set_userdata('country',$Countryname);
					$this->session->set_userdata('display_code',$display_code);
					
					$this->session->set_userdata('DirectEntry',$row_user->DirectEntry);
					
					//echo "ok2"; die();
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
					
							
					
					
					
					?>
					<script>
					location.href="<?php echo base_url();?>";
					</script>
					<?php
					die();
					redirect(base_url(), 'refresh');
					exit();
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
		//print_r($this->session->userdata()); 
		$query_country = $this->db->query("SELECT 
									country,id 
									FROM countries
									order by country asc");
		$res_country = $query_country->result_array();
		
		$data['country'] = $res_country;
		$data['error'] = $error;
		$this->load->view('header');
		$this->load->view('register', $data);
		$this->load->view('footer');
	}
	
	public function homeassessment()
	{
		
		$query_number_of_orders = $this->db->query("SELECT count(*) as no_of_orders from orders where user_id = ".$this->session->userdata('user_id'));
		$users_no_of_orders = $query_number_of_orders->row();
		$data['users_no_of_orders'] = $users_no_of_orders->no_of_orders;


		$query_complete_orders = $this->db->query("SELECT 
														o.order_id
														, o.order_package_name
														, o.order_date
														, order_package_id
														, order_status
													from orders o  
													where user_id = ".$this->session->userdata('user_id')." order by order_id desc
													");
		$complete_orders = $query_complete_orders->result_array();
		
		$data['complete_orders'] = $complete_orders;
		
		$query_incomplete_orders = $this->db->query("SELECT 
														o.order_id
														, o.order_package_name
														, o.order_date
														, order_package_id
														, order_status
													from orders o  
													where user_id = ".$this->session->userdata('user_id')." 
													and order_status <> 'Completed' order by order_id desc");
		$incomplete_orders = $query_incomplete_orders->result_array();
		$data['incomplete_orders'] = $incomplete_orders;
		
//Get Counting & Complete orders

$query_number_of_orders = $this->db->query("SELECT * from orders where user_id = ".$this->session->userdata('user_id')." order by order_id desc");

$query_number_of_orders1f=$query_number_of_orders->result_array();


$users_no_of_orders1 = $query_number_of_orders->num_rows();

//print_r($this->session->userdata);


$users_ordersnumber1 = $query_number_of_orders1f[0]["order_id"];
$users_package1=$query_number_of_orders1f[0]["order_package_id"];	
$users_order_date1 = $query_number_of_orders1f[0]["order_date"];
		
		//echo $users_ordersnumber1;
//
$query_number_of_orders = $this->db->query("SELECT count(*) as no_of_orders from orders where user_id = ".$this->session->userdata('user_id')." and order_package_id=".(int)$users_package1." and order_status='Completed' order by order_id desc limit 0,1");

$query_number_of_orders1f=$query_number_of_orders->result_array();

$Completed1 = $query_number_of_orders1f[0]["no_of_orders"];


	

$data['users_no_of_orders1']=$users_no_of_orders1;
$data['users_ordersnumber1']=$users_ordersnumber1;
$data['Completed1']=$Completed1;
$data['users_package1']=$users_package1;

$data["order_id"]=$users_ordersnumber1;
$data["order_date"]=$users_order_date1;

//print_r($data);
//			
		
		$this->load->view('header');
		$this->load->view('homeassessment', $data);
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
	
}
