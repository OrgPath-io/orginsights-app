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

$checkreponsesQ = $this->db->query("SELECT * from orders_assessment_type_responses where user_id = ".$user_id." and oa_id > 0 and order_id=".$order_id." order by order_id desc,q_id");
$checkreponsesR = $checkreponsesQ->result_array();

$Reportorderid=(int)$checkreponsesR[0]["order_id"];

foreach($checkreponsesR as $key=>$value)
{
	if((int)$value["order_id"]==$Reportorderid)
	{
	$oaid=(int)$value["oa_id"];
	
	$checkorg = $this->db->query("SELECT * from orders_assessment_type where oat_id = ".(int)$value["oat_id"]."");
	$checkorgR = $checkorg->result_array();
	
	$scoretype=0;
	
	if($checkorgR[0]["assessment_type"]=='OrgInsights Assessment')
	{
		$scoretype=1;
	}

	$checkreponsesQ2 = $this->db->query("SELECT * from questions where q_id = ".$value["q_id"]." order by q_id");
	$checkreponsesR2 = $checkreponsesQ2->result_array();
	
	foreach($checkreponsesR2 as $key2=>$value2)
	{
	
		
		$checkreponsesQ3 = $this->db->query("SELECT * from questions_optional_answer_bridge where q_id = ".$value2["q_id"]." order by id");
		$checkreponsesR3 = $checkreponsesQ3->result_array();
		
		$answer=0;
		$Score=0;
		foreach($checkreponsesR3 as $key3=>$value3)
		{
			//echo $oaid."<br>";
		
			if($value3["oa_id"]==$oaid)
			{
				$Score=$answer;
				//echo $Score."<br>";
			}
			$answer++;
		}
		
		
		if($scoretype==1)
		{
			if(!isset($Orgcaps[(int)$value2["cap_id"]]))
			{
				$Orgcaps[(int)$value2["cap_id"]]=0;
				$Orgcapsq[(int)$value2["cap_id"]]=0;
			}
			if(!isset($Orgcats[(int)$value2["cat_id"]]))
			{
				
				$Orgcats[(int)$value2["cat_id"]]=0;
				$Orgcatsq[(int)$value2["cat_id"]]=0;
			}
			
			$Orgcaps[(int)$value2["cap_id"]]+=(int)$Score;
			$Orgcapsq[(int)$value2["cap_id"]]++;
			
			$Orgcats[(int)$value2["cat_id"]]+=(int)$Score;
			$Orgcatsq[(int)$value2["cat_id"]]++;
			
		}
		else
		{
			if(!isset($caps[(int)$value2["cap_id"]]))
			{
				$caps[(int)$value2["cap_id"]]=0;
				$capsq[(int)$value2["cap_id"]]=0;
			}
			if(!isset($cats[(int)$value2["cat_id"]]))
			{
				$cats[(int)$value2["cat_id"]]=0;
				$catsq[(int)$value2["cat_id"]]=0;
			}
			$caps[(int)$value2["cap_id"]]+=(int)$Score;
			$capsq[(int)$value2["cap_id"]]++;
			
			$cats[(int)$value2["cat_id"]]+=(int)$Score;
			$catsq[(int)$value2["cat_id"]]++;
		}
		//echo (int)$value["oa_id"]."<br>";
	}	
	}
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
	if($catsq[$key] > 0)
	{
		$capratings[$key]=$value/$catsq[$key];
	}
	else
	{
		$capratings[$key]=0;
	}
}
foreach($Orgcaps as $key=>$value)
{
	if($Orgcatsq[$key] > 0)
	{
		$Orgcapratings[$key]=$value/$Orgcatsq[$key];
	}
	else
	{
		$Orgcapratings[$key]=0;
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
						<p>Top scoring category means <?php //the individuals you invited to respond,?>Orginsights rated you highest in this category.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								<div style="position:relative">
								<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/circle.png">
								<div style="position:absolute;top:40px;color:#ffffff;font-weight:bold;font-size:30px;" class="score1style"><?php echo number_format($Orghighest,1);?></div>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $OrghighcatName;?>:</b> <?php echo $desctext[(int)$Orghighcat];?>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $levelstext[(int)$Orghighcat][1];?>
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
								<div style="position:absolute;top:40px;left:35%;color:#ffffff;font-weight:bold;font-size:30px;"><?php echo number_format($Orglowest,1);?></div>
								</div>
								
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $OrglowcatName;?>:</b> <?php echo $desctext[(int)$Orglowcat];?>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $levelstext[(int)$Orglowcat][2];?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<div class="equalheight">
							<h2>HIDDEN TALENT / STRENGTH / UNRECOGNIZED STRENGTH</h2>
							<p>Top Rated category means <?php //the individuals invited?>Orginsights rated you higher on the category than you did yourself. This is an area where most people are stronger in than they think.</p>
							<div class="row ">
								<div class="col-12 col-sm-12 col-md-12 col-lg-4 score-chart">
									<table>
									<tr>
									<td colspan="6"><h5>ORGINSIGHTS SCORE</h5></td>
									</tr>
									<tr>
									<?php
									for($i=1;$i<=6;$i++)
									{
										if($i<=(int)$Orghighest)
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
									</tr>
									<tr>
									<?php
									//
									for($i=1;$i<=6;$i++)
									{
										if($i<=(int)$yourhighest)
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
									</tr>
									<tr>
									<td colspan="6"><h5>YOUR SCORE</h5></td>
									</tr>
									</table>
									
								</div>
								<div class="col-12 col-sm-12 col-md-12 col-lg-8">
									<div class="topscore-text">
										<b><?php echo $yourhighcatName;?>:</b> <?php echo $desctext[(int)$yourhighcat];?>

									</div>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $levelstext[(int)$yourhighcat][3];?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box ">
						<div class="equalheight">
						<h2>BLIND SPOT</h2>
						<p>This means <?php //the individuals invited?>Orginsights rated you lower on the category than you did yourself. This is an area where people are weaker in than you think.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4 score-chart">
									
									<table>
									<tr>
									<td colspan="6"><h5>ORGINSIGHTS SCORE</h5></td>
									</tr>
									<tr>
									<?php
									for($i=1;$i<=6;$i++)
									{
										if($i<=(int)$Orglowest)
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
										}									}
									?>
									</tr>
									<tr>
									<?php
									//
									for($i=1;$i<=6;$i++)
									{
										if($i<=(int)$yourlowest)
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
									</tr>
									<tr>
									<td colspan="6"><h5>YOUR SCORE</h5></td>
									</tr>
									</table>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $yourlowcatName;?>:</b> <?php echo $desctext[(int)$yourlowcat];?>
								</div>
							</div>
						</div>
						</div>
						<div class="scoretextbox">
							<?php echo $levelstext[(int)$yourlowcat][4];?>
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
								
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances.png">
									<div style="position:absolute;top:22px;left:38%;color:#000000;font-weight:bold;font-size:24px;"><?php echo number_format($highcap[$i],1);?></div>
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
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances-red.png">
									<div style="position:absolute;top:22px;left:38%;color:#000000;font-weight:bold;font-size:24px;"><?php echo number_format($lowcap[$i],1);?></div>
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
					echo number_format($Orgcatratings[$value],1);
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
					echo number_format($catratings[$value],1);
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
