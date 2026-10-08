<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports360 extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == '' && (int)$this->session->userdata('appAdminadminlog')==0){
			redirect(base_url().'', 'refresh');
		}
		include("fixgroupby.php");
	}
	
	public function index($order_id = 0,$perccheck = 0)
	{
		$perccheck+=2;
		
		$data['order_id'] = $order_id;
		$data['perccheck'] = $perccheck;
		
		
		
		$this->load->view('reports360', $data);
		
	}
	
}
