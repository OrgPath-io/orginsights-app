<?php
include("includes/header.php");
?>
<?php
$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
$yesno=array("No","Yes");

$tablevalue="IndustryCapabilities";



$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}



$IndustryName="";
$isActive=0;
$categoryID=0;
$capabilityID=0;

$formactionqs="";
$whereq="";

if($id!=0)
{
$whereq="where id=".$id;
$formactionqs="?id=".$id;



}



if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{
	
	
	$con->where('IndustryName', $_POST['IndustryName']);
	$con->where('id!=', $id);
	$checkIndustryNamesQ=$con->get($tablevalue);
	
	//echo "ok"; die();
	
	$checkIndustryNames=$checkIndustryNamesQ->row_array();
	$checkIndustryNames="";
	if($checkIndustryNames!="")
	{
		echo "<center><font color='red'>Industry Name already exists</font></center>";

		$IndustryName=$_POST['IndustryName'];
		$IndustryName_typeID=$_POST['IndustryName_typeID'];
		$categoryID=$_POST['categoryID'];
		$capabilityID=$_POST['capabilityID'];
		$isActive=$_POST['isActive'];
		
		
		

	}
	else
	{
	
		
		
		$fieldname=array();
		$fieldvalue=array();
		
		foreach($_POST as $key=>$value)
		{
			
			if($key!="submitform" && $key!="insertform")
			{
			
								
						$fieldname[]=$key;
						$fieldvalue[]=$value;
					
					
					
			}
		}
		
		//print_r($fieldname); die();
		
		if(isset($_POST["insertform"]) && $_POST["insertform"]==1)
		{
		
			foreach($fieldname as $key=>$value)
			{
				$con->set($value, $fieldvalue[$key]);
			}
		
		
			if($whereq=="")
			{
		
				//$dbinsert=dbinsert($tablevalue,$fieldname,$fieldvalue);
				$dbinsert=$con->insert($tablevalue);
				$id=$con->insert_id();
				
				$ThanksText="<p align='center' class='thankstext'>Industry Capability Added</p>";
				
				//$ThanksText.="<br>".$id;
				
				
					
				
			}
			else
			{
				//$dbupdate=dbupdate($tablevalue,$fieldname,$fieldvalue,$whereq);
				$con->where('id', $id);
				$con->update($tablevalue);
								
				foreach($fieldname as $key=>$value)
				{
					$con->set($value, $fieldvalue[$key]);
					
				}
				
				
					$con->where('id', (int)$id);
					$con->update($tablevalue);
				
				
				$ThanksText="<p align='center' class='thankstext'>Industry Capability Updated</p>";
					
				
			}		
			
			
		}
	
	}


}


if($id!=0)
{

$con->where('id', $id);
$checkIndustryNamesQ=$con->get($tablevalue);

$checkIndustryNames=$checkIndustryNamesQ->row_array();
	if($checkIndustryNames!="")
	{
		
		$IndustryName=$checkIndustryNames['IndustryName'];
		$categoryID=$checkIndustryNames['categoryID'];
		$capabilityID=$checkIndustryNames['capabilityID'];
		$isActive=$checkIndustryNames['isActive'];
		
	}
	
	

}
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Add Industry Capability</h4></div>
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
								
								<div style="float:left;" class="col-lg-12">
										<div class="form-group">
										<label>Industry Name</label>
										<input type="text" name="IndustryName" id="IndustryName" value="<?=$IndustryName;?>"  placeholder="Industry Name*" class="form-control validate[required] span12" required>
										
										</div>
								</div>
								<div style="clear:both;"></div>
								
								
								
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>Category</label>
										<select name="categoryID" id="cat_id" class="form-control validate[required] span12" required>
										<option value="">Category</option>
										<?php
										$con->order_by("cat_name");
										$checkrecQ=$con->get("categories");
										$checkrec=$checkrecQ->row_array();
										foreach ($checkrecQ->result_array() as $checkrec)
										{
											$slct="";
											if($checkrec["cat_id"]==$categoryID)
											{
												$slct="selected";
											}
										?>	
										<option value="<?php echo $checkrec["cat_id"];?>" <?php echo $slct;?>><?php echo $checkrec["cat_name"];?></option>
										<?php	
										}
										?>
										</select>
										</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>Capability</label>
										<select name="capabilityID" id="cap_id" class="form-control validate[required] span12" required>
										<option value="">Capability</option>
										<?php
										$con->order_by("cap_name");
										$checkrecQ=$con->get("capabilities");
										$checkrec=$checkrecQ->row_array();
										foreach ($checkrecQ->result_array() as $checkrec)
										{
											$slct="";
											if($checkrec["cap_id"]==$capabilityID)
											{
												$slct="selected";
											}
										?>	
										<option value="<?php echo $checkrec["cap_id"];?>" <?php echo $slct;?>><?php echo $checkrec["cap_name"];?></option>
										<?php	
										}
										?>
										</select>
										</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">
								<div class="form-group">
								<label>isActive</label>
<select name="isActive" id="isActive" class="form-control validate[required] span12">										
									<?php
foreach($yesno as $key=>$value)
{
	$slct="";
	
	if($isActive==$key)
	{
		$slct="selected";
	}
?>	
<option value="<?php echo $key;?>" <?php echo $slct;?>><?php echo $value;?></option>
<?php
}
?>
</select>
</div></div>

<div style="clear:both;"></div>
								
								
                        </div>
                            
                            

                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                               
								<div class="col-lg-12">
                                <p><small>Fields with a * are required</small></p>
                                <input type="hidden" name="insertform" id="insertform" value=1>
								<input type="hidden" name="submitform" value=1>
								<input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/industrycapabilities/'"> 
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