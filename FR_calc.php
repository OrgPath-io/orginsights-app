<?php
$SITEURL="/orginsightapp/";
// Turn off error reporting
error_reporting(0);

$user_id=(int)$_POST['user_id'];

$order_id=(int)$_POST['order_id'];

//echo $order_id;

$Popwhereq="where user_id > 0";

$countryid=0;

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


if(!isset($_POST["countryid"]) && !isset($_POST["province"]) && !isset($_POST["university"]) && !isset($_POST["salary_range"]))
{

	//get country
	$checkreponsesQ = $con->query("Select country_id from users where user_id=".$user_id);
	
	while($value = $checkreponsesQ->fetch_array())
	{
		//print_r($value);
		
		$countryid=$value["country_id"];
		
	}
	//country
	
	$Popwhereq.=" and country_id=".(int)$countryid;
}
else 
{
	if(isset($_POST["reportd"]) && (int)$_POST["reportd"] > 0)
	{
	
		if(isset($_POST["countryid"]) && (int)$_POST["countryid"] > 0)
		{
			$Popwhereq.=" and country_id=".(int)$_POST["countryid"];
			$countryid=$_POST["countryid"];
			
			
			
		}
		if(isset($_POST["province"]) && (int)$_POST["province"] > 0)
		{
			//$checkreponsesQ = $con->query("Select * from provinces where province_name='".$_POST["province"]."'");
			$checkreponsesQ = $con->query("Select * from provinces where id='".(int)$_POST["province"]."'");
			while($value = $checkreponsesQ->fetch_array())
			{
				//print_r($value);
				$Popwhereq.=" and province=".(int)$value["id"];
				$ProvinceFSel=$value["province_name"];
				
			}
		
			
		}
		
		if(isset($_POST["cities"]) && (int)$_POST["cities"] > 0)
		{
			$Popwhereq.=" and city='".(int)$_POST["cities"]."'";
			
			$checkreponsesQ = $con->query("Select * from Cities where id='".(int)$_POST["cities"]."'");
			while($value = $checkreponsesQ->fetch_array())
			{
				//print_r($value);
				$cityFSel=$value["description"];
				$cityFSel=str_replace('Ã©','é',$cityFSel);

				$cityFSel=str_replace('Ã§','ç',$cityFSel);

				$cityFSel=str_replace('Ã¢','â',$cityFSel);

				$cityFSel=str_replace('Ã¨','è',$cityFSel);

				$cityFSel=str_replace('dâ€™','d’',$cityFSel);

				$cityFSel=str_replace('Å“','œ',$cityFSel);

				$cityFSel=str_replace('â€™','’',$cityFSel);
				$cityFSel=str_replace('Ã´','ô',$cityFSel);

				$cityFSel=str_replace('Ã‰','É',$cityFSel);

				$cityFSel=str_replace('Ã®','î',$cityFSel);
				$cityFSel=str_replace('Ã«','ë',$cityFSel);
				
			}
		}
		
		if(isset($_POST["age_range"]) && (int)$_POST["age_range"] > 0)
		{
			$Popwhereq.=" and age_range=".(int)$_POST["age_range"];
		}
		
		if(isset($_POST["hle"]) && (int)$_POST["hle"] > 0)
		{
			$Popwhereq.=" and hle=".(int)$_POST["hle"];
		}
		
		if(isset($_POST["university"]) && (int)$_POST["university"] > 0)
		{
			$Popwhereq.=" and university=".(int)$_POST["university"];
		}
		/*if(isset($_POST["university"]) && $_POST["university"]!="")
		{
			$checkreponsesQ = $con->query("Select * from university where university='".$_POST["university"]."'");
			while($value = $checkreponsesQ->fetch_array())
			{
				//print_r($value);
				$Popwhereq.=" and university=".(int)$value["id"];
				$UniversityFSel=$value["university"];
				
			}
		
			
		}*/
		
		if(isset($_POST["graduation_year"]) && (int)$_POST["graduation_year"] > 0)
		{
			$Popwhereq.=" and graduation_year=".(int)$_POST["graduation_year"];
		}
		
		
		if(isset($_POST["study"]) && (int)$_POST["study"] > 0)
		{
			$Popwhereq.=" and program_study=".(int)$_POST["study"];
		}
		/*if(isset($_POST["study"]) && $_POST["study"]!="")
		{
			$checkreponsesQ = $con->query("Select * from study where major_cat='".$_POST["study"]."'");
			
			
			while($value = $checkreponsesQ->fetch_array())
			{
				$Popwhereq.=" and program_study=".(int)$value["id"];
				$studyFSel=$value["major_cat"];
				
			}
		
			
		}*/
		
		if(isset($_POST["designation"]) && (int)$_POST["designation"] > 0)
		{
			$Popwhereq.=" and designation=".(int)$_POST["designation"];
		}
		/*
		if(isset($_POST["designation"]) && $_POST["designation"]!="")
		{
			$desigfilled=trim($_POST["designation"])." - ";
				$desigfilled1=explode(" - ",$desigfilled);
				$desigfilled=$desigfilled1[0];
			
			$checkreponsesQ = $con->query("Select * from Designations where CertificateDesignationName='".$desigfilled."'");
			while($value = $checkreponsesQ->fetch_array())
			{
				//print_r($value);
				$Popwhereq.=" and designation=".(int)$value["id"];
				
				if($value['Abbreviation']!="")
				{
					$desigFSel=$value['Abbreviation'];
				}
				else
				{
					$desigFSel=$value["CertificateDesignationName"];
				}
				
			}
		
			
		}*/
		
		
		if(isset($_POST["MostRecentExpLevelID"]) && (int)$_POST["MostRecentExpLevelID"] > 0)
		{
			$Popwhereq.=" and MostRecentExpLevelID=".(int)$_POST["MostRecentExpLevelID"];
		}
		
		if(isset($_POST["performance_rating"]) && (int)$_POST["performance_rating"] > 0)
		{
			$Popwhereq.=" and Performance_rating=".(int)$_POST["performance_rating"];
		}
		
		if(isset($_POST["industry_employer"]) && (int)$_POST["industry_employer"] > 0)
		{
			$Popwhereq.=" and industry_employer=".(int)$_POST["industry_employer"];
		}
		/*if(isset($_POST["industry_employer"]) && $_POST["industry_employer"]!="")
		{
			$checkreponsesQ = $con->query("Select * from industry where name='".$_POST["industry_employer"]."'");
			while($value = $checkreponsesQ->fetch_array())
			{
				//print_r($value);
				$Popwhereq.=" and industry_employer=".(int)$value["id"];
				$industryFSel=$value["name"];
				
			}
		
			
		}*/
		
		if(isset($_POST["expertise_role"]) && (int)$_POST["expertise_role"] > 0)
		{
			$Popwhereq.=" and expertise_role=".(int)$_POST["expertise_role"];
		}
		/*if(isset($_POST["expertise_role"]) && $_POST["expertise_role"]!="")
		{
			$checkreponsesQ = $con->query("Select * from Expertise_Role where description='".$_POST["expertise_role"]."'");
			while($value = $checkreponsesQ->fetch_array())
			{
				//print_r($value);
				$Popwhereq.=" and expertise_role=".(int)$value["id"];
				$expertiseFSel=$value["description"];
				
			}
		
			
		}*/
		
		
		
		if(isset($_POST["salary_range"]) && (int)$_POST["salary_range"] > 0)
		{
			$Popwhereq.=" and salary_range=".(int)$_POST["salary_range"];
		}
	}
	else
	{
	if(isset($_POST["countryid"]) && (int)$_POST["countryid"] > 0)
	{
		$Popwhereq.=" and country_id=".(int)$_POST["countryid"];
		$countryid=$_POST["countryid"];
	}
	if(isset($_POST["province"]) && (int)$_POST["province"] > 0)
	{
		//$checkreponsesQ = $con->query("Select * from provinces where province_name='".$_POST["province"]."'");
		$checkreponsesQ = $con->query("Select * from provinces where id='".(int)$_POST["province"]."'");
		while($value = $checkreponsesQ->fetch_array())
		{
			//print_r($value);
			$Popwhereq.=" and province=".(int)$value["id"];
			$ProvinceFSel=$value["province_name"];
			
		}
	
		
	}
	
	if(isset($_POST['cities']) && (int)$_POST['cities'] > 0)
	{
		$Popwhereq.=" and city='".(int)$_POST['cities']."'";
		
		$checkreponsesQ = $con->query("Select * from Cities where id='".(int)$_POST['cities']."'");
		while($value = $checkreponsesQ->fetch_array())
		{
			//print_r($value);
			$cityFSel=$value["description"];
			$cityFSel=str_replace('Ã©','é',$cityFSel);

			$cityFSel=str_replace('Ã§','ç',$cityFSel);

			$cityFSel=str_replace('Ã¢','â',$cityFSel);

			$cityFSel=str_replace('Ã¨','è',$cityFSel);

			$cityFSel=str_replace('dâ€™','d’',$cityFSel);

			$cityFSel=str_replace('Å“','œ',$cityFSel);

			$cityFSel=str_replace('â€™','’',$cityFSel);
			$cityFSel=str_replace('Ã´','ô',$cityFSel);

			$cityFSel=str_replace('Ã‰','É',$cityFSel);

			$cityFSel=str_replace('Ã®','î',$cityFSel);
			$cityFSel=str_replace('Ã«','ë',$cityFSel);
			
		}
	}
	
	if(isset($_POST["age_range"]) && (int)$_POST["age_range"] > 0)
	{
		$Popwhereq.=" and age_range=".(int)$_POST["age_range"];
	}
	
	if(isset($_POST["hle"]) && (int)$_POST["hle"] > 0)
	{
		$Popwhereq.=" and hle=".(int)$_POST["hle"];
	}
	
	
	if(isset($_POST["university"]) && (int)$_POST["university"] > 0)
	{
		$Popwhereq.=" and university=".(int)$_POST["university"];
	
		
	
		
	}
	
	if(isset($_POST["graduation_year"]) && (int)$_POST["graduation_year"] > 0)
	{
		$Popwhereq.=" and graduation_year=".(int)$_POST["graduation_year"];
	}
	
	if(isset($_POST["study"]) && (int)$_POST["study"] > 0)
	{
		$Popwhereq.=" and program_study=".(int)$_POST["study"];
		
		
	
		
	}
	
	if(isset($_POST["designation"]))
	{
		
			$dimplode="-1";
			
			if(isset($_POST['designation']) && $_POST['designation']!="" && is_numeric(str_replace(",","",$_POST['designation'])))
			{
				$dimplode.=",".$_POST['designation'];
			}
			
			
			
			$query_rec = $con->query("SELECT 
									UserID 
									FROM UsersDesignations where DesignationID IN (".$dimplode.") order by DesignationID asc");
			$dusers="0";
			$proceedtod=0;
			while($value = $query_rec->fetch_array())
			{
				$dusers.=",".$value['UserID'];
				$proceedtod=1;
			}
			
			if($proceedtod==1)
			{
			$Popwhereq.=" and user_id IN (".$dusers.")";
			}
		
	
		
	
		
	}
	
	
	if(isset($_POST["MostRecentExpLevelID"]) && (int)$_POST["MostRecentExpLevelID"] > 0)
	{
		$Popwhereq.=" and MostRecentExpLevelID=".(int)$_POST["MostRecentExpLevelID"];
	}
	
	if(isset($_POST["performance_rating"]) && (int)$_POST["performance_rating"] > 0)
	{
		$Popwhereq.=" and Performance_rating=".(int)$_POST["performance_rating"];
	}
	
	if(isset($_POST["industry_employer"]) && (int)$_POST["industry_employer"] > 0)
	{
	
		$Popwhereq.=" and industry_employer=".(int)$_POST["industry_employer"];
		
	
		
	}
	
	
	if(isset($_POST["expertise_role"]) && (int)$_POST["expertise_role"] > 0)
	{
		$Popwhereq.=" and expertise_role=".(int)$_POST["expertise_role"];
		
		
	
		
	}
	
	
	
	if(isset($_POST["salary_range"]) && (int)$_POST["salary_range"] > 0)
	{
		$Popwhereq.=" and salary_range=".(int)$_POST["salary_range"];
	}
	
	
	}
}

//echo $Popwhereq;
//echo "<br><br>";
//die();



//get users
$checkreponsesQ = $con->query("Select user_id,first_name,last_name,email,country_id,created_date,updated_date,province,city,address,visible_minorities,visible_minorities_option,university,graduation_year,program_study,designation,most_recent_employer,Performance_rating,industry_employer,expertise_role,salary_range,local_amazon_web from users ".$Popwhereq);




$PopInvited=(int)$checkreponsesQ->num_rows;


$visible_minorities=0;

$completedIDS="0";
$PeopleInvited=0;
$PeopleCompleted=0;

$Expertise=array();
$Industry=array();

$Education=array();

//
$Popcats=array();
$Popcatsq=array();

$PopOrgcats=array();
$PopOrgcatsq=array();

$Popcaps=array();
$PopOrgcaps=array();
$Popcapsq=array();
$PopOrgcapsq=array();

$Popcatratings=array();
$PopOrgcatratings=array();
$Popcapratings=array();
$PopOrgcapratings=array();


$Population=0;
$popuser_id="0";

while($value = $checkreponsesQ->fetch_array())
{
	//print_r($value);
	
	$popuser_id.=",".$value["user_id"];
	
	
	
	$checkinvitedQ = $con->query("SELECT * from invited_users where invited_by =".$value["user_id"]." and invite_sent=1 order by id desc");
	
	while($value2 = $checkinvitedQ->fetch_array())
	{
		$PeopleInvited++;
		
		$checkcompletedQ = $con->query("SELECT * from orders_assessment_type_rater_responses where r_user_id = ".$value2["id"]." and oa_val = -99 order by order_id desc");
		$checkcompletedR = $checkcompletedQ->fetch_array();
		
		if($checkcompletedR[0]=="")
		{
			$PeopleCompleted++;
			
			$completedIDS.=",".$value2["id"];
			
			if(!isset($Expertise[$value["expertise_role"]]))
			{
				$Expertise[$value["expertise_role"]]=0;
			}
			
			$Expertise[$value["expertise_role"]]++;
			//
			if(!isset($Industry[$value["industry_employer"]]))
			{
				$Industry[$value["industry_employer"]]=0;
			}
			
			$Industry[$value["industry_employer"]]++;
			
			//
			if(!isset($Education[$value["program_study"]]))
			{
				$Education[$value["program_study"]]=0;
			}
			
			$Education[$value["program_study"]]++;
		}
		
	}	
	
	
}	
	//pop stats
	

	
	//arrays
$levelstext=array();

for($i=1;$i<=5;$i++)
{
	$levelstext[$i]=array();
	
	for($j=1;$j<=4;$j++)
	{
		$levelstext[$i][$j]="";
	}
}
$checkreponsesPopQ = $con->query("SELECT * from ConditionalComments_Report order by CategoryID");

while($value = $checkreponsesPopQ->fetch_array())
{
	$i=(int)$value["CategoryID"];
	
	$levelstext[$i][1]=$value["TopScoring"];
	$levelstext[$i][2]=$value["LowestScoring"];
	$levelstext[$i][3]=$value["HiddenTalent"];
	$levelstext[$i][4]=$value["BlindSpot"];

}

//
$desctext=array();

for($i=1;$i<=5;$i++)
{
	$desctext[$i]="";
	
	$checkreponsesPopQ = $con->query("SELECT * from categories where cat_id=".$i."");
	while($value = $checkreponsesPopQ->fetch_array())
	{
		$desctext[$i]=$value["cat_description"];
		

	}
	
}
//


//end




//$checkreponsesPopQ = $con->query("SELECT a.*,q.cat_id,q.cap_id,q.q_type,q.question_typeID from orders_assessment_type_responses a INNER JOIN questions q on a.q_id=q.q_id where a.user_id = ".$popuser_id." and a.oa_val > -99 order by a.order_id desc,a.q_id");

/*/direct query
$checkreponsesPopQ = $con->query("select a.oatr_id AS oatr_id,a.oat_id AS oat_id,a.order_id AS order_id,a.user_id AS user_id,a.q_id AS q_id,a.oa_id AS oa_id,a.oa_val AS oa_val,a.created_date AS created_date,a.updated AS updated,q.cat_id AS cat_id,q.cap_id AS cap_id,q.q_type AS q_type from (orders_assessment_type_responses a join questions q on((a.q_id = q.q_id))) where (a.user_id =".$popuser_id." and a.oa_val > -(99) ) order by a.order_id desc,a.q_id");

//*/
//view

$found=0;



$checkreponsesPopQ = $con->query("SELECT * FROM `View_User_Responses` where user_id IN (".$popuser_id.")");

$orderid=0;
$userarray=array();

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
		$Population++;
		
		$checkvmQ = $con->query("Select visible_minorities from users where user_id=".(int)$value["user_id"]);

		$checkvmR = $checkvmQ->fetch_array();

		if(strtolower($checkvmR['visible_minorities'])=="yes")
		{
			$visible_minorities++;
		}


		
		
		$userarray[]=$value["user_id"];
	}
	
}

