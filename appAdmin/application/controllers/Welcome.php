<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		
		
			$redirecto="/appAdmin/index.php/dashboard/";
			 
				$textdisplay="";
				if(isset($_POST['Email']) && $_POST['Email']!="")
				{
					$usertype="Admin";
					
					
					$db=$this->db;
					
					$query="Select * from AdminUsers where Email='".$_POST['Email']."' AND pwd='".md5($_POST['Password'])."' AND isActive=1";
					
					$chkusersQ=$db->query($query);
					$chkusers=$chkusersQ->row_array();
					if($chkusers!="")
					{
						$this->session->set_userdata('appAdminadminlog',$chkusers["id"]);
						$this->session->set_userdata('appAdminadminlogtype',$usertype);
						$this->session->set_userdata('appAdminadmindisplay',$chkusers["FirstName"].' '.$chkusers["LastName"]);
						?>
						<script>
						location.href="<?php echo $redirecto;?>";
						</script>
						<?php
						die();	
					}
					else
					{
					$textdisplay="INVALID USERNAME OR PASSWORD<br><br>";
					}
				}
				$data["textdisplay"]=$textdisplay;
				$this->load->view("index",$data);
        		
		
	}
}
