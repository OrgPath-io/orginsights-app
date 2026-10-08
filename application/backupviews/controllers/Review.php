<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

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
		$this->load->view('review', $data);
		$this->load->view('footer');
	}
	public function self($order_id = 0)
	{
		$data['order_id'] = $order_id;
		
		$this->load->view('header');
		$this->load->view('self_review', $data);
		$this->load->view('footer');
	}
	public function orginsights($order_id = 0)
	{
		$data['order_id'] = $order_id;
		
		$this->load->view('header');
		$this->load->view('professional_review', $data);
		$this->load->view('footer');
	}
	public function a360($order_id = 0)
	{
		$data['order_id'] = $order_id;
		
		$this->load->view('header');
		$this->load->view('third_party_review', $data);
		$this->load->view('footer');
	}
}
