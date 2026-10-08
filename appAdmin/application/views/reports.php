<?php
$requeststring="";
$backtopage="orders";
if(isset($_REQUEST))
{
	foreach($_REQUEST as $key=>$value)
	{
		if($key=="orderid")
		{
			$requeststring.="?back";
		}
		else if($key=="refid")
		{
			$backtopage="referralreport";
		}
		else
		{
			$requeststring.="&".$key."=".$value;
		}
		
	}
}
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Reports for Order ID <?php echo $_REQUEST["orderid"];?></h4></div>
<?php
$con->where('order_id', (int)$_REQUEST["orderid"]);
$GETRec=$con->get('orders');
$row=$GETRec->row_array();
if($row!="")
{
	$user_id=(int)$row["user_id"];
	//print_r($row);
	include($_SERVER["DOCUMENT_ROOT"]."/application/views/CheckCompletion.php");
	?>
	<ul style="list-style:none;">
	<?php
	$reportdisplayed=0;
	if($Completed_2 >= 100)
	{
		$reportdisplayed=1;
	?>
	<li><a href="javascript:openpdfreport(<?php echo $row['order_id'];?>,1)".>Orginsights PDF </a></li>
	
	<?php
	}
	if($isComplete360==1)
	{
		$reportdisplayed=1;
	?>
	<li><a href="javascript:open360report(<?php echo $row['order_id'];?>,3)">360 Assessment</a></li>
	<?php
	}
	?>
	</ul>
	<?php
	if($reportdisplayed==0)
	{
	?>
	<center>
	No Complete Assessment Found For this Order

	</center>
	<?php
	}
}
?>
<center>
<br><br>
<a href="<?php echo SITEURL;?>/index.php/<?php echo $backtopage;?>/<?php echo $requeststring;?>">Back to List</a>
</center>
</div>
<?php
include("includes/showpagination.php");
?>
</div>
<script>
function openpdfreport(n1,n2)
{
	
		window.open("<?php echo ORGURL;?>/orgreports/"+n1+"/1");
	
}
function open360report(n1,n2)
{
	
		window.open("<?php echo ORGURL;?>/reports360/"+n1+"/1");
	
}
</script>
<?php
include("includes/footer.php");
?>