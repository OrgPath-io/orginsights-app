<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Industryreport extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'', 'refresh');
		}
	}
	
	public function index($order_id = 0,$perccheck = 1)
	{
		$stream=0;
		$data['stream'] = $stream;
		
		//$data['order_id'] = $order_id;
		$data['perccheck'] = $perccheck;
		$data['order_id'] = $order_id;
		
		$this->load->view('industryreport', $data);
		
	}
	
}
