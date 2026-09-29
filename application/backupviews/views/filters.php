<script src="<?php echo base_url();?>asset/js/jquery-min.js"></script>
<script>
$(document).ready(function() {
   var delay = 2000;
   $('#btn-default').click(function(e){
	e.preventDefault();
	var user_id="<?php echo (int)$this->session->userdata('user_id');?>";
	var order_id="<?php echo (int)$order_id;?>";
	var countryid = $('#countryid').val();
	var province = $('#province').val();
	var cities = $('#cities').val();
	var age_range = $('#age_range').val();
	var hle = $('#hle').val();
	var university = $('#university1').val();
	var study = $('#study1').val();
	var designation = $('#designation1').val();
	var MostRecentExpLevelID = $('#MostRecentExpLevelID').val();
	var performance_rating = $('#performance_rating').val();
	var industry_employer = $('#industry_employer1').val();
	var expertise_role = $('#expertise_role1').val();
	var graduation_year = $('#graduation_year').val();
	var salary_range = $('#salary_range').val();
	
	
	
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_form_result.php",
   data: "reportd=1&user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
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
   data: "reportd=1&user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
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
   data: "reportd=1&user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
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
   data: "reportd=1&user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range,
   success: function(data)
   {
   setTimeout(function() {
   $('#fourthdata').html(data);
   }, delay);
   }
   });  
//  


 
});
});  




</script>
<style>
.twitter-typeahead .tt-input {
    max-height: 44px !important;
}
</style>
<div class="section">
        <div class="container">
            <div class="register-column">
<h2>Filters</h2>
            <form action="" method="Post">
<?php



