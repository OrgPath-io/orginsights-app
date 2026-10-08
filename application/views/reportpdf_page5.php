<table>
<tr>
<td class="topscore-main">
	<table>
	<tr>
	<td>
		<div class="topscore-box">
			<h2>TOP SCORING CATEGORY</h2>
			<p>Top scoring category means Orginsights rated you highest<br>in this category.</p>
			<table>
			<tr>
			<td style="background:#737373;border:7px solid #20a449;border-radius:50px;padding:20px;">
			<div style="color:#ffffff;font-weight:bold;font-size:30px;" class="score1style"><?php echo number_format($Orghighest,1);?></div>
			</td>
			<td style="padding-left:30px;">
				<div style="background:#e4eff4;" class="topscore-text1">
				<b><?php echo $OrghighcatName;?>:</b> <?php echo $desctext[(int)$Orghighcat];?>
				</div>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<div class="scoretextbox">
			<?php echo $levelstext[(int)$Orghighcat][1];?>
			</div>
			</td>
			</tr>
			</table>
		</div>
		
	</td>
	<!---->
	<td>
		<div class="topscore-box">
			<h2>LOWEST SCORING CATEGORY</h2>
			<p>Lowest scoring category means <?php //the individuals you invited to respond,?>Orginsights rated you lowest in this category.</p>
			<table>
			<tr>
			<td style="background:#737373;border:7px solid #870608;border-radius:50px;padding:20px;">
			<div style="color:#ffffff;font-weight:bold;font-size:30px;" class="score1style"><?php echo number_format($Orglowest,1);?></div>
			</td>
			<td style="padding-left:30px;">
				<div style="background:#e4eff4;" class="topscore-text1">
				<b><?php echo $OrglowcatName;?>:</b> <?php echo $desctext[(int)$Orglowcat];?>
				</div>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<div class="scoretextbox">
			<?php echo $levelstext[(int)$Orglowcat][2];?>
			</div>
			</td>
			</tr>
			</table>
		</div>
	</td>
	</tr>
	
	<tr>
	<td>
	<div class="topscore-box">
	<h2>HIDDEN TALENT / STRENGTH / UNRECOGNIZED STRENGTH</h2>
	<p>Top Rated category means <?php //the individuals invited?>Orginsights rated you higher on the category than you did yourself. This is an area where most people are stronger in than they think.</p>
		<table>
				<tr>
				<td colspan="6">ORGINSIGHTS SCORE</td>
				</tr>
				<tr>
				<?php
				for($i=1;$i<=6;$i++)
				{
					if($i<=(int)($Orghidden)+1)
					{
					?>
					<td style="background:#20a449;width:20px;line-height:15px;border:solid 1px #20a449;">.</td>
					<?php
					}
					else
					{
					?>
					<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #c6c6c6;">.</td>
					<?php
					}									
				}
				?>
				<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $Orghidden;?></td>
				</tr>
				<tr>
				<?php
				//
				for($i=1;$i<=6;$i++)
				{
					if($i<=(int)($Yourhidden)+1)
					{
					?>
					<td style="background:#3aa1e3;width:20px;line-height:15px;border:solid 1px #3aa1e3;">.</td>
					<?php
					}
					else
					{
					?>
					<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #c6c6c6;">.</td>
					<?php
					}
				}
				?>
				<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $Yourhidden;?></td>
				</tr>
				<tr>
				<td colspan="6">YOUR SCORE</td>
				</tr>
				</table>
				<table>
				<tr>
				<td style="padding-left:30px;">
					<div style="background:#e4eff4;" class="topscore-text1">
					<b><?php echo $catlistsname[(int)$value-1];?>:</b> <?php echo $desctext[(int)$value];?>
					</div>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<div class="scoretextbox">
				<?php echo $levelstext[(int)$value][3];?>
				</div>
				</td>
				</tr>
				</table>
						
	</div>
	</td>
	<td>
	<div class="topscore-box">
	<h2 style="line-height:50px;">BLIND SPOT</h2>
	<p style="margin-bottom:40px;">This means <?php //the individuals invited?>Orginsights rated you lower on the category than you did yourself. This is an area where people are weaker in than you think.</p>
		<table>
				<tr>
				<td colspan="6">ORGINSIGHTS SCORE</td>
				</tr>
				<tr>
				<?php
				for($i=1;$i<=6;$i++)
				{
					if($i<=(int)($Orgblind)+1)
					{
					?>
					<td style="background:#a60205;width:20px;line-height:15px;border:solid 1px #a60205;">.</td>
					<?php
					}
					else
					{
					?>
					<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #c6c6c6;">.</td>
					<?php
					}
				
				}
				?>
				<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $Orgblind;?></td>
				</tr>
				<tr>
				<?php
				//
				for($i=1;$i<=6;$i++)
				{
					if($i<=(int)($Yourblind)+1)
					{
					?>
					<td style="background:#3aa1e3;width:20px;line-height:15px;border:solid 1px #3aa1e3;">.</td>
					<?php
					}
					else
					{
					?>
					<td style="background:#c6c6c6;width:20px;line-height:15px;border:solid 1px #c6c6c6;">.</td>
					<?php
					}
				}
				?>
				<td style="background:#ffffff;width:20px;line-height:15px;border:solid 1px #cccccc;"><?php echo $Yourblind;?></td>
				</tr>
				<tr>
				<td colspan="6">YOUR SCORE</td>
				</tr>
				</table>
				<table>
				<tr>
				<td style="padding-left:30px;">
					<div style="background:#e4eff4;" class="topscore-text1">
					<b><?php echo $yourhighcatNameR;?>:</b> <?php echo $desctext[(int)$yourhighcatR];?>
					</div>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<div class="scoretextbox">
				<?php echo $levelstext[(int)$yourhighcatR][4];?>
				</div>
				</td>
				</tr>
				</table>
	</div>
	</td>
	
	</tr>
	
	<tr>
	<td>
	<div class="three-capbilities">
	<b>TOP THREE CAPABILITIES</b>
	<br>These are capabilities that had the highest scores based on your assessment
		<table>
		<tr>
			<?php
			//rsort($Totalratings);
			for($i=0;$i<=2;$i++)
			{
				$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$highcapID[$i]."");
				$checkreponsesR = $checkreponsesQ->result_array();

				$ratingtext=$checkreponsesR[0]["cap_name"];
				
			?>
			<td style="border:1px solid #20a449;">
			<?php echo number_format($highcap[$i],1);?>
			<br><?php echo $ratingtext;?></td>
			
			<?php
			}
			?>
		</tr>	
		</table>
		
	</div>
	</td>
	<td>
	<div class="three-capbilities">
	<b>BOTTOM THREE CAPABILITIES</b>
	<br>These are capabilities that had the lowest score based on the OrgInsights Assessment
		<table>
		<tr>
			<?php
			//rsort($Totalratings);
			for($i=0;$i<=2;$i++)
			{
				$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$lowcapID[$i]."");
				$checkreponsesR = $checkreponsesQ->result_array();

				$ratingtext=$checkreponsesR[0]["cap_name"];
				
			?>
			<td style="border:1px solid #20a449;">
			<?php echo number_format($lowcap[$i],1);?>
			<br><?php echo $ratingtext;?></td>
			
			<?php
			}
			?>
		</tr>	
		</table>
		
	</div>
	</td>
	</tr>	
	</table><br>
<table>
<tr>
<?php
foreach($catlists as $key=>$value)
{
?>
<td>
<?php echo strtoupper($catlistsname[$key]);?>
<br>
<b>Orginsight Score</b>
<br>
<?php 
if(isset($Orgcatratings[$value]))
{
echo number_format($Orgcatratings[$value],1);
}
else
{
	echo "0.0";
}
?>
<br>
<b>Your score</b>
<br>
<?php 
if(isset($catratings[$value]))
{
echo number_format($catratings[$value],1);
}
else
{
	echo "0.0";
}
?>
</td>
<?php
}
?>
</tr>
</table>	
	
</td>
</tr>
</table>