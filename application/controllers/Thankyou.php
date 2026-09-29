<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thankyou extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == ''){
			redirect(base_url().'login', 'refresh');
		}
		include("fixgroupby.php");
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('thankyou');
		$this->load->view('footer');
	}
	public function a360()
	{
		$data=array();
		$data["page"]="3";
		$this->load->view('header');
		$this->load->view('thankyou',$data);
		$this->load->view('footer');
	}
	public function orginsights()
	{
		$data=array();
		$data["page"]="2";
		$this->load->view('header');
		
		//send email for industry report
		$user_id=(int)$this->session->userdata('user_id');
		
		$this->db->select('first_name');
		$this->db->select('last_name');
		$this->db->select('email');
		$this->db->where('user_id', (int)$user_id);
		$chkusers = $this->db->get('users', 0, 1);
		$chkusersf=$chkusers->result_array();
		
		
		
		$first_name=$chkusersf[0]["first_name"];
		$last_name=$chkusersf[0]["last_name"];
		$email=$chkusersf[0]["email"];
		$email_s=explode("@",$email."@");
		
		$this->db->select('order_id');
		$this->db->select('order_package_id');
		$this->db->select('order_date');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("order_id desc");
		$query_number_of_orders = $this->db->get('orders', 0, 1);
		$query_number_of_orders1f=$query_number_of_orders->result_array();
		if((int)$query_number_of_orders1f[0]["order_package_id"] > 1 && (int)$_SESSION["ALREADYORDERED"]==0)
		{
			$order_id=(int)$query_number_of_orders1f[0]["order_id"];
			
			$uniqueid=bin2hex($email_s[0]."@".$order_id);
			$duniqueid=hex2bin("7368616869643130313538");
			
			
			
			$message = '
			<style type="text/css">
@import url(\'https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap\');
@import url(\'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap\');
body{ margin:0; padding:0; font-family: \'Karla\', sans-serif; color:283250; font-size:17px;}
</style>
<table width="650" border="0" cellspacing="0" align="center">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr>
<td style="text-align:center; border-bottom:3px solid #0A8CAD;"><img src="https://app.orginsights.io/asset/images/emaillogo.png" alt=""></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:20px;">
			
			Hi,<br>A User has completed his assessment<br><br>Click <a href="'.base_url().'industryreports/'.$uniqueid.'" target="blank"> here </a> to view the industry report.<br><br>Sincerely,<br><br>Orginsights
			

	</td>
  </tr>
  <tr>
    <td style="padding:6px;">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" style="padding:15px;background:#404449; text-align:center; font-size:12px; color:rgba(255,255,255,0.5)">Copyright &copy; '.date("Y").' Orginsights. All Rights Reserved.</td>
  </tr>
</table>';



if(trim($this->session->userdata('ref_code'))!="")
{
	$query_referral = $this->db->query("select * from ReferralCodes where ReferralCode = '".$this->session->userdata('ref_code')."' limit 1");
	//echo "ok"; die();
	//echo $query_referral->num_rows();
	if($query_referral->num_rows() > 0)
	{
			$row_referral = $query_referral->result_array();
			$Ref_id=$row_referral[0]["id"];
			
			$Ref_first_name=$row_referral[0]["first_name"];
			$Ref_last_name=$row_referral[0]["last_name"];
			$Ref_email=$row_referral[0]["email"];


			$to = $Ref_email;
			$Subject = "Industry Report Link of a user";
			
			$config = array();
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.authsmtp.com';
			$config['smtp_user'] = 'ac78416';
			$config['smtp_pass'] = 'grab-vixen-wreak-wi';
			$config['smtp_port'] = 25;
			$config['mailtype'] = 'html';
			
			$this->load->library('email', $config);
			
			//$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$from = "ECNet Dev <dev@ecnetsolutions.ca>";
			$headers = "From:" . $from;
			$headers .= "\nContent-type: text/html;";
			

			

			$this->email->from('info@orginsights.io', 'Orginsights');
			$this->email->to($to);
			$this->email->bcc('support@orginsights.io');
			$this->email->subject($Subject);
			$this->email->message($message);
			
			if($this->email->send()){
			   //Success email Sent
			   //echo $this->email->print_debugger();
			}else{
			   //Email Failed To Send
			   //echo $this->email->print_debugger();
			}
	}		
}			
			
			//echo $message;
		}
		//die();
		//end industry report email
		
		
		$this->load->view('thankyou',$data);
		$this->load->view('footer');
	}
}
