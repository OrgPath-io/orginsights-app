<table>
<tr>
<td class="text-banner">
<h1 style="font-weight:normal;color:#ffffff;"><?php //echo strtoupper($HighcatName);?> DETAILED BREAKDOWN</h1>	
<p>The next section includes your ratings for the categories. Each question includes the results of your Self Assessment score compared to the <?php /*average scores of the individuals you invited to respond*/?> Orginsights Score as well as the negative or positive gap in scores</p>
</td>
</tr>
</table>
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
	<table>
	<tr>
	<td style="background:#737373;border:7px solid #20a449;border-radius:50px;padding:20px;">
	<div style="color:#ffffff;font-weight:bold;font-size:30px;" class="score1style"><?php echo number_format($Orgcatratings[$Maincatid],1);?></div>
	</td>
	<td style="padding-left:30px;">
		<div style="background:#e4eff4;" class="topscore-text1">
		<b><?php echo strtoupper($Maincatname);?></b>
		<br>
		<?php echo $desctext[(int)$Maincatid];?>
		</div>
	</td>
	<td>
	Pay attention to flags
	<br>
	<img src="<?php echo base_url();?>asset/report_images/green-flag.png"><b>Hidden Talent:</b> You have rated yourself lower than your respondents rated you.
	<br>
	<img src="<?php echo base_url();?>asset/report_images/red-flag.png"><b>Blind Spot:</b> You have rated yourself higher than your respondents rated you.<br><b>Action:</b> Identify actions you can take to improve in this area
	</td>
	</tr>
	<tr>
	<td>
	CATEGORY SCORE
	</td>
	</tr>
	</table>
<table>	
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
<tr>
<td><?php echo $bkey;?></td>
<td><?php echo $bvalue;?>
<br>
<table width="100%">
<tr>
<td colspan="6">ORGINSIGHTS SCORE</td>
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
	<td style="background:#c6c6c6;width:20px;line-height:30px;border:solid 1px #c6c6c6;">.</td>
	<?php
	}
	else
	{
	?>
	<td style="background:<?php echo $orgscorebg;?>;width:20px;line-height:30px;border:solid 1px #ffffff;">.</td>
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
	<td style="background:#3aa1e3;width:20px;line-height:30px;border:solid 1px #3aa1e3;">.</td>
	<?php
	}
	else
	{
	?>
	<td style="background:#c6c6c6;width:20px;line-height:30px;border:solid 1px #c6c6c6;">.</td>
	<?php
	}
}
?>
<td align="center" style="background:#ffffff;width:20px;line-height:30px;border:solid 1px #cccccc;"><?php echo number_format($capratingC,1);?></td>
</tr>
<tr>
<td colspan="6">YOUR SCORE</td>
</tr>
</table>
</td>
<td>
<?php $Gap=($OrgcapratingC-$capratingC);
$Gap=number_format($Gap,1);
?>
<b>GAP</b><font style="font-size: 25px;"><?php echo $Gap;?></font>
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
?>
</td>
</tr>	
<?php
}
?>
</table>
<?php
}