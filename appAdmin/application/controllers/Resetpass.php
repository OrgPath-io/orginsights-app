<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpass extends CI_Controller {

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
	public function index()
	{
		$this->load->library('session');
		
		
					$data['ThanksText'] = "";
					$_POST["insertform"]=1;
					if(isset($_POST["insertform"]) && (int)$_POST["insertform"]==1)
					{
						$password = uniqid();
						
						if(isset($_REQUEST['id']) && (int)$_REQUEST['id'] > 0)
						{
							$this->db->set('password', md5($password));
							$this->db->where('user_id', (int)$_REQUEST['id']);
							$this->db->update('users');
							
							$data['ThanksText'] = "<p align='center' class='thankstext'>Password Updated</p>
							<p align='center' class='thankstext'>
							<a href='/appAdmin/index.php/users/'>Back to users list</a>
							</p>
							";
							
							$data['password'] = $password;
						}
						
						
					}
					
					$NAME="";
					if(isset($_REQUEST['id']) && (int)$_REQUEST['id'] > 0)
					{
						$checkusersQ=$this->db->query("select * from users where user_id=".(int)$_REQUEST['id']);
						
						$checkusers=$checkusersQ->row_array();
						
						if($checkusers!="")
						{
							$data['first_name'] =$checkusers["first_name"];
							$data['last_name'] =$checkusers["last_name"];
							$data['email'] =$checkusers["email"];
							$data['country_id'] =$checkusers["country_id"];
							$data['province'] =$checkusers["province"];
							$data['city'] =$checkusers["city"];
							$data['isActive'] =$checkusers["is_active"];
							
							$NAME=$checkusers["first_name"]." ".$checkusers["last_name"];
							
							$data['NAME'] =$NAME;
							
							$country_id=(int)$checkusers["country_id"];
							$province=(int)$checkusers["province"];
						}
					}
					
					$this->load->view("resetpass",$data);
	}
}
