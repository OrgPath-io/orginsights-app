<div class="page-banner">
        <div class="container clearfix">
            <h1>Register</h1>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="register-column">
                <div class="row">
					<div class="mobileview col-lg-4 offset-lg-1 col-md-5 offset-md-0 gift-card-main">
                        <div class="gift-card-col">
							<p><b>Get additional insights at no cost!</b></p>
							<p>
							By providing us some optional information that helps us better understand who is taking the assessment and gain additional insights, we will give you FREE access to demographic pools you have selected to let you compare your OrgInsights results to populations that matter to you!
							</p>
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="register-form">
                            <div class="common-form">
							 
								
                                <form id="form_register_option" name="form_register_option" method="Post">
                                    <div class="form-heading text-center">
                                        <p>&nbsp;</p>
										<h4>Demographic Information</h4>
										
                                    </div>
                                    <div class="form-group">
                                        <label>Country : <?php echo $this->session->userdata('country');?></label>
										<div class="req-icon-col">
                                           <!-- <select class="form-control" name="country" id="country" required>
											<option>Country</option>
											<?php
												foreach($country as $row)
												{
											?>
												<option <?php if($this->session->userdata('country')== $row['country'] ){ echo 'Selected';} ?>><?php echo $row['country'];?></option>
											<?php
												}
											?>	
											</select>-->
												
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									<?php
									if(count($province) > 0)
									{
									?>
									<div class="form-group">
                                        <label>State / Province</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="province" id="province" >
											<option value=0>Select State OR Province</option>
											<?php
												foreach($province as $row)
												{
											?>
												<option <?php if($user['province']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['province_name'];?></option>
											<?php
												}
											?>	
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									<?php
									}
									else
									{
									?>
									<input type="hidden" name="province" id="province" value="">
									<?php
									}
									?>
									 <div class="form-group">
                                        <label>City</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="city" id="city">
											<option value=0>Select</option>
											<?php
												foreach($cities as $row)
												{
											?>
												<option <?php if($user['city']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
											
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									 <div class="form-group">
                                        <label>Age Range</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="age_range" id="age_range" >
											<option <?php if($user['age_range']== '' ){ echo 'Selected';} ?> value=0>Select Age Range</option>
											<?php
												foreach($age as $row)
												{
											?>
												<option <?php if($user['age_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>	
											
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Visible Minorities</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="visible_minorities" id="visible_minorities" onchange="changevm()">
											<option selected>Select</option>
											<option <?php if($user['visible_minorities']== 'Yes1' ){ echo 'Selected';} ?>>Yes</option>
											<option <?php if($user['visible_minorities']== 'No' ){ echo 'Selected';} ?>>No</option>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div style="display:none;" id="visible_minorities_optiondiv" class="form-group">
                                        <label>Please Specify</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="visible_minorities_option" id="visible_minorities_option"  onchange="checkvm()">
											<option value=0>Select</option>
											<?php
												foreach($minorities as $row)
												{
											?>
												<option <?php if($user['visible_minorities_option']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											<option value=0>Other</option>

											<option value=-1>I prefer not to specify</option>

											</select>
											<br>
											<input type="text" name="Othervm" id="Othervm" value="" style="display:none" placeholder="Please Specify Other Minority">
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
                                    
									<div class="form-heading text-center">
                                        <p>&nbsp;</p>
										<h4>Education Information</h4>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label>Highest Level of Education Completed / In Progress</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="hle" id="hle">
											<option value=0>Select</option>
											<?php
												foreach($hletypes as $row)
												{
											?>
												<option <?php if($user['hle']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>University / College attended</label>
                                        <div class="req-icon-col bs-example">
										<?php //print_r($universities);?>
											<select class="form-control" name="university" id="university">
											<option value=0>Select</option>
											<?php
												foreach($universities as $row)
												{
											?>
												<option <?php if($user['university']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['university'];?></option>
											<?php
												}
											?>
											</select>
											<span class="req-icon"></span>
                                        </div>
                                    </div>
                                    
									<div class="form-group">
                                        <label>Graduation year / Anticipated year</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="graduation_year" id="graduation_year" >
											<option value=0>Select</option>
											<?php
											for($i=2030;$i>=1950;$i--)
											{
											?>
											<option <?php if($user['graduation_year']== $i ){ echo 'Selected';} ?>><?php echo $i;?></option>
											<?php
											}
											?>
											
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Program of study</label>
                                        <div class="req-icon-col">
											<select class="form-control" name="study" id="study">
											<option value=0>Select</option>
											<?php
												foreach($studys as $row)
												{
											?>
												<option <?php if($user['program_study']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['major_cat'];?></option>
											<?php
												}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Designations</label>
                                        <div class="req-icon-col">
										<select class="form-control" name="designation" id="designation">
											<option value=0>Select</option>
											<?php
												foreach($designations as $row)
												{
											?>
												<option <?php if($user['designation']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-heading text-center">
                                        <p>&nbsp;</p>
										<h4>Employment Information</h4>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label>Most Recent Employer</label>
                                        <div class="req-icon-col">
										<select class="form-control" name="most_recent_employer" id="most_recent_employer">
											<option value=0>Select</option>
											<?php
												foreach($employers as $row)
												{
											?>
												<option <?php if($user['most_recent_employer']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Most Recent Experience Level</label>
                                        <div class="req-icon-col">
											<select class="form-control" name="MostRecentExpLevelID" id="MostRecentExpLevelID">
											<option value=0>Select</option>
											<?php
												foreach($MostRecentExpLevelIDs as $row)
												{
											?>
												<option <?php if($user['MostRecentExpLevelID']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Most Recent Performance Rating Received</label>
										<div class="req-icon-col">
										<select class="form-control" name="performance_rating" id="performance_rating">
											<option value=0>Select</option>
											<?php
												foreach($performances as $row)
												{
											?>
												<option <?php if($user['performance_rating']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
											<span class="req-icon"></span>
										</div>
                                    </div>
									
									<div class="form-group">
                                        <label>Industry of employer</label>
                                        <div class="req-icon-col">
										<select class="form-control" name="industry_employer" id="industry_employer">
											<option value=0>Select</option>
											<?php
												foreach($industrys as $row)
												{
											?>
												<option <?php if($user['industry_employer']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['name'];?></option>
											<?php
												}
											?>
											</select>
											<span class="req-icon"></span>

                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Area of expertise / Type of role</label>
                                        <div class="req-icon-col">
										<select class="form-control" name="expertise_role" id="expertise_role">
											<option value=0>Select</option>
											<?php
												foreach($expertises as $row)
												{
											?>
												<option <?php if($user['expertise_role']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
											<span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Salary Range</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="salary_range" id="salary_range" >
											<option>Select</option>
											<?php
											foreach($salarys as $row)
											{
											?>
											<option <?php if($user['salary_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
											}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="mobileview col-lg-4 offset-lg-1 col-md-5 offset-md-0 gift-card-main">
                        <div class="gift-card-col">
							<p>Complete the registration and get a gift card</p>
                            <img src="<?php echo base_url();?>asset/images/amazon-gift-img.png" class="img-fluid">
                            <div class="custom-progress-bar yellow-progress-bar">
                                <p>You are almost there to win our gift card</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="60"></div>
                                    <div class="total-progress-count">$</div>
                                </div>
                                <div class="complete-text text-center">
                                    <p>60% Complete</p>
                                </div>
                            </div>
                        </div>
                    </div>
									
									<div class="form-heading text-center">
                                        <p>&nbsp;</p>
										<h4>Details for gift card</h4>
                                        
                                    </div>
									<div class="form-group">
                                        <label>What is your local Amazon website you use for shopping?</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="local_amazon_web" id="local_amazon_web" required >
											<option value=0>Select</option>
											<?php
											foreach($amazons as $row)
											{
											?>
											<option <?php if($user['local_amazon_web']== $row["id"] ){ echo 'Selected';} ?> value="<?php echo $row["id"];?>"><?php echo $row["description"];?></option>
											<?php
											}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-secondary btn-style-2">Submit NOW</button>
										
										<button type="submit" class="btn btn-secondary btn-style-2">Save Later</button>
										
										<?php /* ?>
										 <a href="<?php echo base_url();?>" class="btn btn-secondary btn-style-2">Save Later</a>
										 <?php */ ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="desktopview col-lg-4 offset-lg-1 col-md-5 offset-md-0 gift-card-main">
                        <div class="gift-card-col">
							<p><b>Get additional insights at no cost!</b></p>
							<p>
							By providing us some optional information that helps us better understand who is taking the assessment and gain additional insights, we will give you FREE access to demographic pools you have selected to let you compare your OrgInsights results to populations that matter to you!
							</p>
                            <p>Complete the registration and get a gift card</p>
                            <img src="<?php echo base_url();?>asset/images/amazon-gift-img.png" class="img-fluid">
                            <div class="custom-progress-bar yellow-progress-bar">
                                <p>You are almost there to win our gift card</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="60"></div>
                                    <div class="total-progress-count">$</div>
                                </div>
                                <div class="complete-text text-center">
                                    <p>60% Complete</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<script>
function checkvm()
{
	//alert(document.getElementById("visible_minorities_option").value);
	if(document.getElementById("visible_minorities_option").value=="Other")
	{
		document.getElementById("Othervm").style.display="block";
	}
	else
	{
		document.getElementById("Othervm").value="";
		document.getElementById("Othervm").style.display="none";
	}
}
function changevm()
{
	if(document.getElementById("visible_minorities").value=="Yes")
	{
		document.getElementById("visible_minorities_optiondiv").style.display="block";
	}
	else
	{
		document.getElementById("visible_minorities_optiondiv").style.display="none";
	}
}
changevm()
</script>