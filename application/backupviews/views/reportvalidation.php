<link href="<?php echo base_url();?>asset/reports_style.css" rel="stylesheet">
<?php
$Package="OrgInsights Assessment Validation";
?>
<section class="hometext">
		
			<div class="heading">
				<h1><?php echo $Package;?></h1>
			</div>
			
			<div style="padding:10px;" class="reportsection">
				<?php //<a class="reportmian">REPORT 2020</a>?>
			</div>
			
			<div class="homegreensection">
				<?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?>
			</div>
			<div class="homebluesection">
				<?php
				
				
				$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
				if("*".$order_date."*"=="**")
				{
					$order_dateT=$timestamp;
				}
				else
				{
				$Splitdate=explode(" ",$order_date);
				$Splitdate2=explode("-",$Splitdate[0]);
				$Splitdate3=explode(":",$Splitdate[1]);
				$order_dateT=mktime($Splitdate3[0], $Splitdate3[1],$Splitdate3[2], $Splitdate2[1], $Splitdate2[2], $Splitdate2[0]);
				}
				
				//calc hours
				$diff=$timestamp-$order_dateT;
				
				$hours=$diff/3600;
				
				$hours=(int)$hours;
				/*Date: <?php echo date("d");?><sup><?php echo date("S");?></sup> <?php echo date("F");?> <?php echo date("Y");?>*/
				?>
				Date: <?php echo date("d",$order_dateT);?><sup><?php echo date("S",$order_dateT);?></sup> <?php echo date("F",$order_dateT);?> <?php echo date("Y",$order_dateT);?>
			</div>
			<div class="homewhitesection">
				<?php /*Total Hours: <?php echo $hours;?> Hrs */?>
			</div>
			
	</section>
<?php
$user_id=(int)$this->session->userdata('user_id');

$Selftable="<table>
<tr>
<th>Question</th>
<th>Answer Selected</th>
<th>My Score</th>
</tr>";

$Orgtable="<table>
<tr>
<th>Question</th>
<th>Answer Selected</th>
<th>Orginsights Score</th>
</tr>";

$bg1="#ffffff";
$bg2="#abcdef";
$bg=$bg1;

$Orgquestions=0;
$Selfquestions=0;
$Organswers=0;
$Youranswers=0;


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

//$checkreponsesQ = $this->db->query("SELECT a.*,q.cat_id,q.cap_id,q.q_type,q.question_typeID from orders_assessment_type_responses a INNER JOIN questions q on a.q_id=q.q_id where a.user_id = ".$user_id." and a.oa_val > -99 and a.order_id=".$order_id." order by a.order_id desc,a.q_id");

/*/direct query
$checkreponsesQ = $this->db->query("select a.oatr_id AS oatr_id,a.oat_id AS oat_id,a.order_id AS order_id,a.user_id AS user_id,a.q_id AS q_id,a.oa_id AS oa_id,a.oa_val AS oa_val,a.created_date AS created_date,a.updated AS updated,q.cat_id AS cat_id,q.cap_id AS cap_id,q.q_type AS q_type,q.question AS question from (orders_assessment_type_responses a join questions q on((a.q_id = q.q_id))) where (a.user_id =".$user_id." and a.oa_val > -(99) and a.order_id =".$order_id.") order by a.order_id desc,a.q_id");

//*/
//view
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
	
		if($bg==$bg1)
		{
			$bg=$bg2;
		}
		else
		{
			$bg=$bg1;
		}
		
		$tdvalues="<tr style='background:".$bg.";'>";
		$tdvalues.="<td style='width:50%;font-size:12px;padding-right:10px;padding-left:10px;'><br>".$value["question"]."<br><br></td>";
		
		$checkreponsesQ3 = $this->db->query("SELECT * from questions_responses where q_id = ".$value["q_id"]." and Score=".$Score." order by id");
		$checkreponsesR3 = $checkreponsesQ3->result_array();
		
		
		
		$Answerselected="";
		foreach($checkreponsesR3 as $key3=>$value3)
		{
			$oaid=(int)$value3["oa_id"];
			
			$checkans = $this->db->query("SELECT * from responses where oa_id = ".(int)$oaid."");
			$checkansR = $checkans->result_array();
			
			$Answerselected=$checkansR[0]["answers"];
		
			if(strpos($Answerselected,"png") > 0)
			{
				$Answerselected1="<img src='".base_url()."asset/images/answers/".$Answerselected."'>";
				$Answerselected=$Answerselected1;
			}
		}
		$tdvalues.="<td style='width:30%;font-size:12px;padding-right:10px;'>".$Answerselected."</td>";
	
		$tdvalues.="<td style='padding-left:50px;'>".(int)$Score."</td>";
		
		$tdvalues.="</tr>";
	
		
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
			
			$Orgquestions++;
			$Organswers+=(int)$Score;
			
			$Orgtable.=$tdvalues;
			
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
			
			$Selfquestions++;
			$Youranswers+=(int)$Score;
			
			$Selftable.=$tdvalues;
		}
		
		
	
}