$query_country = $this->db->query("SELECT 
									country,id 
									FROM countries
									order by country asc");
$res_country = $query_country->result_array();


$provincewhere=" where countryid=0";


$countrywhere="";



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
				
				$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.country_id=".$row['id']." limit 0,1");
				$checkreponsesR = $checkreponsesQ->num_rows();
				if((int)$checkreponsesR > 0)
				{
				
				if(isset($countryid) && (int)$countryid==$row['id'])
				{
				
					$CountryFSel=$row['country'];
				
					$slct="selected";
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
<?php
$provinceselid=0;

$query_province = $this->db->query("SELECT 
									province_name,id 
									FROM provinces
									".$provincewhere."
									order by province_name asc");
$res_province = $query_province->result_array();
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
	
	<select name="province" id="province" class="form-control span12" onchange="show_cities(this.value,'cities')">
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
<?php
$query_city = $this->db->query("SELECT 
									* 
									FROM Cities where 
									ProvinceID=".(int)$provinceselid."
									order by description");
$res_city = $query_city->result_array();
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
			<select name="city" id="cities" class="form-control span12" onchange="changefields('cities')">
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

<?php
$query_age = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges
									order by id asc");
$res_age = $query_age->result_array();
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Age Range</label>
		<div class="req-icon-col">
			<select class="form-control" name="age_range" id="age_range" onchange="changefields('age_range')" >
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
				<option <?php if($_POST['age_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>	
			
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>

<?php
$query_hletypes = $this->db->query("SELECT 
									description,id 
									FROM HLEType
									order by id asc");
$res_hletypes = $query_hletypes->result_array();
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Highest Level of Education</label>
		<div class="req-icon-col">
			<select class="form-control" name="hle" id="hle" onchange="changefields('hle')">
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
				<option <?php if($_POST['hle']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>


<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
<label>University / College attended</label>
<div class="req-icon-col bs-example">
<?php //print_r($universities);?>
	<?php /*<input type="text" id="university" name="university" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $UniversityFSel;?>"  placeholder="E.g. York University" ><?php */?>
	<?php
	$query_university = $this->db->query("SELECT 
										university,id 
										FROM university where university!='' order by university asc");
			$res_university = $query_university->result_array();
	?>
	<select class="form-control" name="university" id="university1" onchange="changefields('university1')">
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
				<option <?php if(isset($_POST['university']) && $_POST['university']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['university'];?></option>
			<?php
			}
		}
	?>
	</select>
	<span class="req-icon"></span>
</div>
</div>
</div>





<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Program of study</label>
		<div class="req-icon-col">
			<?php /* ?><input type="text" id="study" name="study" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $studyFSel;?>"  placeholder="E.g. Study" ><?php */ ?>
			<?php
			$query_study = $this->db->query("SELECT 
												major_cat,id 
												FROM study where major_cat!=''
												order by major_cat asc");
			$res_study = $query_study->result_array();
			?>
			<select class="form-control" name="study" id="study1" onchange="changefields('study1')">
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
				<option <?php if($_POST['study']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['major_cat'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>


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
		<?php /*/ ?><input type="text" id="designations" name="designation" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $designationsel;?>"  placeholder="E.g. CPA" ><?php */ ?>
		<?php
		$query_designations = $this->db->query("SELECT 
											CertificateDesignationName,id 
											FROM Designations
											order by id asc");
		$res_designations = $query_designations->result_array();
		?>
		<select class="form-control" name="designation" id="designation1" onchange="changefields('designation1')">
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
				<option <?php if($_POST['designation']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['CertificateDesignationName'];?></option>
			<?php
				}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>

<?php
$query_mrels = $this->db->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel
									order by id asc");
$res_mrels = $query_mrels->result_array();
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Experience Level</label>
		<div class="req-icon-col">
			<select class="form-control" name="MostRecentExpLevelID" id="MostRecentExpLevelID" onchange="changefields('MostRecentExpLevelID')">
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
				<option <?php if($_POST['MostRecentExpLevelID']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>

<?php
$query_performances = $this->db->query("SELECT 
									description,id 
									FROM Performance_Rating
									order by id asc");
$res_performances = $query_performances->result_array();
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Most Recent Performance Rating Received</label>
		<div class="req-icon-col">
		<select class="form-control" name="performance_rating" id="performance_rating" onchange="changefields('performance_rating')">
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
				<option <?php if($_POST['performance_rating']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>


<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Industry of employer</label>
		<div class="req-icon-col">
		<?php /*/ ?><input type="text" id="industry" name="industry_employer" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $industryFSel;?>"  placeholder="E.g. industry" ><?php */ ?>
		<?php
		$query_industry = $this->db->query("SELECT 
											name,id 
											FROM industry where name!=''
											order by name asc");
		$res_industry = $query_industry->result_array();
		?>
		<select class="form-control" name="industry_employer" id="industry_employer1" onchange="changefields('industry_employer1')">
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
				<option <?php if($_POST['industry_employer']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['name'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>

		</div>
	</div>
</div>


<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Area of expertise</label>
		<div class="req-icon-col">
		<?php /*/ ?><input type="text" id="expertises" name="expertise_role" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $expertiseFSel;?>"  placeholder="E.g. Business" ><?php */ ?>
		<?php
		$query_expertises = $this->db->query("SELECT 
											description,id 
											FROM Expertise_Role
											order by id asc");
				$res_expertises = $query_expertises->result_array();
		?>
		<select class="form-control" name="expertise_role" id="expertise_role1" onchange="changefields('expertise_role1')">
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
				<option <?php if($_POST['expertise_role']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>


<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
		<label>Graduation year</label>
		<div class="req-icon-col">
			<select class="form-control" name="graduation_year" id="graduation_year" onchange="changefields('graduation_year')" >
			<option value=0>Select</option>
			<?php
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
			<option <?php if($_POST['graduation_year']== $i ){ echo 'Selected';} ?>><?php echo $i;?></option>
			<?php
					}
			}
			?>
			
			</select>
			<span class="req-icon"></span>
		</div>
	</div>
</div>


<?php
$query_salarys = $this->db->query("SELECT 
									description,id 
									FROM SalaryRanges
									order by id asc");
		$res_salarys = $query_salarys->result_array();
?>
<div style="float:left;" class="col-12 col-sm-12 col-md-12 col-lg-6 ">
<div class="form-group">
	<label>Salary Range</label>
	<div class="req-icon-col">
		<select class="form-control" name="salary_range" id="salary_range" onchange="changefields('salary_range')" >
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
		<option <?php if($_POST['salary_range']== $row['id'] ){ echo 'Selected';} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
		<?php
					}
		}
		?>
		</select>
		<span class="req-icon"></span>
	</div>
</div>
</div>

<div style="clear:both;"></div>

<div style="display:none;" class="form-group text-center">
	<button type="submit" class="btn btn-secondary btn-style-2" name="submit_register" id="submit_register">Submit</button>
</div>
<div class="form-group text-center">
	<button type="button" class="btn btn-secondary btn-style-2" name="btn-default" id="btn-default">Submit</button>
</div>


</form>


</div></div></div>
<div id="firstdata">
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
</div>