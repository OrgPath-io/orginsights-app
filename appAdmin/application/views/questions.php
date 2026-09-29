<?php
include("includes/header.php");
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Questions</h4></div>
<p align="left"><a class="btn btn-primary btn-lg" href='<?php echo SITEURL;?>/index.php/question'>Add Question</a></p>
<p>&nbsp;</p>
<p>
<?php
$a_type="Self";

if(isset($_REQUEST["t"]))
{
	$a_type=$_REQUEST["t"];
}



$Atype_array=array();
$Atype_array["self"]="Self Assessment";
$Atype_array["professional"]="Orginsights Assessment";
$Atype_array["other rated"]="360 Assessment";
$Atype_array["All"]="All";

$Btype_array=array();
$Btype_array["self"]="Self";
$Btype_array["professional"]="Org";
$Btype_array["other rated"]="360";
$Btype_array["All"]="All";

$Ctype_array=array();
$Ctype_array["Self"]="self";
$Ctype_array["Org"]="professional";
$Ctype_array["360"]="other rated";
$Ctype_array["All"]="";
?>
<select name="t" onchange="location.href=this.value">
<?php
foreach($Atype_array as $key=>$value)
{
	$slct="";
	if($Btype_array[$key]==$a_type)
	{
		$slct="selected";
	}
?>	
<option value="?t=<?php echo $Btype_array[$key];?>" <?php echo $slct;?>><?php echo $value;?></option>
<?php
}
?>
</select>
</p>
<div class="table-list">
<table id="dataTable1" class="table">
<thead>
<tr>
<th>#</th>
<th>Questions</th>
<th>Category</th>
<th>Capability</th>
<th>Type</th>
<th>Answers</th>
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
	$con->query("Delete FROM questions where q_id=".$_REQUEST['id']);
	?>
	<script type="text/javascript">
	location.href="?t=<?php echo $a_type;?>";
	</script>
	<?php
	die();
	}
	
	//end

if(isset($Ctype_array[$a_type]) && $Ctype_array[$a_type]!="")
{
	$con->where('q_type', $Ctype_array[$a_type]);
}
	
$con->order_by("q_type");
$con->order_by("cat_id asc");
$con->order_by("q_id asc");
$GETRec=$con->get("questions");
$countrec=0;
foreach ($GETRec->result_array() as $GETRecr)
{
	$ID=$GETRecr["q_id"];
	$question=$GETRecr["question"];
	$general_instruction=$GETRecr["general_instruction"];
	$cat_id=$GETRecr['cat_id'];
	$cap_id=$GETRecr['cap_id'];
	$q_type=$GETRecr['q_type'];
	$question_typeID=$GETRecr['question_typeID'];
	
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
	$Answers="";
	$con->where('q_id', $ID);
	$checkrecQ=$con->get("questions_responses");
	$checkrec=$checkrecQ->row_array();
	foreach ($checkrecQ->result_array() as $checkrec)
	{
		$oa_id=(int)$checkrec["oa_id"];
		
		$con->where('oa_id', $oa_id);
		$checkrecQ2=$con->get("responses");
		$checkrec2=$checkrecQ2->row_array();
		if($checkrec2!="")
		{
			$Answers.=$checkrec2["answers"]."<br>";
		}
	}
	//
	$countrec++;
?>
<tr>
<td><?php echo $countrec;?></td>
<td width="25%"><?php echo $general_instruction;?><br><font style="font-size:12px;">(<?php echo $question;?>)</font></td>
<td><?php echo $Cat;?></td>
<td><?php echo $Cap;?></td>
<td><?php echo $q_type;?></td>
<td><?php echo $Answers;?></td>
<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/questionview/?id=<?php echo $ID;?>'"><i class="fas fa-search"></i></button></td>
<td><button type="button" onclick="location.href='<?php echo SITEURL;?>/index.php/question/?id=<?php echo $ID;?>'"><i class="fas fa-pencil-alt"></i></button></td>
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
</div>
<script>
function delrec(n1,n2)
{
	if(confirm("Do you want to delete Question # "+n2+" ?"))
	{
		location.href="?t=<?php echo $a_type;?>&DEL=T&id="+n1
	}


}
</script>

<?php
include("includes/footer.php");
?>