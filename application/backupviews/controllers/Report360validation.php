<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report360validation extends CI_Controller {

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
	
		$this->load->view('header');
		$this->load->view('report360validation', $data);
		$this->load->view('footer');
	}
}
