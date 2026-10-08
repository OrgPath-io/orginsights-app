<?php
include("includes/header.php");
?>
<?php

$tablevalue="packages";

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}


$p_name="";
$price="";


$formactionqs="";
$whereq="";

if($id!=0)
{
$whereq="where p_id=".$id;
$formactionqs="?id=".$id;



}



if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{
	
	
	$checkp_names="";
	if($checkp_names!="")
	{
		echo "<center><font color='red'>Assessment Name already exists</font></center>";

		$p_name=$_POST['p_name'];
		$price=$_POST['price'];
		
		

	}
	else
	{
		
		$fieldname=array();
		$fieldvalue=array();
		
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
				
				
					$ThanksText="<p align='center' class='thankstext'>Price Added</p>";
					
				
			}
			else
			{
				//$dbupdate=dbupdate($tablevalue,$fieldname,$fieldvalue,$whereq);
				$con->where('p_id', (int)$id);
				$con->update($tablevalue);
				
				
					$ThanksText="<p align='center' class='thankstext'>Price Updated</p>";
					
				
			}		
			
			
		}
	
	}


}
if($id!=0)
{

$con->where('p_id', $id);
$checkp_namesQ=$con->get($tablevalue);

$checkp_names=$checkp_namesQ->row_array();
	if($checkp_names!="")
	{
		
		$p_name=$checkp_names['p_name'];
		$price=$checkp_names['price'];
		
		

	}


}
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Assessment Prices</h4></div>
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
										<?=$p_name;?>
										</div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<input type="text" name="price" id="price" value="<?=$price;?>"  placeholder="Price*" class="form-control validate[required] span12" required>
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
								<input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/assessmentprices/'"> 
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