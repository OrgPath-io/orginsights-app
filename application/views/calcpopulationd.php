<?php
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
	$checkreponsesQ = $this->db->query("Select country_id from users where user_id=".$user_id);
	$checkreponsesR = $checkreponsesQ->result_array();
	foreach($checkreponsesR as $key=>$value)
	{
		//print_r($value);
		
		$countryid=$value["country_id"];
		
	}
	//country
	
	$Popwhereq.=" and country_id=".(int)$countryid;
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
		//$checkreponsesQ = $this->db->query("Select * from provinces where province_name='".$_POST["province"]."'");
		$checkreponsesQ = $this->db->query("Select * from provinces where id='".(int)$_POST["province"]."'");
		$checkreponsesR = $checkreponsesQ->result_array();
		foreach($checkreponsesR as $key=>$value)
		{
			//print_r($value);
			$Popwhereq.=" and province=".(int)$value["id"];
			$ProvinceFSel=$value["province_name"];
			
		}
	
		
	}
	
	if(isset($_POST["city"]) && (int)$_POST["city"] > 0)
	{
		$Popwhereq.=" and city='".(int)$_POST["city"]."'";
		
		$checkreponsesQ = $this->db->query("Select * from Cities where id='".(int)$_POST["city"]."'");
		$checkreponsesR = $checkreponsesQ->result_array();
		foreach($checkreponsesR as $key=>$value)
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
	
	
	if(isset($_POST["university"]) && $_POST["university"]!="")
	{
		$checkreponsesQ = $this->db->query("Select * from university where university='".$_POST["university"]."'");
		$checkreponsesR = $checkreponsesQ->result_array();
		foreach($checkreponsesR as $key=>$value)
		{
			//print_r($value);
			$Popwhereq.=" and university=".(int)$value["id"];
			$UniversityFSel=$value["university"];
			
		}
	
		
	}
	
	if(isset($_POST["graduation_year"]) && (int)$_POST["graduation_year"] > 0)
	{
		$Popwhereq.=" and graduation_year=".(int)$_POST["graduation_year"];
	}
	
	if(isset($_POST["study"]) && $_POST["study"]!="")
	{
		$checkreponsesQ = $this->db->query("Select * from study where major_cat='".$_POST["study"]."'");
		$checkreponsesR = $checkreponsesQ->result_array();
		foreach($checkreponsesR as $key=>$value)
		{
			//print_r($value);
			$Popwhereq.=" and program_study=".(int)$value["id"];
			$studyFSel=$value["major_cat"];
			
		}
	
		
	}
	
	if(isset($_POST["designation"]) && $_POST["designation"]!="")
	{
		$desigfilled=trim($_POST["designation"])." - ";
			$desigfilled1=explode(" - ",$desigfilled);
			$desigfilled=$desigfilled1[0];
		
		$checkreponsesQ = $this->db->query("Select * from Designations where CertificateDesignationName='".$desigfilled."'");
		$checkreponsesR = $checkreponsesQ->result_array();
		foreach($checkreponsesR as $key=>$value)
		{
			//print_r($value);
			$Popwhereq.=" and designation=".(int)$value["id"];
			$desigFSel=$value["CertificateDesignationName"];
			
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
	
	if(isset($_POST["industry_employer"]) && $_POST["industry_employer"]!="")
	{
		$checkreponsesQ = $this->db->query("Select * from industry where name='".$_POST["industry_employer"]."'");
		$checkreponsesR = $checkreponsesQ->result_array();
		foreach($checkreponsesR as $key=>$value)
		{
			//print_r($value);
			$Popwhereq.=" and industry_employer=".(int)$value["id"];
			$industryFSel=$value["name"];
			
		}
	
		
	}
	
	
	if(isset($_POST["expertise_role"]) && $_POST["expertise_role"]!="")
	{
		$checkreponsesQ = $this->db->query("Select * from Expertise_Role where description='".$_POST["expertise_role"]."'");
		$checkreponsesR = $checkreponsesQ->result_array();
		foreach($checkreponsesR as $key=>$value)
		{
			//print_r($value);
			$Popwhereq.=" and expertise_role=".(int)$value["id"];
			$expertiseFSel=$value["description"];
			
		}
	
		
	}
	
	
	
	if(isset($_POST["salary_range"]) && (int)$_POST["salary_range"] > 0)
	{
		$Popwhereq.=" and salary_range=".(int)$_POST["salary_range"];
	}
}

//echo $Popwhereq; die();



//get users
$checkreponsesQ = $this->db->query("Select user_id,first_name,last_name,email,country_id,created_date,updated_date,province,city,address,visible_minorities,visible_minorities_option,university,graduation_year,program_study,designation,most_recent_employer,Performance_rating,industry_employer,expertise_role,salary_range,local_amazon_web from users ".$Popwhereq);

$PopInvited=(int)$checkreponsesQ->num_rows();
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

$checkreponsesR = $checkreponsesQ->result_array();
foreach($checkreponsesR as $key=>$value)
{
	//print_r($value);
	
	$popuser_id.=",".$value["user_id"];
	
	if(strtolower($value["visible_minorities"])=="yes")
	{
		$visible_minorities++;
	}
	
	$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by =".$value["user_id"]." and invite_sent=1 order by id desc");
	$checkinvitedR = $checkinvitedQ->result_array();

	foreach($checkinvitedR as $key2=>$value2)
	{
		$PeopleInvited++;
		
		$checkcompletedQ = $this->db->query("SELECT * from orders_assessment_type_rater_responses where r_user_id = ".$value2["id"]." and oa_val = -99 order by order_id desc");
		$checkcompletedR = $checkcompletedQ->result_array();
		
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
$checkreponsesPopQ = $this->db->query("SELECT * from ConditionalComments_Report order by CategoryID");
$checkreponsesPopR = $checkreponsesPopQ->result_array();

foreach($checkreponsesPopR as $key=>$value)
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
	
	$checkreponsesPopQ = $this->db->query("SELECT * from categories where cat_id=".$i."");
	$checkreponsesPopR = $checkreponsesPopQ->result_array();
	foreach($checkreponsesPopR as $key=>$value)
	{
		$desctext[$i]=$value["cat_description"];
		

	}
	
}
//


//end




//$checkreponsesPopQ = $this->db->query("SELECT a.*,q.cat_id,q.cap_id,q.q_type,q.question_typeID from orders_assessment_type_responses a INNER JOIN questions q on a.q_id=q.q_id where a.user_id = ".$popuser_id." and a.oa_val > -99 order by a.order_id desc,a.q_id");

/*/direct query
$checkreponsesPopQ = $this->db->query("select a.oatr_id AS oatr_id,a.oat_id AS oat_id,a.order_id AS order_id,a.user_id AS user_id,a.q_id AS q_id,a.oa_id AS oa_id,a.oa_val AS oa_val,a.created_date AS created_date,a.updated AS updated,q.cat_id AS cat_id,q.cap_id AS cap_id,q.q_type AS q_type from (orders_assessment_type_responses a join questions q on((a.q_id = q.q_id))) where (a.user_id =".$popuser_id." and a.oa_val > -(99) ) order by a.order_id desc,a.q_id");

//*/
//view

$found=0;



$checkreponsesPopQ = $this->db->query("SELECT * FROM `View_User_Responses` where user_id IN (".$popuser_id.")");

$orderid=0;
$userarray=array();
$checkreponsesPopR = $checkreponsesPopQ->result_array();

foreach($checkreponsesPopR as $key=>$value)
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
		$userarray[]=$value["user_id"];
	}
}

//
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cat_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Popcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cat_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$Popcatsq[(int)$value["cat_id"]]=$value["cnt"];
}

