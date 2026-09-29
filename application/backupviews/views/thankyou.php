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
					<p align="left">
					<?php
					if((int)$page==3)
					{
					?>
					Thank you for taking the time to complete a 360 assessment with OrgInsights. You have taken the first step! Next, you wait for your Raters to get provide their feedback. Once all your raters have responded (or your time limit set has been reached) your assessment will close and a report will be available for you to review as long as at least one person answered took the time to respond. Good luck and keep an eye out for our email!
					<?php	
					}
					else if((int)$page==2)
					{
					?>
					Thank you for taking the time to complete an OrgInsights assessment. This is the first step to developing into a stronger leader. The assessment will provide you insights on key capabilities you should work to leverage more or weaknesses you should focus on developing. The next steps are a development plan to help work on the capabilities you want to focus on. Your report is ready on the main page. Please click "Back to Menu" to access
					<?php	
					}
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
