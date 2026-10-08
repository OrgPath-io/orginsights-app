<script src="<?php echo base_url();?>asset/js/jquery-min.js"></script>
<script>
var totalselection=0;

fieldnames=new Array();
fieldnames[1]="countryid";
fieldnames[2]="province";
fieldnames[3]="cities";
fieldnames[4]="age_range";
fieldnames[5]="hle";
fieldnames[6]="university";
fieldnames[7]="study";
fieldnames[8]="designation";
fieldnames[9]="MostRecentExpLevelID";
fieldnames[10]="performance_rating";
fieldnames[11]="industry_employer";
fieldnames[12]="expertise_role";
fieldnames[13]="graduation_year";
fieldnames[14]="salary_range";

var selectfield=new Array();
for(f2=1;f2<=14;f2++)
{
	selectfield[f2]="";
}
selectfield[1]="countryid";

var totpop=0;

$(document).ready(function() {
   var delay = 2000;
   $('.btn-default').click(function(e){
   //e.preventDefault();
   var user_id="<?php echo (int)$this->session->userdata('user_id');?>";
	var order_id="<?php echo (int)$order_id;?>";
	var countryid = $('#countryid').val();
	var province = $('#province').val();
	var cities = $('#cities').val();
	var age_range = $('#age_range').val();
	var hle = $('#hle').val();
	var university = $('#university').val();
	var study = $('#study').val();
	var designation = $('.designation').val();
	var MostRecentExpLevelID = $('#MostRecentExpLevelID').val();
	var performance_rating = $('#performance_rating').val();
	var industry_employer = $('#industry_employer').val();
	var expertise_role = $('#expertise_role').val();
	var graduation_year = $('#graduation_year').val();
	var salary_range = $('#salary_range').val();
	
	var salary_range =555;
	
	totalselection=14;
	
	if($('#countryid').is(':checked')==false)
	{
		countryid=0;
		totalselection--;
	}
	if($('#province').is(':checked')==false)
	{
		province=0;
		totalselection--;
	}
	if($('#cities').is(':checked')==false)
	{
		cities=0;
		totalselection--;
	}
	if($('#age_range').is(':checked')==false)
	{
		age_range=0;
		totalselection--;
	}
	if($('#hle').is(':checked')==false)
	{
		hle=0;
		totalselection--;
	}
	if($('#university').is(':checked')==false)
	{
		university=0;
		totalselection--;
	}
	if($('#study').is(':checked')==false)
	{
		study=0;
		totalselection--;
	}
	if($('.designation').is(':checked')==false)
	{
		designation=0;
		totalselection--;
	}
	if($('#MostRecentExpLevelID').is(':checked')==false)
	{
		MostRecentExpLevelID=0;
		totalselection--;
	}
	if($('#performance_rating').is(':checked')==false)
	{
		performance_rating=0;
		totalselection--;
	}
	if($('#industry_employer').is(':checked')==false)
	{
		industry_employer=0;
		totalselection--;
	}
	if($('#expertise_role').is(':checked')==false)
	{
		expertise_role=0;
		totalselection--;
	}
	if($('#graduation_year').is(':checked')==false)
	{
		graduation_year=0;
		totalselection--;
	}
	if($('#salary_range').is(':checked')==false)
	{
		salary_range=0;
		totalselection--;
	}
	
//check
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_check.php",
   data: "user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
   success: function(data)
   {
   $('#populationcheck').val(data);
   totpop=data;
   //alert(totpop);
   if(totpop > 0)
   {
		selectfieldcnt=0;
		for(f2=1;f2<=14;f2++)
		{
			selectfield[f2]="";
		}
		
		
		for(f=1;f<=14;f++)
		{
			if($('#'+fieldnames[f]).is(':checked')==true)
			{
				selectfieldcnt++;
			
				selectfield[selectfieldcnt]=fieldnames[f];
			}
		}
		
   
		putdetails();
   }
   else
   {
		for(f=1;f<=14;f++)
		{
			if($('#'+fieldnames[f]).is(':checked')==true)
			{
				var found=0;
				for(f2=1;f2<=14;f2++)
				{
					if(selectfield[f2]!="")
					{
						
						if(selectfield[f2]==fieldnames[f])
						{
							found=1;
						}
					}
				}
				
				if(found==0)
				{
					$('#'+fieldnames[f]).prop("checked", false);
				}
			}
		}
   
	alert("There is no result for this filter selected with the other filters\nSo it cannot be selected along with the other filters");
	
	
   }
   /*setTimeout(function() {
   $('#populationcheck').val(data);
   totpop=data;
   }, delay);*/
   }
   });
   
//end check	
	});

