<?php
include("connection.php"); 

include("FR_calc.php"); 

$SITEURL="https://app.orginsights.io/";
?>
<?php
$catlists=array(1,2,3,4,5);
$catlistsname=array("Limits Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationship","Sets<br>Purpose");

/*
//
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
while($checkreponsesR = $checkreponsesQ->fetch_array())
{
foreach($checkreponsesR as $key=>$value)
{
	$i=(int)$value["CategoryID"];
	
	$levelstext[$i][1]=$value["TopScoring"];
	$levelstext[$i][2]=$value["LowestScoring"];
	$levelstext[$i][3]=$value["HiddenTalent"];
	$levelstext[$i][4]=$value["BlindSpot"];

}
}
//
$desctext=array();

for($i=1;$i<=5;$i++)
{
	$desctext[$i]="";
	
	$checkreponsesQ = $con->query("SELECT * from categories where cat_id=".$i."");
	while($checkreponsesR = $checkreponsesQ->fetch_array())
	{
	foreach($checkreponsesR as $key=>$value)
	{
		$desctext[$i]=$value["cat_description"];
		

	}
	}	
	
}
//


//end

$checkinvitedQ = $con->query("SELECT count(*) as PeopleInvited from invited_users where invited_by = ".$user_id." and order_id=".$order_id." order by id desc");
$checkinvitedR = $checkinvitedQ->fetch_array();

$PeopleInvited = $checkinvitedR[0]["PeopleInvited"];

//
$checkcompletedQ = $con->query("SELECT count(*) as PeopleCompleted from orders where user_id = ".$user_id." and order_status = 'Completed' and order_id=".$order_id." order by order_id desc");
$checkcompletedR = $checkcompletedQ->fetch_array();

$PeopleCompleted = $checkcompletedR[0]["PeopleCompleted"];


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

while($checkreponsesR = $checkreponsesQ->fetch_array())
{

foreach($checkreponsesR as $key=>$value)
{
	
	$cats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cat_id
");

while($checkreponsesR = $checkreponsesQ->fetch_array())
{


foreach($checkreponsesR as $key=>$value)
{

	$catsq[(int)$value["cat_id"]]=$value["cnt"];
}
}

//self capabilities
$checkreponsesQ = $con->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id");

while($checkreponsesR = $checkreponsesQ->fetch_array())
{

foreach($checkreponsesR as $key=>$value)
{
	
	$caps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id
");

while($checkreponsesR = $checkreponsesQ->fetch_array())
{


foreach($checkreponsesR as $key=>$value)
{

	$capsq[(int)$value["cap_id"]]=$value["cnt"];
}
}

//
//professional categories
$checkreponsesQ = $con->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");

while($checkreponsesR = $checkreponsesQ->fetch_array())
{

foreach($checkreponsesR as $key=>$value)
{
	
	$Orgcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id
");

while($checkreponsesR = $checkreponsesQ->fetch_array())
{


foreach($checkreponsesR as $key=>$value)
{

	$Orgcatsq[(int)$value["cat_id"]]=$value["cnt"];
}
}

//professional capabilities
$checkreponsesQ = $con->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id");

while($checkreponsesR = $checkreponsesQ->fetch_array())
{

foreach($checkreponsesR as $key=>$value)
{
	
	$Orgcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}
}

//

$checkreponsesQ = $con->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id
");

while($checkreponsesR = $checkreponsesQ->fetch_array())
{


foreach($checkreponsesR as $key=>$value)
{

	$Orgcapsq[(int)$value["cap_id"]]=$value["cnt"];
}
}



////


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
*/
?>
<div class="graph_colum">
<div style="background:none;padding-top:0px;padding-bottom:0px;" class="graph_colTitle"></div>
<ul class="graph_line_list">
<li>
<div style="background:none;padding-top:0px;padding-bottom:0px;" class="line_title"></div>
<div class="graph_lines">
					<span style="position:relative;"><div style="z-index:1000;position:absolute;top:0;left:-5;">0</div></span>
                    <span style="position:relative;" class="border_line border_line_1"><div style="z-index:1000;position:absolute;top:0;left:-4;">1</div></span>
                    <span style="position:relative;" class="border_line border_line_2"><div style="z-index:1000;position:absolute;top:0;left:-4;">2</div></span>
                    <span style="position:relative;" class="border_line border_line_3"><div style="z-index:1000;position:absolute;top:0;left:-4;">3</div></span>
					<span style="position:relative;" class="border_line border_line_4"><div style="z-index:1000;position:absolute;top:0;left:-4;">4</div></span>
					<span style="position:relative;" class="border_line border_line_5"><div style="z-index:1000;position:absolute;top:0;left:-4;">5</div></span>
