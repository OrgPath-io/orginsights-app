<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
					if(isset($_POST["insertform"]) && (int)$_POST["insertform"]==1)
					{
						$con=$this->db;
						$con->where('email', $_POST["email"]);
						$con->where('user_id!=', (int)$_REQUEST['id']);
						$checknamesQ=$con->get("users");
						$checknames=$checknamesQ->row_array();
						if($checknames!="")
						{
							$data['ThanksText'] = "<p style='color:red;font-weight:bold;'>Email Already Exist!</p>";
						}
						else
						{
						if(isset($_REQUEST['id']) && (int)$_REQUEST['id'] > 0)
						{
							$this->db->set('first_name', $_POST["first_name"]);
							$this->db->set('last_name', $_POST["last_name"]);
							$this->db->set('email', $_POST["email"]);
							$this->db->set('country_id', $_POST["country_id"]);
							$this->db->set('province', $_POST["province"]);
							$this->db->set('city', $_POST["city"]);
							$this->db->set('is_active', $_POST["is_active"]);
							$this->db->where('user_id', (int)$_REQUEST['id']);
							$this->db->update('users');
							
							$data['ThanksText'] = "<p align='center' class='thankstext'>User Details Updated</p>";
							
							if(isset($_POST["ChangePassword"]) && (int)$_POST["ChangePassword"] > 0)
							{
								$temp_string = uniqid(uniqid());
								$this->db->set('temp_string', $temp_string);
								$this->db->where('user_id', (int)$_REQUEST['id']);
								$this->db->update('users');
							}
						}
						else
						{
							$data=array();
							$data['first_name']=$_POST["first_name"];
							$data['last_name']=$_POST["last_name"];
							$data['email']=$_POST["email"];
							$data['country_id']=$_POST["country_id"];
							$data['province']=$_POST["province"];
							$data['city']=$_POST["city"];
							$data['is_active']=$_POST["is_active"];
							$data['password']=md5($_POST["password"]);
							$data['created_date']=date("Y-m-d H:i:s");
							$data['signup_via']			=	'system';
							$this->db->insert('users', $data);
							
							
							
							$data['ThanksText'] = "<p align='center' class='thankstext'>User Added</p>";
						}
						}
					}
					
					$query_country = $this->db->query("SELECT 
									country,id 
									FROM countries
									order by country asc");
					$res_country = $query_country->result_array();
					
					$data['country'] = $res_country;
					
					$country_id=39;
					$data['country_id'] = $country_id;
					$province=0;
					$data['city'] =0;
					$data['isActive'] =0;
					
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
					
					$query_province=$this->db->query("select * from provinces where countryid='".(int)$country_id."' order by province_name");
					$res_province = $query_province->result_array();
					
					$data['Province'] = $res_province;
					
					
					$query_city=$this->db->query("select * from Cities where ProvinceID='".(int)$province."' order by description");
					$res_city = $query_city->result_array();
					
					$data['Cities'] = $res_city;
					
					$this->load->view("user",$data);
	}
}
