<?php
include("includes/header.php");
?>

<div class="body-wrapper">
<div class="dashboard-wrapper p-0">
<div class="row">
<div class="col-xl-8 mb-4">
<div class="content coleql_height">
<div class="title d-flex">
<h4>Assessments Completed</h4>
<div class="ml-auto">
<form class="form-inline" method="post">
<div class="form-group">
<label class="my-1 mr-2">Form</label>
<input type="date" class="form-control" name="fromdate" value="<?php echo $_POST['fromdate'];?>">
</div>
<div class="form-group">
<label class="my-1 mr-2">To</label>
<input type="date" class="form-control" name="todate" value="<?php echo $_POST['todate'];?>">
</div>
<div class="form-group">
<label class="my-1 mr-2">&nbsp;</label>
<input type="submit" value="Go">
</div>
</form>
</div>
</div>
<?php
$Collections=array();
$Collections['JAN']=0;
$Collections['FEB']=0;
$Collections['MAR']=0;
$Collections['APR']=0;
$Collections['MAY']=0;
$Collections['JUN']=0;
$Collections['JUL']=0;
$Collections['AUG']=0;
$Collections['SEP']=0;
$Collections['OCT']=0;
$Collections['NOV']=0;
$Collections['DEC']=0;


$fromdate="";
$todate="";

if(isset($_POST['fromdate']) && $_POST['fromdate']!="")
{
$fromdate=strtotime($_POST['fromdate']);
}

if(isset($_POST['todate']) && $_POST['todate']!="")
{
$todate=strtotime($_POST['todate']);
}



if($todate=="")
{
	$todate=$fromdate;
}
if($fromdate=="")
{
	$fromdate=$todate;
}


if($fromdate!="")
{
	$fromdate_s=explode("-",$_POST['fromdate']);
	//$fromdate=mktime(date('H'), date('i'),date('s'), $fromdate_s[1], $fromdate_s[2], $fromdate_s[0]);
	
	//$fromdate=strtotime($fromdate);

	$todate_s=explode("-",$_POST['todate']);
	//$todate=mktime(date('H'), date('i'),date('s'), $todate_s[1], $todate_s[2], $todate_s[0]);
	
	//$todate=strtotime($todate);
	
	$whereq=" and unix_timestamp(updated) between ".$fromdate." and ".$todate;

}
else
{
	$whereq="";
}

//echo $whereq;
$TotalReports=0;



//$sql="select *,unix_timestamp(updated) as updated from orders_assessment_type_responses where oa_val!=-99 ".$whereq." group by order_id order by oatr_id desc";
$sql="select order_package_id,order_id,unix_timestamp(order_date) as order_date from orders where order_id!=-1 ".str_replace('updated','order_date',$whereq)." order by order_id desc";

