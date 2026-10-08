<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {

	public function __construct(){
		parent::__construct();
	include("fixgroupby.php");
	}

	public function index()
	{
		$this->load->library('session');
		$this->load->model('Site_usersModel');
		if($this->session->userdata('user_id')){
			redirect(base_url());
		}
		$error = '';
		$success = '';
		if($_POST)
		{

if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],"app.orginsights.io") > 0)
{
}
else
{
	echo "Access Denied";
	die();
}


			try{
				$data=array();
				$data['email']				=	trim($this->input->get_post('email'));

				$error = '';
				if($error == '')
				{
					$query_user = $this->db->query("select user_id
													, first_name
													, last_name
													, email
													from users
													where email = '".$data['email']."' limit 1");
					if($query_user->num_rows() > 0)
					{
						$row_user = $query_user->row();
						$temp_string = uniqid(uniqid());
						$this->db->set('temp_string', $temp_string);
						$this->db->where('user_id', $row_user->user_id);
						$this->db->update('users');
						$this->load->library('email');
						$config = array();
						$config['protocol'] = 'smtp';
						$config['smtp_host'] = 'mail.authsmtp.com';
						$config['smtp_user'] = 'ac78416';
						$config['smtp_pass'] = 'grab-vixen-wreak-wi';
						$config['smtp_port'] = 25;
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");


						$this->email->from('info@orginsights.io', 'Orginsights');
						$this->email->to($row_user->email);
						//$this->email->cc('another@another-example.com');
						//$this->email->bcc('them@their-example.com');

						$this->email->subject('Forgot Password '.$row_user->first_name.' '.$row_user->last_name);
						
						$fmessage='Hi '.$row_user->first_name.',
						<br><br>
						We heard you can\'t get into your account. That sucks, but we are here to help. Please click the link below to reset your password.
						<br><br>
						Click <a href="'.base_url().'forgotpassword/setpassword/'.$temp_string.'" target="blank">Here</a>
						<br><br>
						Thanks!<br>OrgInsights Admin';
						
						$this->email->message($fmessage);

						$this->email->send();
						$success = 'For Password reset email has been sent to your email address!';


					}else{
						$error = 'Email does not exist!';
					}
				}
			}catch(Exception $e){
				$data['status']='FAILURE';
				$data['message']='Error Occured';
			}
		}else{
			if($this->session->userdata('user_id')){
				redirect(base_url());
			}
		}
		$data['success'] = $success;
		$data['error'] = $error;
		$this->load->view('header');
		$this->load->view('forgotpassword', $data);
		$this->load->view('footer');
	}

	public function setpassword($temp_string='')
	{

		$this->load->library('session');
		$this->load->model('Site_usersModel');
		if($this->session->userdata('user_id')){
			redirect(base_url());
		}



		try{

			$data=array();
			$error = '';

			if($_POST)
			{
				$data['email']				=	trim($this->input->get_post('email'));
				$data['password']			=	trim($this->input->get_post('password'));


				$error = '';
				if($data['password'] == '' && $data['password'] != trim($this->input->get_post('confirm_password')) ){
					$error .='Please Enter a valid Password. <br/>';
				}else{
					$data['password'] = md5($data['password']);
				}

				$query_user = $this->db->query("select user_id
													, first_name
													, last_name
													, email
													, country_id
													, ref_code
													from users
													where email = '".$data['email']."' limit 1");



				if($query_user->num_rows() > 0)
				{
					$row_user = $query_user->row();

					$data['user'] = $row_user;

					$this->db->set('password', $data['password'] );
					$this->db->set('temp_string', '' );
					$this->db->where('user_id', $row_user->user_id);
					$this->db->update('users');

					$this->session->set_userdata('user_auth','1');
					$this->session->set_userdata('site_user_name',$row_user->email);
					$this->session->set_userdata('first_name',$row_user->first_name);
					$this->session->set_userdata('last_name',$row_user->last_name);

					$this->session->set_userdata('full_name',$row_user->first_name.' '.$row_user->last_name);
					$this->session->set_userdata('user_id',$row_user->user_id);
					$this->session->set_userdata('country',$row_user->country_id);
					$this->session->set_userdata('ref_code',$row_user->ref_code);
					redirect(base_url(), 'refresh');
					exit();


				}else{
					$error = 'Email does not exist!';
				}


			}else{

				if($temp_string == ''){
					redirect(base_url());
				}
				$query_user = $this->db->query("select user_id
													, first_name
													, last_name
													, email
													, country_id
													, ref_code
													, password
													from users
													where temp_string = '".$temp_string."' limit 1");



				if($query_user->num_rows() > 0)
				{
					$row_user = $query_user->row();

					$data['user'] = $row_user;



				}else{
					$error = 'The link has been expired!';
					redirect(base_url());
					exit();
				}
			}
		}catch(Exception $e){
			$data['status']='FAILURE';
			$data['message']='Error Occured';
		}

		$data['error'] = $error;
		$this->load->view('header');
		$this->load->view('setpassword', $data);
		$this->load->view('footer');

	}


}
