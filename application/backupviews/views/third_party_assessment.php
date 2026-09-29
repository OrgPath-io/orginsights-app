
<div class="page-banner">
<div class="container clearfix">
<h1>360 Assessment</h1>
<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
</div>
</div>
<script>
function submitmform()
{
	document.getElementById("thirdparty_assessment_form").submit();
}
</script>
<div style="padding-bottom:0px !important;" class="section">
<div class="container">
<?php
$tabmenu3=1;
include("tabmenus.php");?>
<form action="<?php echo base_url().'thirdparty/'.$order_id;?>" id="thirdparty_assessment_form" name="thirdparty_assessment_form" method="post">
<input type="hidden" name="id" id="inviteid" value=0>
<input type="hidden" name="delid" id="delinviteid" value=0>


</div>

</div>
</div>



<div class="bottom-checkbox">
<div class="container">

<?php
/*
<form  method="post" id="Top_form" name="Top_form">
?>
<div class="col-6">
<label>Length of Assessment Time *</label><br>
<?php
$timestampC=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
$timestamp60=mktime(date('H'), date('i'),date('s'), date('m'), date('d')+61, date('Y'));

$yy=date("Y",$timestampC);
$mm=date("m",$timestampC);
$dd=date("d",$timestampC);

$yy2=date("Y",$timestamp60);
$mm2=date("m",$timestamp60);
$dd2=date("d",$timestamp60);

  $myCalendar = new tc_calendar("LengthofAssessment1", true, false);
  //$myCalendar->setIcon("calendar/images/iconCalendar.gif");
  $myCalendar->setDate($dd, $mm, $yy);
  $myCalendar->setPath("calendar/");
  $myCalendar->setYearInterval(date("Y"), date("Y")+1);
  $myCalendar->dateAllow($yy.'-'.$mm.'-'.$dd, $yy2.'-'.$mm2.'-'.$dd2);
  $myCalendar->setDateFormat('d/m/Y');
  //$myCalendar->setHeight(350);
  //$myCalendar->autoSubmit(true, "form1");
  $myCalendar->setAlignment('left', 'bottom');
  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
  //$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
  //$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
  $myCalendar->writeScript();
?>
</div>
<div style="clear:both"></div>
<br>
<div class="col-6">
<label>Frequency of Reminders *</label><br>
<select name="FrequencyofReminders" id="FrequencyofReminders1">
<?php
for($i=7;$i<=21;$i+=7)
{
?>
<option value=<?php echo $i;?>><?php echo $i;?> Days</option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
<br>
<?php
</form>
*/
?>
<style>
.general_instruction{font-size:16px;}
</style>
<div style="padding-left:0px;padding-top:0px;" class="col-12">
<?php /*
If you want to close this assessment <a href="<?php echo base_url().'selfassessment/close_invite_user/'.$order_id;?>">Click Here</a>
*/?>
To close this assessment and go back to the main screen, <a href="<?php echo base_url();?>">Click Here</a>
</div>
<div style="clear:both"></div>
<br>
<div style="padding-left:0px;" class="col-12">
<?php
$AssessmentEnd=0;
$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
foreach($invited_users as $row)
{
	if((int)$row['invite_sent']==1)
	{
		$allowdatechange=0;
	}

	if(isset($row['LengthofAssessment']) && $row['LengthofAssessment']!="")
	{
		$exp_date1=explode(" ",$row['LengthofAssessment']);
		$exp_date2=explode("-",$exp_date1[0]);
				
		$timestampE=mktime(date('H'), date('i'),date('s'), $exp_date2[1], $exp_date2[2], $exp_date2[0]);
		
		if($timestampE <= $timestamp)
		{
			$AssessmentEnd=1;
		}
	}
}	

