<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Assessment Costs</h4></div>
<p align="left"><a href='<?php echo SITEURL;?>/index.php/assessmentcost'>Add Assessment Cost</a></p>
<div class="table-list">
<table id="dataTable" class="table">
<thead>
<tr>
<th>Assessment Name</th>
<th>Original Price</th>
<th>Discounted Price</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
//DELETE the record if clicked
	if(isset($_REQUEST['DEL']) && isset($_REQUEST['id']) && $_REQUEST['DEL']=="T" && $_REQUEST['id']!="" && is_numeric($_REQUEST['id']))
	{
	$con->query("Delete FROM AssessmentCosts where id=".$_REQUEST['id']);
	?>
	<script type="text/javascript">
	location.href="?";
	</script>
	<?php
	die();
	}
	
	//end


$con->order_by("id asc");
$GETRec=$con->get("AssessmentCosts");
foreach ($GETRec->result_array() as $GETRecr)
{
	$ID=$GETRecr["id"];
	$assessmentName=$GETRecr["assessmentName"];
	$originalPrice=$GETRecr['originalPrice'];
	$discountedPrice=$GETRecr['discountedPrice'];
	
?>
<tr>
<td><?php echo $assessmentName;?></td>
<td><?php echo $originalPrice;?></td>
<td><?php echo $discountedPrice;?></td>
<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/assessmentcost/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>
<td>
<button type="button" onclick='delrec(<?php echo $ID;?>)'><i class="fas fa-trash"></i></button>
</td>
</tr>
<?php
}
?>
<tbody>
</tbody>
</table>


</div>
</div>
<script>
function delrec(n1)
{
	if(confirm("Do you want to delete Record # "+n1+" ?"))
	{
		location.href="?DEL=T&id="+n1
	}


}
</script>

<?php
include("includes/footer.php");
?>