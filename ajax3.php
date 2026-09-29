<?php
include("connection.php"); 


include("FR_calc.php");



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
								<img class="topscore-circle" src="<?php echo $SITEURL;?>asset/report_images/circle.png">
								<div style="position:absolute;top:40px;color:#ffffff;font-weight:bold;font-size:30px;" class="score1style">
									<?php 
										//echo number_format(($PopOrghighest/$Population),1);
										//Added by Shahid - Feb 4/21
										echo number_format(($PopOrghighest),1);	
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
								<img class="topscore-circle" src="<?php echo $SITEURL;?>asset/report_images/circle-red.png">
								<div style="position:absolute;top:40px;color:#ffffff;font-weight:bold;font-size:30px;" class="score2style">
									<?php echo number_format(($PopOrglowest),1);?></div>
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
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $checkpop;?></td>
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
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $checkpop;?></td>
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
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $checkpop;?></td>
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
									<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $checkpop;?></td>
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
								$checkreponsesQ = $con->query("SELECT * from capabilities where cap_id = ".(int)$PophighcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->fetch_array();

								$ratingtext=$checkreponsesR["cap_name"];
								
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo $SITEURL;?>asset/report_images/alliances.png">
					 
									<div style="position:absolute;top:22px;color:#000000;font-weight:bold;font-size:24px;" class="score3style">
										<?php //echo number_format(($Pophighcap[$i]/$Population),1);?>
										<?php 
											//added by Shahid - Feb 4/21
											echo number_format(($Pophighcap[$i]),1);
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
								$checkreponsesQ = $con->query("SELECT * from capabilities where cap_id = ".(int)$PoplowcapID[$i]."");
								$checkreponsesR = $checkreponsesQ->fetch_array();

								$ratingtext=$checkreponsesR["cap_name"];
							?>
							<div class="col-md-4">
								<div class="threereport-cercle">
									<div style="position:relative">
									<img class="topscore-circle" src="<?php echo $SITEURL;?>asset/report_images/alliances-red.png">
									<div style="position:absolute;top:22px;color:#000000;font-weight:bold;font-size:24px;" class="score4style">
										<?php echo number_format(($Poplowcap[$i]),1);?></div>
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
						echo number_format(($PopOrgcatratings[$value]),1);
					}
					else
					{
						echo "0.0";
					}
					?></h4>
					<hr style="width: 50%;">
					<p style="margin:0; ">Your score</p>
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
				</div>
				
			
		<?php
		}
		?>
			
			</div>
		</div>
	</section>
