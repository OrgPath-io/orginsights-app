<?php
include("includes/header.php");
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<style>

	.bs-example {

	}
	.typeahead, .tt-query, .tt-hint {
		border: 2px solid #CCCCCC;
		border-radius: 8px;
		font-size: 22px; /* Set input font size */
		height: 30px;
		line-height: 30px;
		outline: medium none;
		padding: 8px 12px;
		max-width:600px;
		
	}
	.typeahead {
		background-color: #FFFFFF;
		
	}
	.typeahead:focus {
		border: 2px solid #0097CF;
		
	}
	.tt-query {
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
	}
	.tt-hint {
		color: #999999;
	}
	.tt-menu {
		background-color: #FFFFFF;
		border: 1px solid rgba(0, 0, 0, 0.2);
		border-radius: 8px;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		margin-top: 12px;
		padding: 8px 0;
		width: 422px;
		display:none;
	}
	.tt-suggestion {
		font-size: 22px;  /* Set suggestion dropdown font size */
		padding: 3px 20px;
		
	}
	.tt-suggestion:hover {
		cursor: pointer;
		background-color: #0097CF;
		color: #FFFFFF;
	}
	.tt-suggestion p {
		margin: 0;
	}
	.tt-menu {
		width: 500px !important;
		
	}
	
	.tt-input-group {
    width: 100%;
}
/** Added from this point */
.twitter-typeahead{
     width: 97%;
}
.tt-dropdown-menu{
    width: 102%;
}
input.typeahead.tt-query{ /* This is optional */
    line-height: 1.5 !important;
	height: 45px !important;
}

</style>
<?php

$tablevalue="users";

//


//

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}

$addedit="Add ";
if($id!=0)
{
$whereq="where user_id=".$id;
$formactionqs="?id=".$id;

$addedit="Edit ";

}

