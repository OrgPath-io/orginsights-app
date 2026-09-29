<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thankyou extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'login', 'refresh');
		}
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('thankyou');
		$this->load->view('footer');
	}
	public function a360()
	{
		$data=array();
		$data["page"]="3";
		$this->load->view('header');
		$this->load->view('thankyou',$data);
		$this->load->view('footer');
	}
	public function orginsights()
	{
		$data=array();
		$data["page"]="2";
		$this->load->view('header');
		$this->load->view('thankyou',$data);
		$this->load->view('footer');
	}
}
