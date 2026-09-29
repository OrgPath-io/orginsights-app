<?php


$con=$this->db;
$user_id=(int)$this->session->userdata('user_id');
$first_name=$this->session->userdata('first_name');
$last_name=$this->session->userdata('last_name');
$MessageID=$this->session->userdata('MessageID');


$ID=0;
$TemplateName="Default";
$Section="360 Assessment for ".$first_name." ".$last_name;
$Message="<p>Hi [First Name]<br><br>
How are you doing? Hope you are keeping well. I am reaching out to you because as part of my career development I am looking and getting a better understanding of how individuals I worked with/worked for perceive my current capabilities level to be based on my experience working with me. 
</p><p>
The goal of this assessment is to identify key areas of strengths and weaknesses and blind spots to help me better develop a strategy to address any concerns and become a stronger employee, team member and leader. As we have worked together I thought you would be in the unique position to be able to provide this feedback. 
</p><p>
You will find the link below, and it will not take more than 15-20 mins to complete. As well, all the feedback in anonymous and although you will be able to provide feedback, i will never know who it comes from or any information that can be used to identify you. 
</p><p>
I wanted to thank you in advance for you help! 
<br>Click <a href='".base_url()."assessment/thirdparty_rater/' target='blank'> here </a> to give assessment.<br>

<br>Sincerely,<br>".$first_name." ".$last_name."</p>";

$sql = "Select * from Mail_messages where user_id=".$user_id." and MsgType=1 order by ID desc";

$resultT = $con->query($sql);
$resultQ = $resultT->result_array();

foreach($resultQ as $row)
{
	
	$ID=$row['ID'];
	$Message=$row['Message'];
	$Section=$row['Section'];
	$TemplateName=$row['TemplateName'];
}




?>
<script type="text/javascript">
const TemplateNameA=["<?php echo $TemplateName;?>",""];
const SectionA=["<?php echo $Section;?>",""];
const MessageA=["<?php echo $Message;?>",""];

</script>
<span class="questionContent"><strong>MAIL MESSAGE</strong></span>
<br><br>
<div style="display:none;" class="form-group">
<br>
<label>Select or Create a New Template</label>
<select name="ID" id="ID" class="form-control span12" onchange="changemessage(this.value)">
<option value=<?php echo (int)$ID;?>>Default</option>
<option value=-1>Create a new template</option>
<?php

$TemplateNameA=array(0,0);
$SectionA=array(0,0);
$MessageA=array(0,0);

$T1="";
$T2="360 Assessment for ".$first_name." ".$last_name;
$T3=$Message;

$cnt=1;
$sql = "Select * from Mail_messages where user_id=".$user_id." and MsgType=0 order by ID desc limit 0,1";
$sql = "Select * from Mail_messages where user_id=".$user_id." order by ID desc limit 0,1";


	$resultT = $con->query($sql);
	
	$resultQ = $resultT->result_array();

	foreach($resultQ as $row)
	{
		$ID=$row['ID'];
		$Message=$row['Message'];
		$Section=$row['Section'];
		$TemplateName=$row['TemplateName'];
		
		
		$T1=$TemplateName;
		$T2=$Section;
		$T3=$Message;
		
		$slct="";
		if((int)$MessageID==$ID)
		{
			//$slct="selected";
		}
		$cnt++;
		
		$TemplateNameA[(int)$cnt]=$TemplateName;
		$SectionA[(int)$cnt]=$Section;
		$MessageA[(int)$cnt]=$Message;
		?>
		<option value=<?php echo (int)$ID;?> <?php echo $slct;?>><?php echo $TemplateName;?></option>
		<?php
		
		
	}
?>
</select>

</div>
<?php
$cnt=0;
foreach($TemplateNameA as $key=>$value)
{
	if($cnt > 1)
	{
?>	
<script>
		TemplateNameA.push("<?php echo $value;?>");
		SectionA.push("<?php echo $SectionA[$key];?>");
		
		var myString = function(){/*
    <?php echo $MessageA[$key];?>
*/}.toString().slice(14,-3)
		
		
		MessageA.push(myString);
		
</script>		
<?php
	}
	$cnt++;
}


