<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Referral Codes</h4></div>
<p align="left"><a href='<?php echo SITEURL;?>/index.php/referralcode'>Add Referral Code</a></p>
<div class="table-list">
<table id="dataTable" class="table">
<thead>
<tr>
<th>Referral Code</th>
<th>Referral Value</th>
<th>Total Uses</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
//DELETE the record if clicked
	if(isset($_REQUEST['DEL']) && isset($_REQUEST['id']) && $_REQUEST['DEL']=="T" && $_REQUEST['id']!="" && is_numeric($_REQUEST['id']))
	{
	$con->query("Delete FROM ReferralCodes where id=".$_REQUEST['id']);
	?>
	<script type="text/javascript">
	location.href="?";
	</script>
	<?php
	die();
	}
	
	//end


$con->order_by("id asc");
$GETRec=$con->get("ReferralCodes");
foreach ($GETRec->result_array() as $GETRecr)
{
	$ID=$GETRecr["id"];
	$NAME=$GETRecr["ReferralCode"];
	$ReferralValue=$GETRecr['ReferralValue'];
	$ReferralType=$GETRecr['ReferralType'];
	
	$ReferralCodeUsesQ=$con->query("select count(*) as ReferralCodeUses from ReferralCodeUses where referralCodeID=".(int)$ID);
	$ReferralCodeUses=$ReferralCodeUsesQ->row_array();
	
	
	if($ReferralType=="percentage")
	{
		$ReferralType="%";
	}
	else
	{
		$ReferralType="";
	}
	
?>
<tr>
<td><?php echo $NAME;?></td>
<td><?php echo $ReferralValue.$ReferralType;?></td>
<td><?php echo (int)$ReferralCodeUses["ReferralCodeUses"];?></td>
<td><?php
if($GETRecr['email']!="")
{
?>
<button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/referralreport/?id=<?php echo $ID;?>'"><i class="fas fa-envelope"></i></button>
<?php
}
?>
</td>
<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/referralcode/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>
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
	if(confirm("Do you want to delete Code # "+n1+" ?"))
	{
		location.href="?DEL=T&id="+n1
	}


}
</script>

<?php
include("includes/footer.php");
?>