function putdetails()
{	
	var user_id="<?php echo (int)$this->session->userdata('user_id');?>";
	var order_id="<?php echo (int)$order_id;?>";
	var countryid = $('#countryid').val();
	var province = $('#province').val();
	var cities = $('#cities').val();
	var age_range = $('#age_range').val();
	var hle = $('#hle').val();
	var university = $('#university').val();
	var study = $('#study').val();
	var designation = $('.designation').val();
	var MostRecentExpLevelID = $('#MostRecentExpLevelID').val();
	var performance_rating = $('#performance_rating').val();
	var industry_employer = $('#industry_employer').val();
	var expertise_role = $('#expertise_role').val();
	var graduation_year = $('#graduation_year').val();
	var salary_range = $('#salary_range').val();
	
	
	totalselection=14;
	
	if($('#countryid').is(':checked')==false)
	{
		countryid=0;
		totalselection--;
	}
	if($('#province').is(':checked')==false)
	{
		province=0;
		totalselection--;
	}
	if($('#cities').is(':checked')==false)
	{
		cities=0;
		totalselection--;
	}
	if($('#age_range').is(':checked')==false)
	{
		age_range=0;
		totalselection--;
	}
	if($('#hle').is(':checked')==false)
	{
		hle=0;
		totalselection--;
	}
	if($('#university').is(':checked')==false)
	{
		university=0;
		totalselection--;
	}
	if($('#study').is(':checked')==false)
	{
		study=0;
		totalselection--;
	}
	if($('.designation').is(':checked')==false)
	{
		designation=0;
		totalselection--;
	}
	if($('#MostRecentExpLevelID').is(':checked')==false)
	{
		MostRecentExpLevelID=0;
		totalselection--;
	}
	if($('#performance_rating').is(':checked')==false)
	{
		performance_rating=0;
		totalselection--;
	}
	if($('#industry_employer').is(':checked')==false)
	{
		industry_employer=0;
		totalselection--;
	}
	if($('#expertise_role').is(':checked')==false)
	{
		expertise_role=0;
		totalselection--;
	}
	if($('#graduation_year').is(':checked')==false)
	{
		graduation_year=0;
		totalselection--;
	}
	if($('#salary_range').is(':checked')==false)
	{
		salary_range=0;
		totalselection--;
	}


	if(totalselection > 222)
	{
		
	
		alert("you cannot select more than 2 filters");
	}
	else
	{
		
		//alert(totpop);
	
	
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_form_result.php",
   data: "user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
   success: function(data)
   {
   setTimeout(function() {
   $('#firstdata').html(data);
   }, delay);
   }
   });
   
//
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_pop_display.php",
   data: "user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
   success: function(data)
   {
   setTimeout(function() {
   $('#seconddata').html(data);
   }, delay);
   }
   });  
// 
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_summary_display.php",
   data: "user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
   success: function(data)
   {
   setTimeout(function() {
   $('#thirddata').html(data);
   }, delay);
   }
   });  
// // 
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_breakdown_display.php",
   data: "user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
   success: function(data)
   {
   setTimeout(function() {
   $('#fourthdata').html(data);
   }, delay);
   }
   });  
//
	}

}	

});    
</script>
<style>
.twitter-typeahead .tt-input {
    max-height: 44px !important;
}
select{height:50px;}

#filtersform input[type="checkbox"] {
    display: none;
}
#filtersform input[type="checkbox"] + label {
    color: #005691;
    display: block;
    cursor: pointer;
    display: inline-block;
    margin: 5px;
}

#filtersform input[type="checkbox"] + label span {
    display: inline-block;
	border-color: #283250;
	background: #f2f2f2;
    padding: 6px 20px;
    color: #222222;
    border-radius: 6px;
	
}

#filtersform input[type="checkbox"]:checked + label span {
    border-color: #cca876;
    background: #283250;
	color:#ffffff;
}
</style>
<div class="section" id="filtersform">
        <div class="container">
            <div class="register-column">
<h2>Filters</h2>
            <form action="" method="Post">
