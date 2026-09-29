<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}
	
	public function index()
	{
		$this->load->library('session');
		$this->load->model('Site_usersModel');
		$error = '';
		
		//echo $_SERVER["DOCUMENT_ROOT"]; die();
		if($_POST)
		{
			include($_SERVER["DOCUMENT_ROOT"]."/application/views/RecaptchaConfirm.php");
			if($RecaptchaConfirmed==0)
			{
				$error = "<center>Invalid Captcha</center>";
				
			}
			else
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
					$data['password'] = md5($data['password']);
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
				if($error == '')
				{
					$q = $this->db->insert('users', $data);
					
					$query_user = $this->db->query("select user_id
													, first_name
													, last_name
													, email
													, country_id
													, ref_code
													from users
													where email = '".$data['email']."' limit 1");
													

					$row_user = $query_user->row();
					
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
					$display_code = Register::getRandomString($row_user->user_id);
					
					$ref_code = trim($this->input->get_post('referral'));
					
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
					
							//
							$refcode=$ref_code;
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
					
					
					if($ref_code!="")
					{
						$query_referral = $this->db->query("select *
													from ReferralCodes
													where ReferralCode = '".$ref_code."' limit 1");
													
													
							$referralCodeID="";								
							if($query_referral->num_rows() > 0)
							{
								$row_referral = $query_referral->row();
								
								$referralCodeID=(int)$row_referral->id;
								
								$data=array();
								$data['referralCodeID'] = (int)$referralCodeID;
								$data['userID'] = (int)$row_user->user_id;

								$this->db->insert('ReferralCodeUses', $data);
								
							}
					}
					redirect(base_url(), 'refresh');
					exit();
				}
			}catch(Exception $e){
				$data['status']='FAILURE';
				$data['message']='Error Occured';
			}
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
	
	public function optional()
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'login', 'refresh');
		}
		
		
		
		if($_POST)
		{
		
			//echo trim($this->input->get_post('city'));
			//die();
		
		
			//check ids
			$CityID=0;
					
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Cities where id='".(int)trim($this->input->get_post('city'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$CityID=$res_cities[0]['id'];
			}
			else
			{
				/*
				$data=array();
				$data['description']=trim($this->input->get_post('city'));
				$this->db->insert('Cities', $data);
				$CityID=$this->db->insert_id();
				*/
			}
			//
			$AgeID=trim($this->input->get_post('age_range'));
			/*		
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges where description='".trim($this->input->get_post('age_range'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$AgeID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($this->input->get_post('age_range'));
				$this->db->insert('AgeRanges', $data);
				$AgeID=$this->db->insert_id();
			}
			*/
			
			//
			$HleID=trim($this->input->get_post('hle'));
			/*		
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM HLEType where description='".trim($this->input->get_post('hle'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$HleID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($this->input->get_post('hle'));
				$this->db->insert('HLEType', $data);
				$HleID=$this->db->insert_id();
			}
			*/
			//
			$universityID=0;
					
			$query_cities = $this->db->query("SELECT 
									university,id,ccode  
									FROM university where university='".trim($this->input->get_post('university'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['university']!="")
			{
				$universityID=$res_cities[0]['id'];
				
				
			}
			else
			{
				$data=array();
				$data['university']=trim($this->input->get_post('university'));
				$this->db->insert('university', $data);
				$universityID=$this->db->insert_id();
			}
			
			//
			$studyID=0;
					
			$query_cities = $this->db->query("SELECT 
									major_cat,id 
									FROM study where major_cat='".trim($this->input->get_post('study'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['major_cat']!="")
			{
				$studyID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['major_cat']=trim($this->input->get_post('study'));
				$this->db->insert('study', $data);
				$studyID=$this->db->insert_id();
			}
			
			//
			
			//designations
			$Useridlogged=(int)$this->session->userdata('user_id');
			$this->db->query("delete from UsersDesignations where UserID=".$Useridlogged); 
			if(is_array(($this->input->get_post('designations'))))
			{
				$desigfillede=$this->input->get_post('designations');
				
				foreach($desigfillede as $dkey=>$dvalue)
				{
				
					$designationsID=0;
				
					$desigfilled=trim($dvalue);
					
					if($desigfilled!="")
					{
					
						$desigfilled1=explode(" - ",$desigfilled);
						$desigfilled=$desigfilled1[0];
						
						$query_cities = $this->db->query("SELECT 
										CertificateDesignationName,id 
										FROM Designations where CertificateDesignationName='".$desigfilled."'
										order by id asc");
						$res_cities = $query_cities->result_array();
						if($res_cities[0]['CertificateDesignationName']!="")
						{
							$designationsID=$res_cities[0]['id'];
						}
						else
						{
							$data=array();
							$data['CertificateDesignationName']=$desigfilled;
							
							if($desigfilled1[1]!="")
							{
								$data['Abbreviation']=$desigfilled1[1];
							}
							
							$this->db->insert('Designations', $data);
							$designationsID=$this->db->insert_id();
						}
						
						//echo $designationsID."<br>";
						$data=array();
						$data['UserID']=$Useridlogged;
						$data['DesignationID']=$designationsID;
						$this->db->insert('UsersDesignations', $data);
					
					}
				}
			}
			$designationsID=0;
			//echo "ok";
			//die();
			
			
			
			
			//
			$employersID=0;
					
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Employers where description='".trim($this->input->get_post('most_recent_employer'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$employersID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($this->input->get_post('most_recent_employer'));
				$this->db->insert('Employers', $data);
				$employersID=$this->db->insert_id();
			}
			
			//
			$mrelsID=trim($this->input->get_post('MostRecentExpLevelID'));
			/*		
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel where description='".trim($this->input->get_post('MostRecentExpLevelID'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$mrelsID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($this->input->get_post('MostRecentExpLevelID'));
				$this->db->insert('MostRecentExperienceLevel', $data);
				$mrelsID=$this->db->insert_id();
			}
			*/
			
			//
			$performancesID=trim($this->input->get_post('performance_rating'));
			/*		
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Performance_Rating where description='".trim($this->input->get_post('performance_rating'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$performancesID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($this->input->get_post('performance_rating'));
				$this->db->insert('Performance_Rating', $data);
				$performancesID=$this->db->insert_id();
			}
			*/
			
			//
			$industryID=0;
					
			$query_cities = $this->db->query("SELECT 
									name,id 
									FROM industry where name='".trim($this->input->get_post('industry_employer'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['name']!="")
			{
				$industryID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['name']=trim($this->input->get_post('industry_employer'));
				$this->db->insert('industry', $data);
				$industryID=$this->db->insert_id();
			}
			
			//
			$expertisesID=0;
					
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role where description='".trim($this->input->get_post('expertise_role'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$expertisesID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($this->input->get_post('expertise_role'));
				$this->db->insert('Expertise_Role', $data);
				$expertisesID=$this->db->insert_id();
			}
			//
			$salarysID=trim($this->input->get_post('salary_range'));
			/*		
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM SalaryRanges where description='".trim($this->input->get_post('salary_range'))."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$salarysID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($this->input->get_post('salary_range'));
				$this->db->insert('SalaryRanges', $data);
				$salarysID=$this->db->insert_id();
			}
			*/
			//die();
			//end ids check
			
			$data=array();
		
			$data['province']			=	trim($this->input->get_post('province'));
			$data['city']			=	(int)$CityID;
			$data['age_range']			=	(int)$AgeID;
			$data['visible_minorities']			=	trim($this->input->get_post('visible_minorities'));
			/*
			if(trim($this->input->get_post('visible_minorities_option'))=="Other")
			{
				$data['visible_minorities_option']			=	trim($this->input->get_post('Othervm'));
			}
			else
			{
			$data['visible_minorities_option']			=	trim($this->input->get_post('visible_minorities_option'));
			}
			*/
			$data['visible_minorities_option']=trim($this->input->get_post('visible_minorities_option'));
			$data['hle']			=	(int)$HleID;
			$data['university']			=	(int)$universityID;
			$data['graduation_year']			=	trim($this->input->get_post('graduation_year'));
			$data['program_study']			=	(int)$studyID;
			$data['designation']			=	(int)$designationsID;
			$data['most_recent_employer']			=	(int)$employersID;
			$data['performance_rating']			=	(int)$performancesID;
			$data['industry_employer']			=	(int)$industryID;
			$data['expertise_role']			=	(int)$expertisesID;
			$data['salary_range']			=	(int)$salarysID;
			$data['local_amazon_web']			=	trim($this->input->get_post('local_amazon_web'));
			
			$data['MostRecentExpLevelID']			=	(int)$mrelsID;
			
			//print_r($data);
			//die();
			$data["TotalFieldsEntered"]=(int)$_POST["TotalFieldsEntered"];
			
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->update('users', $data);
			//var_dump($_POST);
			//exit();
			
			//print_r($data);
			//die();
			
			//add new expertise if not available
			$query_occupation = $this->db->query("SELECT 
												name 
												FROM occupation
												where name='".trim($this->input->get_post('expertise_role'))."'");
			$res_occupation = $query_occupation->result_array();
			
			if($res_occupation[0]['name']!="")
			{
			}
			else
			{
				$data=array();
				$data['name']=trim($this->input->get_post('expertise_role'));
				$this->db->insert('occupation', $data);
			}
			//die();
			//end expertise
			
			redirect(base_url(), 'refresh');
		}

		$query_user = $this->db->query("SELECT 
									province, city 
									, age_range
									, visible_minorities
									, visible_minorities_option
									, hle
									, university
									, graduation_year
									, program_study
									, designation
									, most_recent_employer
									, performance_rating									
									, industry_employer
									, expertise_role
									, salary_range
									, local_amazon_web
									, MostRecentExpLevelID
									FROM users
									where user_id = '".$this->session->userdata('user_id')."'
									limit 1");
		$res_user = $query_user->result_array();
		$data['user'] = $res_user[0];
		$query_country = $this->db->query("SELECT 
									id, country 
									FROM countries
									where country = '".$this->session->userdata('country')."'
									limit 1");
		$res_country = $query_country->row();							
		
		
		$query_province = $this->db->query("SELECT 
									province_name,id 
									FROM provinces
									where countryid = '".$res_country->id."'
									order by province_name asc");
									
									
									
		$res_province = $query_province->result_array();
		
		
		
		$data['province'] = $res_province;
		
		
		$query_age = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges
									order by id asc");
		$res_age = $query_age->result_array();
		
		$data['age'] = $res_age;
		
		//*
		
		foreach($res_age as $result){
			$age_arr[] = $result['description'];
		}

		$age_arr = json_encode($age_arr);
		//$data['age'] = $age_arr;
		
		
		//*/
		
		
		$query_minorities = $this->db->query("SELECT 
									description,id 
									FROM VisibleMinorities
									order by id asc");
		$res_minorities = $query_minorities->result_array();
		
		$data['minorities'] = $res_minorities;
		
		
		$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Cities
									order by id asc");
		$res_cities = $query_cities->result_array();
		
		//$data['cities'] = $res_cities;
		
		//*
		
		foreach($res_cities as $result){
			$cities_arr[] = $result['description'];
		}

		$cities_arr = json_encode($cities_arr);
		$data['cities'] = $cities_arr;
		
		
		//*/
		
		
		$query_employers = $this->db->query("SELECT 
									description,id 
									FROM Employers
									order by id asc");
		$res_employers = $query_employers->result_array();
		
		//$data['employers'] = $res_employers;
		
		//*
		
		foreach($res_employers as $result){
			$employers_arr[] = $result['description'];
		}

		$employers_arr = json_encode($employers_arr);
		$data['employers'] = $employers_arr;
		
		
		//*/
		
		
		
		$query_hletypes = $this->db->query("SELECT 
									description,id 
									FROM HLEType
									order by id asc");
		$res_hletypes = $query_hletypes->result_array();
		
		$data['hletypes'] = $res_hletypes;
		
		//*
		
		foreach($res_hletypes as $result){
			$hletypes_arr[] = $result['description'];
		}

		$hletypes_arr = json_encode($hletypes_arr);
		//$data['hletypes'] = $hletypes_arr;
		
		
		//*/
		/*
		$query_university = $this->db->query("SELECT 
									REPLACE(university,'?','') as university,id 
									FROM university
									where country = '".$this->session->userdata('country')."' or  ccode = 'CA' or  ccode = 'US'
									order by university asc");
									*/
		$query_university = $this->db->query("SELECT 
									REPLACE(university,'?','') as university,id,ccode  
									FROM university
									order by university asc");								
									
		$res_university = $query_university->result_array();

		/*
		$university = json_encode($res_university);
		foreach($res_university as $result){
			$university_arr[] = $result['university'];
		}
		/*/

		//$university_arr = json_encode($university_arr);
		//$data['universities'] = $res_university;
		
		//*
		
		foreach($res_university as $result){
		
			$addtouni="";
			$queryccode=$this->db->query("SELECT country from countries where ccode='".$result['ccode']."'");
			$res_ccode = $queryccode->result_array();
			if($res_ccode[0]['country']!="")
			{
				$addtouni=" - ".$res_ccode[0]['country'];
			}
		
			$university_arr[] = $result['university'].$addtouni;
		}

		$university_arr = json_encode($university_arr);
		$data['university'] = $university_arr;
		
		
		//*/
		


		$query_study = $this->db->query("SELECT 
									major_cat,id 
									FROM study
									order by major_cat asc");
		$res_study = $query_study->result_array();

		/*
		//$university = json_encode($res_university);
		foreach($res_study as $result){
			$study_arr[] = $result['major_cat'];
		}
		*/

		//$study_arr = json_encode($study_arr);
		//$data['studys'] = $res_study;
		
		//*
		
		foreach($res_study as $result){
			$study_arr[] = $result['major_cat'];
		}

		$study_arr = json_encode($study_arr);
		$data['study'] = $study_arr;
		
		
		//*/

		$query_industry = $this->db->query("SELECT 
									name,id 
									FROM industry
									order by name asc");
		$res_industry = $query_industry->result_array();
		/*	
		//$university = json_encode($res_university);
		foreach($res_industry as $result){
			$industry_arr[] = $result['name'];
		}
		*/
		//$industry_arr = json_encode($industry_arr);
		//$data['industrys'] = $res_industry;
		
		//*
		
		foreach($res_industry as $result){
			$industry_arr[] = $result['name'];
		}

		$industry_arr = json_encode($industry_arr);
		$data['industry'] = $industry_arr;
		
		
		//*/
		
		
		$query_salarys = $this->db->query("SELECT 
									description,id 
									FROM SalaryRanges
									order by id asc");
		$res_salarys = $query_salarys->result_array();
		
		$data['salarys'] = $res_salarys;
		
		//*
		
		foreach($res_salarys as $result){
			$salarys_arr[] = $result['description'];
		}

		$salarys_arr = json_encode($salarys_arr);
		//$data['salarys'] = $salarys_arr;
		
		
		//*/
		
		
		$query_mrels = $this->db->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel
									order by id asc");
		$res_mrels = $query_mrels->result_array();
		
		$data['MostRecentExpLevelIDs'] = $res_mrels;
		//*
		
		foreach($res_mrels as $result){
			$mrels_arr[] = $result['description'];
		}

		$mrels_arr = json_encode($mrels_arr);
		//$data['mrels'] = $mrels_arr;
		
		
		//*/
		
		
		$query_amazons = $this->db->query("SELECT 
									description,id 
									FROM LocalAmazon
									order by id asc");
		$res_amazons = $query_amazons->result_array();
		
		$data['amazons'] = $res_amazons;
		
		//
		$query_designations = $this->db->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations
									order by id asc");
		$res_designations = $query_designations->result_array();
		
		//$data['designations'] = $res_designations;
		
		
		//*
		
		foreach($res_designations as $result){
			$designations_arr[] = $result['CertificateDesignationName']." - ".$result['Abbreviation'];
		}

		$designations_arr = json_encode($designations_arr);
		$data['designations'] = $designations_arr;
		
		
		//*/
		
		
		$query_performances = $this->db->query("SELECT 
									description,id 
									FROM Performance_Rating
									order by id asc");
		$res_performances = $query_performances->result_array();
		
		$data['performances'] = $res_performances;
		//*
		
		foreach($res_performances as $result){
			$performances_arr[] = $result['description'];
		}

		$performances_arr = json_encode($performances_arr);
		//$data['performances'] = $performances_arr;
		
		
		//*/
		
		
		$query_expertises = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role
									order by id asc");
		$res_expertises = $query_expertises->result_array();
		
		//$data['expertises'] = $res_expertises;
		//
		//*
		
		foreach($res_expertises as $result){
			$expertises_arr[] = $result['description'];
		}

		$expertises_arr = json_encode($expertises_arr);
		$data['expertises'] = $expertises_arr;
		
		
		//*/


		$query_occupation = $this->db->query("SELECT 
									name 
									FROM occupation
									order by name asc");
		$res_occupation = $query_occupation->result_array();

		//$university = json_encode($res_university);
		foreach($res_occupation as $result){
			$occupation_arr[] = $result['name'];
		}

		$occupation_arr = json_encode($occupation_arr);
		$data['occupation'] = $occupation_arr;

		$this->load->view('header');
		$this->load->view('register_optional', $data);
		$this->load->view('footer', $data);
	}
	
	
	public function self($order_id=0)
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
		
		if($_POST)
		{
			
			$this->db->set('status', 'In Process');
			$this->db->where("order_id= '".$order_id."' and assessment_type = 'Self Assessment' ");
			$this->db->update('orders_assessment_type');
			redirect(base_url().'selfassessment/'.$order_id, 'refresh');
		}
		
		$data['order_id'] = $order_id;
		$this->load->view('header');
		$this->load->view('register_self', $data);
		$this->load->view('footer');
	}
	
	public function professional($order_id=0)
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
		
		if($_POST)
		{
			$this->db->set('status', 'In Process');
			$this->db->where("order_id= '".$order_id."' and assessment_type = 'OrgInsights Assessment' ");
			$this->db->update('orders_assessment_type');
			redirect(base_url().'selfassessment/professional/'.$order_id, 'refresh');
		}
		$data['order_id'] = $order_id;
		$this->load->view('header');
		$this->load->view('register_professional', $data);
		$this->load->view('footer');
	}
	
	public function orginsights($order_id=0)
	{
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'register', 'refresh');
		}
		
		if($_POST)
		{
			$this->db->set('status', 'In Process');
			$this->db->where("order_id= '".$order_id."' and assessment_type = '360 Assessment' ");
			$this->db->update('orders_assessment_type');
			redirect(base_url().'selfassessment/thirdparty/'.$order_id, 'refresh');
		}
		$data['order_id'] = $order_id;
		$this->load->view('header');
		$this->load->view('register_thirdparty', $data);
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
