<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkuserexists extends CI_Controller {

	public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}
	
	public function index()
	{
		$this->load->library('session');
		$this->load->model('Site_usersModel');
		$error = '';
		if($_REQUEST)
		{
			try{
				$data=array();
				$data['email']				=	trim($_REQUEST['email']);
				
				if($error == '')
				{
					$check_user = $this->Site_usersModel->check_user_existance($data['email']);
					if($check_user !== false)
					{
						$error .='Email Already Exist! <br/>';
					}
				}
				
				
			}catch(Exception $e){
				
			}
		}else{
			
		}
		
		echo $error;
		
	}
	
	
	
	
	
}
