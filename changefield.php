<?php
include("connection.php"); 

$Selections=array();
$Selections["countryid"]="a.country_id";
$Selections["province"]="a.province";
$Selections["cities"]="a.city";
$Selections["age_range"]="a.age_range";
$Selections["hle"]="a.hle";
$Selections["MostRecentExpLevelID"]="a.MostRecentExpLevelID";
$Selections["performance_rating"]="a.Performance_rating";
$Selections["graduation_year"]="a.graduation_year";
$Selections["salary_range"]="a.salary_range";
$Selections["university1"]="a.university";
$Selections["study1"]="a.program_study";
$Selections["designation1"]="a.designation";
$Selections["industry_employer1"]="a.industry_employer";
$Selections["expertise_role1"]="a.expertise_role";


$fieldnames=array();

$fieldnames["age_range"]=array();
$fieldnames["age_range"][0]="AgeRanges"; //Table
$fieldnames["age_range"][1]="id"; //id
$fieldnames["age_range"][2]="description"; //value
$fieldnames["age_range"][3]="id asc"; //orderby
$fieldnames["age_range"][4]="a.age_range"; //user table column
$fieldnames["age_range"][5]="Select Age Range"; //first value


$fieldnames["hle"]=array();
$fieldnames["hle"][0]="HLEType"; //Table
$fieldnames["hle"][1]="id"; //id
$fieldnames["hle"][2]="description"; //value
$fieldnames["hle"][3]="id asc"; //orderby
$fieldnames["hle"][4]="a.hle"; //user table column
$fieldnames["hle"][5]="Select Education"; //first value

$fieldnames["MostRecentExpLevelID"]=array();
$fieldnames["MostRecentExpLevelID"][0]="MostRecentExperienceLevel"; //Table
$fieldnames["MostRecentExpLevelID"][1]="id"; //id
$fieldnames["MostRecentExpLevelID"][2]="description"; //value
$fieldnames["MostRecentExpLevelID"][3]="id asc"; //orderby
$fieldnames["MostRecentExpLevelID"][4]="a.MostRecentExpLevelID"; //user table column
$fieldnames["MostRecentExpLevelID"][5]="Select Experience"; //first value

$fieldnames["performance_rating"]=array();
$fieldnames["performance_rating"][0]="Performance_Rating"; //Table
$fieldnames["performance_rating"][1]="id"; //id
$fieldnames["performance_rating"][2]="description"; //value
$fieldnames["performance_rating"][3]="id asc"; //orderby
$fieldnames["performance_rating"][4]="a.Performance_rating"; //user table column
$fieldnames["performance_rating"][5]="Select Performance"; //first value

$fieldnames["graduation_year"]=array();
$fieldnames["graduation_year"][0]="graduation_year"; //Table
$fieldnames["graduation_year"][1]="id"; //id
$fieldnames["graduation_year"][2]="description"; //value
$fieldnames["graduation_year"][3]="id asc"; //orderby
$fieldnames["graduation_year"][4]="a.graduation_year"; //user table column
$fieldnames["graduation_year"][5]="Select Graduation"; //first value

$fieldnames["salary_range"]=array();
$fieldnames["salary_range"][0]="SalaryRanges"; //Table
$fieldnames["salary_range"][1]="id"; //id
$fieldnames["salary_range"][2]="description"; //value
$fieldnames["salary_range"][3]="id asc"; //orderby
$fieldnames["salary_range"][4]="a.salary_range"; //user table column
$fieldnames["salary_range"][5]="Select Salary"; //first value

$fieldnames["university1"]=array();
$fieldnames["university1"][0]="university"; //Table
$fieldnames["university1"][1]="id"; //id
$fieldnames["university1"][2]="university"; //value
$fieldnames["university1"][3]="university asc"; //orderby
$fieldnames["university1"][4]="a.university"; //user table column
$fieldnames["university1"][5]="Select University"; //first value

$fieldnames["study1"]=array();
$fieldnames["study1"][0]="study"; //Table
$fieldnames["study1"][1]="id"; //id
$fieldnames["study1"][2]="major_cat"; //value
$fieldnames["study1"][3]="major_cat asc"; //orderby
$fieldnames["study1"][4]="a.program_study"; //user table column
$fieldnames["study1"][5]="Select Study"; //first value