if((int)strpos($T3,"thirdparty_rater")==0)
{
	$T3=str_replace("Sincerely","<br>Click <a href='".base_url()."assessment/thirdparty_rater/' target='blank'> here </a> to give assessment.<br><br>Sincerely",$T3);
}
?>
<div id="messageform" style="display:block;">

								
								<div class="form-group">
								<span class="questionContent"><strong>Subject</strong></span>
								<br>
								<span class="general_instruction">
								What the title of the email will be, we recommend you do not change the title</span>
								<br><br>
								<input width="100%" type="text" name="Section" id="Section" value="<?php echo $T2;?>" class="form-control span12" required>
								</div>
								
								<script language="javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
								<div class="form-group">
								<span class="questionContent"><strong>Message</strong></span>
								<br>
								<span class="general_instruction">
What the emails that your invitees will receive will say<br>
<font style="font-size:12px;color:red;font-weight:bold;">Note:</font> <font style="font-size:12px">Do not edit the [First Name] field - it is a smart field that pulls your invitees first name into the email
</font>
								</span>
								<br><br>
								<!--<br>Hi [First Name]-->
								<textarea name="Message" id="Message"><?php echo $T3;?></textarea>
								<?php /*Sincerely,<br>
								<?php echo $first_name." ".$last_name; */?>
								<script type="text/javascript">
								//<![CDATA[

									// This call can be placed at any point after the
									// <textarea>, or inside a <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><script> in a
									// window.onload event handler.

									// Replace the <textarea id="editor"> with an CKEditor
									// instance, using default configurations.
									CKEDITOR.replace( 'Message',{toolbar:'MA'});

								//]]>
								CKEDITOR.config.toolbar_MA = [ ['Cut','Copy','Paste','-','Undo','Redo','RemoveFormat','-','Link','Unlink','Anchor'], '-', ['Format','Bold','Italic','Underline','-','Superscript','-',['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], '-','NumberedList','BulletedList','-','Outdent','Indent'] ];
								</script>

								</div>
								<div style="display:none;" class="form-group">
								<label>Save Template As</label>
								<input type="text" name="TemplateName" id="TemplateName" value="Default" class="form-control span12" required><input type="button" value="Save Template" onclick="submitmform()">
								</div>
</div>
<div style="display:none;">	
<iframe id='savemessageid' src="<?php echo base_url();?>savemessage" style="width:1px;height:1px;"></iframe>		
</div>
<script>
//alert(TemplateNameA);

function changemessage(n1)
{
	/*
	n2=document.getElementById("ID").selectedIndex;
	
	if(n2==0)
	{
		document.getElementById("messageform").style.display="block";
		document.getElementById("TemplateName").value=TemplateNameA[0];
		document.getElementById("Section").value=SectionA[0];
		//document.getElementById("Message").value=myString;
		CKEDITOR.instances["Message"].setData(MessageA[0]);
	}
	else if(n2==1)
	{
		document.getElementById("messageform").style.display="block";
		document.getElementById("TemplateName").value="";
		document.getElementById("Section").value="";
		document.getElementById("Message").value="";
	}
	else if(n2 > 1)
	{
		
    //alert(MessageA[n2]);
	//var myString ="HamfR";

		document.getElementById("messageform").style.display="block";
		document.getElementById("TemplateName").value=TemplateNameA[n2];
		document.getElementById("Section").value=SectionA[n2];
		//document.getElementById("Message").value=myString;
		CKEDITOR.instances["Message"].setData(MessageA[n2]);
	}
	document.getElementById("savemessageid").src="<?php echo base_url();?>savemessage/"+n1;
	*/
}

//changemessage("<?php (int)$MessageID;?>");		
		
</script>				