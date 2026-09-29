<script src="<?php echo base_url();?>asset/js/jquery-min.js"></script>

<style>
.twitter-typeahead .tt-input {
    max-height: 44px !important;
}
</style>
<style>
.show-tick {
	position: relative;
  display: inline-block;
  right: 15px;
  margin-top: 15px;
  left:2px;
  top:0px;
  z-index:10000;
}
.show-tick {
  margin-right: 34px;
}
</style>
<?php
$user_id=(int)$this->session->userdata('user_id');

?>
<div class="section">
        <div class="container">
            <div class="register-column">
<h2>Filters</h2>
            <form action="<?php echo base_url();?>additionalreport/<?php echo (int)$order_id;?>" method="Post" target="_blank">
<?php



$query_country = $this->db->query("SELECT 
									country,id 
									FROM countries
									order by country asc");
$res_country = $query_country->result_array();


$provincewhere=" where countryid=0";


$countrywhere="";


$tickmark="display:none;";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
	<label>Country</label>
	<div class="req-icon-col">
		<select class="form-control" name="countryid" id="countryid" onchange="tickdropdown('countryid');show_province(this.value,'province')">
		<option value=0>Select Country</option>
		<?php
			foreach($res_country as $row)
			{
			
				$slct="";
				
				$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.country_id=".$row['id']." limit 0,1");
				$checkreponsesR = $checkreponsesQ->num_rows();
				if((int)$checkreponsesR > 0)
				{
				
				if(isset($countryid) && (int)$countryid==$row['id'])
				{
				
					$CountryFSel=$row['country'];
				
					$slct="selected";
					$tickmark="display:block;";
					$provincewhere=" where countryid='".$row['id']."'";
					
					$countrywhere=" and a.country_id=".(int)$countryid;
				}
		?>
			<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['country'];?></option>
		<?php
				}
			}
		?>	
		</select>
		
	</div>
</div>
</div>
<div id="countryid_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>
<?php
$provinceselid=0;

$query_province = $this->db->query("SELECT 
									province_name,id 
									FROM provinces
									".$provincewhere."
									order by province_name asc");
$res_province = $query_province->result_array();

$tickmark="display:none;";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
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
	
	<select name="province" id="province" class="form-control span12" onchange="tickdropdown('province');show_cities(this.value,'cities')">
	<?php //province ?>
	<option value=0>Select Province</option>
	<?php
		foreach($res_province as $row)
		{
			$slct="";
			
			$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.province=".$row['id']." limit 0,1");
			$checkreponsesR = $checkreponsesQ->num_rows();
			if((int)$checkreponsesR > 0)
			{
			
			if(isset($_POST['province']) && $_POST['province']== $row['id'] ){
			$slct="Selected";
			$tickmark="display:block;";
			$provinceselid=$row['id'];
			}
		
	?>
		<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['province_name'];?></option>
	<?php
			}
		}
	?>	
	<select>
	
</div>
</div>
</div>
<div id="province_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>
<?php
$query_city = $this->db->query("SELECT 
									* 
									FROM Cities where 
									ProvinceID=".(int)$provinceselid."
									order by description");
$res_city = $query_city->result_array();

$tickmark="display:none;";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>City</label>
		<div class="req-icon-col">
			<?php
			//$cityFSel=$_POST['city'];
			?>
			<?php /* ?>
			<input style="line-height: 1;" type="text" name="city" id="city"  class="form-control" value="<?php echo $_POST['city'];?>" placeholder="E.g. Toronto, etc..." >
			<?php */ ?>
			<select name="city" id="cities" class="form-control span12" onchange="tickdropdown('cities');changefields('cities')">
			<?php //city ?>
			<option value=0>Select City</option>
			<?php
				foreach($res_city as $row)
				{
					$slct="";
					
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.city=".$row['id']." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
					
					if(isset($_POST['city']) && $_POST['city']== $row['id'] ){
					$slct="Selected";
					$tickmark="display:block;";
					
					}
				
			?>
				<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>	
			<select>
			
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="cities_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>
<?php
$query_age = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges
									order by id asc");
$res_age = $query_age->result_array();

$tickmark="display:none;";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Age Range</label>
		<div class="req-icon-col">
			<select class="form-control" name="age_range" id="age_range" onchange="tickdropdown('age_range');changefields('age_range')" >
			<option <?php if($_POST['age_range']== '' ){ echo 'Selected';} ?> value=0>Select Age Range</option>
			<?php
				foreach($res_age as $row)
				{
				
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.age_range=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
				
					if(isset($_POST['age_range']) && $_POST['age_range']== $row['id'] ){
					$ageFSel=$row['description'];
					}
				
			?>
				<option <?php if($_POST['age_range']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>	
			
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="age_range_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>
<?php
$query_hletypes = $this->db->query("SELECT 
									description,id 
									FROM HLEType
									order by id asc");
$res_hletypes = $query_hletypes->result_array();

$tickmark="display:none;";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Highest Level of Education</label>
		<div class="req-icon-col">
			<select class="form-control" name="hle" id="hle" onchange="tickdropdown('hle');changefields('hle')">
			<option value=0>Select</option>
			<?php
				foreach($res_hletypes as $row)
				{
				
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.hle=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
					if(isset($_POST['hle']) && $_POST['hle']== $row['id'] ){
					$hleFSel=$row['description'];
					}
				
			?>
				<option <?php if($_POST['hle']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="hle_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
<label>University / College attended</label>
<div class="req-icon-col bs-example">
<?php //print_r($universities);?>
	<?php /*<input type="text" id="university" name="university" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $UniversityFSel;?>"  placeholder="E.g. York University" ><?php */?>
	<?php
	$tickmark="display:none;";
	$query_university = $this->db->query("SELECT 
										university,id 
										FROM university where university!='' order by university asc");
			$res_university = $query_university->result_array();
	?>
	<select class="form-control" name="university" id="university1" onchange="tickdropdown('university1');changefields('university1')">
	<option value=0>Select</option>
	<?php
		foreach($res_university as $row)
		{
			$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.university=".$row['id']." ".$countrywhere." limit 0,1");
			$checkreponsesR = $checkreponsesQ->num_rows();
			if((int)$checkreponsesR > 0)
			{
					if(isset($_POST['university']) && $_POST['university']== $row['id'] ){
					$UniversityFSel=$row['university'];
					}
			?>
				<option <?php if(isset($_POST['university']) && $_POST['university']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['university'];?></option>
			<?php
			}
		}
	?>
	</select>
	<span class="req-icon"></span>
</div>
</div>
</div>
<div id="university1_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>




<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Program of study</label>
		<div class="req-icon-col">
			<?php /* ?><input type="text" id="study" name="study" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $studyFSel;?>"  placeholder="E.g. Study" ><?php */ ?>
			<?php
			$tickmark="display:none;";
			$query_study = $this->db->query("SELECT 
												major_cat,id 
												FROM study where major_cat!=''
												order by major_cat asc");
			$res_study = $query_study->result_array();
			?>
			<select class="form-control" name="study" id="study1" onchange="tickdropdown('study1');changefields('study1')">
			<option value=0>Select</option>
			<?php
				foreach($res_study as $row)
				{
				
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.program_study=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
					if(isset($_POST['study']) && $_POST['study']== $row['id'] ){
					$studyFSel=$row['major_cat'];
					}
			?>
				<option <?php if($_POST['study']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['major_cat'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="study1_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Designations</label>
		<div class="req-icon-col">
		<?php
		$tickmark="display:none;";
		$designationsel="";
		if(isset($_POST["designation"]) && $_POST["designation"]!="")
		{
			$designationsel=$_POST["designation"];
		}
		?>
		<?php /*/ ?><input type="text" id="designations" name="designation" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $designationsel;?>"  placeholder="E.g. CPA" ><?php */ ?>
		<?php
		$query_designations = $this->db->query("SELECT 
											CertificateDesignationName,id 
											FROM Designations
											order by id asc");
		$res_designations = $query_designations->result_array();
		?>
		<select class="form-control" name="designation" id="designation1" onchange="tickdropdown('designation1');changefields('designation1')">
			<option value=0>Select</option>
			<?php
				foreach($res_designations as $row)
				{
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.designation=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
					if(isset($_POST['designation']) && $_POST['designation']== $row['id'] ){
					$desigFSel=$row['CertificateDesignationName'];
					}
					
			?>
				<option <?php if($_POST['designation']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['CertificateDesignationName'];?></option>
			<?php
				}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="designation1_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>
<?php
$query_mrels = $this->db->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel
									order by id asc");
$res_mrels = $query_mrels->result_array();
$tickmark="display:none;";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Experience Level</label>
		<div class="req-icon-col">
			<select class="form-control" name="MostRecentExpLevelID" id="MostRecentExpLevelID" onchange="tickdropdown('MostRecentExpLevelID');changefields('MostRecentExpLevelID')">
			<option value=0>Select</option>
			<?php
				foreach($res_mrels as $row)
				{
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.MostRecentExpLevelID=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
				
					if(isset($_POST['MostRecentExpLevelID']) && $_POST['MostRecentExpLevelID']== $row['id'] ){
					$explevelFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['MostRecentExpLevelID']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="MostRecentExpLevelID_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>
<?php
$query_performances = $this->db->query("SELECT 
									description,id 
									FROM Performance_Rating
									order by id asc");
$res_performances = $query_performances->result_array();
$tickmark="display:none;";
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Performance Rating Received</label>
		<div class="req-icon-col">
		<select class="form-control" name="performance_rating" id="performance_rating" onchange="tickdropdown('performance_rating');changefields('performance_rating')">
			<option value=0>Select</option>
			<?php
				foreach($res_performances as $row)
				{
				
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.Performance_rating=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
					if(isset($_POST['performance_rating']) && $_POST['performance_rating']== $row['id'] ){
					$perfFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['performance_rating']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="performance_rating_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Industry of employer</label>
		<div class="req-icon-col">
		<?php /*/ ?><input type="text" id="industry" name="industry_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $industryFSel;?>"  placeholder="E.g. industry" ><?php */ ?>
		<?php
		$tickmark="display:none;";
		$query_industry = $this->db->query("SELECT 
											name,id 
											FROM industry where name!=''
											order by name asc");
		$res_industry = $query_industry->result_array();
		?>
		<select class="form-control" name="industry_employer" id="industry_employer1" onchange="tickdropdown('industry_employer1');changefields('industry_employer1')">
			<option value=0>Select</option>
			<?php
				foreach($res_industry as $row)
				{
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.industry_employer=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
					if(isset($_POST['industry_employer']) && $_POST['industry_employer']== $row['id'] ){
					$industryFSel=$row['name'];
					}
			?>
				<option <?php if($_POST['industry_employer']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['name'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>

		</div>
	</div>
</div>
<div id="industry_employer1_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Area of expertise</label>
		<div class="req-icon-col">
		<?php /*/ ?><input type="text" id="expertises" name="expertise_role" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $expertiseFSel;?>"  placeholder="E.g. Business" ><?php */ ?>
		<?php
		$tickmark="display:none;";
		$query_expertises = $this->db->query("SELECT 
											description,id 
											FROM Expertise_Role
											order by id asc");
				$res_expertises = $query_expertises->result_array();
		?>
		<select class="form-control" name="expertise_role" id="expertise_role1" onchange="tickdropdown('expertise_role1');changefields('expertise_role1')">
			<option value=0>Select</option>
			<?php
				foreach($res_expertises as $row)
				{
					$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.expertise_role=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
				
					if(isset($_POST['expertise_role']) && $_POST['expertise_role']== $row['id'] ){
					$expertiseFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['expertise_role']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="expertise_role1_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>

<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Graduation year</label>
		<div class="req-icon-col">
			<select class="form-control" name="graduation_year" id="graduation_year" onchange="tickdropdown('graduation_year');changefields('graduation_year')" >
			<option value=0>Select</option>
			<?php
			$tickmark="display:none;";
			for($i=2030;$i>=1950;$i--)
			{
				$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.graduation_year=".$i." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
				if(isset($_POST['graduation_year']) && $_POST['graduation_year']== $i ){
					$gradFSel=$_POST['graduation_year'];
					}
			
			?>
			<option <?php if($_POST['graduation_year']== $i ){ echo 'Selected';$tickmark="display:block;";} ?>><?php echo $i;?></option>
			<?php
					}
			}
			?>
			
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>
<div id="graduation_year_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>

<?php
$query_salarys = $this->db->query("SELECT 
									description,id 
									FROM SalaryRanges
									order by id asc");
		$res_salarys = $query_salarys->result_array();
$tickmark="display:none;";		
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
	<label>Salary Range</label>
	<div class="req-icon-col">
		<select class="form-control" name="salary_range" id="salary_range" onchange="tickdropdown('salary_range');changefields('salary_range')" >
		<option>Select</option>
		<?php
		
		foreach($res_salarys as $row)
		{
		
			$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.salary_range=".$row['id']." ".$countrywhere." limit 0,1");
					$checkreponsesR = $checkreponsesQ->num_rows();
					if((int)$checkreponsesR > 0)
					{
			if(isset($_POST['salary_range']) && $_POST['salary_range']== $row['id'] ){
			$SalaryFSel=$row['description'];
			}
		
		?>
		<option <?php if($_POST['salary_range']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
		<?php
					}
		}
		?>
		</select>
		<span class="req-icon"></span>
	</div>
</div>
</div>
<div id="salary_range_tick" style="float:left;padding:30px 10px 10px 10px;<?php echo $tickmark;?>"><img src="<?php echo base_url();?>asset/images/check.png"></div>
<div style="clear:both;"></div>

<div style="display:none;" class="form-group text-center">
	<button type="submit" class="btn btn-secondary btn-style-2" name="submit_register" id="submit_register">Submit</button>
</div>
<div class="form-group text-center">
	<button type="submit" class="btn btn-secondary btn-style-2" name="btn-default" id="btn-default">Submit</button>
</div>


</form>


</div></div></div>