$GETRec=$con->query($sql);
foreach ($GETRec->result_array() as $row)
{
	$checkorgrep=1;
	if($row["order_package_id"]==1 || $row["order_package_id"]==3)
	{
		if($row["order_package_id"]==1)
		{
			$checkorgrep=0;
		}
		$sql2="select *,udpated as updated from orders_assessment_type_rater_responses where oa_val=-99 and order_id=".$row["order_id"]." group by r_user_id";
		$GETRec2=$con->query($sql2);
		$check=$GETRec2->row_array();
		if($check=="")
		{
			$TotalReports++;
			$Collections[strtoupper(date("M",$row["order_date"]))]++;
		}
	}
	if($checkorgrep==1)
	{
		$sql2="select *,unix_timestamp(updated) as updated from orders_assessment_type_responses where oa_val=-99 and order_id=".$row["order_id"];
		$GETRec2=$con->query($sql2);
		$check=$GETRec2->row_array();
		if($check=="")
		{
			$TotalReports++;
			$Collections[strtoupper(date("M",$row["order_date"]))]++;
		}
	}
	//die();
	
}
/*
$con->where("oa_val!=", "-99");
if($fromdate!="")
{
	$fromdate_s=explode("-",$_POST['fromdate']);
	$fromdate=mktime(date('H'), date('i'),date('s'), $fromdate_s[1], $fromdate_s[2], $fromdate_s[0]);

	$todate_s=explode("-",$_POST['todate']);
	$todate=mktime(date('H'), date('i'),date('s'), $todate_s[1], $todate_s[2], $todate_s[0]);
	
	$whereq=" and unix_timestamp(updated) between ".$fromdate." and ".$todate;

	$con->where("unix_timestamp(updated) >=", $fromdate);
	$con->where("unix_timestamp(updated) <=", $todate);
}
else
{
	$whereq="";
}

//$con->group_by('order_id');
$con->order_by("oatr_id desc");
$GETRec=$con->get("orders_assessment_type_responses");

foreach ($GETRec->result_array() as $row)
{
	$updated=strtotime($row["updated"]);

	$con->where("oa_val", "-99");
	$con->where("order_id", $row["order_id"]);
	$GETRec2=$con->get("orders_assessment_type_responses",1);
	$check=$GETRec2->row_array();
	
	if($check=="")
	{
		$Collections[strtoupper(date("M",$updated))]++;
	}
	//die();
}
*/
$dataPoints = array( 
	array("label"=>"Jan", "y"=>$Collections['JAN']),
	array("label"=>"Feb", "y"=>$Collections['FEB']),
	array("label"=>"Mar", "y"=>$Collections['MAR']),
	array("label"=>"Apr", "y"=>$Collections['APR']),
	array("label"=>"May", "y"=>$Collections['MAY']),
	array("label"=>"Jun", "y"=>$Collections['JUN']),
	array("label"=>"Jul", "y"=>$Collections['JUL']),
	array("label"=>"Aug", "y"=>$Collections['AUG']),
	array("label"=>"Sep", "y"=>$Collections['SEP']),
	array("label"=>"Oct", "y"=>$Collections['OCT']),
	array("label"=>"Nov", "y"=>$Collections['NOV']),
	array("label"=>"Dec", "y"=>$Collections['DEC'])
);
?>
<script>
    window.onload = function() {
     
//*     
    var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: ""
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
//*/	
	

     
    }
	//indexLabelFontColor: "#36454F"
    </script>

<div class="mt-4 chart">
<div class="full-img">
<div id="chartContainer" style="height:400px;background:#ffffff;"></div>
</div>
</div>
</div>
</div>
<?php
$sql="select count(user_id) as TotalUsers from users where user_id!=-1 ".str_replace('updated','created_date',$whereq)."";
$CountsQ=$con->query($sql);
$CountsR=$CountsQ->row_array();
?>
<div class="col-xl-4 mb-4">
<div class="content coleql_height">
<!---->
<div style="cursor:pointer;" onclick="location.href='/appAdmin/index.php/users/'" class="row stats">
<div class="col-md-12 col-lg-12 col-xl-12 mb-4">
<div class="box content">
<div class="media">
<div class="media-body">
<h2><?php echo (int)$CountsR["TotalUsers"];?></h2>
<p>Candidates</p>
</div>
<img src="<?php echo SITEURL;?>/assets/images/icon-1.png" alt="">
</div>
</div>
</div>
</div>

<div style="cursor:pointer;" onclick="location.href='/appAdmin/index.php/orders/'" class="row stats">
<div class="col-md-12 col-lg-12 col-xl-12 mb-4">
<div class="box content">
<div class="media">
<div class="media-body">
<h2><?php echo (int)$TotalReports;?></h2>
<p>Reports</p>
</div>
<img src="<?php echo SITEURL;?>/assets/images/icon-2.png" alt="">
</div>
</div>
</div>
</div>
<?php
$sql="select count(user_id) as CompletedProfiles from users where user_id!=-1  and TotalFieldsEntered > 9 ".str_replace('updated','created_date',$whereq)."";
$CountsQ=$con->query($sql);
$CountsR=$CountsQ->row_array();
?>
<!---->
<div style="cursor:pointer;" onclick="location.href='/appAdmin/index.php/users/'" class="row stats">
<div class="col-md-12 col-lg-12 col-xl-12 mb-4">
<div class="box content">
<div class="media">
<div class="media-body">
<h2><?php echo (int)$CountsR["CompletedProfiles"];?></h2>
<p>Completed Profiles</p>
</div>
<img src="<?php echo SITEURL;?>/assets/images/icon-1.png" alt="">
</div>
</div>
</div>
</div>
<!---->




<!---->
</div>
</div>
</div>




</div>
</div>
<script src="https://app.orginsights.io/assets/js/canvasjs.min.js?v=<?php echo date('His');?>"></script>
<?php
include("includes/footer.php");
?>