<?php
include("includes/header.php");
?>
<?php

$tablevalue="AssessmentCosts";

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}


$assessmentName="";
$originalPrice="";
$discountedPrice="";


$formactionqs="";
$whereq="";

if($id!=0)
{
$whereq="where id=".$id;
$formactionqs="?id=".$id;



}

if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{
	
	$con->where('assessmentName', $_POST['assessmentName']);
	$con->where('id!=', $id);
	$checkassessmentNamesQ=$con->get($tablevalue);
	
	$checkassessmentNames=$checkassessmentNamesQ->row_array();

	if($checkassessmentNames!="")
	{
		echo "<center><font color='red'>Assessment Name already exists</font></center>";

		$assessmentName=$_POST['assessmentName'];
		$originalPrice=$_POST['originalPrice'];
		$discountedPrice=$_POST['discountedPrice'];
		
		

	}
	else
	{
		
		$fieldname=array();
		$fieldvalue=array();
		$lawyerfieldname=array();
		$lawyerfieldvalue=array();
		
		foreach($_POST as $key=>$value)
		{
			if($key!="submitform" && $key!="insertform" && $key!="ConfirmPassword" && $key!="attcimage" && $key!="removeimage")
			{
			
								
						$fieldname[]=$key;
						$fieldvalue[]=$value;
					
					
					
			}
		}
		
		
		if(isset($_POST["insertform"]) && $_POST["insertform"]==1)
		{
		
			foreach($fieldname as $key=>$value)
			{
				$con->set($value, $fieldvalue[$key]);
			}
		
		
			if($whereq=="")
			{
		
				//$dbinsert=dbinsert($tablevalue,$fieldname,$fieldvalue);
				$con->insert($tablevalue);
				
				
					$ThanksText="<p align='center' class='thankstext'>Assessment Details Added</p>";
					
				
			}
			else
			{
				//$dbupdate=dbupdate($tablevalue,$fieldname,$fieldvalue,$whereq);
				$con->where('id', $id);
				$con->update($tablevalue);
				
				
					$ThanksText="<p align='center' class='thankstext'>Assessment Details Updated</p>";
					
				
			}		
			
			
		}
	
	}


}
if($id!=0)
{

$con->where('id', $id);
$checkassessmentNamesQ=$con->get($tablevalue);

$checkassessmentNames=$checkassessmentNamesQ->row_array();
	if($checkassessmentNames!="")
	{
		
		$assessmentName=$checkassessmentNames['assessmentName'];
		$originalPrice=$checkassessmentNames['originalPrice'];
		$discountedPrice=$checkassessmentNames['discountedPrice'];
		
		

	}


}
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Assessment Costs</h4></div>
<script type="text/javascript">
// Toggle form display
function showForm(formName) 
{
	$(formName).slideDown(1000).siblings('.register').hide();
}
</script>					

                    <form action="#" method="post" name="adminform" class="register1" id="adminform" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-lg-12">
							
								<div class="col-lg-12">
                                <?php echo $ThanksText;?><br>
								</div>
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<input type="text" name="assessmentName" id="assessmentName" value="<?=$assessmentName;?>"  placeholder="Assessment Name*" class="form-control validate[required] span12" required>
										</div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<input type="text" name="originalPrice" id="originalPrice" value="<?=$originalPrice;?>"  placeholder="Original Price*" class="form-control validate[required] span12" required>
										</div>
								</div>
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<input type="text" name="discountedPrice" id="discountedPrice" value="<?=$discountedPrice;?>"  placeholder="Discounted Price*" class="form-control validate[required] span12" required>
										</div>
								</div>
																
								
								
								<div style="clear:both;"></div>
																
								
								
								
                        </div>
                            
                            

                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                               
								<div class="col-lg-12">
                                <p><small>Fields with a * are required</small></p>
                                <input type="hidden" name="insertform" id="insertform" value=1>
								<input type="hidden" name="submitform" value=1>
								<input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/assessmentcosts/'"> 
								</div>

                            </div>

                        </div>

                    </form>
					<div id="reg_family" class="register hide"></div>
<script type="text/javascript">
// Form validation hook
$(document).ready(function() 
{
	$("form").validationEngine('attach'); // Validation script
});


	
</div>
<?php
include("includes/footer.php");
?>