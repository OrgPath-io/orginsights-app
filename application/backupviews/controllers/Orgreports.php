<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orgreports extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'', 'refresh');
		}
	}
	
	public function index($order_id = 0,$perccheck = 0)
	{
		$perccheck+=2;
		
		$data['order_id'] = $order_id;
		$data['perccheck'] = $perccheck;
		
		
		
		$this->load->view('orgreports', $data);
		
	}
	
}
