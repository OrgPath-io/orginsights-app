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
				</div></div>
<div class="col-lg-8 text-left">	
<div class="mb-5">			
					<p align="left">
					<?php
					
					?>
<p>					
					Thank you for taking the time to complete an Orglnsights assessment. This is the first step 
In learning about yourself which is a critical part to becoming a stronger leader and getting the job you want!  The assessment will provide you insights on key capabilities you should work to leverage more or weaknesses you should focus on 
developing
</p>
<p>
The next steps are:
<ol>
<li>Go back to the dashboard and start reading the guide. This will give you a foundation on what you are going to see in the report ss well as provide you tips and tricks on how to build soft skills in your resume and use it in interviews. </li>

<li>Go through the OrgInsights Summary Report in detail paying attention to your areas of strength, hidden talents as well as your areas of development. </li>

<li>Got a taste and want more? You can upgrade to the full version of the report and get access to:

<ul>
<li>Detailed breakdown of each section with flags for hidden talents and blind spots</li>
<li>Insights on what other industries that are open to you that you should explore that would be a great fit for with your transferrable (soft) skills!</li>
<li>A development plans with recommendations from LinkedIn Learning (Premium account required) on what videos to watch and courses to take to get to the level you need to get ahead</li>

</ul>

</li>
<li>
Want to take you’re insights even further? Book some time with an OrgInsights Career Coach that can walk you through your report in detail as well as support you with your resume, interview
</li>
</ol>
</p>
</p>
</div></div>
<div class="col-lg-8 text-center">	
<div class="mb-5">
<p>
<?php
$query_number_of_orders = $this->db->query("SELECT * from orders where user_id = ".$this->session->userdata('user_id')."  and order_package_id < 7 order by order_id desc");

$query_number_of_orders1f=$query_number_of_orders->result_array();

if($query_number_of_orders1f[0]["order_package_id"] < 6)
{	

/*background-color: #126aaf;*/
?>
<button style="max-height:auto;color: #fff;
    
    border-color: #126aaf;
	padding: 16px 64px;
    font-weight: bold;
    letter-spacing: 1px;" class="btn btn-secondary" onclick="location.href='/page/'">UPGRADE AND "TAKE CONTROL<BR>OF YOUR CAREER"</button>
<?php
/*<img src="/assets/images/upgrade_button.png" />*/
}
?>
</p>


					<?php	
					
					?>
					</p>
				</div>

				

				<div class="text-center btn-div pt-4">
					<a href="<?php echo base_url();?>" class="btn btn-primary">BACK TO MENU</a>
					
				</div>
			</div>
		</div>
	</div>
</div>