$Selftable.="</table>";
$Orgtable.="</table>";


echo "Self Assessment Questions<br><br>".$Selftable."</br><br>";

echo "Orginsights Assessment Questions<br><br>".$Orgtable."</br><br>";


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
	</section>
<section class="topscore-main">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div style="min-height: 250px;" class="topscore-box">
						<?php
						$OrgHighquest=$Orgcatsq[(int)$Orghighcat];
						$OrgHighscore=$Orgcats[(int)$Orghighcat];
						
						$OrgHighRatings=number_format(($OrgHighscore/$OrgHighquest),1);
						?>
						<h2>TOP SCORING CATEGORY</h2>
						<p><b><?php echo $OrghighcatName;?>:</b>
						<br><br>
						<?php echo "A) Questions in this category = <b>".$OrgHighquest."</b>";?>
						<br>
						<?php echo "B) Total Score Achieved in this category = <b>".$OrgHighscore."</b>";?>
						<br>
						<br>
						<?php
						echo "<b>Top scoring category Rating =</b> (B)/(A) = (".$OrgHighscore.")/(".$OrgHighquest.") = <font style='color:#20a449;font-size:20px;'><b>".$OrgHighRatings."</b></font>";
						?>
						</p>
						
						
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div style="min-height: 250px;" class="topscore-box">
						<?php
						$OrgLowquest=$Orgcatsq[(int)$Orglowcat];
						$OrgLowscore=$Orgcats[(int)$Orglowcat];
						
						$OrgLowRatings=number_format(($OrgLowscore/$OrgLowquest),1);
						?>
						<h2>LOWEST SCORING CATEGORY</h2>
						<p><b><?php echo $OrglowcatName;?>:</b>
						<br><br>
						<?php echo "A) Questions in this category = <b>".$OrgLowquest."</b>";?>
						<br>
						<?php echo "B) Total Score Achieved in this category = <b>".$OrgLowscore."</b>";?>
						<br>
						<br>
						<?php
						echo "<b>Low scoring category Rating =</b> (B)/(A) = (".$OrgLowscore.")/(".$OrgLowquest.") = <font style='color:#20a449;font-size:20px;'><b>".$OrgLowRatings."</b></font>";
						?>
						</p>
						
						
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<div class="equalheight">
							<h2>HIDDEN TALENT / STRENGTH / UNRECOGNIZED STRENGTH</h2>
							<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 score-chart">
							<p><b><?php echo $yourlowcatName;?>:</b>
							<?php
							$OrgLowquest=$Orgcatsq[(int)$Orglowcat];
							$OrgLowscore=$Orgcats[(int)$Orglowcat];
							
							$OrgLowRatings=number_format(($OrgLowscore/$OrgLowquest),1);
							?>
							
							<h5><b>ORGINSIGHTS SCORE</b></h5>
							<?php echo "A) Questions in this category = <b>".$OrgLowquest."</b>";?>
							<br>
							<?php echo "B) Total Score Achieved in this category = <b>".$OrgLowscore."</b>";?>
							<br>
							<br>
							<?php
							echo "<b>Orginsights Score =</b> (B)/(A) = (".$OrgLowscore.")/(".$OrgLowquest.") = <font style='color:#20a449;font-size:20px;'><b>".$OrgLowRatings."</b></font>";
							?>
							<br>
							<hr />
