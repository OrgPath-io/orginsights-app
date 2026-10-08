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
										<?php
										$CITYNAME='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Cities where id='".$user['city']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$CITYNAME=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="cities" name="city" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $CITYNAME;?>"  placeholder="E.g. Toronto" >
                                            
											
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									 <div class="form-group">
                                        <label>Age Range</label>
                                        <div class="req-icon-col">
                                            <?php
										$AgeRanges='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges where id='".$user['age_range']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$AgeRanges=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="age" name="age_range" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $AgeRanges;?>"  placeholder="E.g. 40-54" >
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Visible Minorities</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="visible_minorities" id="visible_minorities" onchange="changevm()">
											<option selected>Select</option>
											<option <?php if($user['visible_minorities']== 'Yes' && $user['visible_minorities_option']!=''){ echo 'Selected';} ?>>Yes</option>
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
                                            <?php
										$hletypes='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM HLEType where id='".$user['hle']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$hletypes=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="hletypes" name="hle" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $hletypes;?>"  placeholder="E.g. Bachelors degree" >
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>University / College attended</label>
                                        <div class="req-icon-col bs-example">
										<?php //print_r($universities);?>
											<?php
										$university1='';
										$query_cities = $this->db->query("SELECT 
									university,id 
									FROM university where id='".$user['university']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['university']!="")
			{
				$university1=$res_cities[0]['university'];
			}
				?>						
											<input type="text" id="university" name="university" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $university1;?>"  placeholder="E.g. York University" >
                                            
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
											<?php
										$study1='';
										$query_cities = $this->db->query("SELECT 
									major_cat,id 
									FROM study where id='".$user['program_study']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['major_cat']!="")
			{
				$study1=$res_cities[0]['major_cat'];
			}
				?>						
											<input type="text" id="study" name="study" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $study1;?>"  placeholder="E.g. Study" >
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Designations</label>
                                        <div class="req-icon-col">
										<?php
										$designation1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Designations where id='".$user['designation']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$designation1=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="designations" name="designation" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $designation1;?>"  placeholder="E.g. CPA" >
                                            
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
										<?php
										$employers1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Employers where id='".$user['most_recent_employer']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$employers1=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="employers" name="most_recent_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $employers1;?>"  placeholder="E.g. Microsoft" >
                                            
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Most Recent Experience Level</label>
                                        <div class="req-icon-col">
											<?php
										$mrels1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel where id='".$user['MostRecentExpLevelID']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$mrels1=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="mrels" name="MostRecentExpLevelID" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $mrels1;?>"  placeholder="E.g. Manager" >
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Most Recent Performance Rating Received</label>
										<div class="req-icon-col">
										<?php
										$performances1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Performance_Rating where id='".$user['performance_rating']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$performances1=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="performances" name="performance_rating" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $performances1;?>"  placeholder="E.g. Meets Expectations" >
                                            
											<span class="req-icon"></span>
										</div>
                                    </div>
									
									<div class="form-group">
                                        <label>Industry of employer</label>
                                        <div class="req-icon-col">
										<?php
										$industry1='';
										$query_cities = $this->db->query("SELECT 
									name,id 
									FROM industry where id='".$user['industry_employer']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['name']!="")
			{
				$industry1=$res_cities[0]['name'];
			}
				?>						
											<input type="text" id="industry" name="industry_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $industry1;?>"  placeholder="E.g. industry" >
                                            
											<span class="req-icon"></span>

                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Area of expertise / Type of role</label>
                                        <div class="req-icon-col">
										<?php
										$expertises1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role where id='".$user['expertise_role']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$expertises1=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="expertises" name="expertise_role" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $expertises1;?>"  placeholder="E.g. Business" >
                                            
											<span class="req-icon"></span>
                                        </div>
                                    </div>
									
									<div class="form-group">
                                        <label>Salary Range</label>
                                        <div class="req-icon-col">
                                            <?php
										$salarys1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM SalaryRanges where id='".$user['expertise_role']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$salarys1=$res_cities[0]['description'];
			}
				?>						
											<input type="text" id="salarys" name="salary_range" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $salarys1;?>"  placeholder="E.g. $40k to $49k per annum" >
                                            
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