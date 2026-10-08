<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testcalendly extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'login', 'refresh');
		}
	}
	
	public function index()
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

$query_number_of_orders = $this->db->query("SELECT * from orders where user_id = ".$this->session->userdata('user_id')."  and order_package_id < 7 order by order_id desc");

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
		$this->load->view('calendlyfunction', $data);
		$this->load->view('footer');
	}
}