<?php
							$Lowquest=$catsq[(int)$yourlowcat];
							$Lowscore=$cats[(int)$yourlowcat];
							
							$LowRatings=number_format(($Lowscore/$Lowquest),1);
							?>
							
							<h5><b>YOUR SCORE</b></h5>
							<?php echo "A) Questions in this category = <b>".$Lowquest."</b>";?>
							<br>
							<?php echo "B) Total Score Achieved in this category = <b>".$Lowscore."</b>";?>
							<br>
							<br>
							<?php
							echo "<b>Your Score =</b> (B)/(A) = (".$Lowscore.")/(".$Lowquest.") = <font style='color:#20a449;font-size:20px;'><b>".$LowRatings."</b></font>";
							?>
							</p>
							
							
						
									
									
							</div>
							
						</div>
						</div>
						
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box ">
						<div class="equalheight">
						<h2 style="line-height:50px;">BLIND SPOT</h2>
						
						<div class="row ">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 score-chart">
							<p><b><?php echo $yourhighcatName;?>:</b>
							<?php
							$OrgHighquest=$Orgcatsq[(int)$Orghighcat];
							$OrgHighscore=$Orgcats[(int)$Orghighcat];
							
							$OrgHighRatings=number_format(($OrgHighscore/$OrgHighquest),1);
							?>
							
							<h5><b>ORGINSIGHTS SCORE</b></h5>
							<?php echo "A) Questions in this category = <b>".$OrgHighquest."</b>";?>
							<br>
							<?php echo "B) Total Score Achieved in this category = <b>".$OrgHighscore."</b>";?>
							<br>
							<br>
							<?php
							echo "<b>Orginsights Score =</b> (B)/(A) = (".$OrgHighscore.")/(".$OrgHighquest.") = <font style='color:#20a449;font-size:20px;'><b>".$OrgHighRatings."</b></font>";
							?>
							<br>
							<hr />
