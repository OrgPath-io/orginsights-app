<?php
include("includes/header.php");
?>
<?php
$ReferralTypes=array("percentage","value");

$tablevalue="ReferralCodes";

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}


$ReferralCode="";
$ReferralValue="";
$ReferralType="";
$isActive=0;

$first_name="";
$last_name="";
$email="";
$company_name="";


$formactionqs="";
$whereq="";

if($id!=0)
{
$whereq="where id=".$id;
$formactionqs="?id=".$id;



}

if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{
	
	$con->where('ReferralCode', $_POST['ReferralCode']);
	$con->where('id!=', $id);
	$checkReferralCodesQ=$con->get($tablevalue);
	
	$checkReferralCodes=$checkReferralCodesQ->row_array();

	if($checkReferralCodes!="")
	{
		echo "<center><font color='red'>ReferralCode already exists</font></center>";

		$ReferralCode=$_POST['ReferralCode'];
		$ReferralValue=$_POST['ReferralValue'];
		$ReferralType=$_POST['ReferralType'];
		$isActive=$_POST['isActive'];
		
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$email=$_POST['email'];
		$company_name=$_POST['company_name'];
		

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
				
				
					$ThanksText="<p align='center' class='thankstext'>ReferralCode Added</p>";
					
				
			}
			else
			{
				//$dbupdate=dbupdate($tablevalue,$fieldname,$fieldvalue,$whereq);
				$con->where('id', $id);
				$con->update($tablevalue);
				
				
					$ThanksText="<p align='center' class='thankstext'>ReferralCode Updated</p>";
					
				
			}		
			
			
		}
	
	}


}
if($id!=0)
{

$con->where('id', $id);
$checkReferralCodesQ=$con->get($tablevalue);

$checkReferralCodes=$checkReferralCodesQ->row_array();
	if($checkReferralCodes!="")
	{
		
		$ReferralCode=$checkReferralCodes['ReferralCode'];
		$ReferralValue=$checkReferralCodes['ReferralValue'];
		$ReferralType=$checkReferralCodes['ReferralType'];
		$isActive=$checkReferralCodes['isActive'];
		
		$first_name=$checkReferralCodes['first_name'];
		$last_name=$checkReferralCodes['last_name'];
		$email=$checkReferralCodes['email'];
		$company_name=$checkReferralCodes['company_name'];
		

	}


}
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Referral Code</h4></div>
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
										<input type="text" name="ReferralCode" id="ReferralCode" value="<?=$ReferralCode;?>"  placeholder="Referral Code*" class="form-control validate[required] span12" required>
										</div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<input type="text" name="ReferralValue" id="ReferralValue" value="<?=$ReferralValue;?>"  placeholder="Value*" class="form-control validate[required] span12" required>
										</div>
								</div>
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-6">Referral Type<span class="requiredspan">*</span></div>
								<div style="clear:both;"></div>
								
								
								
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
<select name="ReferralType" id="ReferralType" class="form-control validate[required] span12">										
									<?php
foreach($ReferralTypes as $key=>$value)
{
	$slct="";
	
	if($ReferralType==$value)
	{
		$slct="selected";
	}
?>	
<option value="<?php echo $value;?>" <?php echo $slct;?>><?php echo $value;?></option>
<?php
}
?>
</select>
										</div>
								</div>
																
								
								
								<div style="clear:both;"></div>
								
								<!---->
								<div style="float:left;" class="col-lg-6">
									<div class="form-group">
                                        <label><span class="req-icon"></span> First Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="<?php echo $first_name;?>">
                                            
                                        </div>
                                    </div>
								</div>	
								
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-6">	
                                    <div class="form-group">
                                        <label><span class="req-icon"></span> Last Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="<?php echo $last_name;?>">
                                            
                                        </div>
                                    </div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">
                                    <div class="form-group">
                                        <label><span class="req-icon"></span> Email Address</label>
                                        <div class="req-icon-col">
                                            <input type="email" class="form-control" placeholder="Enter your email address" name="email" id="email" value="<?php echo $email;?>">
                                            
                                        </div>
                                    </div>
                                </div>
								
								<div style="clear:both;"></div>
																
								<div style="float:left;" class="col-lg-6">	
                                    <div class="form-group">
                                        <label><span class="req-icon"></span> Company Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="Company Name" name="company_name" id="company_name" value="<?php echo $company_name;?>">
                                            
                                        </div>
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
								<input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/referralcodes/'"> 
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