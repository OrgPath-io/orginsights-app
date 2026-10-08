<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Categories</h4></div>
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
	$con->query("Delete FROM categories where cat_id=".$_REQUEST['id']);
	?>
	<script type="text/javascript">
	location.href="?";
	</script>
	<?php
	die();
	}
	
	//end


$con->order_by("cat_id asc");
$GETRec=$con->get("categories");
foreach ($GETRec->result_array() as $GETRecr)
{
	$ID=$GETRecr["cat_id"];
	$cat_name=$GETRecr["cat_name"];
	$cat_description=$GETRecr['cat_description'];
	
	//
	
?>
<tr>
<td width="25%"><?php echo $cat_name;?></td>
<td><?php echo $cat_description;?></td>
<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/category/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>
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
	if(confirm("Do you want to delete Category # "+n1+" ?"))
	{
		location.href="?DEL=T&id="+n1
	}


}
</script>

<?php
include("includes/footer.php");
?>