<style>
.twitter-typeahead .tt-input {
    max-height: 44px !important;
}
select{height:50px;}
</style>
<div class="section">
        <div class="container">
            <div class="register-column">
<h2>Filters</h2>
            <form action="" method="Post">
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
		<select class="form-control" name="countryid" id="countryid" onchange="show_province(this.value,'province')">
		<option>Select Country</option>
		<?php
			foreach($res_country as $row)
			{
			
				$slct="";
				
				if(isset($countryid) && (int)$countryid==$row['id'])
				{
				
					$CountryFSel=$row['country'];
				
					$slct="selected";
					$provincewhere=" where countryid='".$row['id']."'";
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
	
	<select name="province" id="province" class="form-control span12" onchange="show_cities(this.value,'cities')">
	<?php //province ?>
	<option value=0>Select Province</option>
	<?php
		foreach($res_province as $row)
		{
			$slct="";
			if(isset($_POST['province']) && $_POST['province']== $row['id'] ){
			$slct="Selected";
			$provinceselid=$row['id'];
			}
		
	?>
		<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['province_name'];?></option>
	<?php
		}
	?>	
	<select>
	
</div>
</div>
</div>

<?php
$query_city = $this->db->query("SELECT 
									* 
									FROM Cities where 
									ProvinceID=".(int)$provinceselid." and id=".$user_cityid."
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
			<select name="city" id="cities" class="form-control span12">
			<?php //city ?>
			<option value=0>Select City</option>
			<?php
				foreach($res_city as $row)
				{
					$slct="";
					if(isset($_POST['city']) && $_POST['city']== $row['id'] ){
					$slct="Selected";
					
					}
				
			?>
				<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				}
			?>	
			<select>
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>

<?php
$query_age = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges where id=".$user_ageid."
									order by id asc");
$res_age = $query_age->result_array();

if($user_ageid > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Age Range</label>
		<div class="req-icon-col">
			<select class="form-control" name="age_range" id="age_range" >
			<option <?php if($_POST['age_range']== '' ){ echo 'Selected';} ?> value=0>Select Age Range</option>
			<?php
				foreach($res_age as $row)
				{
				
					if(isset($_POST['age_range']) && $_POST['age_range']== $row['id'] ){
					$ageFSel=$row['description'];
					}
				
			?>
				<option <?php if($_POST['age_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				}
			?>	
			
			</select>
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
									FROM HLEType where id=".$user_hleid."
									order by id asc");
$res_hletypes = $query_hletypes->result_array();

if($user_hleid > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Highest Level of Education</label>
		<div class="req-icon-col">
			<select class="form-control" name="hle" id="hle">
			<option value=0>Select</option>
			<?php
				foreach($res_hletypes as $row)
				{
				
					if(isset($_POST['hle']) && $_POST['hle']== $row['id'] ){
					$hleFSel=$row['description'];
					}
				
			?>
				<option <?php if($_POST['hle']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}


if((int)$user_universityid > 0 && trim($university!='[""]') && trim($university!='null'))
{
?>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
<label>University / College attended</label>
<div class="req-icon-col bs-example">
<?php //print_r($universities);?>
	<input type="text" id="university" name="university" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $UniversityFSel;?>"  placeholder="E.g. York University" >
	<span class="req-icon"></span>
</div>
</div>
</div>
<?php
}

if($user_studyid > 0 && trim($study!='[""]'))
{
?>


<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Program of study</label>
		<div class="req-icon-col">
			<input type="text" id="study" name="study" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $studyFSel;?>"  placeholder="E.g. Study" >
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}
?>


<?php
if($user_designationid > 0)
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
		<input type="text" id="designations" name="designation" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $designationsel;?>"  placeholder="E.g. CPA" >
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
									FROM MostRecentExperienceLevel where id=".$user_expid."
									order by id asc");
$res_mrels = $query_mrels->result_array();

if($user_expid > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Experience Level</label>
		<div class="req-icon-col">
			<select class="form-control" name="MostRecentExpLevelID" id="MostRecentExpLevelID">
			<option value=0>Select</option>
			<?php
				foreach($res_mrels as $row)
				{
				
					if(isset($_POST['MostRecentExpLevelID']) && $_POST['MostRecentExpLevelID']== $row['id'] ){
					$explevelFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['MostRecentExpLevelID']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				}
			?>
			</select>
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
									FROM Performance_Rating where id=".$user_Performanceid."
									order by id asc");
$res_performances = $query_performances->result_array();

if($user_Performanceid > 0)
{
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Performance Rating Received</label>
		<div class="req-icon-col">
		<select class="form-control" name="performance_rating" id="performance_rating">
			<option value=0>Select</option>
			<?php
				foreach($res_performances as $row)
				{
				
					if(isset($_POST['performance_rating']) && $_POST['performance_rating']== $row['id'] ){
					$perfFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['performance_rating']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<?php
}

if($user_industryid > 0 && trim($industry!='[""]'))
{
?>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Industry of employer</label>
		<div class="req-icon-col">
		<input type="text" id="industry" name="industry_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $industryFSel;?>"  placeholder="E.g. industry" >
			<span class="req-icon"></span>

		</div>
	</div>
</div>
<?php
}

if($user_expertiseid > 0 && trim($expertises!='[""]'))
{
?>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Area of expertise</label>
		<div class="req-icon-col">
		<input type="text" id="expertises" name="expertise_role" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $expertiseFSel;?>"  placeholder="E.g. Business" >
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
			<select class="form-control" name="graduation_year" id="graduation_year" >
			<option value=0>Select</option>
			<?php
			for($i=(int)$user_graduationid;$i>=(int)$user_graduationid;$i--)
			{
				if(isset($_POST['graduation_year']) && $_POST['graduation_year']== $i ){
					$gradFSel=$_POST['graduation_year'];
					}
			
			?>
			<option <?php if($_POST['graduation_year']== $i ){ echo 'Selected';} ?>><?php echo $i;?></option>
			<?php
			}
			?>
			
			</select>
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
									FROM SalaryRanges where id=".$user_salaryid."
									order by id asc");
		$res_salarys = $query_salarys->result_array();
		
if($user_salaryid > 0)
{	
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
	<label>Salary Range</label>
	<div class="req-icon-col">
		<select class="form-control" name="salary_range" id="salary_range" >
		<option>Select</option>
		<?php
		foreach($res_salarys as $row)
		{
			if(isset($_POST['salary_range']) && $_POST['salary_range']== $row['id'] ){
			$SalaryFSel=$row['description'];
			}
		
		?>
		<option <?php if($_POST['salary_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
		<?php
		}
		?>
		</select>
		<span class="req-icon"></span>
	</div>
</div>
</div>
<?php
}
?>

<div style="clear:both;"></div>

<div class="form-group text-center">
	<button type="submit" class="btn btn-secondary btn-style-2" name="submit_register" id="submit_register">Submit</button>
</div>


</form>


</div></div></div>

<section>
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

<section>
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