<?php
							$Highquest=$catsq[(int)$yourhighcat];
							$Highscore=$cats[(int)$yourhighcat];
							
							$HighRatings=number_format(($Highscore/$Highquest),1);
							?>
							
							<h5><b>YOUR SCORE</b></h5>
							<?php echo "A) Questions in this category = <b>".$Highquest."</b>";?>
							<br>
							<?php echo "B) Total Score Achieved in this category = <b>".$Highscore."</b>";?>
							<br>
							<br>
							<?php
							echo "<b>Your Score =</b> (B)/(A) = (".$Highscore.")/(".$Highquest.") = <font style='color:#20a449;font-size:20px;'><b>".$HighRatings."</b></font>";
							?>
							</p>
							
							
						
									
									
							</div>
							</div>
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
						
							<?php
							//rsort($Totalratings);
							for($i=0;$i<=2;$i++)
							{
								?>
								<div class="row1">
								<?php
								$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$highcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->result_array();

								$ratingtext=$checkreponsesR[0]["cap_name"];
								
								$OrgHighquest=$capsq[(int)$highcapID[$i]];
								$OrgHighscore=$caps[(int)$highcapID[$i]];
							
								$OrgHighRatings=number_format(($OrgHighscore/$OrgHighquest),1);
								
								echo "<br>";
								
								echo "<b>".($i+1).") ".$ratingtext."</b>";
								
								echo "<br>";
								
								echo "A) Questions in this capability = <b>".$OrgHighquest."</b>";
								
								echo "<br>";
								
								echo "B) Total Score Achieved in this capability = <b>".$OrgHighscore."</b>";
								
								echo "<br>";
								
								echo "<b>Score =</b> (B)/(A) = (".$OrgHighscore.")/(".$OrgHighquest.") = <font style='color:#20a449;font-size:20px;'><b>".$OrgHighRatings."</b></font>";
								
								?>
								</div>
								<?php
							
							}
							?>
							
						
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 border-rightcustom">
					<div class="three-capbilities">
						<h2>BOTTOM THREE CAPABILITIES</h2>
						
							<?php
							//sort($ratings);
							for($i=0;$i<=2;$i++)
							{
								?>
								<div class="row1">
								<?php
								$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$lowcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->result_array();

								$ratingtext=$checkreponsesR[0]["cap_name"];
							
								$OrgLowquest=$Orgcapsq[(int)$lowcapID[$i]];
								$OrgLowscore=$Orgcaps[(int)$lowcapID[$i]];
							
								$OrgLowRatings=number_format(($OrgLowscore/$OrgLowquest),1);
								
								echo "<br>";
								
								echo "<b>".($i+1).") ".$ratingtext."</b>";
								
								echo "<br>";
								
								echo "A) Questions in this capability = <b>".$OrgLowquest."</b>";
								
								echo "<br>";
								
								echo "B) Total Score Achieved in this capability = <b>".$OrgLowscore."</b>";
								
								echo "<br>";
								
								echo "<b>Score =</b> (B)/(A) = (".$OrgLowscore.")/(".$OrgLowquest.") = <font style='color:#20a449;font-size:20px;'><b>".$OrgLowRatings."</b></font>";
							
							?>
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
					<?php 
					$OrgHighquest=$Orgcatsq[(int)$value];
					$OrgHighscore=$Orgcats[(int)$value];
					
					$OrgHighRatings=number_format(($OrgHighscore/$OrgHighquest),1);
					
					echo "A) Questions = ".$OrgHighquest;
					echo "<br>";
					echo "B) Total Score = ".$OrgHighscore;
					echo "<br>";
					echo "(B)/(A) = (".$OrgHighscore.")/(".$OrgHighquest.")";
					?>
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
					<?php 
					$Highquest=$catsq[(int)$value];
					$Highscore=$cats[(int)$value];
					
					$HighRatings=number_format(($Highscore/$Highquest),1);
					
					echo "A) Questions = ".$Highquest;
					echo "<br>";
					echo "B) Total Score = ".$Highscore;
					echo "<br>";
					echo "(B)/(A) = (".$Highscore.")/(".$Highquest.")";
					?>
				</div>
				
			
		<?php
		}
		?>
			
			</div>
		</div>
	</section>
<section>
		<div class="text-banner">
			<div class="container">
				<h4><?php //echo strtoupper($HighcatName);?> DETAILED BREAKDOWN</h4>
				
			</div>
		</div>
</section>
<?php
foreach($catlists as $Ckey=>$Cvalue)
{

$Maincatid=$Cvalue;
$Maincatname=$catlistsname[$Ckey];
$Maincatname=str_replace("<br>"," ",$Maincatname);


$breakdowntext=array();
$breakdownid=array();

//echo (int)$Orghighcat;

$ccnt=0;
$checkcapsQ = $this->db->query("SELECT cap_id from questions where cat_id = ".(int)$Maincatid."");
$checkcapsR = $checkcapsQ->result_array();
foreach($checkcapsR as $key=>$value)
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
	$checkcapsQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$value."");
	$checkcapsR = $checkcapsQ->result_array();
	
	if($checkcapsR!="")
	{
		$breakdowntext[$key]="<h2>".$checkcapsR[0]["cap_name"]."</h2><p>".$checkcapsR[0]["description"]."</p>";
	}
}

				
?>
	<section class="categoryscoremain">
		<div class="container">
			<div class="categoryscore">
				<div class="row">
					
					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
					<h4><br>&nbsp;<?php echo strtoupper($Maincatname);?>
					<br><small>&nbsp;<b><?php echo number_format($Orgcatratings[$Maincatid],1);?></b> <-- Orginsights score</small><br><br></h4>
					</div>
					<br>
				</div>
			</div>
		</div>
	</section>
	<section class="scorebordreport">
		<div class="container">
