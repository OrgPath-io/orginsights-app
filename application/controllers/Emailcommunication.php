<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailcommunication extends CI_Controller {

	public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('email_communication');
		$this->load->view('footer');
	}
}
