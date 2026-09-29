<div class="page-banner">
<div class="container clearfix">
<h1>Mail Message</h1>
<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
</div>
</div>

<div class="section">
<div class="container">
<div class="col-md-2">&nbsp;</div>
<div class="col-md-8">
<?php
$con=$this->db;
$yesno_array=array("No","Yes");
?>	
                    <div id="generated"></div>
<?php
$month_array=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

$user_id=(int)$this->session->userdata('user_id');
					
if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{

	if(isset($_POST["Insertvalues"]) && $_POST["Insertvalues"]==1)
	{
						include("setmessage.php");
						
						//echo $sql; die();	
							
							//echo $con->error(); die();
							
	}
	?>
	<script type="text/javascript">
	alert("<?php echo $ThanksText;?>");
	location.href="<?php echo base_url(); ?>"
	</script>
	<?php
	die();
}
if($user_id > 0)
{
	$sql = "Select * from Mail_messages where user_id=".$user_id." order by ID desc";
	$resultT = $con->query($sql);
	$row=$resultT->row_array();
	if($row!="")
	{
		
		$Message=$row['Message'];
		$cc=$row['cc'];
		$bcc=$row['bcc'];
		$Section=$row['Section'];
		$TemplateName=$row['TemplateName'];
		
	}
}	
?>
<script type="text/javascript">
// Toggle form display
function showForm(formName) 
{
	$(formName).slideDown(1000).siblings('.register').hide();
}
</script>					

                    <form action="?id=<?php echo $ID;?>" method="post" name="adminform" class="register1" id="adminform" enctype="multipart/form-data">
						 
											

                        <div class="row">
						
								

                            <div class="col-lg-9">
                                <?php echo $ThanksText;?>
								
								<div class="form-group">
								<label>Template Name</label>
								<input type="text" name="TemplateName" id="TemplateName" value="<?php echo $TemplateName;?>" class="form-control span12" required>
								</div>
								
								<div class="form-group">
								<label>Subject</label>
								<input type="text" name="Section" id="Section" value="<?php echo $Section;?>" class="form-control span12" required>
								</div>
								
								<script language="javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
								<div class="form-group">
								<label>Message</label>
								<textarea name="Message" id="Message"><?php echo $Message;?></textarea>
								<script type="text/javascript">
								//<![CDATA[

									// This call can be placed at any point after the
									// <textarea>, or inside a <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><script> in a
									// window.onload event handler.

									// Replace the <textarea id="editor"> with an CKEditor
									// instance, using default configurations.
									CKEDITOR.replace( 'Message' );

								//]]>
								</script>

								</div>
								<?php /*
								<div class="form-group">
								<label>CC</label>
								<br>(separate each email by comma)
								<input type="text" name="cc" id="cc" value="<?php echo $cc;?>" class="form-control span12">
								</div>
								
								<div class="form-group">
								<label>BCC</label>
								<br>(separate each email by comma)
								<input type="text" name="bcc" id="bcc" value="<?php echo $bcc;?>" class="form-control span12">
								</div>
								*/?>
								
								
                        </div>
                            
                            

                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                               
								<input type="hidden" name="user_id" value=<?php echo (int)$this->session->userdata('user_id');?>>
                                <input type="hidden" name="Insertvalues" value=1>
								<input type="hidden" name="submitform" value=1>
								<input type="submit" class="btn btn-primary btn-lg" value="Submit"> 

                            </div>

                        </div>

                    </form>
					<div id="reg_family" class="register hide"></div>
					


<script type="text/javascript">
/*
// Form validation hook
$(document).ready(function() 
{
	$("form").validationEngine('attach'); // Validation script
});
*/

</script>
</div>
<div class="col-md-2">&nbsp;</div>
</div>

</div>