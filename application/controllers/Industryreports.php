<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Industryreports extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		
	}
	
	public function index($uniqueid)
	{
		$stream=0;
		$data['stream'] = $stream;
		
		//$data['order_id'] = $order_id;
		$data['perccheck'] = 1;
		
		$duniqueid=hex2bin($uniqueid);
		
		$order_id=end(explode("@",$duniqueid));
		
		$data['order_id'] = $order_id;
		
		//echo $order_id; die();
		
		$data['dontchecklogin'] =1;
		
		$this->load->view('industryreport', $data);
		
	}
	
}
