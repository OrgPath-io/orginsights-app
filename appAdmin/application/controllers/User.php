<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('session');
		
		
					$data['ThanksText'] = "";
					if(isset($_POST["insertform"]) && (int)$_POST["insertform"]==1)
					{
						$con=$this->db;
						$con->where('email', $_POST["email"]);
						$con->where('user_id!=', (int)$_REQUEST['id']);
						$checknamesQ=$con->get("users");
						$checknames=$checknamesQ->row_array();
						if($checknames!="")
						{
							$data['ThanksText'] = "<p style='color:red;font-weight:bold;'>Email Already Exist!</p>";
						}
						else
						{
						
							//
							$universityID=0;
							$univer=explode(" - ",$_POST['university']." - ");
					
							$query_cities = $this->db->query("SELECT 
													university,id,ccode  
													FROM university where university='".trim($univer[0])."'
													order by id asc");
							$res_cities = $query_cities->result_array();
							if($res_cities[0]['university']!="")
							{
								$universityID=$res_cities[0]['id'];
								
								
							}
							else
							{
								$data=array();
								$data['university']=trim($_POST['university']);
								$this->db->insert('university', $data);
								$universityID=$this->db->insert_id();
							}
							//
							//
			$studyID=0;
					
			$query_cities = $this->db->query("SELECT 
									major_cat,id 
									FROM study where major_cat='".trim($_POST['study'])."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['major_cat']!="")
			{
				$studyID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['major_cat']=trim($_POST['study']);
				$this->db->insert('study', $data);
				$studyID=$this->db->insert_id();
			}
			
			//
			$designationsID=0;
$query_cities = $this->db->query("SELECT 
										CertificateDesignationName,id 
										FROM Designations where CertificateDesignationName='".$_POST["designation"]."'
										order by id asc");
						$res_cities = $query_cities->result_array();
						if($res_cities[0]['CertificateDesignationName']!="")
						{
							$designationsID=$res_cities[0]['id'];
						}
						else
						{
							$data=array();
							$data['CertificateDesignationName']=$_POST["designation"];
							
							$this->db->insert('Designations', $data);
							$designationsID=$this->db->insert_id();
						}
						//
						//
			$employersID=0;
					
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Employers where description='".trim($_POST['most_recent_employer'])."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$employersID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($_POST['most_recent_employer']);
				$this->db->insert('Employers', $data);
				$employersID=$this->db->insert_id();
			}
			
			//
			//
			$industryID=0;
					
			$query_cities = $this->db->query("SELECT 
									name,id 
									FROM industry where name='".trim($_POST['industry_employer'])."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['name']!="")
			{
				$industryID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['name']=trim($_POST['industry_employer']);
				$this->db->insert('industry', $data);
				$industryID=$this->db->insert_id();
			}
			
			//
			//
			$expertisesID=0;
					
			$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role where description='".trim($_POST['expertise_role'])."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$expertisesID=$res_cities[0]['id'];
			}
			else
			{
				$data=array();
				$data['description']=trim($_POST['expertise_role']);
				$this->db->insert('Expertise_Role', $data);
				$expertisesID=$this->db->insert_id();
			}
			//
						//print_r($_POST);
						//check fields entered/selected
						$ActualTicks=0;	
						if($_POST["province"]!="" && $_POST["province"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["city"]!="" && $_POST["city"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["age_range"]!="" && $_POST["age_range"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["visible_minorities"]!="" && $_POST["visible_minorities"]=="No")
						{
							$ActualTicks++;
						}
						else if($_POST["visible_minorities"]!="" && $_POST["visible_minorities"]=="Yes")
						{
							if($_POST["visible_minorities_option"]!="" && $_POST["visible_minorities_option"]!="0")
							{
								$ActualTicks++;
							}
						}
						if($_POST["hle"]!="" && $_POST["hle"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["university"]!="" && $_POST["university"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["graduation_year"]!="" && $_POST["graduation_year"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["study"]!="" && $_POST["study"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["designation"]!="" && $_POST["designation"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["MostRecentExpLevelID"]!="" && $_POST["MostRecentExpLevelID"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["most_recent_employer"]!="" && $_POST["most_recent_employer"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["performance_rating"]!="" && $_POST["performance_rating"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["industry_employer"]!="" && $_POST["industry_employer"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["expertise_role"]!="" && $_POST["expertise_role"]!="0")
						{
							$ActualTicks++;
						}
						if($_POST["salary_range"]!="" && $_POST["salary_range"]!="0")
						{
							$ActualTicks++;
						}
						//end check fields entered/selected
						
						if(isset($_REQUEST['id']) && (int)$_REQUEST['id'] > 0)
						{
							$this->db->set('first_name', $_POST["first_name"]);
							$this->db->set('last_name', $_POST["last_name"]);
							$this->db->set('email', $_POST["email"]);
							$this->db->set('country_id', $_POST["country_id"]);
							$this->db->set('province', $_POST["province"]);
							$this->db->set('city', $_POST["city"]);
							$this->db->set('is_active', $_POST["is_active"]);
							$this->db->where('user_id', (int)$_REQUEST['id']);
							
							//
							$this->db->set('age_range', $_POST["age_range"]);
							$this->db->set('visible_minorities', $_POST["visible_minorities"]);
							$this->db->set('visible_minorities_option', $_POST["visible_minorities_option"]);
							$this->db->set('hle', $_POST["hle"]);
							$this->db->set('university', (int)$universityID);
							$this->db->set('graduation_year', (int)$_POST["graduation_year"]);
							$this->db->set('program_study', (int)$studyID);
							$this->db->set('designation', (int)$designationsID);
							$this->db->set('MostRecentExpLevelID', $_POST["MostRecentExpLevelID"]);
							$this->db->set('performance_rating', $_POST["performance_rating"]);
							$this->db->set('salary_range', $_POST["salary_range"]);
							
							$this->db->set('most_recent_employer', (int)$employersID);
							$this->db->set('industry_employer', (int)$industryID);
							$this->db->set('expertise_role', (int)$expertisesID);
							
							$this->db->set('TotalFieldsEntered', (int)$ActualTicks);
							
							$this->db->update('users');
							
							$data['ThanksText'] = "<p align='center' class='thankstext'>User Details Updated</p>";
							
							/*
							if(isset($_POST["ChangePassword"]) && (int)$_POST["ChangePassword"]==1)
							{
								$temp_string = uniqid(uniqid());
								$this->db->set('temp_string', $temp_string);
								$this->db->where('user_id', (int)$_REQUEST['id']);
								$this->db->update('users');
							}
							*/
							if(isset($_POST["ChangePassword"]) && (int)$_POST["ChangePassword"] > 0)
							{
								//echo $_POST["password"];
								$temp_string = uniqid(uniqid());
								$this->db->set('password', md5($_POST["password"]));
								$this->db->where('user_id', (int)$_REQUEST['id']);
								$this->db->update('users');
							}
						}
						else
						{
							$data=array();
							$data['first_name']=$_POST["first_name"];
							$data['last_name']=$_POST["last_name"];
							$data['email']=$_POST["email"];
							$data['country_id']=$_POST["country_id"];
							$data['province']=$_POST["province"];
							$data['city']=$_POST["city"];
							$data['is_active']=$_POST["is_active"];
							$data['password']=md5($_POST["password"]);
							$data['created_date']=date("Y-m-d H:i:s");
							$data['signup_via']			=	'system';
							$this->db->insert('users', $data);
							
							
							
							$data['ThanksText'] = "<p align='center' class='thankstext'>User Added</p>";
						}
						}
					}
					
					$query_country = $this->db->query("SELECT 
									country,id 
									FROM countries
									order by country asc");
					$res_country = $query_country->result_array();
					
					$data['country'] = $res_country;
					
					$country_id=39;
					$data['country_id'] = $country_id;
					$province=0;
					$data['city'] =0;
					$data['isActive'] =0;
					
					$NAME="";
					if(isset($_REQUEST['id']) && (int)$_REQUEST['id'] > 0)
					{
						$checkusersQ=$this->db->query("select * from users where user_id=".(int)$_REQUEST['id']);
						
						$checkusers=$checkusersQ->row_array();
						
						if($checkusers!="")
						{
							$NAME=$checkusers["first_name"]." ".$checkusers["last_name"];
							$data['NAME'] =$NAME;
							
							$country_id=(int)$checkusers["country_id"];
							$province=(int)$checkusers["province"];
							
							foreach($checkusers as $key=>$value)
							{
								$data[$key]=$value;
								
								//echo $key."<br>";
							}

							
						}
					}
					
					
					$query_province=$this->db->query("select * from provinces where countryid='".(int)$country_id."' order by province_name");
					$res_province = $query_province->result_array();
					
					$data['Province'] = $res_province;
					
					
					$query_city=$this->db->query("select * from Cities where ProvinceID='".(int)$province."' order by description");
					$res_city = $query_city->result_array();
					
					$data['Cities'] = $res_city;
					
					//
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
		$data['universitys'] = $university_arr;
		
		
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
					//
					
					$this->load->view("user",$data);
	}
}
