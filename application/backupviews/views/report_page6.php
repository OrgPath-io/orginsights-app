<?php
$user_id=(int)$this->session->userdata('user_id');
?>
				
<section>
		<div class="text-banner">
			<div class="container">
				<h1 style="font-weight:normal;color:#ffffff;"><?php //echo strtoupper($HighcatName);?> DETAILED BREAKDOWN</h1>
				<p>The next section includes your ratings for the categories. Each question includes the results of your Self Assessment score compared to the <?php /*average scores of the individuals you invited to respond*/?> Orginsights Score as well as the negative or positive gap in scores</p>
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
					<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
						<div class="catagoryicon">
							<div style="position:relative">
								<img class="topscore-circle" src="<?php echo base_url();?>asset/report_images/circle.png">
								<div style="position:absolute;top:42px;color:#ffffff;font-weight:bold;font-size:30px;" class="score5style"><?php echo number_format(($Orgcatratings[$Maincatid]*$multiplybyP),(int)$numberformat);?><?php echo $displaysign;?></div>
								</div>
							<h4>CATEGORY SCORE</h4>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-4">
						<div class="creatoingpurposetext">
							<h4><?php echo strtoupper($Maincatname);?></h4>
							<p><?php echo $desctext[(int)$Maincatid];?></p>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-5">
						<div class="flagsmain">
							<h4>Pay attention to flags</h4>
							<div class="flagtext">
								<div class="flgicon">
									<img src="<?php echo base_url();?>asset/report_images/green-flag.png">
								</div>
								<p><b>Hidden Talent:</b> You have rated yourself lower than your respondents rated you.</p>
								<p><b>Action:</b> Consider trying to build on this strength</p>
							</div>
							<div class="flagtext mb-0">
								<div class="flgicon">
									<img src="<?php echo base_url();?>asset/report_images/red-flag.png">
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
				
			
				$value=(int)$Orgcaps[(int)$breakdownid[$bkey]];
				
				if($Orgcapsq[(int)$breakdownid[$bkey]] > 0)
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
										if($i > (int)($OrgcapratingC)+1)
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
									<td align="center" style="background:#ffffff;width:20px;line-height:30px;border:solid 1px #cccccc;"><?php echo number_format(($OrgcapratingC*$multiplybyP),(int)$numberformat);?><?php echo $displaysign;?></td>
									</tr>
									<tr>
									<?php
									//
									for($i=1;$i<=6;$i++)
									{
										if($i<=(int)($capratingC)+1)
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
									<td align="center" style="background:#ffffff;width:20px;line-height:30px;border:solid 1px #cccccc;"><?php echo number_format(($capratingC*$multiplybyP),(int)$numberformat);?><?php echo $displaysign;?></td>
									</tr>
									<tr>
									<td colspan="6"><h3>YOUR SCORE</h3></td>
									</tr>
									</table>
						</div>
					</div>
					<?php $Gap=($OrgcapratingC-$capratingC);
					$Gap1=$Gap*$multiplybyP;
					$Gap2=number_format($Gap1,(int)$numberformat);
					?>
					<div class="col-12 col-sm-12 col-md-8 col-lg-3">
						<div class="gapmain"><b>GAP&nbsp;</b><font style="font-size: 25px;"><?php echo ($Gap2);?><?php echo $displaysign;?></font></div>
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