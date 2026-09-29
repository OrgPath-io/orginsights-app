<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thirdparty extends CI_Controller {

		public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($order_id = 0)
	{
	
		if((int)$_POST['ID']<=0)
		{
			include("setmessage.php");
			$ID=$this->db->insert_id();
		}
		else
		{
			$ID=(int)$_POST['ID'];
			include("setmessage.php");
		}
		$this->session->set_userdata('MessageID',(int)$ID);
	
		$data['order_id'] = $order_id;
		$data["page"]="3";
		$this->load->view('header');
		$this->load->view('thirdpartymail', $data);
		$this->load->view('footer');
	}
}
