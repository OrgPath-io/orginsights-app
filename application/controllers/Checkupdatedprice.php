<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkupdatedprice extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'', 'refresh');
		}
	}
	
	public function index($order_id = 0,$perccheck = 0)
	{
		$data['order_id'] = $order_id;
		$data['perccheck'] = $perccheck;
		
		//$this->load->view('header');
		$this->load->view('checkupdatedprice', $data);
		//$this->load->view('footer');
	}
}
