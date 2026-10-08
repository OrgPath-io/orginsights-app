<?php
$checkquest = $this->db->query("SELECT q_id FROM questions WHERE q_type = 'self'");
									
$Numberofquest=(int)$checkquest->num_rows();
?>
    <div class="page-banner">
        <div class="container clearfix">
            <h1>Self Assessment</h1>
			<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
        </div>
    </div>

    <div class="section">
        <div class="container">
        <div class="row">
        <div style="margin-top:70px;" class="col-lg-7 col-md-6 page-content">
        <h5>Key information you need to know before you start</h5>
        <ul>
       <li>You will be going to start with the Self-Assessment. You will be taken through a series of questions/statements. For these questions, please provide your opinion on your own capabilities on a scale of 0-5.</li>
	   
	   <li>You may not have experience with an area. This is normal. Answering "Strongly Disagree" is not a reflection of your overall potential, but just your current lack of experience.</li>
	   
        <li>Be honest. The point of this exercise is to help you identify key areas of development. You are person you are harming by gaming the system, will be yourself..</li>
        <li>If at any point you need to stop there is a SAVE option available to you.</li>
        <li>This will take approx. 20 mins and consists of <?php echo $Numberofquest;?> questions.</li>
        </ul>
		<div class="buttonp">
		<form method="Post" action="<?php echo base_url().'register/self/'.$order_id;?>">
			<input type="submit" class="btn btn-secondary" value="GO TO Self Assessment">
			<input type="hidden" name="self" value="1" />
	   </form>
	   </p>
        </div>
        
       
        
        </div>
		<div class="col-lg-5 col-md-6 full-img">
        <img src="<?php echo base_url()?>asset/images/self.jpg" alt="">
        </div>
        </div>
    </div>