if($AssessmentEnd==1)
{
	echo "<h3>This Assessment has Ended</h3>";
}
else
{
/*
<input type="hidden" name="FrequencyofReminders" id="FrequencyofR" value=7>
<input type="hidden" name="LengthofAssessment" id="LengthofA" value="<?php echo $dd."/".$mm."/".$yy;?>">
*/

$timestampS=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
$timestampC=mktime(date('H'), date('i'),date('s'), date('m'), date('d')+3, date('Y'));
$timestamp60=mktime(date('H'), date('i'),date('s'), date('m'), date('d')+30, date('Y'));

$timestampD=mktime(date('H'), date('i'),date('s'), date('m'), date('d')+14, date('Y'));

$yys=date("Y",$timestampD);
$mms=date("m",$timestampD);
$dds=date("d",$timestampD);


$yy=date("Y",$timestampC);
$mm=date("m",$timestampC);
$dd=date("d",$timestampC);

$yy2=date("Y",$timestamp60);
$mm2=date("m",$timestamp60);
$dd2=date("d",$timestamp60);

$datefetched="";
$freqfetched=7;

$allowdatechange=1;
foreach($invited_users as $row)
{
	if((int)$row['invite_sent']==1)
	{
		$allowdatechange=0;
	}

	if(isset($row['LengthofAssessment']) && $row['LengthofAssessment']!="")
	{
		$datefetched2=$row['LengthofAssessment'];
		
		$datefetcheds=explode("-",$datefetched2);
		
		$timestampcheck=mktime(date('H'), date('i'),date('s'), $datefetcheds[1], $datefetcheds[2], $datefetcheds[0]);
		
		if($timestampcheck >= $timestampC && $timestampcheck <= $timestamp60)
		{
			$datefetched=$row['LengthofAssessment'];
		}
		
		
	}
	if(isset($row['FrequencyofReminders']) && $row['FrequencyofReminders']!="")
	{
		$freqfetched=$row['FrequencyofReminders'];
	}
}
?>
<div id="assessmentenddate" style="display:none;padding-left:0px;">
<?php
if($datefetched!="")
{
	$datefetcheds=explode("-",$datefetched);

	
	$yys=$datefetcheds[0];
	$mms=$datefetcheds[1];
	$dds=$datefetcheds[2];
	
	$timestampD=mktime(date('H'), date('i'),date('s'), $mms, $dds, $yys);
	
	
	/*/&nbsp;(<?php echo $row['LengthofAssessment'];?>)*/
	
	echo "Your assessment end date is: <b>".$datefetched."</b>";
	echo "<br><br>";
	
}
?>
</div>
<div id="Frequencydiv" style="display:none;padding-left:0px;">
<?php
if($datefetched!="")
{
	if($freqfetched > 0)
	{
	echo "Your assessment Frequency of Reminders is: <b>".$freqfetched." Days</b>";
	}
	else
	{
	echo "Your assessment Frequency of Reminders is: <b>No reminder</b>";
	}
	echo "<br><br>";
}
?>
</div>
</div>
<div style="clear:both"></div>
<?php
if($allowdatechange==1)
{
?>
<div style="padding-left:0px;" class="col-12">
<span class="questionContent"><strong>Length of Assessment Time *</strong></span>
<br><span class="general_instruction">
How long do you want to give invitees to respond? You can take as little as two days and as long as a a month (defaults to two weeks)</span>
<br><br>
<input type="date" id="MainLengthofAssessment" name="MainLengthofAssessment" value="<?php echo date("Y-m-d",$timestampD);?>">
</div>
<div style="clear:both"></div>
<br>
<div style="padding-left:0px;" class="col-6">
<span class="questionContent"><strong>Frequency of Reminders *</strong></span>
<br><span class="general_instruction">
How often do you want to remind your invitees to complete the survey? This will only go out to people who have not yet completed</span>
<br><br>
<select name="MainFrequencyofReminders" id="MainFrequencyofReminders" onchange="changefreq()">
<option value=0>No reminder</option>
<?php
for($i=1;$i<=9;$i+=2)
{
	$slct="";
	if($freqfetched==$i)
	{
		$slct="selected";
	}
?>
<option value=<?php echo $i;?> <?php echo $slct;?>><?php echo $i;?> Days</option>
<?php
}
?>
</select>
</div>
<div style="clear:both"></div>
<?php
}
?>
<style>
.messageform6{max-width: 80%;}
@media (max-width: 992px){
.messageform6{max-width: 100% !important;}
}
</style>
<br>
<div style="padding-left:0px;" class="messageform6">
<?php include("messageform.php");?>
</div>
<span class="questionContent"><strong>Select one or more people you want to send an invite to.</strong></span><br>
<span class="general_instruction">You must have minimum 3 names entered to be able to send out the invites. You can invite as much as 10 people to provide feedback. <u><b>Once you have added and selected 3 names, you will be able to click the "MAIL MESSAGE" button</b></u></span>
</div>
<div class="checkbox">
<div class="container">
<?php
$chkposted=$this->session->userdata('postedname');
if($chkposted!="")
{
	$inviteestyle="";
}
else
{
	$inviteestyle="";
	//$inviteestyle=" style='display:none;'";
}
?>
<div <?php echo $inviteestyle;?> class="row" id="invitee">


<?php
$this->session->set_userdata('postedname',"");

	$div_count = 1;
	$counter = 1;
	$div_id = 1;
	//echo count($selfassessment);
	$state = false;
	$state_count = 0;
	//*
	
	$minimumcheck=3;
	
	
	foreach($invited_users as $row)
	{
	
		
		$insntclass="style='background:none;'";
		$allowdelete=1;
		if((int)$row['invite_sent']==1)
		{
			$insntclass="style='color:#cccccc;'";
			$allowdelete=0;
			$minimumcheck=1;
		}
	
		if($div_count == 1)
			{
				
		?>		
				<div class="col-6 col-sm-6 col-md-3">
		<?php		
			}
		?>	
	<input onclick="checkinvite('c_<?php echo $counter;?>',<?php echo (int)$row['invite_sent'];?>)" type="checkbox" id="c_<?php echo $counter;?>" name="c_<?php echo $counter;?>" value="<?php echo $row['user_id'];?>"><label <?php echo $insntclass;?> title="<?php echo $row['email'];?>" for="c_<?php echo $counter;?>"><span></span><?php echo $row['first_name'].' '.$row['last_name'];?>&nbsp;&nbsp;<?php
	if($allowdelete==1)
	{
	?>
	<a href="javascript:delinvite(<?php echo (int)$row['id'];?>)">Delete</a>
	<?php
	}
	?>
	</label>
	
<?php

	
		if($div_count >= 3 || $counter >= count($invited_users))
		{
?>
		
		</div>
<?php
		$div_id++;
		}
		$div_count++;
		
		if($div_count >3 )
		{
			$div_count = 1;
		}
		$counter++;
	}
	/*/
	<div class="col-6 col-sm-6 col-md-3"><input type="checkbox" id="c_1" name="c_1" value="0"><label for="c_!"><span></span><?php echo $chkposted;?></label></div>
	*/
	?>
	


</div>

<div style="padding-left:0px;" class="col-6 col-sm-6 col-md-3">
<?php if($counter < 11){ ?>
<br>
<a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#ModalForm" ><i class="fas fa-plus mr-2"></i>ADD NEW NAME</a>
<?php }?>
</div>

</div>
</div>
<?php
/*
<div class="text-center"><?php if($counter >3){ ?><button type="button"   class="btn btn-primary" disabled id="invite_submit" name="invite_submit">Mail Message</button><?php } ?></div>
<?php 
*/
$invite_submit_div="display:none;";
if($counter >3){
$invite_submit_div="display:block;";
 } ?>
 <input type="hidden" name="selectedinvitees" id="selectedinvitees" value=0>
<div class="text-center" id="invite_submit_div" style="<?php echo $invite_submit_div;?>"><button type="button" class="btn btn-primary" disabled id="invite_submit" name="invite_submit">Mail Message</button></div>
</div>
</form>
<?php
}
?>
<!-- Modal -->
<div class="modal fade" id="ModalForm" tabindex="-1" role="dialog" aria-labelledby="ModalForm" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content custom-modal">
<div class="modal-body">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="sr-only">&times;</span></button>
<div class="text-center">
<h3>Enter 360 Assessment details</h3>
<p>We dont use your details for marketing purposes</p>
</div>
<form  method="post" id="invite_users_form" name="invite_users_form">
<br>
<input type="hidden" name="LengthofAssessment" id="LengthofAssessment" value="">
<input type="hidden" name="FrequencyofReminders" id="FrequencyofReminders" value="">
<input type="hidden" name="MessageTemplate" id="MessageTemplate" value="">



