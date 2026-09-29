<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
	}
	
	
	public function index()
	{
		$this->load->library('session');
		
		
		$this->session->unset_userdata('user_auth');
		$this->session->unset_userdata('site_user_name');
		$this->session->unset_userdata('full_name');
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		
		
		
		redirect(base_url().'login','refresh'); 
    }	
	
}
