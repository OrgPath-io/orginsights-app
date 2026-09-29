<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Showpdf extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'', 'refresh');
		}
		include("fixgroupby.php");
	}
	
	public function index($order_id = 0,$perccheck = 0,$pdftype = 0)
	{
		$data['order_id'] = $order_id;
		$data['perccheck'] = $perccheck;
		$data['pdftype'] = $pdftype;
		
		$this->load->view('showpdf', $data);
		
	}
	
}
