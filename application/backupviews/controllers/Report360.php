<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report360 extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'', 'refresh');
		}
	}
	
	/*public function index($order_id = 0)
	{
		$data['order_id'] = $order_id;
		
		$this->load->view('header');
		$this->load->view('report360', $data);
		$this->load->view('footer');
	}*/
	public function index($order_id = 0,$perccheck = 0)
	{
		$stream=1;
		if((int)$perccheck > 1)
		{
			$perccheck-=2;
			$stream=0;
		}
		$data['stream'] = $stream;
		$data['order_id'] = $order_id;
		$data['perccheck'] = $perccheck;
		
		$this->load->view('report360', $data);
		
	}
}
