<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Assessment Prices</h4></div>
<div class="table-list">
<table id="dataTable" class="table">
<thead>
<tr>
<th>Assessment Name</th>
<th>Price</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php



$con->order_by("p_id asc");
$GETRec=$con->get("packages");
foreach ($GETRec->result_array() as $GETRecr)
{
	$ID=$GETRecr["p_id"];
	$p_name=$GETRecr["p_name"];
	$price=$GETRecr['price'];
	
	
?>
<tr>
<td><?php echo $p_name;?></td>
<td><?php echo $price;?></td>
<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/assessmentprice/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>

</tr>
<?php
}
?>
<tbody>
</tbody>
</table>


</div>
</div>


<?php
include("includes/footer.php");
?>