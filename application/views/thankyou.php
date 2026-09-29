<div class="page-banner">
<div class="container clearfix">
<h1>Thank You</h1>

<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>

</div>
</div>
<div class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 text-center">
				<div class="mb-4"><img src="<?php echo base_url();?>asset/images/handshake.png" alt=""></div>
				<div class="mb-5">
					<h3>Thank You!</h3>
					<?php
$showpricing=0;

if($this->session->userdata('ref_code')!="")
{
	$query_user2 = $this->db->query("select * from ReferralCodes where ReferralCode='".$this->session->userdata('ref_code')."' order by ReferralCode");
	foreach ($query_user2->result_array() as $row_user2)
	{
			if($row_user2["ReferralValue"]>=0)
			{
				$showpricing=1;
			}
		
	}
}					
					
					$query_complete_orders = $this->db->query("SELECT * from orders o  
													where user_id = ".$this->session->userdata('user_id')." order by order_id desc
													");
		$query_number_of_orders1f = $query_complete_orders->result_array();
		
		//echo $query_number_of_orders1f[0]["order_package_id"];
					?>
					
					<p align="left">
					<?php
					//if((int)$query_number_of_orders1f[0]["order_package_id"] > 3 && (int)$query_number_of_orders1f[0]["order_package_id"] < 7)
					if((int)$query_number_of_orders1f[0]["order_package_id"] < 4 && $showpricing==0)
					{
						//include("thanksmessage_".(int)$query_number_of_orders1f[0]["order_package_id"].".php");
						include("thanksmessage_4.php");
					}
					else if((int)$query_number_of_orders1f[0]["order_package_id"] > 3 && (int)$query_number_of_orders1f[0]["order_package_id"] < 7)
					{
					?>
					Thank you for taking the time to complete an OrgInsights assessment. This is the first step to developing into a stronger leader. The assessment will provide you insights on key capabilities you should work to leverage more or weaknesses you should focus on developing. The next steps are a development plan to help work on the capabilities you want to focus on. Your report is ready on the main page. Please click "Back to Menu" to access
					<?php	
					}
					else if((int)$query_number_of_orders1f[0]["order_package_id"]==3 || (int)$query_number_of_orders1f[0]["order_package_id"]==1)
					{
					?>
					Thank you for taking the time to complete a 360 assessment with OrgInsights. You have taken the first step! Next, you wait for your Raters to get provide their feedback. Once all your raters have responded (or your time limit set has been reached) your assessment will close and a report will be available for you to review as long as at least one person answered took the time to respond. Good luck and keep an eye out for our email!
					<?php	
					}
					else if((int)$query_number_of_orders1f[0]["order_package_id"]==2)
					{
					?>
					Thank you for taking the time to complete an OrgInsights assessment. This is the first step to developing into a stronger leader. The assessment will provide you insights on key capabilities you should work to leverage more or weaknesses you should focus on developing. The next steps are a development plan to help work on the capabilities you want to focus on. Your report is ready on the main page. Please click "Back to Menu" to access
					<?php	
					}
					
					
					?>
					</p>
					
				</div>

				

				<div class="text-center btn-div pt-4">
					<?php
					/*
					<a style="" href="<?php echo base_url();?>" class="btn btn-primary">BACK TO MENU</a>
					*/
					/*
					style="max-height:auto;color: #fff;
    border-color: #126aaf;
	padding: 16px 64px;
    font-weight: bold;
    letter-spacing: 1px;"
					*/
					?>
					
					<button  class="btn btn-secondary" onclick="location.href='<?php echo base_url();?>'">BACK TO MENU</button>
					
				</div>
			</div>
		</div>
	</div>
</div>