</div>
</li>	
</ul>
</div>
<br>					
<?php
////
foreach($catlists as $Ckey=>$Cvalue)
{

$Maincatid=$Cvalue;
$Maincatname=$catlistsname[$Ckey];
$Maincattitle=$catlistsname[$Ckey];
$Maincatname=str_replace("<br>"," ",$Maincatname);


$breakdowntext=array();
$breakdownid=array();

//echo (int)$Orghighcat;

$ccnt=0;
$checkcapsQ = $con->query("SELECT cap_id from questions where cat_id = ".(int)$Maincatid."");
while($value = $checkcapsQ->fetch_array())
{
	if(in_array($value["cap_id"],$breakdownid))
	{
	}
	else
	{
		$ccnt++;
		//echo "<br>".$value["cap_id"];
		$breakdownid[$ccnt]=$value["cap_id"];
	}
}

foreach($breakdownid as $key=>$value)
{
	$checkcapsQ = $con->query("SELECT * from capabilities where cap_id = ".(int)$value."");
	$checkcapsR = $checkcapsQ->fetch_array();
	
	if($checkcapsR!="")
	{
		$breakdowntext[$key]=$checkcapsR["cap_name"];
	}
}

?>
<div class="graph_colum">
	<div class="graph_colTitle">
		<span><?php echo substr($Maincattitle,0,1);?></span><?php echo substr($Maincattitle,1);?>
	</div>
	<ul class="graph_line_list">
								<?php
								
								$currentquestion=0;
			foreach($breakdowntext as $bkey=>$bvalue)
			{
				
				//echo $PopOrgcapratings[(int)$breakdownid[$bkey]]."<br>";
			
				$value=(int)$PopOrgcaps[(int)$breakdownid[$bkey]];
				
				if($PopOrgcapsq[(int)$breakdownid[$bkey]] > 0)
				{
					$OrgcapratingC=$value/$PopOrgcapsq[(int)$breakdownid[$bkey]];
					
					//$OrgcapratingC=$PopOrgcapratings[(int)$breakdownid[$bkey]]/$Population;
				}
				else
				{
					$OrgcapratingC=0;
				}
				
				//echo $value."<br>";
				//
				$value=(int)$Orgcaps[(int)$breakdownid[$bkey]];
				
				if($Orgcapsq[(int)$breakdownid[$bkey]] > 0)
				{
					//$capratingC=$value/$Orgcapsq[(int)$breakdownid[$bkey]];
					
					$capratingC=$Orgcapratings[(int)$breakdownid[$bkey]];
				}
				else
				{
					$capratingC=0;
				}
				
				
				$orgscore=$OrgcapratingC;
				$yourscore=$capratingC;
				
				$yourscore/=5;
				$yourscore*=100;
				
				$orgscore/=5;
				$orgscore*=100;
				
				//echo $capratingC; die();
				
				//end check
				//$Gap=($OrgcapratingC-);
				//$Gap=($capratingC-$OrgcapratingC);
				$Gap=(number_format($OrgcapratingC,1)-number_format($capratingC,1));
				//new
				$Gap=(number_format($capratingC,1)-number_format($OrgcapratingC,1));
				$Gap=number_format($Gap,1);
				?>
									<li>
										<?php
										if($Gap >=2 && (int)$_POST["hh"]==0)
										{
										?>
										<div class="line_title colGG">
										<?php
										}
										else if($Gap <=-2 && (int)$_POST["hg"]==0)
										{
										?>
										<div class="line_title colRR">
										<?php
										}
										else
										{
										?>
										<div class="line_title">
										<?php
										}
										?>
											<?php echo $bvalue;?>
										</div>
										<div class="graph_lines">
											<span class="border_line border_line_1"></span>
											<span class="border_line border_line_2"></span>
											<span class="border_line border_line_3"></span>
											<span class="border_line border_line_4"></span>
											<span class="border_line border_line_5"></span>
											<div class="greenLine" style="width: <?php echo (int)$orgscore;?>%"><img src="<?php echo $SITEURL;?>assets/img/green.png" alt="green"></div>
											<div class="blueLine" style="width: <?php echo (int)$yourscore;?>%"><img src="<?php echo $SITEURL;?>assets/img/blue.png"></div>
											
										</div>
										<?php 
										
										if($Gap >=2 && (int)$_POST["hh"]==0)
											{
											?>
											<span class="GreenFlag" style="display:none">
											<img class="flag" src="<?php echo $SITEURL;?>asset/report_images/green-flag.png" >
											</span>
											<?php
											}
											else if($Gap <=-2 && (int)$_POST["hg"]==0)
											{
											?>
											<span class="RedFlag" style="display:none">
											<img class="flag" src="<?php echo $SITEURL;?>asset/report_images/red-flag.png" >
											</span>
											<?php
											}
											else
											{
											
											}
										?>
									</li>
									<?php
									}
									?>
								</ul>
</div> <!-- /.graph_colum -->
<?php
}
?>								