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
//1
$levelstext[1][1]="You have an innate awareness of potential risks that could be political, social, or economical in nature existing in the operating ecosystem, and you are proactive in identifying process and procedures to mitigate negative impacts in order to attain goals and objectives. Continue to leverage this capability as it will propel you towards future success.";

$levelstext[1][2]="An area that you can start improving to gain immediate results is in becoming more aware of potential risks that could be political, social, or economical in nature. This includes anticipating those risks ahead of time. It is also important to develop your ability to identify process and procedures to mitigate negative impacts in order to attain goals and objectives.";

$levelstext[1][3]="You may have overlooked this capability which is one of your top strengths so far. You have an innate awareness of potential risks that could be political, social, or economical in nature existing in the operating ecosystem, and you are proactive in identifying process and procedures to mitigate negative impacts in order to attain goals and objectives.";

$levelstext[1][4]="You may not have an innate awareness of potential risks that could be political, social, or economical in nature existing in the operating ecosystem. This is an area that you can start developing by first understanding different types of risks, and then begin developing your ability to identify process and procedures to mitigate negative impacts in order to attain goals and objectives.";

//2
$levelstext[2][1]="Your strength lies in being able to anticipate and respond to changes with swift, focused, and future-oriented actions; You are able to thrive on chaos, navigate changes with tact and political savviness thus allowing you to achieve desired results ";

$levelstext[2][2]="You may prefer to keep changes to a minimum and may rarely need to do things differently than how they have been done before. However, with the everchanging business landscape that we operate in, it is important to accept some degree of uncertainty and seek fresh challenges that will in term help you learn to embrace change.";

$levelstext[2][3]="Being able to anticipate and respond to changes with swift, focused, and future-oriented actions may be a strength that you have overlooked in the past.
You are able to thrive on chaos, navigate changes with tact and political savviness thus allowing you to achieve desired results ";

$levelstext[2][4]="An area for growth lies in your ability to anticipate and respond to changes with swift, focused, and future-oriented actions; First step is becoming aware of this blind stop and then act to develop a plan that will help you accept some degree of uncertainty and seek fresh challenges that will in term help you learn to embrace change";


//3
$levelstext[3][1]="One of your top strengths is the ability to take ownership of projects and goals and drive towards concrete results, this includes actively developing future talents, making financially sound judgements and driving team performance and increasing productivity.";

$levelstext[3][2]="An area that you can improve on is taking more ownership of projects and goals and drive towards concrete results, this includes actively developing future talents, making financially sound judgements and driving team performance and increasing productivity. Start developing this capability by taking full responsibility of everything under your influence, continuously seek to develop self-growth and invests in the development of others as well.";

$levelstext[3][3]="You may not be aware of this aspect of your strengths, however, your ability to take ownership of projects and goals and drive towards concrete results has enabled your success thus far, this includes actively developing future talents, making financially sound judgements and driving team performance and increase productivity. ";

$levelstext[3][4]="An area for growth lies in ability to take ownership of projects and goals and drive towards concrete results, this includes actively developing future talents, making financially sound judgements and driving team performance and increase productivity. Becoming aware is first step then, start developing this capability by taking full responsibility of everything under your influence, continuously seek to develop self-growth and invests in the development of others as well. ";

//4
$levelstext[4][1]="You focus on building positive working relationships with customers and identifying opportunities to create partnerships; you find it easy to influence others by displaying empathy, knowing what motivates them, and finding common grounds ";

$levelstext[4][2]="Building and maintaining positive customer relationships may not have been an area that you prioritized in the past. Start developing this capability by creating alliances, influence others by knowing what motivates them. It's also important to demonstrate empathy while resolving conflicts and focusing on the customer. That is how great relationships are built.";

$levelstext[4][3]="Because this is something that comes very natural to you, you may not be aware of your strengths in building positive working relationships with customers and identifies opportunities to create partnerships; you find it easy to influence others by displaying empathy, knowing what motivates them, and finding common grounds. ";

$levelstext[4][4]="An area of development lies in your ability to build and maintain positive working relationships with customers. First step is becoming aware of this blind spot and then act to develop a plan to create alliances, influence others by knowing what motivates them. It's also important to demonstrate empathy while resolving conflicts and focusing on the customer. That is how great relationships are built. ";



//5
$levelstext[5][1]="Your propensity to create a common purpose, articulate a compelling vision and inspire alignment to make a positive difference is a strength that will aid in your ongoing success in your career. Keep leveraging this capability to propel you towards future successes.";

$levelstext[5][2]="Creating a shared sense of common purpose may not be something that comes natural to you. Act to develop a plan that will help you articulate a clear and compelling vision of the future with more ease and be inclusive of diverse perspectives when decisions are being made. This is one of the fastest ways to ensure buy-in and results. ";

$levelstext[5][3]="You may not be aware of this aspect of your strengths, however, your propensity to create a common purpose and articulate a compelling vision to inspire alignment to make a positive difference is a strength that will aid in your ongoing success in your career.";

$levelstext[5][4]="Creating a shared sense of purpose may not be something that comes natural to you. First step is becoming aware of this blind stop and then act to develop a plan that will help you articulate a clear and compelling vision of the future with more ease and be inclusive of diverse perspectives when decisions are being made. This is one of the fastest ways to ensure buy-in and results";



//end

