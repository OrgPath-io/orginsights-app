<div class="page-banner">
        <div class="container clearfix">
            <h1>360 Assessment</h1>
			<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
        </div>
    </div>

    <div class="section">
        <div class="container">
        <div class="row">
        <div style="margin-top:50px;" class="col-lg-7 col-md-6 page-content">
        <h5>Key information you need to know before you start</h5>
        <ul>
        <li>You will be now going on to ask other individuals (3rd party) to provide their feedback. Please pick people that would best be able to comment on your capabilities and have worked with you in some capacity. 
</li><li>To ensure they provide accurate feedback respect the anonymity of the process and do not try and find out who rated you what. 
</li><li>You will have to invite a minimum of 3 up to maximum of 10. As long as anyone completed the assessment you will be shown answers but you will never know who provided the feedback. 
</li><li>Ensure you pick a time period for the 360 that will allow everyone to provide feedback. he report will be automatically generated once your deadline has been reached. 
</li><li>It will take approx. 20 mins to complete the assessment. 
</li>
        </ul>
		<div class="buttonp">
		<form method="Post" action="<?php echo base_url().'register/orginsights/'.$order_id;?>">
			<input type="submit" class="btn btn-secondary" value="GO TO 360 Assessment">
			<input type="hidden" name="self" value="1" />
	   </form>
       </div>
        </div>
        
        <div class="col-lg-5 col-md-6 full-img">
        <img src="<?php echo base_url()?>asset/images/360.jpg" alt="">
        </div>
        
        </div>
        </div>
    </div>
