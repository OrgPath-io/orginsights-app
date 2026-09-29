<div class="page-banner">
	<div class="container clearfix">
		<h1>OrgInsights 360 Assessment</h1>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="row">
			<div style="margin-top:60px;" class="col-lg-7 col-md-6 page-content">
				<h5>Key information you need to know before you start</h5>
        <ul>
        <li>You have been asked to provide feedback on someone who values your opinion. Be honest, and ensure you don’t let personal biases cloud your judgement
</li><li>This is anonymous. The individual who asked for your feedback will see the scores given but will NEVER know who provided the feedback. 
</li><li>The individual has been asked to provide a minimum of 3 assessors to ensure that feedback is always anonymous
</li><li>If at any point you need to stop there is a SAVE option available to you.
</li><li>This will take approx. 20 mins of your time 
</li>
        </ul>
				<form method="Post" action="<?php echo base_url().'assessment/intro/'.$unique;?>">
					<input type="submit" class="btn btn-secondary" value="CONTINUE TO ORGInsights 360 Assessment">
					<input type="hidden" name="self" value="1" />
				</form>

			</div>

			<div class="col-lg-5 col-md-6 full-img">
				<img src="<?php echo base_url()?>asset/images/360.jpg" alt="">
			</div>

		</div>
	</div>
</div>
