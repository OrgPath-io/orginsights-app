<?php
include("connection.php"); 

include("FR_calc.php"); 
?>
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
<?php

if(isset($_POST["reportd"]) && (int)$_POST["reportd"] > 0)
{
}
else
{
$CountryFSel="";
$ProvinceFSel="";
$cityFSel="";
$ageFSel="";
$hleFSel="";
$UniversityFSel="";
$gradFSel="";
$studyFSel="";
$desigFSel="";
$explevelFSel="";
$perfFSel="";
$industryFSel="";
$expertiseFSel="";
$SalaryFSel="";
}

$query_country = $con->query("SELECT 
									country,id 
									FROM countries where id=".(int)$_POST['countryid']."
									order by country asc");
$res_country = $query_country->fetch_array();

if($res_country!="")
{
	$CountryFSel=$res_country['country'];
}
//
$query_province = $con->query("SELECT 
									province_name,id 
									FROM provinces where id=".(int)$_POST['province']."
									order by province_name asc");
$res_province = $query_province->fetch_array();

if($res_province!="")
{
	$ProvinceFSel=$res_province['province_name'];
}
//
$query_city = $con->query("SELECT 
									* 
									FROM Cities where id=".(int)$_POST['cities']."
									order by description");
$res_city = $query_city->fetch_array();

if($res_city!="")
{
	$cityFSel=$res_city['description'];
}
//
$query_age = $con->query("SELECT 
									description,id 
									FROM AgeRanges where id=".(int)$_POST['age_range']." and description!=''
									order by id asc");
$res_age = $query_age->fetch_array();

if($res_age!="")
{
	$ageFSel=$res_age['description'];
}
//
$query_hletypes = $con->query("SELECT 
									description,id 
									FROM HLEType where id=".(int)$_POST['hle']." and description!=''
									order by id asc");
$res_hletypes = $query_hletypes->fetch_array();

if($res_hletypes!="")
{
	$hleFSel=$res_hletypes['description'];
}
//
$query_rec = $con->query("SELECT 
									REPLACE(university,'?','') as university,id 
									FROM university
									where id=".(int)$_POST['university']." and university!=''
									order by university asc");
$res_rec = $query_rec->fetch_array();

if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec!="")
{
	$UniversityFSel=$res_rec['university'];
}
//
$query_rec = $con->query("SELECT 
									major_cat,id 
									FROM study where id=".(int)$_POST['study']." and major_cat!=''
									order by major_cat asc");
$res_rec = $query_rec->fetch_array();

if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec!="")
{
	$studyFSel=$res_rec['major_cat'];
}
//
$designationsIDs="0";
if(isset($_POST['designation']) && $_POST['designation']!="" && is_numeric(str_replace(",","",$_POST['designation'])))
{
	$designationsIDs.=",".$_POST['designation'];
}
$query_rec = $con->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations where id IN (".$designationsIDs.") and CertificateDesignationName!=''
									order by id asc");
if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else 
{									
while($row = $query_rec->fetch_array())
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
}
}
//
$query_mrels = $con->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel where id=".(int)$_POST['MostRecentExpLevelID']." and description!=''
									order by id asc");
$res_mrels = $query_mrels->fetch_array();

if($res_mrels!="")
{
	$explevelFSel=$res_mrels['description'];
}
//
$query_performances = $con->query("SELECT 
									description,id 
									FROM Performance_Rating where id=".(int)$_POST['performance_rating']." and description!=''
									order by id asc");
$res_performances = $query_performances->fetch_array();

if($res_performances!="")
{
	$perfFSel=$res_performances['description'];
}
//
$query_rec = $con->query("SELECT 
									name,id 
									FROM industry where id=".(int)$_POST['industry_employer']." and name!=''
									order by name asc");
$res_rec = $query_rec->fetch_array();



if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec!="")
{
	$industryFSel=$res_rec['name'];
}
//
$query_rec = $con->query("SELECT 
									description,id 
									FROM Expertise_Role where id=".(int)$_POST['expertise_role']." and description!=''
									order by id asc");
$res_rec = $query_rec->fetch_array();

if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec!="")
{
	$expertiseFSel=$res_rec['description'];
}
//
$gradFSel=$_POST['graduation_year'];
//
$query_salarys = $con->query("SELECT 
									description,id 
									FROM SalaryRanges where id=".(int)$_POST['salary_range']." and description!=''
									order by id asc");
$res_salarys = $query_salarys->fetch_array();

if($res_salarys!="")
{
	$SalaryFSel=$res_salarys['description'];
}
?>
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

</div></div>
</section>