?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4><?php echo $addedit;?>User <?php echo $NAME;?></h4></div>
<script type="text/javascript">
// Toggle form display
function showForm(formName) 
{
	$(formName).slideDown(1000).siblings('.register').hide();
}
</script>					

                    <form action="#" method="post" name="adminform" class="register1" id="adminform" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-lg-12">
							
								<div class="col-lg-12">
								<center>
                                <?php echo $ThanksText;?><br>
								</center>
								</div>
								<div style="clear:both;"></div>
								<!---->
								<div style="float:left;" class="col-lg-6">
									<div class="form-group">
                                        <label><span class="req-icon">*</span> First Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="<?php echo $first_name;?>" required>
                                            
                                        </div>
                                    </div>
								</div>	
								<div style="float:left;" class="col-lg-6">	
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Last Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="<?php echo $last_name;?>" required>
                                            
                                        </div>
                                    </div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Email Address</label>
                                        <div class="req-icon-col">
                                            <input type="email" class="form-control" placeholder="Enter your email address" name="email" id="email" value="<?php echo $email;?>" required>
                                            
                                        </div>
                                    </div>
                                </div>	
								<?php
								if($id==0)
								{
								?>
								<div style="float:left;" class="col-lg-6">
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Password</label>
                                        <div class="req-icon-col">
                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="" required>
                                            
                                        </div>
                                    </div>
                                </div>
								<?php
								}
								else
								{
								?>
								<div style="float:left;" class="col-lg-6"> <div class="form-group">
																<label>Change Password</label>
								<select name="ChangePassword" id="changepassoption" onclick="showpassfield()" class="form-control span12">										
																	<?php
								foreach($yesno as $key=>$value)
								{
									$slct="";
									
									if($key==0)
									{
										$slct="selected";
									}
								?>	
								<option value="<?php echo $key;?>" <?php echo $slct;?>><?php echo $value;?></option>
								<?php
								}
								?>
								</select>
								<?php
									$Passwordstyle="Password";
									$Pwd="";
									if($id!=0)
									{
									$Passwordstyle="hidden";
									$Pwd="-";
									}
									?>
								<input type="<?php echo $Passwordstyle;?>" name="password" id="Password" value="<?=$Pwd;?>"  placeholder="Enter Password" class="form-control validate[required] span12" required>
								</div></div>
								<?php
								}
								?>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">   
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Country</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="country_id" id="country" onchange="show_province(this.value,'Province','')" required>
											<option value="">Country</option>
											<?php
												foreach($country as $row)
												{
													$slct="";
													if($row['id']==(int)$country_id)
													{
														$slct="selected";
													}
											?>
												<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['country'];?></option>
											<?php
												}
											?>	
											</select>
                                            
                                            
                                        </div>
                                    </div>
								</div>
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Province</label>
									<select name="province" id="Province" class="form-control" onchange="show_cities(this.value,'cities')">
									<option value=0>Select Province</option>
									<?php
										foreach($Province as $row)
										{
											$slct="";
											if($row['id']==(int)$province)
											{
												$slct="selected";
											}
											
									?>
										<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['province_name'];?></option>
									<?php
										}
									?>	
									</select>
									</div>
								</div>	
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
                                        <label>City</label>
									<select name="city" id="cities" class="form-control span12">
									<option value=0>Select City</option><?php
										foreach($Cities as $row)
										{
											$slct="";
											if($row['id']==(int)$city)
											{
												$slct="selected";
											}
											
									?>
										<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['description'];?></option>
									<?php
										}
									?>										
									</select>
									</div>	
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Age Range</label>
									<select name="age_range" id="age_range" class="form-control">
									<option value=0>Select Age Range</option>
									<?php
												foreach($age as $row)
												{
												
												$slct="";
												
												if($age_range== $row['id'] ){
												$slct='Selected';
												$tickmark="display:block;";
												$ActualTicks++;
												}
											?>
												<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>	
									</select>
									</div>
								</div>
								
								<div style="float:left;" class="col-lg-4">	
									<div class="form-group">
									<label>Visible Minorities</label>
									<select name="visible_minorities" id="visible_minorities" class="form-control">
									<option value="">Select</option>
									<option <?php if($visible_minorities== 'Yes' && (int)$visible_minorities_option>0){ echo 'Selected';} ?> value='Yes'>Yes</option>
											<option <?php if($visible_minorities== 'No' ){ echo 'Selected';} ?> value='No'>No</option>	
									</select>
									</div>
								</div>
								
								<div style="float:left;" class="col-lg-4">	
									<div class="form-group">
									<label>&nbsp;</label>
									<select name="visible_minorities_option" id="visible_minorities_option" class="form-control">
									<option value="">Specify</option>
									<?php
												foreach($minorities as $row)
												{
											?>
												<option <?php if($visible_minorities_option== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											<option value=0>Other</option>

											<option value=-1>Prefer not to specify</option>
	
									</select>
									</div>
								</div>
								
								<div style="float:left;" class="col-lg-4">	
									<div class="form-group">
									<label>Other (if applicable)</label>
									<input type="text" name="Othervm" id="Othervm" value="" placeholder="Please Specify Other Minority" class="form-control">
									</div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-4"> <div class="form-group">
								<label>Is Active</label>
<select name="is_active" id="is_active" class="form-control span12">										
									<?php
foreach($yesno as $key=>$value)
{
	$slct="";
	
	if($isActive==$key)
	{
		$slct="selected";
	}
?>	
<option value="<?php echo $key;?>" <?php echo $slct;?>><?php echo $value;?></option>
<?php
}
?>
</select>
</div></div>

<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-4" class="form-heading">
                                        <p>&nbsp;</p>
										<h4>Education Information</h4>
                                        <br>
                                    </div>
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Highest Level of Education Completed / In Progress</label>
									<select name="hle" id="hle" class="form-control">
									<option value="">Select</option>
									<?php
												foreach($hletypes as $row)
												{
											?>
												<option <?php if($hle== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
									</select>
									</div>
								</div>
								<?php
								$university1='';
										$query_cities = $con->query("SELECT 
									university,id,ccode 
									FROM university where id='".$university."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['university']!="")
			{
				$university1=$res_cities[0]['university'];
				
				$queryccode=$con->query("SELECT country from countries where ccode='".$res_cities[0]['ccode']."'");
				$res_ccode = $queryccode->result_array();
				if($res_ccode[0]['country']!="")
				{
					$university1.=" - ".$res_ccode[0]['country'];
				}
			}
								?>
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>University / College attended</label><br>
									<input type="text" id="university" name="university" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $university1;?>"  placeholder="E.g. York University" >

									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Graduation year / Anticipated year</label>
									<select name="graduation_year" id="graduation_year" class="form-control">
									<option value=0>Select</option>
									<?php
											for($i=2030;$i>=1950;$i--)
											{
											?>
											<option <?php if($graduation_year== $i ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?>><?php echo $i;?></option>
											<?php
											}
											?>
									</select>
									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Program of study</label><br>
									<?php
										$study1='';
										$query_cities = $this->db->query("SELECT 
									major_cat,id 
									FROM study where id='".$program_study."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['major_cat']!="")
			{
				$study1=$res_cities[0]['major_cat'];
			}
			
			
				?>
				<input type="text" id="study" name="study" class="typeahead tt-query form-control" autocomplete="off" spellcheck="false" value="<?php echo $study1;?>"  placeholder="E.g. Study" >

									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Designations</label>
									<?php
										$designation1='';
										$query_cities = $this->db->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations where id='".$designation."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['CertificateDesignationName']!="")
			{
				$designation1=$res_cities[0]['CertificateDesignationName']." - ".$res_cities[0]['Abbreviation'];
			}
			$designation1="";
				?>	
				<input type="text" id="designations" name="designation" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $designation1;?>"  placeholder="E.g. CPA" >

									</div>
								</div>
								
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-4" class="form-heading">
                                        <p>&nbsp;</p>
										<h4>Employment Information</h4>
                                        <br>
                                    </div>
								<div style="clear:both;"></div>
								
								
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Most Recent Experience Level</label>
									<select name="MostRecentExpLevelID" id="MostRecentExpLevelID" class="form-control">
									<option value=0>Select</option>
									<?php
										foreach($MostRecentExpLevelIDs as $row)
										{
									?>
										<option <?php if($MostRecentExpLevelID== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
									<?php
										}
									?>
									</select>
									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Most Recent Performance Rating Received</label>
									<select name="performance_rating" id="performance_rating" class="form-control">
									<option value=0>Select</option>
									<?php
												foreach($performances as $row)
												{
											?>
												<option <?php if($performance_rating== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
									</select>
									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Most Recent Employer</label>
									<?php
										$employers1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Employers where id='".$most_recent_employer."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$employers1=$res_cities[0]['description'];
			}
				?>		
				<input type="text" id="employers" name="most_recent_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $employers1;?>"  placeholder="E.g. Microsoft" >

									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Industry of employer</label><br>
									<?php
										$industry1='';
										$query_cities = $this->db->query("SELECT 
									name,id 
									FROM industry where id='".$industry_employer."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['name']!="")
			{
				$industry1=$res_cities[0]['name'];
			}
				?>	
				<input type="text" id="industry_employer" name="industry_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $industry1;?>"  placeholder="E.g. industry" >

									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Area of expertise / Type of role</label><br>
									<?php
										$expertises1='';
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role where id='".$expertise_role."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$expertises1=$res_cities[0]['description'];
			}
				?>		
				<input type="text" id="expertise_role" name="expertise_role" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false"  value="<?php echo $expertises1;?>"  placeholder="E.g. Business" >

									</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Salary Range</label>
									<select name="salary_range" id="salary_range" class="form-control">
									<option value=0>Select</option>
									<?php
											foreach($salarys as $row)
											{
											?>
											<option <?php if($salary_range== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
											}
											?>
									</select>
									</div>
								</div>
								
								<div style="clear:both;"></div>
								
								<!---->
<p align="center">
<input type="hidden" name="insertform" id="insertform" value=1>
<input type="hidden" name="submitform" value=1>
<input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/users/'">
</p>								
							</div>	
						</div>
					</form>		
</div>
<script>
function show_province(n1,fieldname,n2)
{
	
	document.getElementById("cities").options.length = 0;
	var select1 = document.getElementById("cities");

	select1.options[select1.options.length] = new Option("Select City", '');
	
	Getpages("<?php echo ORGURL;?>/provincelistR.php?p="+n1,fieldname);
	
	

}
function show_cities(n1,fieldname)
{
	Getpages("<?php echo ORGURL;?>/citylistR.php?p="+n1,"cities");
}

function showpassfield()
{
	if(document.getElementById("changepassoption").value==1)
	{
	document.getElementById("Password").value="";
	document.getElementById("Password").type="Password"
	}
	else
	{
	document.getElementById("Password").value="-";
	document.getElementById("Password").type="hidden"
	}
}

</script>

<?php
//include("includes/footer.php");
?>
<!-- Bootstrap core JavaScript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/app/asset/js/jquery-min.js"></script>
    <script src="/app/asset/js/popper.min.js"></script>
    <script src="/app/asset/js/bootstrap.min.js"></script>
    <script src="/app/asset/js/ie10-viewport-bug-workaround.js"></script>
    <script src="/app/asset/js/ie-emulation-modes-warning.js"></script>
    <script src="/app/asset/js/custom.js"></script>
    <script src="/app/asset/js/jquery.matchHeight-min.js"></script>
	<script src="/app/asset/js/typeahead.js"></script>
    <script type="text/javascript">
        jQuery('.coleql_height').matchHeight();
		var checkboxes = $("input[type='checkbox']"),
		submitButt = $("button[type='button']");
		checkboxes.click(function() {
		submitButt.attr("disabled", !checkboxes.is(":checked"));
		});
		
		
		function continue_click(id,n1=0)
		{
			if(n1==1)
			{
				idless=id-1;
				if(document.getElementById("div"+idless))
				{
					var divname=document.getElementById("div"+idless).innerHTML;
				
					
					checkradio=new Array();
					
					checkradiocnt=0;
				
					var radios = document.getElementsByTagName('input');
					for (i = 0; i < radios.length; i++) {
						if (radios[i].type == 'radio') {
							checkradioname=radios[i].name;
							checkradioid='id="'+checkradioname+'"';
								
							if(divname.indexOf(checkradioid) > 0)
							{
								var n = checkradio.includes(checkradioname);
							
								if(n > 0)
								{
								}
								else
								{
									checkradiocnt++;
									checkradio[checkradiocnt]=checkradioname;
									
								}
							}
							
						}
						
					}
					
					moveforward=1;
					for(i=1;i<=checkradiocnt;i++)
					{
						var radios = document.getElementsByName(checkradio[i]);
						
						var checkforward=0;
						
						for(var j = 0; j < radios.length; j++){
							
							if(radios[j].checked)
							{
								checkforward=1;
							}
						}
						
						if(checkforward==0)
						{
							moveforward=0;
						}
					}
				}	
			}
		
			//alert();
			if(n1==0)
			{
				moveforward=1;
			}
			
			if(moveforward==1)
			{
				$(".unknow").hide();
				
				$('#div'+id).show(function(){$('#div'+id).focus();});
			}
			else
			{
				alert("Please Select Answer for all questions");
			}
		}
		
		$('form[name="form_register"]').submit(function(e) {
									  
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if($("#first_name").val()=="First name" || $("#first_name").val()=="")
		{
			$("#first_name").addClass('error');	
			$("#first_name").focus().val('').attr('placeholder','Please Enter First Name');
			return false;
		}
		
		if($("#last_name").val()=="Last name" || $("#last_name").val()=="")
		{
			$("#last_name").addClass('error');	
			$("#last_name").focus().val('').attr('placeholder','Please Enter Last Name');
			return false;
		}
		
		if(!filter.test($("#email").val()))
		{
			$("#email").addClass('error');	
			$("#email").focus().val('').attr('placeholder','Please Enter Valid Email Address');
			return false;
		}
		
		if($("#password").val()=="Password" || $("#password").val()=="")
		{
			$("#password").addClass('error');	
			$("#password").focus().val('').attr('placeholder','Please Enter Password Here');
			return false;
		}
		
		if($("#password").val()!=$("#confirm_password").val() )
		{
			$("#confirm_password").focus().val('').attr('placeholder','Password does not match');
			return false;
		}
		
		
	});

		$('form[name="forgot_password"]').submit(function(e) {

			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!filter.test($("#email").val()))
			{
				$("#email").addClass('error');
				$("#email").focus().val('').attr('placeholder','Please Enter Valid Email Address');
				return false;
			}




		});


		$('form[name="set_new_password"]').submit(function(e) {



			if($("#password").val()=="Password" || $("#password").val()=="")
			{
				$("#password").addClass('error');
				$("#password").focus().val('').attr('placeholder','Please Enter Password Here');
				return false;
			}

			if($("#password").val()!=$("#confirm_password").val() )
			{
				$("#confirm_password").focus().val('').attr('placeholder','Password does not match');
				return false;
			}


		});



		$('#self').click(function(e) {
        e.preventDefault();
        $("#checkout1").submit();
    });
	
   $('#orgin').click(function(e) {
        e.preventDefault();
        $("#checkout2").submit();
    });
   $('#orgin360').click(function(e) {
        e.preventDefault();
        $("#checkout3").submit();
    });	
	if(typeof state_id !== "undefined")
	{
		continue_click(state_id);
    }


	
$(document).on('click', '#invite_users',function(e) {
									 
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if($("#first_name").val()=="First name" || $("#first_name").val()=="")
		{
			$("#first_name").addClass('error');	
			$("#first_name").focus().val('').attr('placeholder','Please Enter First Name');
			return false;
		}
		
		if($("#last_name").val()=="Last name" || $("#last_name").val()=="")
		{
			$("#last_name").addClass('error');	
			$("#last_name").focus().val('').attr('placeholder','Please Enter Last Name');
			return false;
		}
		
		if(!filter.test($("#email").val()))
		{
			
			$("#email").addClass('error');	
			$("#email").focus().val('').attr('placeholder','Please Enter Valid Email Address');
			return false;
		}
		
		/*if($("#wwt").val()=="Last name" || $("#wwt").val()=="")
		{
			$("#wwt").addClass('error');	
			$("#wwt").focus().val('').attr('placeholder','Please Enter Details');
			return false;
		}
		
		if($("#mentor").val()=="Last name" || $("#mentor").val()=="")
		{
			$("#mentor").addClass('error');	
			$("#mentor").focus().val('').attr('placeholder','Please Enter Mentor');
			return false;
		}
		
		if($("#peer").val()=="Last name" || $("#peer").val()=="")
		{
			$("#peer").addClass('error');	
			$("#peer").focus().val('').attr('placeholder','Please Enter if this person a peer');
			return false;
		}*/
		
		$("#invite_users_form").on( "submit", function(e) {
		
			var postData = $(this).serializeArray();
			var formURL = "<?php echo '/selfassessment/add_invite_user/';?>"+order_id; 
			
			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data) 
				{
					//data: return data from server
					//alert('it worked');
					$('#invitee').empty();
					//$( "#invitee" ).load("<?php echo '/selfassessment/show_invited_people/';?>"+order_id);
					//$('#ModalForm').modal('toggle');
					location.reload("<?php echo '/selfassessment/thirdparty/8#invitee';?>");
					//window.location.href = "<?php echo '/selfassessment/thirdparty/8#invitee';?>";
					return false;
					
				}
			});
		e.preventDefault();	
		});
		
		
		
		
		
	});
	$('#invite_submit').click( function(){
			$('form[name="thirdparty_assessment_form"]').submit();
		});
		<?php
		if(isset($universitys))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var university = <?php echo $universitys;?>;

				// Constructing the suggestion engine
				var university = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: university
				});

				// Initializing the typeahead
				$('#university').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 1 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'university',
							source: university
						});
			});
		<?php
		}
		?>

		<?php
		if(isset($study))
		{
		?>
		$(document).ready(function(){
			// Defining the local dataset
			var study = <?php echo $study;?>;

			// Constructing the suggestion engine
			var study = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				local: study
			});

			// Initializing the typeahead
			$('#study').typeahead({
						hint: false,
						highlight: true, /* Enable substring highlighting */
						minLength: 1 /* Specify minimum characters required for showing suggestions */
					},
					{
						name: 'study',
						source: study
					});
		});
		<?php
		}
		?>


		<?php
		if(isset($industry))
		{
		?>
		$(document).ready(function(){
			// Defining the local dataset
			var industry = <?php echo $industry;?>;

			// Constructing the suggestion engine
			var industry = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				local: industry
			});

			// Initializing the typeahead
			$('#industry_employer').typeahead({
						hint: false,
						highlight: true, /* Enable substring highlighting */
						minLength: 1 /* Specify minimum characters required for showing suggestions */
					},
					{
						name: 'industry',
						source: industry
					});
		});
		<?php
		}
		?>

		<?php
		if(isset($occupation))
		{
		?>
		$(document).ready(function(){
			// Defining the local dataset
			var expertise_role = <?php echo $occupation;?>;

			// Constructing the suggestion engine
			var expertise_role = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				local: expertise_role
			});

			// Initializing the typeahead
			$('#expertise_role').typeahead({
						hint: false,
						highlight: true, /* Enable substring highlighting */
						minLength: 1 /* Specify minimum characters required for showing suggestions */
					},
					{
						name: 'expertise_role',
						source: expertise_role
					});
		});
		<?php
		}
		?>

</script>