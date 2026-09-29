<?php
$checkquest = $this->db->query("SELECT q_id FROM questions WHERE q_type = 'professional'");
									
$Numberofquest=(int)$checkquest->num_rows();
?>
<div class="page-banner">
        <div class="container clearfix">
            <h1>Orginsights Assessment</h1>
			<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
        </div>
    </div>

    <div class="section">
        <div class="container">
        <div class="row">
        <div style="margin-top:50px;" class="col-lg-7 col-md-6 page-content">
        <h5>Key information you need to know before you start</h5>
        <ul>
        <li>You will be going to continue into the I/O Psychologist built assessment (Orgpath Assessment). Please pay attention and pick the appropriate answer based on the questions asked.
</li><li>Be as honest as possible and please do not try to game the assessment. You can only get an accurate assessment of your capabilities if you are honest. By manipulating your result, you are only hurting yourself.  
</li><li>If at any point you need to stop there is a SAVE option available to you.
</li><li>This will take approx. 45-60 mins and consists of <?php echo $Numberofquest;?> questions. The time taken is worth it.
</li><li>The assessment consists of Personality, Likert, Situational judgement and cognitive questions to ensure we gain a holistic understanding of your capabilities.
</li>
        </ul>
		<div class="buttonp">
		<form method="Post" action="<?php echo base_url().'register/professional/'.$order_id;?>">
			<input type="submit" class="btn btn-secondary" value="GO TO Orginsights Assessment">
			<input type="hidden" name="self" value="1" />
	   </form>
       </div>
        </div>
        
        <div class="col-lg-5 col-md-6 full-img">
        <img src="<?php echo base_url()?>asset/images/orginsights.jpg" alt="">
        </div>
        
        </div>
        </div>
    </div>