<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
          function Getpages (n1,id1) {
             $('#'+id1).load(n1);
          };
</script>
<script type="text/javascript">
cities_list=new Array();
</script>
<?php
$query_country = $this->db->query("SELECT 
									id, country 
									FROM countries
									where country = '".$this->session->userdata('country')."'
									limit 1");
$res_country = $query_country->row();


//GET THE LIST OF CITIES
$noprovinces="-1";
$chkprovinces=$this->db->query("select * from provinces where countryid = '".$res_country->id."' order by province_name");

$chkprovincesQ = $chkprovinces->result_array();

foreach($chkprovincesQ as $chkprovincesr)
{
	$chkcities=$this->db->query("select * from Cities where ProvinceID=".$chkprovincesr["id"]." order by description");	
	
	$cities="";
	
	$chkcitiesQ = $chkcities->result_array();
	foreach($chkcitiesQ as $chkcitiesr)
	{
		if($cities!="")
		{
			$cities.=",";
		}
		$cities.=$chkcitiesr["description"];
	}
	if(trim($cities)=="")
	{
		$noprovinces.=",".$chkprovincesr["id"];
	}
	else
	{
		//$cities.=",Not Applicable";
	}
	?>
  <script type="text/javascript">
  cities_list["<?=$chkprovincesr["id"];?>"]="<?php echo $cities;?>";
  </script>
  <?php
}
//END

$TotalTicks=16;
$ActualTicks=0;
?>
<style>
.common-form select{color:#000000 !important;}
.common-form select option {
  color: #000000 !important; // color of all the other options
}
.common-form input[type="text"]{color:#000000 !important;}

.tt-menu {
		width: 500px !important;
		
	}
</style>
<div class="page-banner">
        <div class="container clearfix">
            <h1>Register</h1>
			<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="register-column">
                <div class="row">
					<div style="display:none;" class="mobileview col-lg-4 offset-lg-1 col-md-5 offset-md-0 gift-card-main">
                        <div class="gift-card-col">
							<p><b><big><big>Help us evolve our tool and give you more Insights and resources!</big></big></b></p>
							<p>
							As more people apply and we are able to gather more information, we will be starting to releasee insight reports, personalized development strategies as well as access to exclusive recruitment and talent events. By sharing some information you get be a critical part of our growth journey 
							<br><br>
		<b>We recommend that you will out 10 or more fields but share as much (or little) information as you want. </b> 
							</p>
                            
                        </div>
                    </div>
                    <div class="col-md-12">
					
<div class="desktopview1 gift-card-main">
	<div class="gift-card-col">
		
		<div style="float:left;" class="col-md-12">
		<p><b><big><big>Help us evolve our tool and give you more Insights and resources!</big></big></b></p>
							<p>
							As more people apply and we are able to gather more information, we will be starting to releasee insight reports, personalized development strategies as well as access to exclusive recruitment and talent events. By sharing some information you get be a critical part of our growth journey 
							<br><br>
		<b>We recommend that you will out 10 or more fields but share as much (or little) information as you want. </b> 
							</p>
		
		</div>
		<div style="clear:both;"></div>
		<?php /*
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
		</div>*/?>
		
	</div>
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
										<div style="clear:both;"></div>
                                        <div style="float:left;" class="req-icon-col">
<style>
.show-tick {
	position: relative;
  display: inline-block;
  right: 15px;
  /*margin-top: 5px;*/
  left:2px;
  top:0px;
  z-index:10000;
}
.show-tick {
  margin-right: 34px;
}

.req-icon-col{float:left;width:88%;}
@media screen and (max-width: 991px) {
.req-icon-col{width:75%;}

}

#province_tick, #cities_tick,#age_range_tick,#visible_minorities_tick,#visible_minorities_option_tick,$hle_tick,#university_tick,#graduation_year_tick,#study_tick,#designations_tick,#employers_tick,#MostRecentExpLevelID_tick,#performance_rating_tick,#industry_tick,#expertises_tick,#salary_range_tick{width:5%;float:left;}

.custom-progress-bar .progress {
  background-color: #ffffff !important;
 } 
.yellow-progress-bar .total-progress-count {
  padding-right: 0px !important;
}
</style>										
											<?php
											$tickmark="display:none;";
											?>
                                            <select class="form-control" name="province" id="province" onchange="show_cities(this.value,'cities')">
											<option value=0>Select State OR Province</option>
											<?php
												foreach($province as $row)
												{
												
												$slct="";
												
												if($user['province']== $row['id'] ){
												$slct='Selected ';
												$tickmark="display:block;";
												$ActualTicks++;
												
												}
											?>
												<option <?php echo $slct; ?> value=<?php echo $row['id'];?>><?php echo $row['province_name'];?></option>
											<?php
												}
											?>	
											</select>
											
                                            <span class="req-icon"></span>
                                        </div>
										
										<div id="province_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<?php
										?>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
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
                                        <div style="clear:both;"></div>
                                        <div style="float:left;" class="req-icon-col">
										<?php
										$CITYNAME='';
										
										if(count($province) > 0)
										{
										
										$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Cities where ProvinceID='".(int)$user['province']."'
									order by description asc");
									}
									else
									{
									
									
									$query_cities = $this->db->query("SELECT 
									description,id 
									FROM Cities where CountryID='".(int)$res_country->id."'
									order by description asc");
									}
									
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['description']!="")
			{
				$CITYNAME=$res_cities[0]['description'];
				
			}
			/*<input type="text" id="cities" name="city" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $CITYNAME;?>"  placeholder="E.g. Toronto" >*/
			
			$tickmark="display:none;";
				?>						
											
                                            
											<select name="city" id="cities" class="form-control span12" onchange="tickdropdown('cities')">
											<?php //city ?>
											<option value=0>Select City</option>
			<?php
				foreach($res_cities as $row)
				{
					$slct="";
					if(isset($user['city']) && (int)$user['city']== $row['id'] ){
					$slct="Selected";
					
					$tickmark="display:block;";
					$ActualTicks++;
					
					}
					
					$cityFSel=$row["description"];
			$cityFSel=str_replace('Ã©','é',$cityFSel);

			$cityFSel=str_replace('Ã§','ç',$cityFSel);

			$cityFSel=str_replace('Ã¢','â',$cityFSel);

			$cityFSel=str_replace('Ã¨','è',$cityFSel);

			$cityFSel=str_replace('dâ€™','d’',$cityFSel);

			$cityFSel=str_replace('Å“','œ',$cityFSel);

			$cityFSel=str_replace('â€™','’',$cityFSel);
			$cityFSel=str_replace('Ã´','ô',$cityFSel);

			$cityFSel=str_replace('Ã‰','É',$cityFSel);

			$cityFSel=str_replace('Ã®','î',$cityFSel);
			$cityFSel=str_replace('Ã«','ë',$cityFSel);
			$cityFSel=utf8_decode($row["description"]);
				
			?>
				<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $cityFSel;?></option>
			<?php
				}
			?>	
											<select>
											
                                            <span class="req-icon"></span>
                                        </div>
										<?php
										if($user['city']!="" && $user['city']!="0")
										{
										
										}
										?>
										<div id="cities_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
                                    
									
									 <div class="form-group">
                                        <label>Age Range</label>
                                        <div style="clear:both;"></div>
                                        <div style="float:left;" class="req-icon-col">
 <?php
 $tickmark="display:none;";

 ?>
 <select class="form-control" name="age_range" id="age_range" onchange="tickdropdown('age_range')" >
											<option <?php if($user['age_range']== '' ){ echo 'Selected';} ?> value=0>Select Age Range</option>
											<?php
												foreach($age as $row)
												{
												
												$slct="";
												
												if($user['age_range']== $row['id'] ){
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

                                            
                                            <span class="req-icon"></span>
                                        </div>
										<?php
										if($user['age_range']!="" && $user['age_range']!="0")
										{
										?>
										
										<?php
										}
										?>
										<div id="age_range_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
                                    
									<div class="form-group">
                                        <label>Visible Minorities</label>
                                        <div style="clear:both;"></div>
                                        <div style="float:left;" class="req-icon-col">
<?php
$tickmark="display:none;";
?>
                                            <select class="form-control" name="visible_minorities" id="visible_minorities" onchange="changevm()">
											<option selected>Select</option>
											<option <?php if($user['visible_minorities']== 'Yes' && (int)$user['visible_minorities_option']>0){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value='Yes'>Yes</option>
											<option <?php if($user['visible_minorities']== 'No' ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value='No'>No</option>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
										<?php
										if($user['visible_minorities']== 'Yes' && (int)$user['visible_minorities_option']>0)
										{
										?>
										<?php
										}
										?>
										<div id="visible_minorities_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
                                    
									
									<div style="display:none;" id="visible_minorities_optiondiv" class="form-group">
                                        <label>Please Specify</label>
                                        <div style="clear:both;"></div>
                                        <div style="float:left;" class="req-icon-col">
										<?php
$tickmark="display:none;";
?>
                                            <select class="form-control" name="visible_minorities_option" id="visible_minorities_option"  onchange="checkvm()">
											<option value=0>Select</option>
											<?php
												foreach($minorities as $row)
												{
											?>
												<option <?php if($user['visible_minorities_option']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
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
										<?php
										if($user['visible_minorities_option']!="" && $user['visible_minorities_option']!="0")
										{
										?>
										
										<?php
										}
										?>
										<div id="visible_minorities_option_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
                                    
                                    
									<div class="form-heading text-center">
                                        <p>&nbsp;</p>
										<h4>Education Information</h4>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label>Highest Level of Education Completed / In Progress</label>
                                        <div style="clear:both;"></div>
                                        <div style="float:left;" class="req-icon-col">
										<?php
$tickmark="display:none;";
?>
                                            <select onchange="tickdropdown('hle')" class="form-control" name="hle" id="hle">
											<option value=0>Select</option>
											<?php
												foreach($hletypes as $row)
												{
											?>
												<option <?php if($user['hle']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    <?php
										if($user['hle']!="" && $user['hle']!="0")
										{
										?>
										<?php
										}
										?>
										<div id="hle_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>University / College attended</label>
										<div style="clear:both;"></div>
                                        <div style="float:left;width:88%;" class="req-icon-col bs-example">
                                        <?php //print_r($universities);?>
											<?php
											
										$university1='';
										$query_cities = $this->db->query("SELECT 
									university,id,ccode 
									FROM university where id='".$user['university']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['university']!="" && (int)$user['university'] > 0)
			{
				$university1=$res_cities[0]['university'];
				
				$queryccode=$this->db->query("SELECT country from countries where ccode='".$res_cities[0]['ccode']."'");
				$res_ccode = $queryccode->result_array();
				if($res_ccode[0]['country']!="")
				{
					$university1.=" - ".$res_ccode[0]['country'];
				}
			}
				?>					
<?php
$tickmark="display:none;";
?>				
											<input onfocus="ticktext('university')" onblur="ticktext('university')" onkeyup="ticktext('university')" onkeydown="ticktext('university')" type="text" id="university" name="university" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $university1;?>"  placeholder="E.g. York University" >
                                            
											<span class="req-icon"></span>
                                        </div>
                                    <?php
										if($university1!="")
										{
											$tickmark="display:block;";
											$ActualTicks++;
										?>
										<?php
										}
										?>
										<div id="university_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
                                    
									<div class="form-group">
                                        <label>Graduation year / Anticipated year</label>
                                        <div style="float:left;" class="req-icon-col">
										<?php
$tickmark="display:none;";
?>
                                            <select onchange="tickdropdown('graduation_year')" class="form-control" name="graduation_year" id="graduation_year" >
											<option value=0>Select</option>
											<?php
											for($i=2030;$i>=1950;$i--)
											{
											?>
											<option <?php if($user['graduation_year']== $i ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?>><?php echo $i;?></option>
											<?php
											}
											?>
											
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                   <?php
										if($user['graduation_year']!="" && $user['graduation_year']!="0")
										{
										?>
										
										<?php
										}
										?>
										<div id="graduation_year_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>Program of study</label>
                                        <div style="float:left;" class="req-icon-col">
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
<?php
$tickmark="display:none;";
?>				
											<input onfocus="ticktext('study')" onblur="ticktext('study')" onkeyup="ticktext('study')" onkeydown="ticktext('study')" type="text" id="study" name="study" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $study1;?>"  placeholder="E.g. Study" >
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                   <?php
										if($study1!="")
										{
											$tickmark="display:block;";
											$ActualTicks++;
										?>
										
										<?php
										}
										?>
										<div id="study_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>Designations</label>
                                        <div style="float:left;" class="req-icon-col">
										<?php
										$designation1='';
										$query_cities = $this->db->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations where id='".$user['designation']."'
									order by id asc");
			$res_cities = $query_cities->result_array();
			if($res_cities[0]['CertificateDesignationName']!="")
			{
				$designation1=$res_cities[0]['CertificateDesignationName']." - ".$res_cities[0]['Abbreviation'];
			}
			$designation1="";
				?>	
<?php
$tickmark="display:none;";
?>				
											<input type="text" id="designations" name="designation" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $designation1;?>"  placeholder="E.g. CPA" >
											<p align="right">
											<a href="javascript:addDesignation()">Add to List</a>
											</p>
											<p>
<?php
$totaldesignations=0;

$nodesig_style="display:block";

$putdesignations="";
$query_desigidQ = $this->db->query("SELECT 
									DesignationID 
									FROM UsersDesignations where UserID=".(int)$this->session->userdata('user_id'));
$res_desigidR = $query_desigidQ->result_array();
foreach($res_desigidR as $result1){

	$designationsID=(int)$result1['DesignationID'];
	
	
	
	$query_desig = $this->db->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations where id='".$designationsID."'
									order by id asc");
			$res_desig = $query_desig->result_array();
			if($res_desig[0]['CertificateDesignationName']!="")
			{
				$designationsel=$res_desig[0]['CertificateDesignationName'];
				if($res_desig[0]['Abbreviation']!="")
				{
				$designationsel.=" - ".$res_desig[0]['Abbreviation'];
				}
				
				
			
				$totaldesignations++;
				
				$nodesig_style="display:none";
				
				$inputvar='<input type="hidden" name="designations[]" id="designations_'.$totaldesignations.'" value="'.$designationsel.'">';
				
				$delvar='&nbsp;&nbsp;<a style="color:red;font-weight:bold;font-size:24px;" href="javascript:delDesignation('.$totaldesignations.')">X</a>';
				
				$spanvar='<span id="Spandesignations_'.$totaldesignations.'"><br>'.$designationsel.$delvar.'</span>';
			
				$putdesignations.=$inputvar.$spanvar;
			}

}									
											
?>
											<span style="font-size:12px;" id="designations_sel">
											<b>Designations Selected</b>
											<?php echo $putdesignations;?>
											<span id="nodesig" style='<?php echo $nodesig_style;?>'><br>No Designation Selected<br></span>
											</span>
											</p>
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    <?php
										if($totaldesignations > 0)
										{
											$tickmark="display:block;";
											$ActualTicks++;
										?>
										<?php
										}
										?>
										<div id="designations_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
<script>
totaldesignations="<?php echo $totaldesignations;?>";
totaldesignationsel=totaldesignations;									
function addDesignation()
{
	if(document.getElementById("designations").value=="")
	{
		alert("Please Select a Designation to Add");
	}
	else
	{
		totaldesignations++;
		totaldesignationsel++;
		
		inputvar='<input type="hidden" name="designations[]" id="designations_'+totaldesignations+'" value="'+document.getElementById("designations").value+'">';
		
		delvar='&nbsp;&nbsp;<a style="color:red;font-weight:bold;font-size:24px;" href="javascript:delDesignation('+totaldesignations+')">X</a>';
		
		spanvar='<span id="Spandesignations_'+totaldesignations+'"><br>'+document.getElementById("designations").value+delvar+'</span>';
		
		document.getElementById("designations_sel").innerHTML+=inputvar+spanvar;
		document.getElementById("designations").value="";
	}
	
	if(totaldesignationsel > 0)
	{
		document.getElementById("nodesig").style.display="none";
		document.getElementById("designations_tick").style.display="block";
	}
	else
	{
		document.getElementById("designations_tick").style.display="none";
	}
}
function delDesignation(n1)
{
	if(document.getElementById("designations_"+n1) && document.getElementById("Spandesignations_"+n1))
	{
		document.getElementById("designations_"+n1).value="";
		document.getElementById("Spandesignations_"+n1).style.display="none";
		
		totaldesignationsel--;
	}
	
	if(totaldesignationsel < 1)
	{
		document.getElementById("nodesig").style.display="block";
		document.getElementById("designations_tick").style.display="none";
	}
	else
	{
		document.getElementById("designations_tick").style.display="block";
	}
}
</script>
									<div class="form-heading text-center">
                                        <p>&nbsp;</p>
										<h4>Employment Information</h4>
                                        
                                    </div>
									
									<div class="form-group">
                                        <label>Most Recent Employer</label>
                                        <div style="float:left;" class="req-icon-col">
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
<?php
$tickmark="display:none;";
?>				
											<input onfocus="ticktext('employers')" onblur="ticktext('employers')" onkeyup="ticktext('employers')" onkeydown="ticktext('employers')" type="text" id="employers" name="most_recent_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $employers1;?>"  placeholder="E.g. Microsoft" >
                                            
                                            
                                            <span class="req-icon"></span>
                                        </div>
                                    <?php
										if($employers1!="")
										{
										$tickmark="display:block;";
										$ActualTicks++;
										?>
										<?php
										}
										?>
										<div id="employers_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>Most Recent Experience Level</label>
                                        <div style="float:left;" class="req-icon-col">
										<?php
$tickmark="display:none;";
?>
											<select onchange="tickdropdown('MostRecentExpLevelID')" class="form-control" name="MostRecentExpLevelID" id="MostRecentExpLevelID">
											<option value=0>Select</option>
											<?php
												foreach($MostRecentExpLevelIDs as $row)
												{
											?>
												<option <?php if($user['MostRecentExpLevelID']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    <?php
										if($user['MostRecentExpLevelID']!="" && $user['MostRecentExpLevelID']!="0")
										{
										?>
										<?php
										}
										?>
										<div id="MostRecentExpLevelID_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>Most Recent Performance Rating Received</label>
										<div style="float:left;" class="req-icon-col">
										<?php
$tickmark="display:none;";
?>
										<select onchange="tickdropdown('performance_rating')" class="form-control" name="performance_rating" id="performance_rating">
											<option value=0>Select</option>
											<?php
												foreach($performances as $row)
												{
											?>
												<option <?php if($user['performance_rating']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
												}
											?>
											</select>
                                            
											<span class="req-icon"></span>
										</div>
                                    <?php
										if($user['performance_rating']!="" && $user['performance_rating']!="0")
										{
										?>
										<?php
										}
										?>
										<div id="performance_rating_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>Industry of employer</label>
                                        <div style="float:left;" class="req-icon-col">
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
<?php
$tickmark="display:none;";
?>				
											<input onfocus="ticktext('industry')" onblur="ticktext('industry')" onkeyup="ticktext('industry')" onkeydown="ticktext('industry')" type="text" id="industry" name="industry_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $industry1;?>"  placeholder="E.g. industry" >
                                            
											<span class="req-icon"></span>

                                        </div>
                                   <?php
								   	if($industry1!="" && $industry1!="0")
										{
											$tickmark="display:block;";
											$ActualTicks++;
										?>
										<?php
										}
										?>
										<div id="industry_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>Area of expertise / Type of role</label>
                                        <div style="float:left;" class="req-icon-col">
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
<?php
$tickmark="display:none;";
?>				
											<input onfocus="ticktext('expertises')" onblur="ticktext('expertises')" onkeyup="ticktext('expertises')" onkeydown="ticktext('expertises')" type="text" id="expertises" name="expertise_role" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $expertises1;?>"  placeholder="E.g. Business" >
                                            
											<span class="req-icon"></span>
                                        </div>
                                    <?php
										if($expertises1!="")
										{
											$tickmark="display:block;";
											$ActualTicks++;
										?>
										<?php
										}
										?>
										<div id="expertises_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
									<div class="form-group">
                                        <label>Salary Range</label>
                                        <div style="float:left;" class="req-icon-col">
										<?php
$tickmark="display:none;";
?>
                                            <select onchange="tickdropdown('salary_range')" class="form-control" name="salary_range" id="salary_range" >
											<option>Select</option>
											<?php
											foreach($salarys as $row)
											{
											?>
											<option <?php if($user['salary_range']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";$ActualTicks++;} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
											<?php
											}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
                                    <?php
										if($user['salary_range']!="" && $user['salary_range']!="0")
										{
										?>
										<?php
										}
										?>
										<div id="salary_range_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
									<div style="clear:both;"></div>
									
<?php
$TotalTicks=10;

$diff=$ActualTicks/$TotalTicks;
$diff*=100;
if($diff < 0)
{
	$diff=0;
}
if($diff > 100)
{
	$diff=100;
}
//echo (int)$diff;
?>									
					<div id="progress-bar" class="custom-progress-bar yellow-progress-bar">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo (int)$diff;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="<?php echo (int)$diff;?>"></div>
                                    <div class="total-progress-count"></div>
                                </div>
                                <div class="complete-text text-center">
                                    <p><?php echo (int)$diff;?>% Complete</p>
                                </div>
                            </div>
									<?php
									/*/
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
                                        <div style="float:left;" class="req-icon-col">
										<select onchange="tickdropdown('local_amazon_web')" class="form-control" name="local_amazon_web" id="local_amazon_web" required >
											<option value=0>Select</option>
											<?php
											foreach($amazons as $row)
											{
											?>
											<option <?php if($user['local_amazon_web']== $row["id"] ){ echo 'Selected';$tickmark="display:block;";} ?> value="<?php echo $row["id"];?>"><?php echo $row["description"];?></option>
											<?php
											}
											?>
											</select>
                                            <span class="req-icon"></span>
                                        </div>
										<?php
										<?php
										if($user['local_amazon_web']!="" && $user['local_amazon_web']!="0")
										{
										?>
										<?php
										}
										?>
										<div id="local_amazon_web_tick" style="float:left;padding:10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
										<div style="clear:both;"></div>
                                    </div>
										*/
$tickmark="display:none;";
?>
                                            
                                    
									<div style="clear:both;"></div>
									
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-secondary btn-style-2">Submit NOW</button>
										
										<button type="submit" class="btn btn-secondary btn-style-2">Save Later</button>
										
										<?php /* ?>
										 <a href="<?php echo base_url();?>" class="btn btn-secondary btn-style-2">Save Later</a>
										 <?php */ ?>
                                    </div>
									<input type="hidden" name="TotalFieldsEntered" id="TotalFieldsEntered" value="<?php echo (int)$ActualTicks;?>">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="desktopview col-lg-4 offset-lg-1 col-md-5 offset-md-0 gift-card-main">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
<script>
function checkvm()
{

	if(document.getElementById("visible_minorities_option").selectedIndex > 0)
	{
		if(document.getElementById("visible_minorities_option_tick").style.display=="none")
		{
			ActualTicks++;
		}
		document.getElementById("visible_minorities_option_tick").style.display="block";
	}
	else
	{
		if(document.getElementById("visible_minorities_option_tick").style.display=="block")
		{
			ActualTicks--;
		}
		document.getElementById("visible_minorities_option_tick").style.display="none";
	}

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
	showprogress()
}
function changevm()
{

	if(document.getElementById("visible_minorities").selectedIndex > 0)
	{
		if(document.getElementById("visible_minorities_tick").style.display=="none")
		{
			ActualTicks++;
		}
		document.getElementById("visible_minorities_tick").style.display="block";
	}
	else
	{
		if(document.getElementById("visible_minorities_tick").style.display=="block")
		{
			ActualTicks--;
		}
		document.getElementById("visible_minorities_tick").style.display="none";
	}

	if(document.getElementById("visible_minorities").value=="Yes")
	{
		document.getElementById("visible_minorities_optiondiv").style.display="block";
	}
	else
	{
		document.getElementById("visible_minorities_optiondiv").style.display="none";
	}
	showprogress()
}
changevm()
</script>
<script type="text/javascript">
//CHECK CITY
city1="<?php echo $CITYNAME;?>";



function display_cities1(n1,fieldname)
{
    
    
	
	myobject1=cities_list[n1].split(",");


	var select1 = document.getElementById(fieldname);



	cnt1=0;

	for(index1 in myobject1) 
	{
		select1.options[select1.options.length] = new Option(myobject1[index1], myobject1[index1]);

		cnt1++;



		if(city1==myobject1[index1] && fieldname=="cities")
		{
			select1.selectedIndex=(cnt1);
			
			//alert((cnt1-1))
		}
		
	}
}
function show_cities1(n1,fieldname)
{
    
     
	
	document.getElementById(fieldname).options.length = 0;
	var select1 = document.getElementById(fieldname);

	select1.options[select1.options.length] = new Option("Select City", "");

	if(cities_list[n1]!="")
	{
		display_cities1(n1,fieldname);
	}

}
function show_cities(n1,fieldname)
{
	
	if(document.getElementById("province").selectedIndex > 0)
	{
		if(document.getElementById("province_tick").style.display=="none")
		{
			ActualTicks++;
		}
		document.getElementById("province_tick").style.display="block";
	}
	else
	{
		if(document.getElementById("province_tick").style.display=="block")
		{
			ActualTicks--;
		}
		document.getElementById("province_tick").style.display="none";
	}
	
	if(document.getElementById("cities_tick").style.display=="block")
	{
		ActualTicks--;
	}
	
	document.getElementById("cities_tick").style.display="none";
	showprogress()

	Getpages("<?php echo base_url();?>citylistR.php?p="+n1,"cities");
}

function tickdropdown(n1)
{
	if(document.getElementById(n1).selectedIndex > 0)
	{
		if(document.getElementById(n1+"_tick").style.display=="none")
		{
			ActualTicks++;
		}
		document.getElementById(n1+"_tick").style.display="block";
		
	}
	else
	{
		if(document.getElementById(n1+"_tick").style.display!="none")
		{
			ActualTicks--;
		}
		document.getElementById(n1+"_tick").style.display="none";
		
	}
	showprogress()
}
function ticktext(n1)
{
	if(document.getElementById(n1).value!="")
	{
		if(document.getElementById(n1+"_tick").style.display=="none")
		{
			ActualTicks++;
		}
		document.getElementById(n1+"_tick").style.display="block";
		
		
	}
	else
	{
		if(document.getElementById(n1+"_tick").style.display!="none")
		{
			ActualTicks--;
		}
		document.getElementById(n1+"_tick").style.display="none";
		
	}
	showprogress()
}

ActualTicks="<?php echo (int)$ActualTicks;?>";
TotalTicks=10;
function showprogress()
{
	
	diff=ActualTicks/TotalTicks;
	diff*=100;
	if(diff < 0)
	{
		diff=0;
	}
	
	if(diff > 100)
	{
		diff=100;
	}
	
	abcd=(ActualTicks+" "+TotalTicks+" "+diff);
	
	document.getElementById("TotalFieldsEntered").value=ActualTicks;
	
	document.getElementById("progress-bar").innerHTML='<div class="progress"><div class="progress-bar" role="progressbar" style="width: '+parseInt(diff)+'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="'+parseInt(diff)+'"></div><div class="total-progress-count"></div></div><div class="complete-text text-center"><p>'+parseInt(diff)+'% Complete</p></div>';
}

//show_cities(document.getElementById("province").value,'cities')
</script>