<?php

//print_r($Orgcapsq);
			$currentquestion=0;
			foreach($breakdowntext as $bkey=>$bvalue)
			{
				$capidv=(int)$breakdownid[$bkey];
			
				$value=(int)$Orgcaps[(int)$breakdownid[$bkey]];
				
				if($capsq[(int)$breakdownid[$bkey]] > 0)
				{
					$OrgcapratingC=$value/$Orgcapsq[(int)$breakdownid[$bkey]];
				}
				else
				{
					$OrgcapratingC=0;
				}
				//
				$value=(int)$caps[(int)$breakdownid[$bkey]];
				
				if($capsq[(int)$breakdownid[$bkey]] > 0)
				{
					$capratingC=$value/$capsq[(int)$breakdownid[$bkey]];
				}
				else
				{
					$capratingC=0;
				}
				//end check
			?>
			<div class="scorebordbox">
				<div class="scordbordnumber">
					<?php echo $bkey;?>
				</div>
				<?php echo $bvalue;?>
				<div class="row d-flex align-items-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-7">
						<div class="scorecolorbord">
							<table width="100%">
									<tr>
									<td colspan="6"><h3>ORGINSIGHTS SCORE</h3>
									<?php 
									$OrgHighquest=$Orgcapsq[(int)$capidv];
									$OrgHighscore=$Orgcaps[(int)$capidv];
									
									$OrgHighRatings=number_format(($OrgHighscore/$OrgHighquest),1);
									
									echo "A) Questions = ".$OrgHighquest;
									echo "<br>";
									echo "B) Total Score = ".$OrgHighscore;
									echo "<br>";
									echo "Orginsights Score = (B)/(A) = (".$OrgHighscore.")/(".$OrgHighquest.") = ".number_format($OrgcapratingC,1);
									?>
									</td>
									</tr>
									
									<tr>
									
									<td align="center">
									<hr />
									</td>
									</tr>
									<tr>
									<td colspan="6"><h3>YOUR SCORE</h3>
									<?php 
									$Highquest=$capsq[(int)$capidv];
									$Highscore=$caps[(int)$capidv];
									
									$HighRatings=number_format(($Highscore/$Highquest),1);
									
									echo "A) Questions = ".$Highquest;
									echo "<br>";
									echo "B) Total Score = ".$Highscore;
									echo "<br>";
									echo "Your Score = (B)/(A) = (".$Highscore.")/(".$Highquest.") = ".number_format($capratingC,1);;
									?>
									</td>
									</tr>
									</table>
						</div>
					</div>
					<?php $Gap=($OrgcapratingC-$capratingC);
					$Gap=number_format($Gap,1);
					?>
					<div class="col-12 col-sm-12 col-md-8 col-lg-3">
						<div class="gapmain"><b>GAP&nbsp;</b><font style="font-size: 25px;"><?php echo $Gap;?></font></div>
					</div>
					<div class="col-12 col-sm-12 col-md-4 col-lg-2">
						<?php
						if($Gap >=2)
						{
						?>
						<img class="scorerightflag" src="<?php echo base_url();?>asset/report_images/green-flag.png" >
						<?php
						}
						else if($Gap <=-2)
						{
						?>
						<img class="scorerightflag" src="<?php echo base_url();?>asset/report_images/red-flag.png" >
						<?php
						}
						else
						{
						
						}
						?>
					</div>
				</div>
			</div>
			<?php
			}
			?>
			

		</div>
	</section>
<?php
}
?>