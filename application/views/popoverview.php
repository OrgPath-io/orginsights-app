<?php
$user_id=(int)$this->session->userdata('user_id');

$AssetPATH=$_SERVER['DOCUMENT_ROOT']."/app/";

//
$query_country = $this->db->query("SELECT 
									country,id 
									FROM countries where id=".(int)$_POST['countryid']."
									order by country asc");
$res_country = $query_country->result_array();

if($res_country[0]!="")
{
	$CountryFSel=$res_country[0]['country'];
}
//
$query_province = $this->db->query("SELECT 
									province_name,id 
									FROM provinces where id=".(int)$_POST['province']."
									order by province_name asc");
$res_province = $query_province->result_array();

if($res_province[0]!="")
{
	$ProvinceFSel=$res_province[0]['province_name'];
}
//
$query_city = $this->db->query("SELECT 
									* 
									FROM Cities where id=".(int)$_POST['cities']."
									order by description");
$res_city = $query_city->result_array();

if($res_city[0]!="")
{
	$cityFSel=$res_city[0]['description'];
}
//
$query_age = $this->db->query("SELECT 
									description,id 
									FROM AgeRanges where id=".(int)$_POST['age_range']." and description!=''
									order by id asc");
$res_age = $query_age->result_array();

if($res_age[0]!="")
{
	$ageFSel=$res_age[0]['description'];
}
//
$query_hletypes = $this->db->query("SELECT 
									description,id 
									FROM HLEType where id=".(int)$_POST['hle']." and description!=''
									order by id asc");
$res_hletypes = $query_hletypes->result_array();

if($res_hletypes[0]!="")
{
	$hleFSel=$res_hletypes[0]['description'];
}
//
$query_rec = $this->db->query("SELECT 
									REPLACE(university,'?','') as university,id 
									FROM university
									where id=".(int)$_POST['university']." and university!=''
									order by university asc");
$res_rec = $query_rec->result_array();

if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec[0]!="")
{
	$UniversityFSel=$res_rec[0]['university'];
}
//
$query_rec = $this->db->query("SELECT 
									major_cat,id 
									FROM study where id=".(int)$_POST['study']." and major_cat!=''
									order by major_cat asc");
$res_rec = $query_rec->result_array();

if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec[0]!="")
{
	$studyFSel=$res_rec[0]['major_cat'];
}
//
$designationsIDs="0";
if(isset($_POST['designation']) && $_POST['designation']!="" && is_numeric(str_replace(",","",$_POST['designation'])))
{
	$designationsIDs=$_POST['designation'];
}
$query_rec = $this->db->query("SELECT 
									CertificateDesignationName,Abbreviation,id 
									FROM Designations where id IN (".$designationsIDs.") and CertificateDesignationName!=''
									order by id asc");
									
$res_rec2 = $query_rec->result_array();									
if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec2[0]!="")
{
	if($res_rec2[0]['Abbreviation']!="")
	{
		$desigFSel=$res_rec2[0]['Abbreviation'];
	}
	else
	{
		$desigFSel=$res_rec2[0]['CertificateDesignationName'];
	}
}

//
$query_mrels = $this->db->query("SELECT 
									description,id 
									FROM MostRecentExperienceLevel where id=".(int)$_POST['MostRecentExpLevelID']." and description!=''
									order by id asc");
$res_mrels = $query_mrels->result_array();

if($res_mrels[0]!="")
{
	$explevelFSel=$res_mrels[0]['description'];
}
//
$query_performances = $this->db->query("SELECT 
									description,id 
									FROM Performance_Rating where id=".(int)$_POST['performance_rating']." and description!=''
									order by id asc");
$res_performances = $query_performances->result_array();

if($res_performances[0]!="")
{
	$perfFSel=$res_performances[0]['description'];
}
//
$query_rec = $this->db->query("SELECT 
									name,id 
									FROM industry where id=".(int)$_POST['industry_employer']." and name!=''
									order by name asc");
$res_rec = $query_rec->result_array();



if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec[0]!="")
{
	$industryFSel=$res_rec[0]['name'];
}
//
$query_rec = $this->db->query("SELECT 
									description,id 
									FROM Expertise_Role where id=".(int)$_POST['expertise_role']." and description!=''
									order by id asc");
$res_rec = $query_rec->result_array();

if(isset($_POST["reportd1"]) && (int)$_POST["reportd1"] > 0)
{
}
else if($res_rec[0]!="")
{
	$expertiseFSel=$res_rec[0]['description'];
}
//
$gradFSel=$_POST['graduation_year'];
//
$query_salarys = $this->db->query("SELECT 
									description,id 
									FROM SalaryRanges where id=".(int)$_POST['salary_range']." and description!=''
									order by id asc");
$res_salarys = $query_salarys->result_array();

if($res_salarys[0]!="")
{
	$SalaryFSel=$res_salarys[0]['description'];
}
//



$html .= '<div class="page_break"></div>

    <!-- Page additional -->

    
	<div class="container">
	<br>
	<table width="100%">';

$html.='<tr><td><b>Population</b>-'.$Population.'<br></td></tr>';

$overviewpop=0;

$html.='<tr>';
if($CountryFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Country</b>-'.$CountryFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($ProvinceFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Province</b>-'.$ProvinceFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($cityFSel!="")
{
$overviewpop++;
$html.='<td>
<b>City</b>-'.$cityFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($ageFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Age Range</b>-'.$ageFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($hleFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Education</b>-'.$hleFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($UniversityFSel!="")
{
$overviewpop++;
$html.='<td>
<b>University</b>-'.$UniversityFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($gradFSel!="" && $gradFSel!="0")
{
$overviewpop++;
$html.='<td>
<b>Graduation Year</b>-'.$gradFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($studyFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Study</b>-'.$studyFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($desigFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Designation</b>-'.$desigFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($explevelFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Experience</b>-'.$explevelFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($perfFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Performance</b>-'.$perfFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($industryFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Industry</b>-'.$industryFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($expertiseFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Expertise</b>-'.$expertiseFSel.'
<br><br>
</td>';
}

if($overviewpop==4)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($SalaryFSel!="")
{
$overviewpop++;
$html.='<td>
<b>Salary Range</b>-'.$SalaryFSel.'
<br><br>
</td>';
}

$html.='</tr>';

$html.='</table>';

$html.='<table width="100%">';
$html.='<tr><td>
<img src="'.$IMAGEPATH.'pdf_templates/images/country_image.png">
</td><td>
<img src="'.$IMAGEPATH.'pdf_templates/images/visible_minority.png">
</td><td style="font-size:30px;font-weight:bold;">
					'.(int)$visible_minoritiesp.'%
					</td></tr>';
$html.='</table>';

$html.='<table width="100%">';
$html.='<tr><td colspan="3">
<center>ACTIVITY<br><br></center>
</td>
<td width="4%"></td>
<td colspan="3">
<center>GENDER<br><br></center>
</td></tr>';
$html.='<tr>
<td width="22%" style="background:#135782;color:#ffffff;font-weight:bold;">
<br><br>
<center>'.$PopInvited.'<br>
PEOPLE INVITED
</center>
<br><br>
</td>
<td width="4%"></td>
<td width="22%" style="background:#07b051;color:#ffffff;font-weight:bold;">
<center>'.$Population.'<br>
PEOPLE COMPLETED
</center>
</td>
<td width="4%"></td>
<td width="22%" style="background:#135782;color:#ffffff;font-weight:bold;">
<center>47%<br>
MALE
</center>
</td>
<td width="4%"></td>
<td width="22%" style="background:#07b051;color:#ffffff;font-weight:bold;">
<center>41%<br>
FEMALE
</center>
</td>
</tr>';
$html.='</table>';

//
$html.='
<table width="100%">
<tr><td>
<center>RESPONDENTS BY AREA OF EXPERTISE<br><br></center>
<table width="100%">';
foreach($Expertise as $key=>$value)
{
	$perc=$value/$PeopleCompleted;
	$perc*=100;
	
$html .= '<tr>
<td>'.$key.'</td>
<td>'.(int)$perc.'%</td>
</tr>';	
}
$html .= '</table>
</td>
<td>
<center>RESPONDENTS BY INDUSTRY<br><br></center>
<table width="100%">';
foreach($Industry as $key=>$value)
{
	$perc=$value/$PeopleCompleted;
	$perc*=100;
	
	
	$Thename="";
	$query_industry = $this->db->query("SELECT 
									* 
									FROM industry where id=".(int)$key."");
	$res_industry = $query_industry->result_array();
	
	$Thename=$res_industry[0]["name"];
	
	if($Thename=="")
	{
		$Thename="undefined";
	}
	
$html .= '<tr>
<td>'.$Thename.'</td>
<td>'.(int)$perc.'%</td>
</tr>';	
}
$html .= '</table>
</td>
</tr></table>
';

$html.='
<center>EDUCATIONAL LEVEL<br><br></center>
<table width="100%">';
$educount=0;
foreach($Education as $key=>$value)
{
	$perc=$value/$PeopleCompleted;
	$perc*=100;
	
	
	$Thename="";
	$query_study = $this->db->query("SELECT 
									* 
									FROM study where id=".(int)$key."");
	$res_study = $query_study->result_array();
	
	$Thename=$res_study[0]["major_cat"];
	
	if($Thename=="")
	{
		$Thename="undefined";
	}
	$educount++;
	
	if($educount==5)
	{
		$html .= '</tr>';
		$educount=1;
	}
	
	if($educount==1)
	{
		$html .= '<tr>';
	}
	
$html .= '<td style="padding-right:10px;">
'.(int)$perc.'%
<br>'.$Thename.'
</td>';	



}
$html .= '</tr></table></div>';

	
	
?>