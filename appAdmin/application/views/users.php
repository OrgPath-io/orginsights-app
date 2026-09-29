<?php
$requeststring="";
if(isset($_REQUEST))
{
	foreach($_REQUEST as $key=>$value)
	{
		$requeststring.="&".$key."=".$value;
	}
}
$perpage=array(50,100,200,300,10000);

include("includes/header.php");
?>
<?php

$nsortby="created_date desc";
if(isset($_REQUEST["sort"]) && $_REQUEST["sort"]!="")
{
		$nsortby=$_REQUEST["sort"];
}
$limitselected=50;
if(isset($_REQUEST['perpage']) && (int)$_REQUEST['perpage'] > 0)
{
	$limitselected=$_REQUEST['perpage'];
	if($_REQUEST['perpage']=="All")
	{
		$limitselected=10000;
	}
}
$querystring="&sort=".$nsortby."&perpage=".$_REQUEST['perpage'];
?>
<script>
activeinactive=new Array("Inactive","Active");
function switchoption(n1,n2)
{

	if(confirm("Are you sure you want to mark the user as "+activeinactive[n1]+"?"))
	{
		if(n1==1)
		{
			document.getElementById("isActive1Span_"+n2).style.display="block";
			document.getElementById("isActive0Span_"+n2).style.display="none";
			document.getElementById("isActive0_"+n2).checked=false;
		}
		else if(n1==0)
		{
			document.getElementById("isActive0Span_"+n2).style.display="block";
			document.getElementById("isActive1Span_"+n2).style.display="none";
			document.getElementById("isActive1_"+n2).checked=false;
		}
		Getpages("<?php echo ORGURL;?>/ActiveR.php?a="+n1+"&i="+n2,"Switchactive");
	}
}
</script>
<style>
.switch-field {
	max-width: 150px;
	display: flex;
	/*margin-bottom: 36px;*/
	overflow: hidden;
	width:auto;
	/*padding:17px 15px 15px 15px;*/
	border-radius:45%;
}

.switch-field span {
cursor:pointer;
}

.switch-field input {
	position: absolute !important;
	clip: rect(0, 0, 0, 0);
	height: 1px;
	width: 1px;
	border: 0;
	overflow: hidden;
	
}



.switch-field label:hover {
	cursor: pointer;
}


.switch-field label .index{
	background-color: #ffffff;
	color: #ffffff;
	font-size: 14px;
	text-align: center;
	padding: 8px 8px;
	border: 0px solid rgba(0, 0, 0, 0);
	border-radius: 60%;
	box-shadow: none;
	
}
.switch-field input:checked + label .index{
	background-color: #0b8465;
	color: #0b8465;
	font-size: 14px;
	text-align: center;
	padding: 8px 8px;
	border: 0px solid rgba(0, 0, 0, 0);
	border-radius: 60%;
	box-shadow: none;
	
}
</style>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Users</h4></div>
<div style="float:left;padding-top:5px;padding-bottom:10px;"><a class="btn btn-primary btn-lg" href='<?php echo SITEURL;?>/index.php/user'>Add User</a></div>
<div style="float:left;padding-left:10px;padding-top:5px;padding-bottom:10px;"><a class="btn btn-primary btn-lg" href='<?php echo SITEURL;?>/index.php/csvimport'>Import Users</a></div>

<div style="float:right;"><select style="width:auto;" class="form-control" id="perpage" name="perpage" onchange="checksearch(this.value)">
<?php
foreach($perpage as $key=>$value)
{
	$slct="";
	if($_REQUEST['perpage']=="All" && $value==10000)
	{
		$slct="selected";
	}
	else if((int)$_REQUEST['perpage']==$value)
	{
		$slct="selected";
	}
	//$value2="Show ".$value." per page";
	$value2=$value;
	if($value==10000)
	{
		$value2="All";
	}
	?>
	<option value=<?php echo $value2;?> <?php echo $slct;?>><?php echo $value2;?></option>
	<?php
}
?>
</select></div>
<div style="float:right;padding-top:10px;">Show:&nbsp;</div>
<div style="clear:both;"></div>
<script>
function checksearch(n1)
{
	
	location.href="?sort=<?php echo $nsortby;?>&perpage="+n1;
	
}
</script>
<div id="Switchactive"></div>
<div class="table-list">
<table id="dataTable1" class="table">
<thead>
<tr>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="first_name asc"){echo 'first_name desc';}else{echo 'first_name asc';}?>')">Name</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="email asc"){echo 'email desc';}else{echo 'email asc';}?>')">Email</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="created_date asc"){echo 'created_date desc';}else{echo 'created_date asc';}?>')">Created Date</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="country_id asc"){echo 'country_id desc';}else{echo 'country_id asc';}?>')">Country</a></th>
<th><a href="javascript:void(0)" onclick="sortlist('<?php if($nsortby=="TotalFieldsEntered asc"){echo 'TotalFieldsEntered desc';}else{echo 'TotalFieldsEntered asc';}?>')">Is Profile Complete</a></th>
<th><center>Is Active</center></th>
<th>&nbsp;</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<?php
//DELETE the record if clicked
	if(isset($_REQUEST['DEL']) && isset($_REQUEST['id']) && $_REQUEST['DEL']=="T" && $_REQUEST['id']!="" && is_numeric($_REQUEST['id']))
	{
	$con->query("Delete FROM users where user_id=".$_REQUEST['id']);
	?>
	<script type="text/javascript">
	location.href="?";
	</script>
	<?php
	die();
	}
	
	//end


