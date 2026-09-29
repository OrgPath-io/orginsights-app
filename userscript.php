<?php
include("connection.php");

//Country
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["country_name"];
	
	$Countryid=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from countries where country='".$checkreponsesR2["country_name"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$Countryid=$checkreponsesR3["id"];
	}
	
	echo " ".$Countryid;
	
	echo "<br>";
	
	$con->query("Update users set country_id=".(int)$Countryid." where user_id=".$checkreponsesR2["user_id"]);
	
	
}
echo "Country Done";


//Province
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["province"];
	
	if(is_numeric($checkreponsesR2["province"]))
	{
	}
	else
	{
	
	$Province=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from provinces where province_name='".$checkreponsesR2["province"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$Province=$checkreponsesR3["id"];
	}
	
	echo " ".$Province;
	
	echo "<br>";
	
	$con->query("Update users set province=".(int)$Province." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "Province Done";

//AgeRanges
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["age_range"];
	
	if(is_numeric($checkreponsesR2["age_range"]))
	{
	}
	else
	{
	
	$AgeRanges=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from AgeRanges where description='".$checkreponsesR2["age_range"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$AgeRanges=$checkreponsesR3["id"];
	}
	
	echo " ".$AgeRanges;
	
	echo "<br>";
	
	$con->query("Update users set age_range=".(int)$AgeRanges." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "AgeRanges Done";

//VisibleMinorities
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["visible_minorities_option"];
	
	if(is_numeric($checkreponsesR2["visible_minorities_option"]))
	{
	}
	else
	{
	
	$VisibleMinorities=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from VisibleMinorities where description='".$checkreponsesR2["visible_minorities_option"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$VisibleMinorities=$checkreponsesR3["id"];
	}
	
	echo " ".$VisibleMinorities;
	
	echo "<br>";
	
	$con->query("Update users set visible_minorities_option=".(int)$VisibleMinorities." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "VisibleMinorities Done";

//HLEType
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["hle"];
	
	if(is_numeric($checkreponsesR2["hle"]))
	{
	}
	else
	{
	
	$HLEType=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from HLEType where description='".$checkreponsesR2["hle"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$HLEType=$checkreponsesR3["id"];
	}
	
	echo " ".$HLEType;
	
	echo "<br>";
	
	$con->query("Update users set hle=".(int)$HLEType." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "HLEType Done";

//university
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["university"];
	
	if(is_numeric($checkreponsesR2["university"]))
	{
	}
	else
	{
	
	$university=0;
	
	/*
	$checkreponsesQ3 = $con->query("SELECT * from university where university='".str_replace("*","",$checkreponsesR2["university"])."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$university=$checkreponsesR3["id"];
	}
	*/
	
	echo " ".$university;
	
	echo "<br>";
	
	$con->query("Update users set university=".(int)$university." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "university Done";

//study
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["program_study"];
	
	if(is_numeric($checkreponsesR2["program_study"]))
	{
	}
	else
	{
	
	$study=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from study where major_cat='".$checkreponsesR2["program_study"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$study=$checkreponsesR3["id"];
	}
	
	echo " ".$study;
	
	echo "<br>";
	
	$con->query("Update users set program_study=".(int)$study." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "study Done";

//industry
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["industry_employer"];
	
	if(is_numeric($checkreponsesR2["industry_employer"]))
	{
	}
	else
	{
	
	$industry=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from industry where name='".$checkreponsesR2["industry_employer"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$industry=$checkreponsesR3["id"];
	}
	
	echo " ".$industry;
	
	echo "<br>";
	
	$con->query("Update users set industry_employer=".(int)$industry." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "industry Done";

//SalaryRanges
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["salary_range"];
	
	if(is_numeric($checkreponsesR2["salary_range"]))
	{
	}
	else
	{
	
	$SalaryRanges=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from SalaryRanges where description='".$checkreponsesR2["salary_range"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$SalaryRanges=$checkreponsesR3["id"];
	}
	
	echo " ".$SalaryRanges;
	
	echo "<br>";
	
	$con->query("Update users set salary_range=".(int)$SalaryRanges." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "SalaryRanges Done";

//LocalAmazon
$checkreponsesQ2 = $con->query("SELECT * from users order by user_id");
while($checkreponsesR2 = $checkreponsesQ2->fetch_array())
{
	echo $checkreponsesR2["local_amazon_web"];
	
	if(is_numeric($checkreponsesR2["local_amazon_web"]))
	{
	}
	else
	{
	
	$LocalAmazon=0;
	
	$checkreponsesQ3 = $con->query("SELECT * from LocalAmazon where description='".$checkreponsesR2["local_amazon_web"]."' order by id");
	$checkreponsesR3 = $checkreponsesQ3->fetch_array();
	
	if($checkreponsesR3!="")
	{
		$LocalAmazon=$checkreponsesR3["id"];
	}
	
	echo " ".$LocalAmazon;
	
	echo "<br>";
	
	$con->query("Update users set local_amazon_web=".(int)$LocalAmazon." where user_id=".$checkreponsesR2["user_id"]);
	
	}
	
	
}
echo "LocalAmazon Done";
?>