<table>
<tr>
<td align="center" class="banner">
		<img src="<?php echo base_url();?>asset/report_images/banner-img.jpg">
</td>
</tr>

<tr>
<td class="hometext">
		
			<div class="heading">
				<h1><?php echo $Package;?></h1>
			</div>
</td>
</tr>			
			
<tr>
<td class="homegreensection1">
				<h1 style="font-weight:normal;"><?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?></h1>
</td>
</tr>

<tr>
<td style="padding-top:10px;" class="homebluesection1">
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
				<h1 style="font-weight:normal;">Date: <?php echo date("d",$order_dateT);?><sup><?php echo date("S",$order_dateT);?></sup> <?php echo date("F",$order_dateT);?> <?php echo date("Y",$order_dateT);?></h1>
</td>
</tr>

</table>