//
$checkreponsesQ = $con->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cat_id");

while($value = $checkreponsesQ->fetch_array())
{
	
	$Popcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $con->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cat_id
");




while($value = $checkreponsesQ->fetch_array())
{

	$Popcatsq[(int)$value["cat_id"]]=$value["cnt"];
}

//
$checkreponsesQ = $con->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cap_id");



while($value = $checkreponsesQ->fetch_array())
{
	
	$Popcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $con->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cap_id");




while($value = $checkreponsesQ->fetch_array())
{

	$Popcapsq[(int)$value["cap_id"]]=$value["cnt"];
}

//PROFESSIONAL

//
$checkreponsesQ = $con->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");



while($value = $checkreponsesQ->fetch_array())
{
	
	$PopOrgcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $con->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");




while($value = $checkreponsesQ->fetch_array())
{

	$PopOrgcatsq[(int)$value["cat_id"]]=$value["cnt"];
}

//
$checkreponsesQ = $con->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id");



while($value = $checkreponsesQ->fetch_array())
{
	
	$PopOrgcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $con->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id
");




while($value = $checkreponsesQ->fetch_array())
{

	$PopOrgcapsq[(int)$value["cap_id"]]=$value["cnt"];
}
//
//

//echo $Population;
//die();
	
	
//users

foreach($Popcats as $key=>$value)
{	
	$Popcatratings[$key]+=$value/$Popcatsq[$key];
}
foreach($PopOrgcats as $key=>$value)
{
	$PopOrgcatratings[$key]+=$value/$PopOrgcatsq[$key];
}

//
//print_r($Popcats);
//print_r($Popcatratings);


foreach($Popcaps as $key=>$value)
{
	if($Popcapsq[$key] > 0)
	{
		$Popcapratings[$key]+=$value/$Popcapsq[$key];
	}
	else
	{
		$Popcapratings[$key]+=0;
	}
}


foreach($PopOrgcaps as $key=>$value)
{

	

	if($PopOrgcapsq[$key] > 0)
	{
		$PopOrgcapratings[$key]+=$value/$PopOrgcapsq[$key];
	}
	else
	{
		$PopOrgcapratings[$key]+=0;
	}
	
	
	
	
	$checkcapsQ = $con->query("SELECT * from capabilities where cap_id = ".(int)$key);
	$checkcapsR = $checkcapsQ->fetch_array();
	if($checkcapsR!="")
	{
		//echo $checkcapsR["cap_name"]." <b>".$value."</b> (".$PopOrgcapsq[$key].") = <b>".number_format($PopOrgcapratings[$key],1)."</b><br>";
	}
	
}	

//pop
$PopTotalratings=array();
$PopOrgTotalratings=array();
$PopTotalratingsID=array();
$PopOrgTotalratingsID=array();


for($i=1;$i<=6;$i++)
{
	$PopTotalratings[$i]=0;
}
for($i=1;$i<=6;$i++)
{
	$PopOrgTotalratings[$i]=0;
}

//print_r($PopOrgcapratings);

$i=0;
foreach($Popcapratings as $key=>$value)
{
	
	$PopTotalratings[$i]=$value;
	$PopTotalratingsID[$i]=$key;
	$i++;
}

$i=0;
foreach($PopOrgcapratings as $key=>$value)
{
	
	
	$PopOrgTotalratings[$i]=$value;
	$PopOrgTotalratingsID[$i]=$key;
	$i++;
	
}


//CALC HIGHEST

$Pophighest1=0;
$Pophighest1ID=0;
foreach($PopOrgTotalratings as $key=>$value)
{
	if($value > $Pophighest1)
	{
		$Pophighest1=$value;
		$Pophighest1ID=$PopOrgTotalratingsID[$key];
	}

}



//
$Pophighest2=0;
$Pophighest1ID2=0;
foreach($PopOrgTotalratings as $key=>$value)
{
	if($PopOrgTotalratingsID[$key]!=$Pophighest1ID)
	{
		if($value > $Pophighest2)
		{
			$Pophighest2=$value;
			$Pophighest1ID2=$PopOrgTotalratingsID[$key];
		}
	}

}


//
$Pophighest3=0;
$Pophighest1ID3=0;
foreach($PopOrgTotalratings as $key=>$value)
{
	if($PopOrgTotalratingsID[$key]!=$Pophighest1ID && $PopOrgTotalratingsID[$key]!=$Pophighest1ID2)
	{
		if($value > $Pophighest3)
		{
			$Pophighest3=$value;
			$Pophighest1ID3=$PopOrgTotalratingsID[$key];
		}
	}

}



$Pophighcap=array($Pophighest1,$Pophighest2,$Pophighest3);
$PophighcapID=array($Pophighest1ID,$Pophighest1ID2,$Pophighest1ID3);



//
//CALC lowEST
$Poplowest1=99999999;
$Poplowest1ID=0;
foreach($PopOrgTotalratings as $key=>$value)
{
	if($value < $Poplowest1 && $value > 0)
	{
		$Poplowest1=$value;
		$Poplowest1ID=$PopOrgTotalratingsID[$key];
	}

}

if($Poplowest1==99999999)
{
	$Poplowest1=0;
}
//
$Poplowest2=99999999;
$Poplowest1ID2=0;
foreach($PopOrgTotalratings as $key=>$value)
{
	if($PopOrgTotalratingsID[$key]!=$Poplowest1ID)
	{
		if($value < $Poplowest2 && $value > 0)
		{
			$Poplowest2=$value;
			$Poplowest1ID2=$PopOrgTotalratingsID[$key];
		}
	}

}
if($Poplowest2==99999999)
{
	$Poplowest2=0;
}
//
$Poplowest3=99999999;
$Poplowest1ID3=0;
foreach($PopOrgTotalratings as $key=>$value)
{
	if($PopOrgTotalratingsID[$key]!=$Poplowest1ID && $PopOrgTotalratingsID[$key]!=$Poplowest1ID2)
	{
		if($value < $Poplowest3 && $value > 0)
		{
			$Poplowest3=$value;
			$Poplowest1ID3=$PopOrgTotalratingsID[$key];
		}
	}

}

if($Poplowest3==99999999)
{
	$Poplowest3=0;
}



$Poplowcap=array($Poplowest1,$Poplowest2,$Poplowest3);
$PoplowcapID=array($Poplowest1ID,$Poplowest1ID2,$Poplowest1ID3);
//


$Popyourlowest=99999999;
$Popyourhighest=0;
$Popyourlowcat=0;
$Popyourhighcat=0;

$Popratings=array();
$PopOrgratings=array();

for($i=1;$i<=6;$i++)
{
	$Popratings[$i]=0;
}
for($i=1;$i<=6;$i++)
{
	$PopOrgratings[$i]=0;
}

$i=0;
foreach($Popcatratings as $key=>$value)
{
	$i++;
	$Popratings[$i]=(int)$value;
	
	if($value < $Popyourlowest)
	{
		$Popyourlowest=$value;
		$Popyourlowcat=$key;
	}
	
	if($value > $Popyourhighest)
	{
		$Popyourhighest=$value;
		$Popyourhighcat=$key;
	}
}

if($Popyourlowest==99999999)
{
	$Popyourlowest=0;
}

//
if((int)$Popyourlowcat==0)
{
	$PopyourlowcatName="Not Assigned";
}
else
{
$checkreponsesPopQ = $con->query("SELECT * from categories where cat_id = ".(int)$Popyourlowcat."");
$checkreponsesPopR = $checkreponsesPopQ->fetch_array();

$PopyourlowcatName=$checkreponsesPopR["cat_name"];
}

//
if((int)$Popyourhighcat==0)
{
	$PopyourhighcatName="Not Assigned";
}
else
{
$checkreponsesPopQ = $con->query("SELECT * from categories where cat_id = ".(int)$Popyourhighcat."");
$checkreponsesPopR = $checkreponsesPopQ->fetch_array();

$PopyourhighcatName=$checkreponsesPopR["cat_name"];
}

//
$PopOrglowest=99999999;
$PopOrghighest=0;
$PopOrglowcat=0;
$PopOrghighcat=0;
$i=0;
foreach($PopOrgcatratings as $key=>$value)
{
	$i++;
	$PopOrgratings[$i]=(int)$value;
	
	if($value < $PopOrglowest)
	{
		$PopOrglowest=$value;
		$PopOrglowcat=$key;
	}
	
	if($value > $PopOrghighest)
	{
		$PopOrghighest=$value;
		$PopOrghighcat=$key;
	}
}

//print_r ($PopOrglowest);

if($PopOrglowest==99999999)
{
	$PopOrglowest=0;
}
//
if((int)$PopOrglowcat==0)
{
	$PopOrglowcatName="Not Assigned";
}
else
{
$checkreponsesPopQ = $con->query("SELECT * from categories where cat_id = ".(int)$PopOrglowcat."");
$checkreponsesPopR = $checkreponsesPopQ->fetch_array();

$PopOrglowcatName=$checkreponsesPopR["cat_name"];
}

//
if((int)$PopOrghighcat==0)
{
	$PopOrghighcatName="Not Assigned";
}
else
{
$checkreponsesPopQ = $con->query("SELECT * from categories where cat_id = ".(int)$PopOrghighcat."");
$checkreponsesPopR = $checkreponsesPopQ->fetch_array();

$PopOrghighcatName=$checkreponsesPopR["cat_name"];
}
//end

$visible_minoritiesp=$visible_minorities/$Population;
$visible_minoritiesp*=100;

$PeopleInvitedp=$PeopleInvited/$Population;
$PeopleInvitedp*=100;

$PeopleCompletedp=$PeopleCompleted/$Population;
$PeopleCompletedp*=100;

//print_r($Population);
?>
<?php
//finalreport6
//arrays
$levelstext=array();

for($i=1;$i<=5;$i++)
	{
	$levelstext[$i]=array();
	
	for($j=1;$j<=4;$j++)
	{
		$levelstext[$i][$j]="";
	}
}
$checkreponsesQ = $con->query("SELECT * from ConditionalComments_Report order by CategoryID");


while($value = $checkreponsesQ->fetch_array())
{
	$i=(int)$value["CategoryID"];
	
	$levelstext[$i][1]=$value["TopScoring"];
	$levelstext[$i][2]=$value["LowestScoring"];
	$levelstext[$i][3]=$value["HiddenTalent"];
	$levelstext[$i][4]=$value["BlindSpot"];

}

//
$desctext=array();

for($i=1;$i<=5;$i++)
{
	$desctext[$i]="";
	
	$checkreponsesQ = $con->query("SELECT * from categories where cat_id=".$i."");
	
	while($value = $checkreponsesQ->fetch_array())
	{
		$desctext[$i]=$value["cat_description"];
		

	}
	
}
//


//end

$checkinvitedQ = $con->query("SELECT count(*) as PeopleInvited from invited_users where invited_by = ".$user_id." and order_id=".$order_id." order by id desc");
$checkinvitedR = $checkinvitedQ->fetch_array();

$PeopleInvited = $checkinvitedR["PeopleInvited"];

//
$checkcompletedQ = $con->query("SELECT count(*) as PeopleCompleted from orders where user_id = ".$user_id." and order_status = 'Completed' and order_id=".$order_id." order by order_id desc");
$checkcompletedR = $checkcompletedQ->fetch_array();

$PeopleCompleted = $checkcompletedR["PeopleCompleted"];


//
$cats=array();
$catsq=array();

$Orgcats=array();
$Orgcatsq=array();

$caps=array();
$Orgcaps=array();
$capsq=array();
$Orgcapsq=array();


//view

//self categories
$checkreponsesQ = $con->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cat_id");



while($value = $checkreponsesQ->fetch_array())
{
	
	$cats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cat_id
");




while($value = $checkreponsesQ->fetch_array())
{

	$catsq[(int)$value["cat_id"]]=$value["cnt"];
}

//self capabilities
$checkreponsesQ = $con->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id");



while($value = $checkreponsesQ->fetch_array())
{
	
	$caps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id
");




while($value = $checkreponsesQ->fetch_array())
{

	$capsq[(int)$value["cap_id"]]=$value["cnt"];
}

//
//professional categories
$checkreponsesQ = $con->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");



while($value = $checkreponsesQ->fetch_array())
{
	
	$Orgcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id
");




while($value = $checkreponsesQ->fetch_array())
{

	$Orgcatsq[(int)$value["cat_id"]]=$value["cnt"];
}

//professional capabilities
$checkreponsesQ = $con->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id");



while($value = $checkreponsesQ->fetch_array())
{
	
	$Orgcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id
");




while($value = $checkreponsesQ->fetch_array())
{

	$Orgcapsq[(int)$value["cap_id"]]=$value["cnt"];
}


$catratings=array();
$Orgcatratings=array();
foreach($cats as $key=>$value)
{
	$catratings[$key]=$value/$catsq[$key];
}
foreach($Orgcats as $key=>$value)
{
	$Orgcatratings[$key]=$value/$Orgcatsq[$key];
}

//
$capratings=array();
$Orgcapratings=array();
foreach($caps as $key=>$value)
{
	if($capsq[$key] > 0)
	{
		$capratings[$key]=$value/$capsq[$key];
	}
	else
	{
		$capratings[$key]=0;
	}
}
foreach($Orgcaps as $key=>$value)
{



	if($Orgcapsq[$key] > 0)
	{
		$Orgcapratings[$key]=$value/$Orgcapsq[$key];
	}
	else
	{
		$Orgcapratings[$key]=0;
	}
	
	
	$checkcapsQ = $con->query("SELECT * from capabilities where cap_id = ".(int)$key);
	$checkcapsR = $checkcapsQ->fetch_array();
	if($checkcapsR!="")
	{
		//echo $checkcapsR[0]["cap_name"]." <b>".$value."</b> (".$Orgcapsq[$key].") = <b>".number_format($Orgcapratings[$key],1)."</b><br>";
	}
	
}

$Totalratings=array();
$OrgTotalratings=array();
$TotalratingsID=array();
$OrgTotalratingsID=array();



for($i=1;$i<=6;$i++)
{
	$Totalratings[$i]=0;
}
for($i=1;$i<=6;$i++)
{
	$OrgTotalratings[$i]=0;
}

$i=0;
foreach($capratings as $key=>$value)
{
	
	$Totalratings[$i]=$value;
	$TotalratingsID[$i]=$key;
	$i++;
}

$i=0;
foreach($Orgcapratings as $key=>$value)
{
	
	$OrgTotalratings[$i]=$value;
	$OrgTotalratingsID[$i]=$key;
	$i++;
	
}

//CALC HIGHEST

$highest1=0;
$highest1ID=0;
foreach($Totalratings as $key=>$value)
{
	if($value > $highest1)
	{
		$highest1=$value;
		$highest1ID=$TotalratingsID[$key];
	}

}



//
$highest2=0;
$highest1ID2=0;
foreach($Totalratings as $key=>$value)
{
	if($TotalratingsID[$key]!=$highest1ID)
	{
		if($value > $highest2)
		{
			$highest2=$value;
			$highest1ID2=$TotalratingsID[$key];
		}
	}

}


//
$highest3=0;
$highest1ID3=0;
foreach($Totalratings as $key=>$value)
{
	if($TotalratingsID[$key]!=$highest1ID && $TotalratingsID[$key]!=$highest1ID2)
	{
		if($value > $highest3)
		{
			$highest3=$value;
			$highest1ID3=$TotalratingsID[$key];
		}
	}

}



$highcap=array($highest1,$highest2,$highest3);
$highcapID=array($highest1ID,$highest1ID2,$highest1ID3);



//
//CALC lowEST
$lowest1=99999999;
$lowest1ID=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($value < $lowest1 && $value > 0)
	{
		$lowest1=$value;
		$lowest1ID=$OrgTotalratingsID[$key];
	}

}

if($lowest1==99999999)
{
	$lowest1=0;
}
//
$lowest2=99999999;
$lowest1ID2=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$lowest1ID)
	{
		if($value < $lowest2 && $value > 0)
		{
			$lowest2=$value;
			$lowest1ID2=$OrgTotalratingsID[$key];
		}
	}

}
if($lowest2==99999999)
{
	$lowest2=0;
}
//
$lowest3=99999999;
$lowest1ID3=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$lowest1ID && $OrgTotalratingsID[$key]!=$lowest1ID2)
	{
		if($value < $lowest3 && $value > 0)
		{
			$lowest3=$value;
			$lowest1ID3=$OrgTotalratingsID[$key];
		}
	}

}

if($lowest3==99999999)
{
	$lowest3=0;
}



$lowcap=array($lowest1,$lowest2,$lowest3);
$lowcapID=array($lowest1ID,$lowest1ID2,$lowest1ID3);
//


$yourlowest=99999999;
$yourhighest=0;
$yourlowcat=0;
$yourhighcat=0;

$ratings=array();
$Orgratings=array();

for($i=1;$i<=6;$i++)
{
	$ratings[$i]=0;
}
for($i=1;$i<=6;$i++)
{
	$Orgratings[$i]=0;
}

$i=0;
foreach($catratings as $key=>$value)
{
	$i++;
	$ratings[$i]=(int)$value;
	
	if($value < $yourlowest)
	{
		$yourlowest=$value;
		$yourlowcat=$key;
	}
	
	if($value > $yourhighest)
	{
		$yourhighest=$value;
		$yourhighcat=$key;
	}
}

if($yourlowest==99999999)
{
	$yourlowest=0;
}

//
if((int)$yourlowcat==0)
{
	$yourlowcatName="Not Assigned";
}
else
{
$checkreponsesQ = $con->query("SELECT * from categories where cat_id = ".(int)$yourlowcat."");
$checkreponsesR = $checkreponsesQ->fetch_array();

$yourlowcatName=$checkreponsesR["cat_name"];
}
//
if((int)$yourhighcat==0)
{
	$yourhighcatName="Not Assigned";
}
else
{
$checkreponsesQ = $con->query("SELECT * from categories where cat_id = ".(int)$yourhighcat."");
$checkreponsesR = $checkreponsesQ->fetch_array();

$yourhighcatName=$checkreponsesR["cat_name"];
}


//
$Orglowest=99999999;
$Orghighest=0;
$Orglowcat=0;
$Orghighcat=0;
$i=0;
foreach($Orgcatratings as $key=>$value)
{
	$i++;
	$Orgratings[$i]=(int)$value;
	
	if($value < $Orglowest)
	{
		$Orglowest=$value;
		$Orglowcat=$key;
	}
	
	if($value > $Orghighest)
	{
		$Orghighest=$value;
		$Orghighcat=$key;
	}
}


if($Orglowest==99999999)
{
	$Orglowest=0;
}

//
if((int)$Orglowcat==0)
{
	$OrglowcatName="Not Assigned";
}
else
{
$checkreponsesQ = $con->query("SELECT * from categories where cat_id = ".(int)$Orglowcat."");
$checkreponsesR = $checkreponsesQ->fetch_array();

$OrglowcatName=$checkreponsesR["cat_name"];
}
//
if((int)$Orghighcat==0)
{
	$OrghighcatName="Not Assigned";
}
else
{
$checkreponsesQ = $con->query("SELECT * from categories where cat_id = ".(int)$Orghighcat."");
$checkreponsesR = $checkreponsesQ->fetch_array();

$OrghighcatName=$checkreponsesR["cat_name"];
}


$catlists=array(1,2,3,4,5);
$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
?>