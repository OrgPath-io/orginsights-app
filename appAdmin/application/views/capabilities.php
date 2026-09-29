<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Capabilities</h4></div>
<div class="table-list">
<table id="dataTable1" class="table">
<thead>
<tr>
<th>Name</th>
<th>Description</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
//DELETE the record if clicked
	if(isset($_REQUEST['DEL']) && isset($_REQUEST['id']) && $_REQUEST['DEL']=="T" && $_REQUEST['id']!="" && is_numeric($_REQUEST['id']))
	{
	$con->query("Delete FROM capabilities where cap_id=".$_REQUEST['id']);
	?>
	<script type="text/javascript">
	location.href="?";
	</script>
	<?php
	die();
	}
	
	//end


$con->order_by("cap_id asc");
$GETRec=$con->get("capabilities");
foreach ($GETRec->result_array() as $GETRecr)
{
	$ID=$GETRecr["cap_id"];
	$cap_name=$GETRecr["cap_name"];
	$description=$GETRecr['description'];
	
	//
	
?>
<tr>
<td width="25%"><?php echo $cap_name;?></td>
<td><?php echo $description;?></td>
<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/capability/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>
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
	if(confirm("Do you want to delete Capability # "+n1+" ?"))
	{
		location.href="?DEL=T&id="+n1
	}


}
</script>

<?php
include("includes/footer.php");
?>