$fieldnames["designation1"]=array();
$fieldnames["designation1"][0]="Designations"; //Table
$fieldnames["designation1"][1]="id"; //id
$fieldnames["designation1"][2]="CertificateDesignationName"; //value
$fieldnames["designation1"][3]="id asc"; //orderby
$fieldnames["designation1"][4]="a.designation"; //user table column
$fieldnames["designation1"][5]="Select Designation"; //first value


$fieldnames["industry_employer1"]=array();
$fieldnames["industry_employer1"][0]="industry"; //Table
$fieldnames["industry_employer1"][1]="id"; //id
$fieldnames["industry_employer1"][2]="name"; //value
$fieldnames["industry_employer1"][3]="name asc"; //orderby
$fieldnames["industry_employer1"][4]="a.industry_employer"; //user table column
$fieldnames["industry_employer1"][5]="Select Industry"; //first value

$fieldnames["expertise_role1"]=array();
$fieldnames["expertise_role1"][0]="Expertise_Role"; //Table
$fieldnames["expertise_role1"][1]="id"; //id
$fieldnames["expertise_role1"][2]="description"; //value
$fieldnames["expertise_role1"][3]="id asc"; //orderby
$fieldnames["expertise_role1"][4]="a.expertise_role"; //user table column
$fieldnames["expertise_role1"][5]="Select Expertise"; //first value


if(isset($_REQUEST["p"]) && $_REQUEST["p"]!="")
{
	//
	$Tablename=$fieldnames[$_REQUEST["p"]][0];
	$IDname=$fieldnames[$_REQUEST["p"]][1];
	$Descname=$fieldnames[$_REQUEST["p"]][2];
	$Ordername=$fieldnames[$_REQUEST["p"]][3];
	$UserCname=$fieldnames[$_REQUEST["p"]][4];
	$Firstvname=$fieldnames[$_REQUEST["p"]][5];
	//


	echo "<option value=0>".$Firstvname."</option>";

	$whereq=" and a.user_id > 0";
	
	if((int)$_REQUEST["countryid"] > 0)
	{
		$whereq.=" and a.country_id=".(int)$_REQUEST["countryid"];
	}
	if((int)$_REQUEST["province"] > 0)
	{
		$whereq.=" and a.province=".(int)$_REQUEST["province"];
	}
	if((int)$_REQUEST["cities"] > 0)
	{
		$whereq.=" and a.city=".(int)$_REQUEST["cities"];
	}
	
	if((int)$_REQUEST["selectionv"] > 0)
	{
		$whereq.=" and ".$Selections[$_REQUEST["selection"]]."=".(int)$_REQUEST["selectionv"];
	}
	
	
		if($_REQUEST["p"]=="graduation_year")
		{
			for($i=2030;$i>=1950;$i--)
			{
				$checkreponsesQ = $con->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.graduation_year=".$i." ".$whereq." limit 0,1");
				$checkreponsesR = $checkreponsesQ->num_rows;
				
				
						
				if((int)$checkreponsesR > 0)
				{
			
				$slct="";
				if(isset($_REQUEST["v"]) && $_REQUEST["v"]== $i ){
					$slct='Selected';
				}
				
				
				echo "<option value=".(int)$i." ".$slct.">".$i."</option>";
			
		
				}
			}
		}
		else
		{
			$query_age = $con->query("SELECT 
										".$Descname.",".$IDname." 
										FROM ".$Tablename."
										order by ".$Ordername);
			while($row = $query_age->fetch_array())
			{
			
				$checkreponsesQ = $con->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and ".$UserCname."=".$row[$IDname]." ".$whereq." limit 0,1");
				$checkreponsesR = $checkreponsesQ->num_rows;
				
				
						
				if((int)$checkreponsesR > 0)
				{
			
				$slct="";
				if(isset($_REQUEST["v"]) && $_REQUEST["v"]== $row[$IDname] ){
					$slct='Selected';
				}
				
				$description=utf8_encode($row[$Descname]);
				$description=$row[$Descname];
				
				echo "<option value=".(int)$row[$IDname]." ".$slct.">".$description."</option>";
			
		
				}
			}
		}
}
?>