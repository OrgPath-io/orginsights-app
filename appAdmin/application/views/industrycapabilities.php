<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Industry Capabilities</h4></div>
<p align="left"><a class="btn btn-primary btn-lg" href='<?php echo SITEURL;?>/index.php/industrycapability'>Add Capability</a></p>
<p>&nbsp;</p>

<div class="table-list">
<table id="dataTable1" class="table">
<thead>
<tr>
<th>Industry Name</th>
<th>Category</th>
<th>Capability</th>
<th>isActive</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
//DELETE the record if clicked
	if(isset($_REQUEST['DEL']) && isset($_REQUEST['id']) && $_REQUEST['DEL']=="T" && $_REQUEST['id']!="" && is_numeric($_REQUEST['id']))
	{
	$con->query("Delete FROM ".$tablevalue." where id=".$_REQUEST['id']);
	?>
	<script type="text/javascript">
	location.href="?";
	</script>
	<?php
	die();
	}
	
	//end
//$limitselected=50;
$yesno=array("No","Yes");

$whereq=array();
$whereq["id !="]="-1";
$nsortby="IndustryName";
$tablevalue="IndustryCapabilities";
	
$con->order_by($nsortby);
$GETRec=$con->get($tablevalue);

include("includes/calcpagination.php");

$page=(int)$_REQUEST['page'];
$page++;

if($page < 0)
{
$page=1;
}
$limit=50;

$end=$page*$limit;
$start=$end-$limit;

//echo $start;

$countrec=0;
$con->limit($limit, $start);
$GETRec=$con->get($tablevalue);
foreach ($GETRec->result_array() as $GETRecr)
{
	$ID=$GETRecr["id"];
	$IndustryName=$GETRecr["IndustryName"];
	$cat_id=$GETRecr['categoryID'];
	$cap_id=$GETRecr['capabilityID'];
	$isActive=$yesno[(int)$GETRecr['isActive']];;
	
	//
	$Cat="";
	$con->where('cat_id', $cat_id);
	$checkrecQ=$con->get("categories");
	$checkrec=$checkrecQ->row_array();
	if($checkrec!="")
	{
		$Cat=$checkrec["cat_name"];
	}
	//
	$Cap="";
	$con->where('cap_id', $cap_id);
	$checkrecQ=$con->get("capabilities");
	$checkrec=$checkrecQ->row_array();
	if($checkrec!="")
	{
		$Cap=$checkrec["cap_name"];
	}
	
	//
	$countrec++;
	/*<td><?php echo $countrec;?></td>*/
?>
<tr>

<td width="25%"><?php echo $IndustryName;?></td>
<td><?php echo $Cat;?></td>
<td><?php echo $Cap;?></td>
<td><?php echo $isActive;?></td>

<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/industrycapability/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>
<td>
<button type="button" onclick='delrec(<?php echo $ID;?>,<?php echo $countrec;?>)'><i class="fas fa-trash"></i></button>
</td>
</tr>
<?php
	if($countrec > 49)
	{
		//break;
	}
}
?>
<tbody>
</tbody>
</table>

<?php
include("includes/showpagination.php");
?>
</div>
</div>
<script>
function delrec(n1,n2)
{
	if(confirm("Do you want to delete Record # "+n2+" ?"))
	{
		location.href="?DEL=T&id="+n1
	}


}
</script>

<?php
include("includes/footer.php");
?>