<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finalreportperc extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'', 'refresh');
		}
		include("fixgroupby.php");
	}
	
	public function index($order_id = 0)
	{
		$data['order_id'] = $order_id;
		
		
$user_id=(int)$this->session->userdata('user_id');

$getRecQ=$this->db->query("SELECT * FROM users where user_id = '".$user_id."' limit 0,1");
$getRecR=$getRecQ->result_array();
foreach($getRecR as $key=>$value)
{
	$user_countryid=(int)$value["country_id"];
	$user_provinceid=(int)$value["province"];
	$user_cityid=(int)$value["city"];
	$user_ageid=(int)$value["age_range"];
	$user_hleid=(int)$value["hle"];
	$user_universityid=(int)$value["university"];
	$user_studyid=(int)$value["program_study"];
	$user_designationid=(int)$value["designation"];
	$user_expid=(int)$value["MostRecentExpLevelID"];
	$user_Performanceid=(int)$value["Performance_rating"];
	$user_industryid=(int)$value["industry_employer"];
	$user_expertiseid=(int)$value["expertise_role"];
	$user_graduationid=(int)$value["graduation_year"];
	$user_salaryid=(int)$value["salary_range"];
}

$user_designationid=0;
$designationsIDs="0";
$query_desigidQ = $this->db->query("SELECT 
									DesignationID 
									FROM UsersDesignations where UserID=".(int)$this->session->userdata('user_id'));
$res_desigidR = $query_desigidQ->result_array();
foreach($res_desigidR as $result1){

	$designationsIDs.=",".(int)$result1['DesignationID'];
	$user_designationid++;
}	
		
		//
		$query_university = $this->db->query("SELECT 
									REPLACE(university,'?','') as university,id 
									FROM university
									where id=".$user_universityid."
									order by university asc");
		$res_university = $query_university->result_array();

		
		
		foreach($res_university as $result){
			$university_arr[] = $result['university'];
		}

		$university_arr = json_encode($university_arr);
		$data['university9'] = $university_arr;
		//
		
		$query_study = $this->db->query("SELECT 
									major_cat,id 
									FROM study where id=".$user_studyid."
									order by major_cat asc");
		$res_study = $query_study->result_array();

		
		
		foreach($res_study as $result){
			$study_arr[] = $result['major_cat'];
		}

		$study_arr = json_encode($study_arr);
		$data['study9'] = $study_arr;
		//
		
		//
		$query_designations = $this->db->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations where id IN (".$designationsIDs.")
									order by id asc");
		$res_designations = $query_designations->result_array();
		
		//$data['designations'] = $res_designations;
		
		
		//*
		
		foreach($res_designations as $result){
			$designations_arr[] = $result['CertificateDesignationName']." - ".$result['Abbreviation'];
		}

		$designations_arr = json_encode($designations_arr);
		$data['designations9'] = $designations_arr;
		
		//
		//*/

		$query_industry = $this->db->query("SELECT 
									name,id 
									FROM industry where id=".$user_industryid."
									order by name asc");
		$res_industry = $query_industry->result_array();
		
		
		foreach($res_industry as $result){
			$industry_arr[] = $result['name'];
		}

		$industry_arr = json_encode($industry_arr);
		$data['industry9'] = $industry_arr;
		
		
		//*/
		$query_expertises = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role where id=".$user_expertiseid."
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
		//
		
		$this->load->view('header');
		$this->load->view('finalreportperc', $data);
		$this->load->view('footer');
	}
}
