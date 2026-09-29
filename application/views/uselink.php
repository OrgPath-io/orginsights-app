<?php
$query_u = $this->db->query("SELECT invu.*,u.first_name as Candidatename FROM invited_users invu
												LEFT JOIN users AS u ON u.user_id = invu.invited_by
												WHERE invu.unique_url = '".$unique."'");
$query_uR = $query_u->result_array();		
$Candidatename=$query_uR[0]["Candidatename"];										
?>
<div class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 text-center">
				<div class="mb-4"><img src="<?php echo base_url();?>asset/images/handshake.png" alt=""></div>
				<div class="mb-5">
					<h3>Link To Continue</h3>
					<p align="center">Thank you for providing feedback for <?php echo $Candidatename;?>.<br><br>Please use the link provided in the initial email to continue the assessment.</p>
				</div>

				

				<div class="text-center btn-div pt-4">
					<a href="<?php echo base_url();?>register" class="btn btn-secondary">Register to do your own assessment</a>
				</div>
			</div>
		</div>
	</div>
</div>
