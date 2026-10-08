<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Assessments</h4></div>
<?php

$nsortby="u.user_id desc";
if(isset($_REQUEST["sort"]) && $_REQUEST["sort"]!="")
{
		$nsortby=$_REQUEST["sort"];
}
?>
<div class="table-list">
<table id="dataTable1" class="table">
<thead>
<tr>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="u.email asc"){echo 'u.email desc';}else{echo 'u.email asc';}?>')">Email</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="u.first_name asc"){echo 'u.first_name desc';}else{echo 'u.first_name asc';}?>')">First Name</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="u.last_name asc"){echo 'u.last_name desc';}else{echo 'u.last_name asc';}?>')">Last Name</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="u.created_date asc"){echo 'u.created_date desc';}else{echo 'u.created_date asc';}?>')">Date joined</a></th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php

if(isset($_POST["searchtext"]) && $_POST["searchtext"]!="")
{
	$whereq=" where (u.email='".$_POST["searchtext"]."') or (u.first_name='".$_POST["searchtext"]."') or (u.last_name='".$_POST["searchtext"]."')";
}

$sql="select u.user_id,u.first_name,u.last_name,u.email,u.created_date FROM users u inner join orders o on u.user_id=o.user_id ".$whereq." group by u.user_id order by ".$nsortby;
include("includes/calcpagination2.php");
$querystring="&sort=".$nsortby;
$GETRec=$con->query($sql);
foreach ($GETRec->result_array() as $row)
{
	$ID=$row["user_id"];
	
	$FNAME=$row["first_name"];
	$LNAME=$row["last_name"];
	$EMAIL=$row["email"];
	
	
	
	if(isset($row['created_date']) && $row['created_date']!="")
	{
		$Splitdate=explode(" ",$row['created_date']);
		$Splitdate2=explode("-",$Splitdate[0]);
		
		$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
		
		$Corderdate=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
	}
	else
	{
		$Corderdate="";
	}
	
	
	//

?>
<tr>
<td><?php echo $EMAIL;?></td>
<td><?php echo $FNAME;?></td>
<td><?php echo $LNAME;?></td>
<td><?php echo $Corderdate;?></td>
<td>
<button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/orders/?id=<?php echo $ID;?>'"><i class="fas fa-search"></i></button>
</td>
</tr>
<?php
}
?>
<tbody>
</tbody>
</table>


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
	
		window.open("<?php echo ORGURL;?>/report360/"+n1+"/1");
	
}
</script>
<?php
include("includes/footer.php");
?>