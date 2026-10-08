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
if(isset($_REQUEST['perpage']))
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
<?php

$whereq=array();
$whereq["user_id !="]="-1";
$tablevalue="users";

foreach($whereq as $key=>$value)
{
	$con->where($key, $value);
}
$GETRec=$con->get($tablevalue);



$countrec=0;
foreach ($GETRec->result_array() as $GETRecr)
{
	$countrec++;
	$ID=$GETRecr["user_id"];
	//check fields entered/selected
						$ActualTicks=0;	
						if($GETRecr["province"]!="" && $GETRecr["province"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["city"]!="" && $GETRecr["city"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["age_range"]!="" && $GETRecr["age_range"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["visible_minorities"]!="" && $GETRecr["visible_minorities"]=="No")
						{
							$ActualTicks++;
						}
						else if($GETRecr["visible_minorities"]!="" && $GETRecr["visible_minorities"]=="Yes")
						{
							if($GETRecr["visible_minorities_option"]!="" && $GETRecr["visible_minorities_option"]!="0")
							{
								$ActualTicks++;
							}
						}
						if($GETRecr["hle"]!="" && $GETRecr["hle"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["university"]!="" && $GETRecr["university"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["graduation_year"]!="" && $GETRecr["graduation_year"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["program_study"]!="" && $GETRecr["program_study"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["designation"]!="" && $GETRecr["designation"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["MostRecentExpLevelID"]!="" && $GETRecr["MostRecentExpLevelID"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["most_recent_employer"]!="" && $GETRecr["most_recent_employer"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["performance_rating"]!="" && $GETRecr["performance_rating"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["industry_employer"]!="" && $GETRecr["industry_employer"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["expertise_role"]!="" && $GETRecr["expertise_role"]!="0")
						{
							$ActualTicks++;
						}
						if($GETRecr["salary_range"]!="" && $GETRecr["salary_range"]!="0")
						{
							$ActualTicks++;
						}
						//end check fields entered/selected
						
						//echo $ID." ".$ActualTicks;
						//echo "<br>";
						$this->db->set('TotalFieldsEntered', $ActualTicks);
						$this->db->where('user_id', (int)$ID);
						$this->db->update('users');
}
?>

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