<?php

class Site_usersModel extends CI_Model{

	public function __construct(){
		
		 parent::__construct();
		
	}
	
	// get single User
	public function check_user_existance($email){
		$sql="SELECT user_id FROM users where email = '".$email."' limit 1";			
		$query=$this->db->query($sql);
		
		if($query->num_rows() > 0)
		{
			$data=$query->row_array();
		}else{
			$data = false;
		}
		return $data;
	}

		
}