//
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cap_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Popcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='self' and question_typeID IN (3,5) group by cap_id");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$Popcapsq[(int)$value["cap_id"]]=$value["cnt"];
}

//PROFESSIONAL

//
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$PopOrgcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$PopOrgcatsq[(int)$value["cat_id"]]=$value["cnt"];
}

//
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$PopOrgcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//
$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id IN (".$popuser_id.") and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
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
	
	
	
	
	$checkcapsQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$key);
	$checkcapsR = $checkcapsQ->result_array();
	if($checkcapsR!="")
	{
		//echo $checkcapsR[0]["cap_name"]." <b>".$value."</b> (".$PopOrgcapsq[$key].") = <b>".number_format($PopOrgcapratings[$key],1)."</b><br>";
	}
	
}
//print_r($PopOrgcapratings);

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
	
	//echo $value." > ".$Popyourhighest." ".$key."<br>";
	
	if(number_format($value,1) > number_format($Popyourhighest,1))
	{
		$Popyourhighest=number_format($value,1);
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
$checkreponsesPopQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$Popyourlowcat."");
$checkreponsesPopR = $checkreponsesPopQ->result_array();

$PopyourlowcatName=$checkreponsesPopR[0]["cat_name"];
}
//
if((int)$Popyourhighcat==0)
{
	$PopyourhighcatName="Not Assigned";
}
else
{
$checkreponsesPopQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$Popyourhighcat."");
$checkreponsesPopR = $checkreponsesPopQ->result_array();

$PopyourhighcatName=$checkreponsesPopR[0]["cat_name"];
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

//added on oct 20th 2022
$PopOrghighcat=$Popyourhighcat;
//

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
$checkreponsesPopQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$PopOrglowcat."");
$checkreponsesPopR = $checkreponsesPopQ->result_array();

$PopOrglowcatName=$checkreponsesPopR[0]["cat_name"];
}
//
if((int)$PopOrghighcat==0)
{
	$PopOrghighcatName="Not Assigned";
}
else
{
$checkreponsesPopQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$PopOrghighcat."");
$checkreponsesPopR = $checkreponsesPopQ->result_array();

$PopOrghighcatName=$checkreponsesPopR[0]["cat_name"];
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
