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



$html .= '

    <!-- Page additional -->
	<table width="100%">';

$overviewpop=0;

$html.='<tr>';
if($CountryFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Country</b>

</td></tr><tr><td style="">
'.$CountryFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Country</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($ProvinceFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Province</b>

</td></tr><tr><td style="">
'.$ProvinceFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Province</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($cityFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>City</b>

</td></tr><tr><td style="">
'.$cityFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>City</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($ageFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Age Range</b>

</td></tr><tr><td style="">
'.$ageFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Age Range</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($hleFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Education</b>

</td></tr><tr><td style="">
'.$hleFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Education</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($UniversityFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>University</b>

</td></tr><tr><td style="">
'.$UniversityFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>University</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr><td colspan="6" style="height:10px;"></td></tr><tr>';
	$overviewpop=0;
}

if($gradFSel!="" && $gradFSel!="0")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Graduation Year</b>

</td></tr><tr><td style="">
'.$gradFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Graduation Year</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($studyFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Study</b>

</td></tr><tr><td style="">
'.$studyFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Study</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($desigFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Designation</b>

</td></tr><tr><td style="">
'.$desigFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Designation</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($explevelFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Experience</b>

</td></tr><tr><td style="">
'.$explevelFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Experience</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($perfFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Performance</b>

</td></tr><tr><td style="">
'.$perfFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Performance</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($industryFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Industry</b>

</td></tr><tr><td style="">
'.$industryFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Industry</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr><td colspan="6" style="height:10px;"></td></tr><tr>';
	$overviewpop=0;
}

if($expertiseFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Expertise</b>

</td></tr><tr><td style="">
'.$expertiseFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Expertise</b>

</td>';
}

if($overviewpop==6)
{
	$html.='</tr><tr>';
	$overviewpop=0;
}

if($SalaryFSel!="")
{
$overviewpop++;
$html.='<td align="center"><table width="100%"><tr><td>
<b>Salary Range</b>

</td></tr><tr><td style="">
'.$SalaryFSel.'

</td></tr></table></td>';
}
else
{
$overviewpop++;
$html.='<td style="">
<b>Salary Range</b>

</td>';
}

$html.='</tr>';

$html.='</table>';

	
?>