<div class="page-banner">
<div class="container clearfix">
<h1>360 Assessment</h1>
<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
</div>
</div>

<div class="section">
<div class="container">
<?php
$tabmenu3=1;
include("tabmenus.php");?>
<form action="<?php echo base_url().'selfassessment/thirdparty/'.$order_id;?>" id="thirdparty_assessment_form" name="thirdparty_assessment_form" method="post">



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
<div class="col-6">
If you want to close this assessment <a href="<?php echo base_url().'selfassessment/close_invite_user/'.$order_id;?>">Click Here</a>
</div>
<div style="clear:both"></div>

<br>

<h4>Select one or more people you want to send (Minimum 3 and Maximum 10)</h4>
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
	foreach($invited_users as $row)
	{
		if($div_count == 1)
			{
				
		?>		
				<div class="col-6 col-sm-6 col-md-3">
		<?php		
			}
		?>	
	<input type="checkbox" id="c_<?php echo $counter;?>" name="c_<?php echo $counter;?>" value="<?php echo $row['user_id'];?>"><label title="<?php echo $row['email'];?>" for="c_<?php echo $counter;?>"><span></span><?php echo $row['first_name'].' '.$row['last_name'];?></label>
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
<div class="col-6 col-sm-6 col-md-3">
<?php if($counter < 11){ ?>
<a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#ModalForm" ><i class="fas fa-plus mr-2"></i>ADD NEW NAME</a>
<?php }?>
</div>

</div>
</div>
<div class="text-center"><?php if($counter >3){ ?><button type="button"   class="btn btn-primary" disabled id="invite_submit" name="invite_submit">Submit to Share</button><?php } ?></div>
</div>
</form>
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
<div style="padding-left:0px;" class="col-12">
<label>Length of Assessment Time *</label><br>
<?php
/*
<input type="hidden" name="FrequencyofReminders" id="FrequencyofR" value=7>
<input type="hidden" name="LengthofAssessment" id="LengthofA" value="<?php echo $dd."/".$mm."/".$yy;?>">
*/

$timestampS=mktime(date('H'), date('i'),date('s'), date('m'), date('d')+5, date('Y'));
$timestampC=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
$timestamp60=mktime(date('H'), date('i'),date('s'), date('m'), date('d')+61, date('Y'));

$yys=date("Y",$timestampS);
$mms=date("m",$timestampS);
$dds=date("d",$timestampS);


$yy=date("Y",$timestampC);
$mm=date("m",$timestampC);
$dd=date("d",$timestampC);

$yy2=date("Y",$timestamp60);
$mm2=date("m",$timestamp60);
$dd2=date("d",$timestamp60);

  $myCalendar = new tc_calendar("LengthofAssessment", true, false);
  //$myCalendar->setIcon("calendar/images/iconCalendar.gif");
  $myCalendar->setDate($dds, $mms, $yys);
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
<div style="padding-left:0px;" class="col-12">
<label>Frequency of Reminders *</label><br>
<select name="FrequencyofReminders" id="FrequencyofReminders">
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

<div class="mt-3"><label>First Name *</label><input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name"></div>
<div class="mt-3"><label>Last Name *</label><input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name"></div>
<div class="mt-3"><label>Email Address *</label><input type="text" id="email" name="email" class="form-control" placeholder="Enter your email address"></div>
<div class="mt-3"><label>Where Worked Together? </label><input type="text" id="wwt" name="wwt" class="form-control" placeholder="Enter detail"></div>
<div class="mt-3"><label>If never worked together is this a mentor? </label><input type="text" id="mentor" name="mentor" class="form-control" placeholder="If never worked together is this a mentor?"></div>
<div class="mt-3"><label>Is this person a peer? </label><input type="text" id="peer" name="peer" class="form-control" placeholder="Is this person a peer?"></div>
<div class="mt-3 text-center"><input type="submit" class="btn btn-primary" value="Invite" id="invite_users" name="invite_users"></div>
</form>
</div>
</div>
</div>
</div>

<script type="text/javascript">
var order_id = <?php echo $order_id;?>;


</script>