<?php
$Allow1=1;
$Allow2=0;
$Allow3=0;

if($result_oat[0]['order_package_id'] == 1)
{
	if((int)$progress_s==100)
	{
		$Allow1=0;
		$Allow3=1;
	}
	
}
else if($result_oat[0]['order_package_id'] == 2)
{
	if((int)$progress_s==100)
	{
		$Allow1=0;
		$Allow2=1;
	}
}
else if($result_oat[0]['order_package_id'] == 3)
{
	if((int)$progress_s==100)
	{
		$Allow1=0;
		$Allow2=1;
	}
	if((int)$progress_o==100)
	{
		$Allow2=0;
		$Allow3=1;
	}
}
?>
<ul class="tab-menu">
<?php
$link=base_url().'selfassessment/'.$result_oat[0]['order_id'];
$listyle='';

if($Allow1==0)
{
	$link="javascript:void(0)";
	//$listyle='style="background:#cccccc;"';
	
}
?>
<li <?php echo $listyle;?>>
<?php

if(isset($tabmenu1) && $tabmenu1==1)
{
?>
<a href="javascript:void(0)" class="active">
<?php
}
else
{
?>
<a href="<?php echo $link;?>">
<?php
}
?>
<img src="<?php echo base_url();?>asset/images/icon-1.png" alt="">Self Assessment</a>
	<div class="progress"> <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_s;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="Selfprogress"><?php echo $progress_s;?>%</div> </div>
</li>
<?php if($result_oat[0]['order_package_id'] == 2 || $result_oat[0]['order_package_id'] == 3){?>
<?php
$link=base_url().'selfassessment/professional/'.$result_oat[0]['order_id'];
$listyle='';

if($Allow2==0)
{
	$link="javascript:void(0)";
	//$listyle='style="background:#cccccc;"';
	
}
?>
<li <?php echo $listyle;?>>
<?php
if(isset($tabmenu2) && $tabmenu2==1)
{
?>
<a href="javascript:void(0)" class="active">
<?php
}
else
{
?>
<a href="<?php echo $link;?>">
<?php
}
?>
<img src="<?php echo base_url();?>asset/images/icon-2.png" alt="">OrgInsights Assessment</a>
	<div class="progress"> <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_o;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="Orgprogress"><?php echo $progress_o;?>%</div> </div>
</li>
<?php } ?>
<?php if($result_oat[0]['order_package_id'] == 1 || $result_oat[0]['order_package_id'] == 3){?>
<?php
$link=base_url().'selfassessment/thirdparty/'.$result_oat[0]['order_id'];
$listyle='';

if($Allow3==0)
{
	$link="javascript:void(0)";
	//$listyle='style="background:#cccccc;"';
	
}
?>
<li <?php echo $listyle;?>>
<?php
if(isset($tabmenu3) && $tabmenu3==1)
{
?>
<a href="javascript:void(0)" class="active">
<?php
}
else
{
?>
<a href="<?php echo $link;?>">
<?php
}
?>
<img src="<?php echo base_url();?>asset/images/icon-3.png" alt=""> 360 Assessment</a></li>
<?php } ?>
</ul>