<input type="hidden" id="populationcheck">			
<?php



$query_country = $this->db->query("SELECT 
									country,id 
									FROM countries where id=".(int)$user_countryid."
									order by country asc");
$res_country = $query_country->result_array();


$provincewhere=" where countryid=0";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
	<label>Country</label>
	<div class="req-icon-col">
		
		<?php
		/*
		<select class="form-control" name="countryid" id="countryid" onchange="show_province(this.value,'province')">
		<option>Select Country</option>
		*/
			foreach($res_country as $row)
			{
			
				$slct="";
				
				if(isset($countryid) && (int)$countryid==$row['id'])
				{
				
					$CountryFSel=$row['country'];
				
					$slct="selected";
					$provincewhere=" where countryid='".$row['id']."'";
					
					?>
					<script>
					totalselection++;
					</script>
					<?php
				}
				?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="countryid" class="btn-default"><label for="countryid"><span><?php echo $row['country'];?></span></label>
				<?php
		/*
		?>
			<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['country'];?></option>
		<?php
		*/
			}
		/*	
		?>	
		</select>
		*/
		?>
		
	</div>
</div>
</div>
<?php
$provinceselid=0;

$query_province = $this->db->query("SELECT 
									province_name,id 
									FROM provinces
									".$provincewhere." and id=".$user_provinceid."
									order by province_name asc");
$res_province = $query_province->result_array();

$displaydiv="";
if($user_provinceid==0)
{
	$displaydiv="display:none;";
}
?>
<div style="float:left;<?php echo $displaydiv;?>" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
<label>State / Province</label>
<div class="req-icon-col">
	<?php /* ?><select class="form-control" name="province" id="province" >
	<option value=0>Select State OR Province</option>
	<?php
		foreach($res_province as $row)
		{
		
			if(isset($_POST['province']) && $_POST['province']== $row['id'] ){
			$ProvinceFSel=$row['province_name'];
			}
		
	?>
		<option <?php if(isset($_POST['province']) && $_POST['province']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['province_name'];?></option>
	<?php
		}
	?>	
	</select><?php */ ?>
	
	
	<?php
	/*
	<select name="province" id="province" class="form-control span12" onchange="show_cities(this.value,'cities')">
	<?php //province ?>
	<option value=0>Select Province</option>
	*/
		foreach($res_province as $row)
		{
			$slct="";
			if(isset($_POST['province']) && $_POST['province']== $row['id'] ){
			$slct="Selected";
			$provinceselid=$row['id'];
			}
			?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="province" class="btn-default"><label for="province"><span><?php echo $row['province_name'];?></span></label>
				<?php
		/*
	?>
		<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['province_name'];?></option>
	<?php
	*/
		}
		/*
	?>	
	<select>
	<?php */ ?>
	
</div>
</div>
</div>

<?php
$query_city = $this->db->query("SELECT 
									* 
									FROM Cities where 
									ProvinceID=".(int)$provinceselid." and id=".$user_cityid."
									order by description");
$query_city = $this->db->query("SELECT 
									* 
									FROM Cities where 
									id=".$user_cityid."
									order by description");									
$res_city = $query_city->result_array();

$displaydiv="";
if($user_cityid==0)
{
	$displaydiv="display:none;";
}
?>
<div style="float:left;<?php echo $displaydiv;?>" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>City</label>
		<div class="req-icon-col">
			<?php
			//$cityFSel=$_POST['city'];
			?>
			<?php /* ?>
			<input style="line-height: 1;" type="text" name="city" id="city"  class="form-control" value="<?php echo $_POST['city'];?>" placeholder="E.g. Toronto, etc..." >
			<?php */ ?>
			
			<?php
			/*<select name="city" id="cities" class="form-control span12">
			<?php //city ?>
			<option value=0>Select City</option>*/
				foreach($res_city as $row)
				{
					$slct="";
					if(isset($_POST['city']) && $_POST['city']== $row['id'] ){
					$slct="Selected";
					
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="cities" class="btn-default"><label for="cities"><span><?php echo $row['description'];?></span></label>
				<?php
			/*	
			?>
				<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
			*/
				}
				/*<select>*/
			?>	
			
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>

<?php
$query_age = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges where id=".$user_ageid." and description!=''
									order by id asc");
$res_age = $query_age->result_array();

if($user_ageid > 0 && $query_age->num_rows() > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Age Range</label>
		<div class="req-icon-col">
			
			<?php
			/*<select class="form-control" name="age_range" id="age_range" >
			<option <?php if($_POST['age_range']== '' ){ echo 'Selected';} ?> value=0>Select Age Range</option>*/
				foreach($res_age as $row)
				{
					$slct="";
					if(isset($_POST['age_range']) && $_POST['age_range']== $row['id'] ){
					$ageFSel=$row['description'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="age_range" class="btn-default"><label for="age_range"><span><?php echo $row['description'];?></span></label>
				<?php
				/*
			?>
				<option <?php if($_POST['age_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
			*/
				}
				/*</select>*/
			?>	
			
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}
?>
<?php
$query_hletypes = $this->db->query("SELECT 
									description,id 
									FROM HLEType where id=".$user_hleid." and description!=''
									order by id asc");
$res_hletypes = $query_hletypes->result_array();

if($user_hleid > 0 && $query_hletypes->num_rows() > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Highest Level of Education</label>
		<div class="req-icon-col">
			
			<?php
			/*<select class="form-control" name="hle" id="hle">
			<option value=0>Select</option>*/
				foreach($res_hletypes as $row)
				{
				
					if(isset($_POST['hle']) && $_POST['hle']== $row['id'] ){
					$hleFSel=$row['description'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="hle" class="btn-default"><label for="hle"><span><?php echo $row['description'];?></span></label>
				<?php
				/*
			?>
				<option <?php if($_POST['hle']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				*/
				}
				/*</select>*/
			?>
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}


$query_rec = $this->db->query("SELECT 
									REPLACE(university,'?','') as university,id 
									FROM university
									where id=".$user_universityid." and university!=''
									order by university asc");
$res_rec = $query_rec->result_array();

if((int)$user_universityid > 0 && $query_rec->num_rows() > 0)
{
?>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
<label>University / College attended</label>
<div class="req-icon-col bs-example">
<?php //print_r($universities);?>
	
	<?php
	/*<select class="form-control" name="university" id="university" >
	<option <?php if($_POST['university']== '' ){ echo 'Selected';} ?> value=0>Select University</option>*/
		foreach($res_rec as $row)
		{
		
			if(isset($_POST['university']) && $_POST['university']== $row['id'] ){
			$UniversityFSel=$row['university'];
			}
			?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="university" class="btn-default"><label for="university"><span><?php echo $row['university'];?></span></label>
				<?php
		/*
	?>
		<option <?php if($_POST['university']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['university'];?></option>
	<?php
		*/
		}
		/*</select>*/
	?>	
	
	
	<span class="req-icon"></span>
</div>
</div>
</div>
<?php
}

$query_rec = $this->db->query("SELECT 
									major_cat,id 
									FROM study where id=".$user_studyid." and major_cat!=''
									order by major_cat asc");
$res_rec = $query_rec->result_array();


if($user_studyid > 0 && $query_rec->num_rows() > 0)
{
?>


<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Program of study</label>
		<div class="req-icon-col">
			
			<?php
			/*<select class="form-control" name="study" id="study" >
			<option <?php if($_POST['study']== '' ){ echo 'Selected';} ?> value=0>Select Program of study</option>*/
				foreach($res_rec as $row)
				{
				
					if(isset($_POST['study']) && $_POST['study']== $row['id'] ){
					$studyFSel=$row['major_cat'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="study" class="btn-default"><label for="study"><span><?php echo $row['major_cat'];?></span></label>
				<?php
				/*
			?>
				<option <?php if($_POST['study']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['major_cat'];?></option>
			<?php
				*/
				}
				/*</select>*/
			?>	
			
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}



$desigFSel="";
$query_rec = $this->db->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations where id IN (".$designationsIDs.") and CertificateDesignationName!=''
									order by id asc");
$res_rec = $query_rec->result_array();

if($user_designationid > 0 && $query_rec->num_rows() > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Designations</label>
		<div class="req-icon-col">
		<?php
		$designationsel="";
		if(isset($_POST["designation"]) && $_POST["designation"]!="")
		{
			$designationsel=$_POST["designation"];
		}
		?>
		
			<?php
			/*<select class="form-control" name="designation[]" id="designation" multiple >
			<option <?php if($_POST['designation']== '' ){ echo 'Selected';} ?> value=0>Select Designations</option>*/
				foreach($res_rec as $row)
				{
					$slct="";
					if(isset($_POST['designation']))
					{
						if(is_array($_POST["designation"]))
						{
							if(in_array($row['id'],$_POST["designation"]))
							{
								if($desigFSel!="")
								{
									$desigFSel.=", ";
								}
								if($row['Abbreviation']!="")
								{
									$desigFSel.=$row['Abbreviation'];
								}
								else
								{
									$desigFSel.=$row['CertificateDesignationName'];
								}
								
								$slct="selected";
							}
						}
						else if(isset($_POST['designation']) && $_POST['designation']== $row['id'] ){
							$desigFSel=$row['CertificateDesignationName'];
							$slct="selected";
						}
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="designation_<?php echo $row['id'];?>" class="designation btn-default"><label for="designation_<?php echo $row['id'];?>"><span><?php echo $row['CertificateDesignationName']." - ".$row['Abbreviation'];?></span></label>
				<?php
				/*	
				
			?>
				<option <?php echo $slct; ?> value=<?php echo $row['id'];?>><?php echo $row['CertificateDesignationName']." - ".$row['Abbreviation'];?></option>
			<?php
				*/
				}
				/*</select>*/
			?>	
			
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}
?>

<?php
$query_mrels = $this->db->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel where id=".$user_expid." and description!=''
									order by id asc");
$res_mrels = $query_mrels->result_array();

if($user_expid > 0 && $query_mrels->num_rows() > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Experience Level</label>
		<div class="req-icon-col">
			
			<?php
			/*<select class="form-control" name="MostRecentExpLevelID" id="MostRecentExpLevelID">
			<option value=0>Select</option>*/
				foreach($res_mrels as $row)
				{
				
					if(isset($_POST['MostRecentExpLevelID']) && $_POST['MostRecentExpLevelID']== $row['id'] ){
					$explevelFSel=$row['description'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="MostRecentExpLevelID" class="btn-default"><label for="MostRecentExpLevelID"><span><?php echo $row['description'];?></span></label>
				<?php
					/*
			?>
				<option <?php if($_POST['MostRecentExpLevelID']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				*/
				}
				/*</select>*/
			?>
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}
?>

<?php
$query_performances = $this->db->query("SELECT 
									description,id 
									FROM Performance_Rating where id=".$user_Performanceid." and description!=''
									order by id asc");
$res_performances = $query_performances->result_array();

if($user_Performanceid > 0 && $query_performances->num_rows() > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Performance Rating Received</label>
		<div class="req-icon-col">
		
			<?php
			/*<select class="form-control" name="performance_rating" id="performance_rating">
			<option value=0>Select</option>*/
				foreach($res_performances as $row)
				{
				
					if(isset($_POST['performance_rating']) && $_POST['performance_rating']== $row['id'] ){
					$perfFSel=$row['description'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="performance_rating" class="btn-default"><label for="performance_rating"><span><?php echo $row['description'];?></span></label>
				<?php
					/*
			?>
				<option <?php if($_POST['performance_rating']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					*/
				}
				/*</select>*/
			?>
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}

$query_rec = $this->db->query("SELECT 
									name,id 
									FROM industry where id=".$user_industryid." and name!=''
									order by name asc");
$res_rec = $query_rec->result_array();

if($user_industryid > 0 && $query_rec->num_rows() > 0)
{
?>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Industry of employer</label>
		<div class="req-icon-col">
		
			<?php	
			/*<select class="form-control" name="industry_employer" id="industry_employer">
			<option <?php if($_POST['industry_employer']== '' ){ echo 'Selected';} ?> value=0>Select Industry</option>*/
				foreach($res_rec as $row)
				{
				
					if(isset($_POST['industry_employer']) && $_POST['industry_employer']== $row['id'] ){
					$industryFSel=$row['name'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="industry_employer" class="btn-default"><label for="industry_employer"><span><?php echo $row['name'];?></span></label>
				<?php
				/*
			?>
				<option <?php if($_POST['industry_employer']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['name'];?></option>
			<?php
				*/
				}
				/*</select>*/
			?>	
			
			
			<span class="req-icon"></span>

		</div>
	</div>
</div>
<?php
}

$query_rec = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role where id=".$user_expertiseid." and description!=''
									order by id asc");
$res_rec = $query_rec->result_array();

if($user_expertiseid > 0  && $query_rec->num_rows() > 0)
{
?>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Area of expertise</label>
		<div class="req-icon-col">
		
			<?php
			/*<select class="form-control" name="expertise_role" id="expertise_role">
			<option <?php if($_POST['expertise_role']== '' ){ echo 'Selected';} ?> value=0>Select Expertise</option>*/
				foreach($res_rec as $row)
				{
				
					if(isset($_POST['expertise_role']) && $_POST['expertise_role']== $row['id'] ){
					$expertiseFSel=$row['description'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="expertise_role" class="btn-default"><label for="expertise_role"><span><?php echo $row['description'];?></span></label>
				<?php
				/*
			?>
				<option <?php if($_POST['expertise_role']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				*/
				}
				/*</select>*/
			?>	
			
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}

if((int)$user_graduationid > 0)
{
?>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Graduation year</label>
		<div class="req-icon-col">
			
			<?php
			/*<select class="form-control" name="graduation_year" id="graduation_year" >
			<option value=0>Select</option>*/
			for($i=(int)$user_graduationid;$i>=(int)$user_graduationid;$i--)
			{
				if(isset($_POST['graduation_year']) && $_POST['graduation_year']== $i ){
					$gradFSel=$_POST['graduation_year'];
					}
					?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="graduation_year" class="btn-default"><label for="graduation_year"><span><?php echo $i;?></span></label>
				<?php
			/*
			?>
			<option <?php if($_POST['graduation_year']== $i ){ echo 'Selected';} ?>><?php echo $i;?></option>
			<?php
			*/
			}
			/*</select>*/
			?>
			
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}
?>

<?php
$query_salarys = $this->db->query("SELECT 
									description,id 
									FROM SalaryRanges where id=".$user_salaryid." and description!=''
									order by id asc");
		$res_salarys = $query_salarys->result_array();
		
if($user_salaryid > 0 && $query_salarys->num_rows() > 0)
{	
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
	<label>Salary Range</label>
	<div class="req-icon-col">
		
		<?php
		/*<select class="form-control" name="salary_range" id="salary_range" >
		<option>Select</option>*/
		foreach($res_salarys as $row)
		{
			if(isset($_POST['salary_range']) && $_POST['salary_range']== $row['id'] ){
			$SalaryFSel=$row['description'];
			}
			?>
				<input type="checkbox" <?php if($slct!=""){echo "checked";}?>  value=<?php echo $row['id'];?> id="salary_range" class="btn-default"><label for="salary_range"><span><?php echo $row['description'];?></span></label>
				<?php
		/*
		?>
		<option <?php if($_POST['salary_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
		<?php
		*/
		}
		/*</select>*/
		?>
		
		<span class="req-icon"></span>
	</div>
</div>
</div>
<?php
}
?>

<div style="clear:both;"></div>

<div style="display:none;" class="form-group text-center">
	<button type="submit" class="btn btn-secondary btn-style-2" name="submit_register" id="submit_register">Submit</button>
</div>
<div style="display:none;" class="form-group text-center">
	<button type="button" class="btn btn-secondary btn-style-2" name="btn-default" id="btn-default">Submit</button>
</div>

</form>


</div></div></div>

<div id="firstdata">
<section id="Total_Population">
		<div class="container">
				<div class="row">

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Population</b>
<br>
<?php echo $Population;?>
<br><br>
</div>
<br><br>

</div>
</div>
</section>

<section id="filters_selected">
		<div class="container">
				<div class="row">


				
<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Country</b>
<br>
<?php echo $CountryFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Province</b>
<br>
<?php echo $ProvinceFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>City</b>
<br>
<?php echo $cityFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Age Range</b>
<br>
<?php echo $ageFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Education</b>
<br>
<?php echo $hleFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>University</b>
<br>
<?php echo $UniversityFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Graduation Year</b>
<br>
<?php echo $gradFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Study</b>
<br>
<?php echo $studyFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Designation</b>
<br>
<?php echo $desigFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Experience</b>
<br>
<?php echo $explevelFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Performance</b>
<br>
<?php echo $perfFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Industry</b>
<br>
<?php echo $industryFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Expertise</b>
<br>
<?php echo $expertiseFSel;?>
<br><br>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
<b>Salary Range</b>
<br>
<?php echo $SalaryFSel;?>
<br><br>
</div>

</div></div></section>
</div>