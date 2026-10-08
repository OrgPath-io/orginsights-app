<?php
$requeststring="";
if(isset($_REQUEST))
{
	foreach($_REQUEST as $key=>$value)
	{
		$requeststring.="&".$key."=".$value;
	}
}
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Orders</h4></div>
<?php

$nsortby="o.order_id desc";
if(isset($_REQUEST["sort"]) && $_REQUEST["sort"]!="")
{
		$nsortby=$_REQUEST["sort"];
}
?>
<div class="table-list">
<table id="dataTable1" class="table">
<thead>
<tr>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="o.order_id asc"){echo 'o.order_id desc';}else{echo 'o.order_id asc';}?>')">Order ID</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="u.email asc"){echo 'u.email desc';}else{echo 'u.email asc';}?>')">Email</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="u.first_name asc"){echo 'u.first_name desc';}else{echo 'u.first_name asc';}?>')">First Name</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="u.last_name asc"){echo 'u.last_name desc';}else{echo 'u.last_name asc';}?>')">Last Name</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="o.order_package_name asc"){echo 'o.order_package_name desc';}else{echo 'o.order_package_name asc';}?>')">Details</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="o.order_date asc"){echo 'o.order_date desc';}else{echo 'o.order_date asc';}?>')">Date started</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="r.updated asc"){echo 'r.updated desc';}else{echo 'r.updated asc';}?>')">Date Completed</a></th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php

$whereq="";

if(isset($_REQUEST["id"]) && (int)$_REQUEST["id"] > 0)
{
	$whereq=" where o.user_id=".(int)$_REQUEST["id"];
}

if(isset($_POST["searchtext"]) && $_POST["searchtext"]!="")
{
	$whereq=" where (o.order_id='".$_POST["searchtext"]."') or (u.email='".$_POST["searchtext"]."') or (u.first_name='".$_POST["searchtext"]."') or (u.last_name='".$_POST["searchtext"]."')";
}

$sql="select o.*,u.first_name,u.last_name,u.email,r.updated as DateCompleted FROM orders o inner join users u on o.user_id=u.user_id inner join orders_assessment_type_responses r on o.order_id=r.order_id ".$whereq." group by o.order_id order by ".$nsortby;
include("includes/calcpagination2.php");

$querystring="&sort=".$nsortby."&id=".(int)$_REQUEST["id"];

$GETRec=$con->query($sql);
foreach ($GETRec->result_array() as $row)
{
	$ID=$row["order_id"];
	$Details=$row["order_package_name"];
	$user_id=(int)$row["user_id"];
	
	$FNAME=$row["first_name"];
	$LNAME=$row["last_name"];
	$EMAIL=$row["email"];
	
	
	if(isset($row['order_date']) && $row['order_date']!="")
	{
		$Splitdate=explode(" ",$row['order_date']);
		$Splitdate2=explode("-",$Splitdate[0]);
		
		$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
		
		$Corderdate=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
	}
	else
	{
		$Corderdate="";
	}
	
	//
	if(isset($row['DateCompleted']) && $row['DateCompleted']!="")
	{
		$Splitdate=explode(" ",$row["DateCompleted"]);
		$Splitdate2=explode("-",$Splitdate[0]);
		
		$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
		
		$Splitdate=explode(" ",$checkdateR[0]["DateCompleted"]);
		
		$DateCompleted=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
	}
	else
	{
		$DateCompleted="";
	}
	//

?>
<tr>
<td><?php echo (int)$row["order_id"];?></td>
<td><?php echo $EMAIL;?></td>
<td><?php echo $FNAME;?></td>
<td><?php echo $LNAME;?></td>
<td><?php echo $Details;?></td>
<td><?php echo $Corderdate;?></td>
<td><?php echo $DateCompleted;?></td>
<td>
<button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/reports/?orderid=<?php echo $ID;?><?php echo $requeststring;?>'"><i class="fas fa-search"></i></button>
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