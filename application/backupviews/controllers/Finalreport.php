<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finalreport extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'', 'refresh');
		}
	}
	
	public function index($order_id = 0)
	{
		$data['order_id'] = $order_id;
		
		//
		$query_university = $this->db->query("SELECT 
									REPLACE(university,'?','') as university,id 
									FROM university order by university asc");
		$res_university = $query_university->result_array();

		
		
		foreach($res_university as $result){
			$university_arr[] = $result['university'];
		}

		$university_arr = json_encode($university_arr);
		$data['university'] = $university_arr;
		//
		
		$query_study = $this->db->query("SELECT 
									major_cat,id 
									FROM study
									order by major_cat asc");
		$res_study = $query_study->result_array();

		
		
		foreach($res_study as $result){
			$study_arr[] = $result['major_cat'];
		}

		$study_arr = json_encode($study_arr);
		$data['study'] = $study_arr;
		//
		
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
		
		//
		//*/

		$query_industry = $this->db->query("SELECT 
									name,id 
									FROM industry
									order by name asc");
		$res_industry = $query_industry->result_array();
		
		
		foreach($res_industry as $result){
			$industry_arr[] = $result['name'];
		}

		$industry_arr = json_encode($industry_arr);
		$data['industry'] = $industry_arr;
		
		
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
		//
		
		//$this->load->view('header');
		$this->load->view('finalreportg', $data);
		$this->load->view('graphfooter');
	}
}
