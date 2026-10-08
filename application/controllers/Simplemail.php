<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simplemail extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'login', 'refresh');
		}
		include("fixgroupby.php");
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('simplemail');
		$this->load->view('footer');
	}
	
}
