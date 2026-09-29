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
$completedIDS="0";
$PeopleInvited=0;
$PeopleCompleted=0;
$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by = ".$user_id." and order_id=".$order_id." and invite_sent=1 order by id desc");
$checkinvitedR = $checkinvitedQ->result_array();

foreach($checkinvitedR as $key=>$value)
{
	$PeopleInvited++;
	
	$checkcompletedQ = $this->db->query("SELECT * from orders_assessment_type_rater_responses where r_user_id = ".$value["id"]." and  order_id = ".$value["order_id"]." and oa_val = -99 order by order_id desc");
	$checkcompletedR = $checkcompletedQ->result_array();
	
	if($checkcompletedR[0]=="")
	{
		$PeopleCompleted++;
		
		$completedIDS.=",".$value["id"];
	}
	
}



//
$cats=array();
$catsq=array();

$Orgcats=array();
$Orgcatsq=array();

$caps=array();
$Orgcaps=array();
$capsq=array();
$Orgcapsq=array();

$RaterQAttempts=array();
$RaterQScore=array();

//$checkreponsesQ = $this->db->query("SELECT a.*,q.cat_id,q.cap_id,q.q_type,q.question_typeID from orders_assessment_type_responses a INNER JOIN questions q on a.q_id=q.q_id where a.user_id = ".$user_id." and a.oa_val > -99 and a.order_id=".$order_id." order by a.order_id desc,a.q_id");

/*/direct query
$checkreponsesQ = $this->db->query("select a.oatr_id AS oatr_id,a.oat_id AS oat_id,a.order_id AS order_id,a.user_id AS user_id,a.q_id AS q_id,a.oa_id AS oa_id,a.oa_val AS oa_val,a.created_date AS created_date,a.updated AS updated,q.cat_id AS cat_id,q.cap_id AS cap_id,q.q_type AS q_type from (orders_assessment_type_responses a join questions q on((a.q_id = q.q_id))) where (a.user_id =".$user_id." and a.oa_val > -(99) and a.order_id =".$order_id.") order by a.order_id desc,a.q_id");
//*/

//view
$checkreponsesQ = $this->db->query("SELECT * FROM `View_Self_Responses` where user_id =".$user_id." and order_id =".$order_id);




$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Score=(int)$value["oa_val"];
	
	$scoretype=0;
	
	if($value["q_type"]=='professional' && $value["question_typeID"]!=3 && $value["question_typeID"]!=5)
	{
		$scoretype=1;
	}

	
		
		if($scoretype==0)
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

//360
	/*/direct query
	$checkreponsesQ = $this->db->query("select a.oatrr_id AS oatrr_id,a.oat_id AS oat_id,a.order_id AS order_id,a.r_user_id AS user_id,a.q_id AS q_id,a.oa_id AS oa_id,a.oa_val AS oa_val,a.created_date AS created_date,a.udpated AS updated,q.cat_id AS cat_id,q.cap_id AS cap_id,q.q_type AS q_type,q.question AS question,q.general_instruction AS general_instruction from (orders_assessment_type_rater_responses a join questions q on((a.q_id = q.q_id))) where (a.oa_val > -(99) and a.order_id =".$order_id.") order by a.order_id desc,a.q_id");
	//*/

//view
$checkreponsesQ = $this->db->query("SELECT * FROM `View_User_Responses_360` where order_id =".$order_id." and r_user_id IN (".$completedIDS.")");	
	

	$checkreponsesR = $checkreponsesQ->result_array();

	foreach($checkreponsesR as $key=>$value)
	{
		
		$Score=(int)$value["oa_val"];
		
		
		if($Score > (-1))
		{
				if(!isset($RaterQAttempts[(int)$value["q_id"]]))
				{
					$RaterQAttempts[(int)$value["q_id"]]=0;
					$RaterQScore[(int)$value["q_id"]]=0;
				}
				
				$RaterQScore[(int)$value["q_id"]]+=(int)$Score;
				$RaterQAttempts[(int)$value["q_id"]]++;
		}		
		
	}
	
	//
	foreach($RaterQAttempts as $Qkey=>$Qvalue)
	{
		
		$Score=$RaterQScore[$Qkey];
		
		if($Qvalue > 0)
		{
			$Score/=$Qvalue;
		}
		
		$checkcapsQ = $this->db->query("SELECT * from questions where q_id = ".(int)$Qkey);
		$checkcapsR = $checkcapsQ->result_array();
		foreach($checkcapsR as $key=>$value)
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
			
			$Orgcaps[(int)$value["cap_id"]]+=$Score;
			$Orgcapsq[(int)$value["cap_id"]]++;
			
			$Orgcats[(int)$value["cat_id"]]+=$Score;
			$Orgcatsq[(int)$value["cat_id"]]++;
		
			
		}
		
		
	}
	//