<div class="mt-3"><label>First Name *</label><input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"></div>
<div class="mt-3"><label>Last Name *</label><input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name"></div>
<div class="mt-3"><label>Email Address *</label><input type="text" id="email" name="email" class="form-control" placeholder="Enter your email address"></div>
<div class="mt-3"><label>Where Worked Together? </label><input type="text" id="wwt" name="wwt" class="form-control" placeholder="Enter detail"></div>
<div class="mt-3"><label>If never worked together is this a mentor? </label><input type="text" id="mentor" name="mentor" class="form-control" placeholder="If never worked together is this a mentor?"></div>
<div class="mt-3"><label>Is this person a peer? </label><input type="text" id="peer" name="peer" class="form-control" placeholder="Is this person a peer?"></div>
<div class="mt-3 text-center"><input type="submit" class="btn btn-primary" value="Add" id="invite_users" name="invite_users"></div>
</form>
</div>
</div>
</div>
</div>

<script type="text/javascript">
var order_id = <?php echo $order_id;?>;
var minimumcheck=<?php echo (int)$minimumcheck;?>;

function checkinvite(n1,n2)
{
	if(document.getElementById(n1))
	{
		if(document.getElementById(n1).checked==true && n2==1)
		{
			alert("A 360 Assessment has already been shared with this person. Are you sure you want to resend it?");
		}
		else
		{
		}
		
		
	}
	
	//selectedinvitees
	var checkboxeschk = document.querySelectorAll('input[type="checkbox"]');
	
	//alert(checkboxeschk[1].checked);
	//alert(checkboxeschk[1].value);
	
	var selectedinvitees1="0";
	for(c=0;c<checkboxeschk.length;c++)
	{
		if(checkboxeschk[c].checked)
		{
			selectedinvitees1+=","+checkboxeschk[c].value;
		}
	}
	document.getElementById('selectedinvitees').value=selectedinvitees1;
	
	//alert(selectedinvitees1);
	
	var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    if(checkboxes.length>=minimumcheck)
	{
		document.getElementById('invite_submit').disabled = false;
	}
	else
	{
		document.getElementById('invite_submit').disabled = true;
	}
	
}