$checkinvitedQ = $this->db->query("SELECT count(*) as PeopleInvited from invited_users where invited_by = ".$user_id." order by id desc");
$checkinvitedR = $checkinvitedQ->result_array();

$PeopleInvited = $checkinvitedR[0]["PeopleInvited"];

//
$checkcompletedQ = $this->db->query("SELECT count(*) as PeopleCompleted from orders where user_id = ".$user_id." and order_status = 'Completed' order by order_id desc");
$checkcompletedR = $checkcompletedQ->result_array();

$PeopleCompleted = $checkcompletedR[0]["PeopleCompleted"];


//
$cats=array();
$catsq=array();

$Orgcats=array();
$Orgcatsq=array();

$caps=array();
$Orgcaps=array();

$checkreponsesQ = $this->db->query("SELECT * from orders_assessment_type_responses where user_id = ".$user_id." and oa_id > 0 order by order_id desc");
$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
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
			if(!isset($Orgcats[(int)$value2["cat_id"]]))
			{
				
				$Orgcats[(int)$value2["cat_id"]]=0;
				$Orgcatsq[(int)$value2["cat_id"]]=0;
			}
			
			
			$Orgcats[(int)$value2["cat_id"]]+=(int)$Score;
			$Orgcatsq[(int)$value2["cat_id"]]++;
		}
		else
		{
			if(!isset($cats[(int)$value2["cat_id"]]))
			{
				$cats[(int)$value2["cat_id"]]=0;
				$catsq[(int)$value2["cat_id"]]=0;
			}
			
			$cats[(int)$value2["cat_id"]]+=(int)$Score;
			$catsq[(int)$value2["cat_id"]]++;
		}
		//echo (int)$value["oa_id"]."<br>";
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
	$yourlowcatName="Initial";
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
	$yourhighcatName="Initial";
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
	$OrglowcatName="Initial";
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
	$OrghighcatName="Initial";
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
						<p>Top scoring category means the individuals you invited to respond, rated you highest in this category.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								<div style="position:relative">
								<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/circle.png">
								<div style="position:absolute;top:40px;left:32%;color:#ffffff;font-weight:bold;font-size:30px;"><?php echo number_format($Orghighest,1);?></div>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $OrghighcatName;?>:</b> <?php echo $levelstext[(int)$Orghighcat][1];?>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $OrghighcatName;?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<h2>LOWEST SCORING CATEGORY</h2>
						<p>Lowest scoring category means the individuals you invited to respond, rated you lowest in this category.</p>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-4">
								
								<div style="position:relative">
								<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/circle-red.png">
								<div style="position:absolute;top:40px;left:35%;color:#ffffff;font-weight:bold;font-size:30px;"><?php echo number_format($Orglowest,1);?></div>
								</div>
								
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-8">
								<div class="topscore-text">
									<b><?php echo $OrglowcatName;?>:</b> <?php echo $levelstext[(int)$Orglowcat][2];?>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $OrglowcatName;?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box">
						<div class="equalheight">
							<h2>HIDDEN TALENT / STRENGTH / UNRECOGNIZED STRENGTH</h2>
							<p>Top Rated category means the individuals invited rated you higher on the category than you did yourself. This is an area where most people are stronger in than they think.</p>
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
										<b><?php echo $yourhighcatName;?>:</b> <?php echo $levelstext[(int)$yourhighcat][3];?>

									</div>
								</div>
							</div>
						</div>
						<div class="scoretextbox">
							<?php echo $yourhighcatName;?>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box ">
						<div class="equalheight">
						<h2>BLIND SPOT</h2>
						<p>This means the individuals invited rated you lower on the category than you did yourself. This is an area where people are weaker in than you think.</p>
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
									<b><?php echo $yourlowcatName;?>:</b> <?php echo $levelstext[(int)$yourlowcat][4];?>
								</div>
							</div>
						</div>
						</div>
						<div class="scoretextbox">
							<?php echo $yourlowcatName;?>
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
						<p>These are capabilities that had the highest scores based on individuals you invited to respond.</p>
						<div class="row">
							<?php
							
							rsort($Totalratings);
							for($i=0;$i<=2;$i++)
							{
							
								$ratingtext="Test";
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances.png">
									<div style="position:absolute;top:22px;left:38%;color:#000000;font-weight:bold;font-size:24px;"><?php echo number_format($Totalratings[$i],1);?></div>
									</div>
									<h6><?php echo $yourhightexts[$i];?></h6>
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
							$yourlowtexts=array("Manages<br>Risk","Takes Financial<br>Accountability","Establishes <br>Governance");
							sort($ratings);
							for($i=0;$i<=2;$i++)
							{
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/alliances-red.png">
									<div style="position:absolute;top:22px;left:38%;color:#000000;font-weight:bold;font-size:24px;"><?php echo number_format($ratings[$i],1);?></div>
									</div>
									<h6><?php echo $yourlowtexts[$i];?></h6>
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
		$catlistsname=array("Limits Risk","Embraces Agility","Achieves Excellence","Develops Relationships","Sets Purpose");
		foreach($catlists as $key=>$value)
		{
			
		
		?>
		
				<div class="score-boxex">
					<h2><?php echo strtoupper($catlistsname[$key]);?></h2>
					<h3>Invited Respondant score</h3>
					<h4>4.0</h4>
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