<?php
include("connection.php"); 


include("FR_calc.php");



?>
>				
<section>
		<div class="text-banner">
			<div class="container">
				<h4><?php //echo strtoupper($HighcatName);?> DETAILED BREAKDOWN</h4>
				<p>The next section includes your ratings for the categories. Each question includes the results of your Self Assessment score compared to the <?php /*average scores of the individuals you invited to respond*/?> Orginsights Score as well as the negative or positive gap in scores</p>
			</div>
		</div>
		<?php //include("filters.php");?>
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
		$breakdowntext[$key]="<h2>".$checkcapsR["cap_name"]."</h2><p>".$checkcapsR["description"]."</p>";
	}
}

	

	
?>
	<section class="categoryscoremain">
		<div class="container">
			<div class="categoryscore">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-3 ">
					<?php
					/*
					echo number_format($Orgcatratings[$Maincatid],1);
					echo "<br>";
					echo $Population;
					echo "<br>";
					echo number_format(($PopOrgcatratings[$Maincatid]/$Population),1);
					//*/
					
					
					?>
						<div class="catagoryicon">
							<div style="position:relative">
								<img class="topscore-circle" src="<?php echo $SITEURL;?>asset/report_images/circle.png">
								<div style="position:absolute;top:42px;color:#ffffff;font-weight:bold;font-size:30px;" class="score5style">
									<?php echo number_format(($PopOrgcatratings[$Maincatid]),1);?></div>
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
									<img src="<?php echo $SITEURL;?>asset/report_images/green-flag.png">
								</div>
								<p><b>Hidden Talent:</b> You have rated yourself lower than your respondents rated you.</p>
								<p><b>Action:</b> Consider trying to build on this strength</p>
							</div>
							<div class="flagtext mb-0">
								<div class="flgicon">
									<img src="<?php echo $SITEURL;?>asset/report_images/red-flag.png">
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
									<td align="center" style="background:#ffffff;width:20px;line-height:30px;border:solid 1px #cccccc;"><?php echo number_format($OrgcapratingC,1);?></td>
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
									<td align="center" style="background:#ffffff;width:20px;line-height:30px;border:solid 1px #cccccc;"><?php echo number_format($capratingC,1);?></td>
									</tr>
									<tr>
									<td colspan="6"><h3>YOUR SCORE</h3></td>
									</tr>
									</table>
						</div>
					</div>
					<?php 
					//$Gap=($OrgcapratingC-);
					//$Gap=($capratingC-$OrgcapratingC);
					$Gap=(number_format($capratingC,1)-number_format($OrgcapratingC,1));
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
						<img class="scorerightflag" src="<?php echo $SITEURL;?>asset/report_images/green-flag.png" >
						<?php
						}
						else if($Gap <=-2)
						{
						?>
						<img class="scorerightflag" src="<?php echo $SITEURL;?>asset/report_images/red-flag.png" >
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