<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloadpdf extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('user_id') == '' && (int)$this->session->userdata('appAdminadminlog')==0){
			redirect(base_url().'', 'refresh');
		}
		include("fixgroupby.php");
	}
	
	public function index($order_id = 0,$perccheck = 0)
	{
		?>
		<form id="dform" action="<?php echo base_url();?>assets/reports/<?php echo $_REQUEST['filename'];?>.pdf" method="post" target="_parent">
		<input type="hidden">
		</form>
		<script>
		//window.parent.document.getElementById("pdfframe2").src="<?php echo base_url();?>assets/reports/<?php echo $_REQUEST['filename'];?>.pdf"; 

document.getElementById("dform").submit();

//window.open("<?php echo base_url();?>assets/reports/<?php echo $_REQUEST['filename'];?>.pdf");

		function checkframe()
		{
			window.parent.close();
		}
		setTimeout('checkframe()', 15000);
		
		
		</script>
		<?php
		/*$data['order_id'] = $order_id;
		$data['perccheck'] = $perccheck;
		
		$this->load->view('header');
		$this->load->view('reports', $data);
		$this->load->view('footer');*/
	}
}
