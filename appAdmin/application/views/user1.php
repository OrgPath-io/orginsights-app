<?php
include("includes/header.php");
?>
<?php

$tablevalue="users";

//


//

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}

$addedit="Add ";
if($id!=0)
{
$whereq="where user_id=".$id;
$formactionqs="?id=".$id;

$addedit="Edit ";

}

?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4><?php echo $addedit;?>User <?php echo $NAME;?></h4></div>
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
								<center>
                                <?php echo $ThanksText;?><br>
								</center>
								</div>
								<div style="clear:both;"></div>
								<!---->
								<div style="float:left;" class="col-lg-6">
									<div class="form-group">
                                        <label><span class="req-icon">*</span> First Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" value="<?php echo $first_name;?>" required>
                                            
                                        </div>
                                    </div>
								</div>	
								<div style="float:left;" class="col-lg-6">	
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Last Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="<?php echo $last_name;?>" required>
                                            
                                        </div>
                                    </div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Email Address</label>
                                        <div class="req-icon-col">
                                            <input type="email" class="form-control" placeholder="Enter your email address" name="email" id="email" value="<?php echo $email;?>" required>
                                            
                                        </div>
                                    </div>
                                </div>	
								<?php
								if($id==0)
								{
								?>
								<div style="float:left;" class="col-lg-6">
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Password</label>
                                        <div class="req-icon-col">
                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="" required>
                                            
                                        </div>
                                    </div>
                                </div>
								<?php
								}
								else
								{
								?>
								<div style="float:left;" class="col-lg-6"> <div class="form-group">
																<label>Change Password</label>
								<select name="ChangePassword" id="ChangePassword" class="form-control span12">										
																	<?php
								foreach($yesno as $key=>$value)
								{
									$slct="";
									
									if($key==0)
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
								<?php
								}
								?>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">   
                                    <div class="form-group">
                                        <label><span class="req-icon">*</span> Country</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="country_id" id="country" onchange="show_province(this.value,'Province','')" required>
											<option value="">Country</option>
											<?php
												foreach($country as $row)
												{
													$slct="";
													if($row['id']==(int)$country_id)
													{
														$slct="selected";
													}
											?>
												<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['country'];?></option>
											<?php
												}
											?>	
											</select>
                                            
                                            
                                        </div>
                                    </div>
								</div>
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
									<label>Province</label>
									<select name="province" id="Province" class="form-control" onchange="show_cities(this.value,'cities')">
									<option value=0>Select Province</option>
									<?php
										foreach($Province as $row)
										{
											$slct="";
											if($row['id']==(int)$province)
											{
												$slct="selected";
											}
											
									?>
										<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['province_name'];?></option>
									<?php
										}
									?>	
									</select>
									</div>
								</div>	
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-6">	
									<div class="form-group">
                                        <label>City</label>
									<select name="city" id="cities" class="form-control span12">
									<option value=0>Select City</option><?php
										foreach($Cities as $row)
										{
											$slct="";
											if($row['id']==(int)$city)
											{
												$slct="selected";
											}
											
									?>
										<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['description'];?></option>
									<?php
										}
									?>										
									</select>
									</div>	
								</div>
								
								<div style="float:left;" class="col-lg-6"> <div class="form-group">
								<label>Is Active</label>
<select name="is_active" id="is_active" class="form-control span12">										
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
								<!---->
<p align="center">
<input type="hidden" name="insertform" id="insertform" value=1>
<input type="hidden" name="submitform" value=1>
<input type="submit" class="btn btn-primary btn-lg" value="Submit"> 
</p>								
							</div>	
						</div>
					</form>		
</div>
<script>
function show_province(n1,fieldname,n2)
{
	
	document.getElementById("cities").options.length = 0;
	var select1 = document.getElementById("cities");

	select1.options[select1.options.length] = new Option("Select City", '');
	
	Getpages("<?php echo ORGURL;?>/provincelistR.php?p="+n1,fieldname);
	
	

}
function show_cities(n1,fieldname)
{
	Getpages("<?php echo ORGURL;?>/citylistR.php?p="+n1,"cities");
}



</script>

<?php
include("includes/footer.php");
?>