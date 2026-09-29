<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv_todb extends CI_Controller {

	public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}

	public function index()
	{
		$csv = base_url("asset/university.csv");;

		$handle = fopen($csv,"r");
		while (($row = fgetcsv($handle, 100000, ",")) != FALSE) //get row vales
		{
			print_r($row); //rows in array
			$data['country'] = $row[0];
			$data['university'] = $row[1];
			//$this->db->insert('university', $data);
			//here you can manipulate the values by accessing the array


		}
	}

	public function study()
	{
		$csv = base_url("asset/study.csv");;

		$handle = fopen($csv,"r");
		while (($row = fgetcsv($handle, 100000, ",")) != FALSE) //get row vales
		{
			print_r($row); //rows in array
			$data['major_cat'] = $row[0];
			$data['sub_cat'] = $row[1];
			//$this->db->insert('study', $data);
			//here you can manipulate the values by accessing the array


		}
	}

	public function certificate()
	{
		$csv = base_url("asset/certificate.csv");;

		$handle = fopen($csv, "r");
		while (($row = fgetcsv($handle, 100000, ",")) != FALSE) //get row vales
		{
			print_r($row); //rows in array
			$data['category'] = $row[0];
			$data['certificate_designation_name'] = $row[1];
			$data['abbreviation'] = $row[2];
			//$this->db->insert('certificate', $data);
			//here you can manipulate the values by accessing the array


		}
	}

	public function companies()
	{
		$csv = base_url("asset/companies.csv");;

		$handle = fopen($csv,"r");
		while (($row = fgetcsv($handle, 100000, ",")) != FALSE) //get row vales
		{
			print_r($row); //rows in array
			$data['name'] = $row[0];
			$data['country'] = $row[1];

			//$this->db->insert('companies', $data);
			//here you can manipulate the values by accessing the array


		}
	}

	public function industry()
	{
		$csv = base_url("asset/industry.csv");;

		$handle = fopen($csv,"r");
		while (($row = fgetcsv($handle, 100000, ",")) != FALSE) //get row vales
		{
			print_r($row); //rows in array
			$data['name'] = $row[0];


			//$this->db->insert('industry', $data);
			//here you can manipulate the values by accessing the array


		}
	}

	public function occupation()
	{
		$csv = base_url("asset/occupation.csv");;

		$handle = fopen($csv,"r");
		while (($row = fgetcsv($handle, 100000, ",")) != FALSE) //get row vales
		{
			print_r($row); //rows in array
			$data['name'] = $row[0];


			//$this->db->insert('occupation', $data);
			//here you can manipulate the values by accessing the array


		}
	}



}