//end 360



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
foreach($OrgTotalratings as $key=>$value)
{
	if($value > $highest1)
	{
		$highest1=$value;
		$highest1ID=$OrgTotalratingsID[$key];
	}

}



//
$highest2=0;
$highest1ID2=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$highest1ID)
	{
		if($value > $highest2)
		{
			$highest2=$value;
			$highest1ID2=$OrgTotalratingsID[$key];
		}
	}

}


//
$highest3=0;
$highest1ID3=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$highest1ID && $OrgTotalratingsID[$key]!=$highest1ID2)
	{
		if($value > $highest3)
		{
			$highest3=$value;
			$highest1ID3=$OrgTotalratingsID[$key];
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
					<div class="col-12 col-sm-12 col-md-12 col-lg-12">		
						<div class="bannertitle">
						<center>
							<h1 style="font-weight:normal;">High Level Summary</h1>
						</center>	
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-5">	
						<?php //*/ ?>
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
						<?php //*/ ?>
					</div>
				</div>
			</div>
		</div>
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
								<div>
								<img class="topscore-circle1" src="<?php echo base_url();?>assets/images/top-rating-flag-mountain.png">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text1">
									<?php echo $desctext[(int)$Orghighcat];?>
								</div>
							</div>
						</div>
						<p>&nbsp;</p>
						<div class="scoretextbox1">
							<table style="border:1px solid #cccccc;" cellspacing="0" cellpadding="0">
							<tr>
							<td style="background:#e0d09a;height:50px;color:#ffffff;font-size:20px;padding:10px;"><b><?php echo $OrghighcatName;?></b></td>
							</tr>
							<tr>
							<td style="background:#e6f1fa;padding:10px;height:200px;" valign="top">
							<?php echo $levelstext[(int)$Orghighcat][1];?>
							</td>
							</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<h2>LOWEST SCORING CATEGORY</h2>
						<p>Lowest scoring category means <?php //the individuals you invited to respond,?>Orginsights rated you lowest in this category.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								<div>
								<img class="topscore-circle1" src="<?php echo base_url();?>assets/images/lowest-rating-yield-sign.png">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text1">
									<?php echo $desctext[(int)$Orglowcat];?>
								</div>
							</div>
						</div>
						<p>&nbsp;</p>
						<div class="scoretextbox1">
							<table style="border:1px solid #cccccc;" cellspacing="0" cellpadding="0">
							<tr>
							<td style="background:#e0d09a;height:50px;color:#ffffff;font-size:20px;padding:10px;"><b><?php echo $OrglowcatName;?></b></td>
							</tr>
							<tr>
							<td style="background:#e6f1fa;padding:10px;height:200px;" valign="top">
							<?php echo $levelstext[(int)$Orglowcat][2];?>
							</td>
							</tr>
							</table>
						</div>
					</div>
				</div>
				<?php
				$hiddenspot=0;
				$hiddenspotG=-9999999;
				$catlists=array(1,2,3,4,5);
				$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
				foreach($catlists as $key=>$value)
				{
					
					if(number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1) > $hiddenspotG)
					{
						$hiddenspot=$value;
						$hiddenspotG=number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1);
					}
				}
				$value=(int)$hiddenspot;
				
				if(isset($Orgcatratings[$value]))
				{
					$Orghidden=number_format($Orgcatratings[$value],1);
				}
				else
				{
					$Orghidden="0.0";
				}
				//
				if(isset($catratings[$value]))
				{
					$Yourhidden=number_format($catratings[$value],1);
				}
				else
				{
					$Yourhidden="0.0";
				}
				?>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<h2>HIDDEN TALENT</h2>
						<p>This means Orginsights rated you higher on the category than you did yourself. This is an area where most people are stronger in than they think.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								<div>
								<img class="topscore-circle1" src="<?php echo base_url();?>assets/images/hidden-talent-flags.png">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text1">
									<?php echo $desctext[(int)$value];?>
								</div>
							</div>
						</div>
						<p>&nbsp;</p>
						<div class="scoretextbox1">
							<table style="border:1px solid #cccccc;" cellspacing="0" cellpadding="0">
							<tr>
							<td style="background:#e0d09a;height:50px;color:#ffffff;font-size:20px;padding:10px;"><b><?php echo str_replace("<br>"," ",$catlistsname[(int)$value-1]);?></b></td>
							</tr>
							<tr>
							<td style="background:#e6f1fa;padding:10px;height:200px;" valign="top">
							<?php echo $levelstext[(int)$value][3];?>
							</td>
							</tr>
							</table>
						</div>
					</div>
				</div>
				<?php
						$blindspot=0;
						$blindspotG=9999999;
						$catlists=array(1,2,3,4,5);
						$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
						foreach($catlists as $key=>$value)
						{
							if(number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1) < $blindspotG)
							{
								$blindspot=$value;
								$blindspotG=number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1);
							}
						}
						
						$OrghighestR=$Orgcatratings[$blindspot];
						$yourhighestR=$catratings[$blindspot];
						$yourhighcatR=$blindspot;
						$yourhighcatNameR=$catlistsname[$blindspot-1];
						?>
						<?php
						$value=(int)$blindspot;
						
						if(isset($Orgcatratings[$value]))
						{
							$Orgblind=number_format($Orgcatratings[$value],1);
						}
						else
						{
							$Orgblind="0.0";
						}
						//
						if(isset($catratings[$value]))
						{
							$Yourblind=number_format($catratings[$value],1);
						}
						else
						{
							$Yourblind="0.0";
						}
						?>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<h2>BLIND SPOT</h2>
						<p>This means Orginsights rated you lower on the category than you did yourself. This is an area where people are weaker in than you think.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								<div>
								<img class="topscore-circle1" src="<?php echo base_url();?>assets/images/Blind-Spot-talents-red-flags.png">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text1">
									<?php echo $desctext[(int)$value];?>
								</div>
							</div>
						</div>
						<p>&nbsp;</p>
						<div class="scoretextbox1">
							<table style="border:1px solid #cccccc;" cellspacing="0" cellpadding="0">
							<tr>
							<td style="background:#e0d09a;height:50px;color:#ffffff;font-size:20px;padding:10px;"><b><?php echo str_replace("<br>"," ",$yourhighcatNameR);?></b></td>
							</tr>
							<tr>
							<td style="background:#e6f1fa;padding:10px;height:200px;" valign="top">
							<?php echo $levelstext[(int)$yourhighcatR][4];?>
							</td>
							</tr>
							</table>
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
								$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$highcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->result_array();

								$ratingtext=$checkreponsesR[0]["cap_name"];
								
								
								
								if((int)$perccheck==1)
								{
									if(strlen(number_format(($highcap[$i]*$multiplybyP),(int)$numberformat)) > 2)
									{
										$fontsize="font-size:16px;";
									}
									else
									{
										$fontsize="font-size:20px;";
									}
								}
								else
								{
									$fontsize="font-size:24px;";
								}
								
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances.png">
									<div style="position:absolute;top:22px;color:#000000;font-weight:bold;<?php echo $fontsize;?>" class="score3style"><?php echo number_format(($highcap[$i]*$multiplybyP),(int)$numberformat);?><?php echo $displaysign;?></div>
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
								$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$lowcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->result_array();

								$ratingtext=$checkreponsesR[0]["cap_name"];
								
								
								
								if((int)$perccheck==1)
								{
									if(strlen(number_format(($lowcap[$i]*$multiplybyP),(int)$numberformat)) > 2)
									{
										$fontsize="font-size:16px;";
									}
									else
									{
										$fontsize="font-size:20px;";
									}
								}
								else
								{
									$fontsize="font-size:24px;";
								}
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances-red.png">
									<div style="position:absolute;top:22px;color:#000000;font-weight:bold;<?php echo $fontsize;?>" class="score4style"><?php echo number_format(($lowcap[$i]*$multiplybyP),(int)$numberformat);?><?php echo $displaysign;?></div>
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
					if(isset($Orgcatratings[$value]))
					{
					echo number_format(($Orgcatratings[$value]*$multiplybyP),(int)$numberformat); echo $displaysign;
					}
					else
					{
						echo "0.0";
					}
					?></h4>
					<hr style="width: 50%;">
					<p style="margin:0; ">Your score</p>
					<h4><?php 
					if(isset($catratings[$value]))
					{
					echo number_format(($catratings[$value]*$multiplybyP),(int)$numberformat); echo $displaysign;
					}
					else
					{
						echo "0.0";
					}
					?></h4>
				</div>
				
			
		<?php
		}
		?>
			
			</div>
		</div>
	</section>