function delinvite(n1)
{
	document.getElementById("thirdparty_assessment_form").action="<?php echo base_url().'selfassessment/thirdparty/'.$order_id;?>"
	document.getElementById("inviteid").value=n1;
	document.getElementById("delinviteid").value=1;
	
	document.getElementById("thirdparty_assessment_form").submit();
}

function changedate(n1,n2,n3)
{
	datefetched=n3+"-"+n2+"-"+n1;
	
	
	document.getElementById("assessmentenddate").innerHTML="Your assessment end date is: <b>"+datefetched+"</b><br><br>";
	
	document.getElementById("assessmentenddate").style.display="block";
}
function changefreq()
{
	MainFofReminders=document.getElementById("MainFrequencyofReminders").value;
	if(MainFofReminders=="0")
	{
	document.getElementById("Frequencydiv").innerHTML="Your assessment Frequency of Reminders is: <b>No reminder</b><br><br>";
	}
	else
	{
	
	document.getElementById("Frequencydiv").innerHTML="Your assessment Frequency of Reminders is: <b>"+MainFofReminders+" Days</b><br><br>";
	}
	document.getElementById("Frequencydiv").style.display="block";
}

datefetched="<?php echo $datefetched;?>";
if(datefetched!="")
{
	document.getElementById("assessmentenddate").style.display="block";
	document.getElementById("Frequencydiv").style.display="block";
}
</script>