<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Savemessage extends CI_Controller {

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
	
		
		$data['id'] = (int)$order_id;
		$this->session->set_userdata('MessageID',(int)$order_id);
		//$this->load->view('header');
		$this->load->view('savemessage', $data);
		//$this->load->view('footer');
		
	}
}
