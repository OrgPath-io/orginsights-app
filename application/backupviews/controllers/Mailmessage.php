<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailmessage extends CI_Controller {

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
		$this->load->view('mailmessage');
		$this->load->view('footer');
	}
	
}