$whereq=array();
$whereq["user_id !="]="-1";
$tablevalue="users";

foreach($whereq as $key=>$value)
{
	$con->where($key, $value);
}
$con->order_by($nsortby);
$GETRec=$con->get($tablevalue);

include("includes/calcpagination.php");


$countrec=0;
$GETRec=$con->get($tablevalue, $start, $limit);
foreach ($GETRec->result_array() as $GETRecr)
{
	$countrec++;
	$ID=$GETRecr["user_id"];
	$NAME=$GETRecr["first_name"]." ".$GETRecr["last_name"];
	$email=$GETRecr["email"];
	$created_date=explode(" ",$GETRecr["created_date"]);
	$country_id=(int)$GETRecr["country_id"];
	$is_active=(int)$GETRecr["is_active"];
	$TotalFieldsEntered=(int)$GETRecr["TotalFieldsEntered"];
	
	$COUNTRY="";
		
	$chkutypeQ=$con->query("select * from countries where id=".(int)$country_id);
	$chkutypeuser=$chkutypeQ->row_array();
	 if($chkutypeuser["country"]!="")
	{
		$COUNTRY=$chkutypeuser["country"];
	}
?>
<tr>
<td><?php echo $NAME;?></td>
<td><?php echo $email;?></td>
<td><?php echo $created_date[0];?></td>
<td><?php echo $COUNTRY;?></td>
<td>
<?php
if($TotalFieldsEntered > 9)
{
	echo "<font color='green'>Yes</font>";
}
else
{
	echo "<font color='red'>No</font>";
}
?>
</td>
<td>
<?php
$switchcheck=array("","");
$switchdisplay=array("display:none;","display:none;");

if($is_active==1)
{
	$switchcheck[1]="checked";
	$switchdisplay[1]="display:block;";
}
else
{
	$switchcheck[0]="checked";
	$switchdisplay[0]="display:block;";
}
?>
<div class="switch-field">
<input type="radio" id="isActive1_<?php echo $ID;?>" name="switch-one_<?php echo $ID;?>" value="yes" <?php echo $switchcheck[1];?> />
<input type="radio" id="isActive0_<?php echo $ID;?>" name="switch-one_<?php echo $ID;?>" value="no" <?php echo $switchcheck[0];?> />
<span style="<?php echo $switchdisplay[1];?>" id="isActive1Span_<?php echo $ID;?>" onclick="switchoption(0,<?php echo $ID;?>)"><img src="<?php echo SITEURL;?>/assets/images/Toggl-ON.png"></span>
<span style="<?php echo $switchdisplay[0];?>" id="isActive0Span_<?php echo $ID;?>" onclick="switchoption(1,<?php echo $ID;?>)"><img src="<?php echo SITEURL;?>/assets/images/Toggl-OFF.png"></span>
</div>
</td>
<td><button type="button" onclick="resetpass(<?php echo $ID;?>,<?php echo $countrec;?>)"><i class="fas fa-unlock-alt"></i></button></td>

<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/user/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>


<td>
<button type="button" onclick='delrec(<?php echo $ID;?>,<?php echo $countrec;?>)'><i class="fas fa-trash"></i></button>
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
function delrec(n1,n2)
{
	if(confirm("Do you want to delete User # "+n2+" ?"))
	{
		location.href="?DEL=T&id="+n1
	}


}
function resetpass(n1,n2)
{
	if(confirm("Do you want to reset password for User # "+n2+" ?"))
	{
		location.href="<?php echo SITEURL;?>/index.php/resetpass/?id="+n1
	}
}
</script>

<?php
include("includes/footer.php");
?>