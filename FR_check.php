<?php
include("connection.php"); 

if((int)$_POST["check"]==2)
{
	$fieldnames=array();
	$fieldnames["countryid"]="country_id";
	$fieldnames["province"]="province";
	$fieldnames["cities"]="city";
	$fieldnames["age_range"]="age_range";
	$fieldnames["hle"]="hle";
	$fieldnames["university"]="university";
	$fieldnames["study"]="program_study";
	$fieldnames["designation"]="designation";
	$fieldnames["MostRecentExpLevelID"]="MostRecentExpLevelID";
	$fieldnames["performance_rating"]="Performance_rating";
	$fieldnames["industry_employer"]="industry_employer";
	$fieldnames["expertise_role"]="expertise_role";
	$fieldnames["graduation_year"]="graduation_year";
	$fieldnames["salary_range"]="salary_range";

	$selectedfields=explode(",",$_POST["selectedfields"].",0");
	
	$Popwhereq="where a.user_id > 0";
	
	
	
	
	foreach($selectedfields as $key=>$value)
	{
		if($value!="0")
		{
		$Popwhereq.=" and a.".$fieldnames[$value]."='".$_POST[$value]."'";
		}
	}
	
	//echo $Popwhereq;
	$test="";
	foreach($fieldnames as $key=>$value)
	{
		if($test!="")
		{
			$test.=",";
		}
	
		if(in_array($key,$selectedfields))
		{
			$test.="1";
		}
		else
		{
			$checkreponsesQ = $con->query("Select user_id from users a ".$Popwhereq." and a.".$value."='".$_POST[$key]."'");
			
			$popuser_id="0";
			while($checkreponsesR = $checkreponsesQ->fetch_array())
			{
				$popuser_id.=",".$checkreponsesR['user_id'];
			}
			
			$checkreponsesPopQ = $con->query("SELECT * FROM View_User_Responses where user_id IN (".$popuser_id.")");
			
			
			
			
			$orderid=0;
			$userarray=array();
			$checknum=0;

			while($value = $checkreponsesPopQ->fetch_array())
			{

				if($value["order_id"]!=$orderid)
				{
					
					$orderid=$value["order_id"];
					
				}
				
				if(in_array($value["user_id"],$userarray))
				{
				}
				else
				{
					$checknum++;
					
					$userarray[]=$value["user_id"];
				}
				
			}
			
			//$checknum=(int)$checkreponsesQ->num_rows;
			
			
			if($checknum > 1)
			{
				$test.="1";
			}
			else
			{
				$test.="0";
			}
		}
		
	}
	echo $test;
	
	
}
else
{
include("FR_calc.php"); 

echo $Population;
}
?>
