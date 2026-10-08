<?php
$user_id=(int)$this->session->userdata('user_id');

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
$checkreponsesQ = $this->db->query("SELECT * from ConditionalComments_Report order by CategoryID");
$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
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
	
	$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id=".$i."");
	$checkreponsesR = $checkreponsesQ->result_array();
	foreach($checkreponsesR as $key=>$value)
	{
		$desctext[$i]=$value["cat_description"];
		

	}
	
}
//


//end

$checkinvitedQ = $this->db->query("SELECT count(*) as PeopleInvited from invited_users where invited_by = ".$user_id." and order_id=".$order_id." order by id desc");
$checkinvitedR = $checkinvitedQ->result_array();

$PeopleInvited = $checkinvitedR[0]["PeopleInvited"];

//
$checkcompletedQ = $this->db->query("SELECT count(*) as PeopleCompleted from orders where user_id = ".$user_id." and order_status = 'Completed' and order_id=".$order_id." order by order_id desc");
$checkcompletedR = $checkcompletedQ->result_array();

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
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cat_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$cats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cat_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$catsq[(int)$value["cat_id"]]=$value["cnt"];
}

//self capabilities
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$caps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$capsq[(int)$value["cap_id"]]=$value["cnt"];
}

//
//professional categories
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Orgcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$Orgcatsq[(int)$value["cat_id"]]=$value["cnt"];
}

//professional capabilities
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Orgcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$Orgcapsq[(int)$value["cap_id"]]=$value["cnt"];
}




//view
/*
$checkreponsesQ = $this->db->query("SELECT * FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id);


$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Score=(int)$value["oa_val"];
	
	$scoretype=0;
	
	if($value["q_type"]=='professional' && $value["question_typeID"]!=3 && $value["question_typeID"]!=5)
	{
		$scoretype=1;
	}

	
		
		if($scoretype==1)
		{
			if(!isset($Orgcaps[(int)$value["cap_id"]]))
			{
				$Orgcaps[(int)$value["cap_id"]]=0;
				$Orgcapsq[(int)$value["cap_id"]]=0;
			}
			if(!isset($Orgcats[(int)$value["cat_id"]]))
			{
				
				$Orgcats[(int)$value["cat_id"]]=0;
				$Orgcatsq[(int)$value["cat_id"]]=0;
			}
			
			$Orgcaps[(int)$value["cap_id"]]+=(int)$Score;
			$Orgcapsq[(int)$value["cap_id"]]++;
			
			$Orgcats[(int)$value["cat_id"]]+=(int)$Score;
			$Orgcatsq[(int)$value["cat_id"]]++;
			
		}
		else
		{
			if(!isset($caps[(int)$value["cap_id"]]))
			{
				$caps[(int)$value["cap_id"]]=0;
				$capsq[(int)$value["cap_id"]]=0;
			}
			if(!isset($cats[(int)$value["cat_id"]]))
			{
				$cats[(int)$value["cat_id"]]=0;
				$catsq[(int)$value["cat_id"]]=0;
			}
			$caps[(int)$value["cap_id"]]+=(int)$Score;
			$capsq[(int)$value["cap_id"]]++;
			
			$cats[(int)$value["cat_id"]]+=(int)$Score;
			$catsq[(int)$value["cat_id"]]++;
		}
	
}
*/


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
	
	
	$checkcapsQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$key);
	$checkcapsR = $checkcapsQ->result_array();
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
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$yourlowcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$yourlowcatName=$checkreponsesR[0]["cat_name"];
}
//
if((int)$yourhighcat==0)
{
	$yourhighcatName="Not Assigned";
}
else
{
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$yourhighcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$yourhighcatName=$checkreponsesR[0]["cat_name"];
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
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$Orglowcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$OrglowcatName=$checkreponsesR[0]["cat_name"];
}
//
if((int)$Orghighcat==0)
{
	$OrghighcatName="Not Assigned";
}
else
{
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$Orghighcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$OrghighcatName=$checkreponsesR[0]["cat_name"];
}



?>
<section>
		<div class="text-banner textbanner-padding">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-7">		
						<div class="bannertitle">
							HIGH LEVEL<br>
							SUMMARY OF ASSESS
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-5">	
						<?php /*/ ?>
						<div class="scorebordmainbanner">
							<div class="bannerscorebord-box">
							<span><?php echo $PeopleInvited;?></span>
								PEOPLE INVITED
							</div>
							<div class="bannerscorebord-box bggreenbox">
								<span><?php echo $PeopleCompleted;?></span>
								PEOPLE COMPLETED
							</div>
						</div>
						<?php */ ?>
					</div>
				</div>
			</div>
		</div>
		<?php //include("filters.php");?>
	</section>
