<?php
$user_id=(int)$this->session->userdata('user_id');

$breakdowntext=array();
$breakdownid=array();

$breakdownid[1]=13;
$breakdowntext[1]="<h2>INSPIRES OTHERS</h2>
				<p>Articulates a clear and compelling vision of the Articulates a clear and compelling vision of the future, inspiring others to align on the shared purpose, building confidence and followership through sincere intention of making a positive difference.</p>";

$breakdownid[2]=1;				
$breakdowntext[2]="<h2>COMMUNICATES CLARITY</h2>
				<p>Uses appropriate and well articulated communications to deliver clear messages to diverse groups, creating shared understanding and meaning.</p>";

$breakdownid[3]=16;				
$breakdowntext[3]="<h2>MOVES DATA TO ACTION</h2>
				<p>Applies knowledge acquired through market research, data analysis and other methods to develop cohesive stories which connect data points and provide clear calls to action.</p>";	

$breakdownid[4]=2;				
$breakdowntext[4]="<h2>INVITED RESPONDENTS SCORE</h2>
				<p>Consciously brings different experiences, backgrounds and perspectives to the ta- ble, confronting bias (personal and others) and addressing systemic barriers to inclusion and accessibility</p>";				
?>				
<section>
		<div class="text-banner">
			<div class="container">
				<h4><?php echo strtoupper($HighcatName);?> DETAILED BREAKDOWN</h4>
				<p>The next section includes your ratings for the <?php echo $OrghighcatName;?> category. Each question includes the results of your Self— Assess- ment score compared to the average scores of the individuals you invited to respond as well as the negative or positive gap in scores</p>
			</div>
		</div>
	</section>
	<section class="categoryscoremain">
		<div class="container">
			<div class="categoryscore">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
						<div class="catagoryicon">
							<div style="position:relative">
								<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/circle.png">
								<div style="position:absolute;top:42px;color:#737373;font-weight:bold;font-size:30px;" class="score5style"><?php echo number_format($Orghighest,1);?></div>
								</div>
							<h4>CATEGORY SCORE</h4>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-4">
						<div class="creatoingpurposetext">
							<h4><?php echo strtoupper($OrghighcatName);?></h4>
							<p><?php echo $levelstext[(int)$Orghighcat][1];?></p>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-5">
						<div class="flagsmain">
							<h4>Pay attention to flags</h4>
							<div class="flagtext">
								<div class="flgicon">
									<img src="<?php echo base_url();?>asset/report_images/red-flag.png">
								</div>
								<p><b>Hidden Talent:</b> You have rated yourself lower than your respondents rated you.</p>
								<p><b>Action:</b> Consider trying to build on this strength</p>
							</div>
							<div class="flagtext mb-0">
								<div class="flgicon">
									<img src="<?php echo base_url();?>asset/report_images/green-flag.png">
								</div>
								<p><b>Blind Spot:</b> You have rated yourself higher than your respondents rated you.</p>
								<p><b>Action:</b> Identify actions you can take to improve in this area</p>
							</div>
						</div>
					</div>
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
				$value=(int)$Orgcaps[(int)$breakdownid];
				
				if($capsq[(int)$breakdownid] > 0)
				{
					$OrgcapratingC=$value/$Orgcapsq[(int)$breakdownid];
				}
				else
				{
					$OrgcapratingC=0;
				}
				//
				$value=(int)$caps[(int)$breakdownid];
				
				if($capsq[(int)$breakdownid] > 0)
				{
					$capratingC=$value/$capsq[(int)$breakdownid];
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
									<td colspan="6"><h3>ORGINSIGHTS SCORE</h3></td>
									</tr>
									<tr>
									<?php
									$orgscore=$OrgcapratingC;
									if($orgscore > 2)
									{
										$orgscorebg="#20a449";
									}
									else
									{
										$orgscorebg="#a60205";
										
									}
									for($i=1;$i<=6;$i++)
									{
										if($i > $OrgcapratingC)
										{
										?>
										<td style="background:#c6c6c6;width:20px;line-height:30px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
										else
										{
										?>
										<td style="background:<?php echo $orgscorebg;?>;width:20px;line-height:30px;border:solid 1px #ffffff;">&nbsp;</td>
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
										if($i<=(int)$capratingC)
										{
										?>
										<td style="background:#3aa1e3;width:20px;line-height:30px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
										else
										{
										?>
										<td style="background:#c6c6c6;width:20px;line-height:30px;border:solid 1px #ffffff;">&nbsp;</td>
										<?php
										}
									}
									?>
									</tr>
									<tr>
									<td colspan="6"><h3>YOUR SCORE</h3></td>
									</tr>
									</table>
						</div>
					</div>
					<?php $Gap=(int)($capratingC-$OrgcapratingC);?>
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