<section class="topscore-main">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<h2>TOP SCORING CATEGORY</h2>
						<p>Top scoring category means <?php //the individuals you invited to respond,?>Orginsights rated you highest<br>in this category.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								<div style="position:relative">
								<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/circle.png">
								<div style="position:absolute;top:40px;color:#ffffff;font-weight:bold;font-size:30px;" class="score1style">
									<?php 
										//echo number_format(($PopOrghighest/$Population),1);
										//Added by Shahid - Feb 4/21
										echo calcperc(number_format(($PopOrghighest),1));	
									?>
								</div>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $PopOrghighcatName;?>:</b> <?php echo $desctext[(int)$PopOrghighcat];?>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $levelstext[(int)$PopOrghighcat][1];?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<h2>LOWEST SCORING CATEGORY</h2>
						<p>Lowest scoring category means <?php //the individuals you invited to respond,?>Orginsights rated you lowest in this category.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								
								<div style="position:relative">
								<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/circle-red.png">
								<div style="position:absolute;top:40px;color:#ffffff;font-weight:bold;font-size:30px;" class="score2style">
									<?php echo calcperc(number_format(($PopOrglowest),1));?></div>
								</div>
								
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $PopOrglowcatName;?>:</b> <?php echo $desctext[(int)$PopOrglowcat];?>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $levelstext[(int)$PopOrglowcat][2];?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<div class="equalheight">
							<h2>HIDDEN TALENT / STRENGTH / UNRECOGNIZED STRENGTH</h2>
							<p>Top Rated category means <?php //the individuals invited?>Orginsights rated you higher on the category than you did yourself. This is an area where most people are stronger in than they think.</p>
							<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4 score-chart">
							<?php
							$hiddenspot=0;
							$hiddenspotG=-9999999;
							$catlists=array(1,2,3,4,5);
							$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
							foreach($catlists as $key=>$value)
							{
								
								if(number_format($PopOrgcatratings[$value],1)-number_format($Popcatratings[$value],1) > $hiddenspotG)
								{
									$hiddenspot=$value;
									$hiddenspotG=number_format($PopOrgcatratings[$value],1)-number_format($Popcatratings[$value],1);
								}
							}
							$value=(int)$hiddenspot;
							
							
							
							if(isset($PopOrgcatratings[$value]))
							{
								$Orghidden=number_format($PopOrgcatratings[$value],1);
							}
							else
							{
								$Orghidden="0.0";
							}
							//
							if(isset($Popcatratings[$value]))
							{
								$Yourhidden=number_format($Popcatratings[$value],1);
							}
							else
							{
								$Yourhidden="0.0";
							}
							?>
									<table>
									<tr>
									<td colspan="6"><h5>ORGINSIGHTS SCORE</h5></td>
									</tr>
									<tr>
									<?php
									for($i=1;$i<=6;$i++)
									{
										//$checkpop=($PopOrglowest/$Population);
										//Added by Shahid - Feb 4/21
										$checkpop=($Orghidden);

										if($i<=(int)($checkpop)+1)
										{
										?>
										<td style="background:#20a449;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
										else
										{
										?>
										<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}									
									}
									?>
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo calcperc($checkpop);?></td>
									</tr>
									<tr>
									<?php
									//
									for($i=1;$i<=6;$i++)
									{
										//$checkpop=($Popyourlowest/$Population);
										//added by Shahid - Feb 4/21
										$checkpop=($Yourhidden);

										if($i<=(int)($checkpop)+1)
										{
										?>
										<td style="background:#3aa1e3;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
										else
										{
										?>
										<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
									}
									?>
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo calcperc($checkpop);?></td>
									</tr>
									<tr>
									<td colspan="6"><h5>Population Self Score</h5></td>
									</tr>
									</table>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $catlistsname[(int)$value-1];?>:</b> <?php echo $desctext[(int)$value];?>
								</div>
							</div>
						</div>
						</div>
						<div style="position: absolute; bottom: 0;left:0;margin-top:50px;margin-bottom:40px" class="scoretextbox">
							<?php echo $levelstext[(int)$value][3];?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box ">
						<div class="equalheight">
						<h2 style="line-height:50px;">BLIND SPOT</h2>
						<p style="margin-bottom:40px;">This means <?php //the individuals invited?>Orginsights rated you lower on the category than you did yourself. This is an area where people are weaker in than you think.</p>
						<div class="row ">
						<?php
						$blindspot=0;
						$blindspotG=9999999;
						$catlists=array(1,2,3,4,5);
						$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
						foreach($catlists as $key=>$value)
						{
							if(number_format($PopOrgcatratings[$value],1)-number_format($Popcatratings[$value],1) < $blindspotG)
							{
								$blindspot=$value;
								$blindspotG=number_format($PopOrgcatratings[$value],1)-number_format($Popcatratings[$value],1);
							}
						}
						
						$OrghighestR=$PopOrgcatratings[$blindspot];
						$yourhighestR=$Popcatratings[$blindspot];
						$yourhighcatR=$blindspot;
						$yourhighcatNameR=$catlistsname[$blindspot-1];
						?>
						<?php
						$value=(int)$blindspot;
						
						if(isset($PopOrgcatratings[$value]))
						{
							$Orgblind=number_format($PopOrgcatratings[$value],1);
						}
						else
						{
							$Orgblind="0.0";
						}
						//
						if(isset($Popcatratings[$value]))
						{
							$Yourblind=number_format($Popcatratings[$value],1);
						}
						else
						{
							$Yourblind="0.0";
						}
						?>
								<div class="col-12 col-sm-12 col-md-12 col-lg-4 score-chart">
									<table>
									<tr>
									<td colspan="6"><h5>ORGINSIGHTS SCORE</h5></td>
									</tr>
									<tr>
									<?php
									for($i=1;$i<=6;$i++)
									{
										//$checkpop=($OrghighestR/$Population);
										//Added by Shahid - Feb 4/21
										$checkpop=($Orgblind);
										if($i<=(int)($checkpop)+1)
										{
										?>
										<td style="background:#a60205;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
										else
										{
										?>
										<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
									
									}
									?>
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo calcperc($checkpop);?></td>
									</tr>
									<tr>
									<?php
									//
									for($i=1;$i<=6;$i++)
									{
										$checkpop=($Yourblind);
									
										if($i<=(int)($checkpop)+1)
										{
										?>
										<td style="background:#3aa1e3;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
										else
										{
										?>
										<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
									}
									?>
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo calcperc($checkpop);?></td>
									</tr>
									<tr>
									<td colspan="6"><h5>Population Self Score</h5></td>
									</tr>
									</table>
									
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-8">
									<div class="topscore-text">
										<b><?php echo $yourhighcatNameR;?>:</b> <?php echo $desctext[(int)$yourhighcatR];?>

									</div>
								</div>
							</div>
						</div>
						<div style="position: absolute; bottom: 0;left:0;margin:50px;" class="scoretextbox">
						<?php echo $levelstext[(int)$yourhighcatR][4];?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<section>
		<div class="container">
			<div class="row no-gutters">
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="three-capbilities">
						<h2>TOP THREE CAPABILITIES</h2>
						<p>These are capabilities that had the highest scores based on <?php //individuals you invited to respond.?>your assessment</p>
						<div class="row">
							<?php
							//rsort($Totalratings);
							for($i=0;$i<=2;$i++)
							{
								$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$PophighcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->result_array();

								$ratingtext=$checkreponsesR[0]["cap_name"];
								
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances.png">
					 
									<div style="position:absolute;top:22px;color:#000000;font-weight:bold;font-size:20px;" class="score3style">
										<?php //echo number_format(($Pophighcap[$i]/$Population),1);?>
										<?php 
											//added by Shahid - Feb 4/21
											echo calcperc(number_format(($Pophighcap[$i]),1));
										?>
									</div>
									
								</div>
									<h6><?php echo $ratingtext;?></h6>
								</div>
							</div>
							<?php
							}
							?>
							
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 border-rightcustom">
					<div class="three-capbilities">
						<h2>BOTTOM THREE CAPABILITIES</h2>
						<p>These are capabilities that had the lowest score based on the OrgInsights Assessment</p>
						<div class="row">
							<?php
							//sort($ratings);
							for($i=0;$i<=2;$i++)
							{
								$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$PoplowcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->result_array();

								$ratingtext=$checkreponsesR[0]["cap_name"];
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances-red.png">
									<div style="position:absolute;top:22px;color:#000000;font-weight:bold;font-size:20px;" class="score4style">
										<?php echo calcperc(number_format(($Poplowcap[$i]),1));?></div>
									</div>
									<h6><?php echo $ratingtext;?></h6>
								</div>
							</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>	

<section class="respondant-score-man">
		<div class="container">
			<div class="score-boxmain">
			
		<?php
		$catlists=array(1,2,3,4,5);
		$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
		foreach($catlists as $key=>$value)
		{
			
		
		?>
		
				<div class="score-boxex">
					<h2><?php echo strtoupper($catlistsname[$key]);?></h2>
					<?php //<h3>Invited Respondant score</h3>?>
					<h3>Orginsight Score</h3>
					<h4><?php 
					if(isset($PopOrgcatratings[$value]))
					{
						//echo number_format(($PopOrgcatratings[$value]/$Population),1);
						//added by Shahid - Feb 4/21	
						echo calcperc(number_format(($PopOrgcatratings[$value]),1));
					}
					else
					{
						echo "0%";
					}
					?></h4>
					<hr style="width: 50%;">
					<p style="margin:0; ">Your score</p>
					<h4><?php 
					if(isset($Orgcatratings[$value]))
					{
					echo calcperc(number_format($Orgcatratings[$value],1));
					}
					else
					{
						echo "0%";
					}
					?></h4>
				</div>
				
			
		<?php
		}
		?>
			
			</div>
		</div>
	</section>
