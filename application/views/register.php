<?php
include("RecaptchaConfirm.php");
?>
    <div class="page-banner">
        <div class="container clearfix">
            <h1>Register</h1>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="register-column">
            <form id="form_register" name="form_register" method="Post">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="register-form p-0">
                            <div class="common-form">
                                
                                    <div class="form-heading text-center">
                                        <h4>Enter your details</h4>
                                        <p>We dont use your details for marketing purposes</p>
                                    </div>
									<?php if($error != ''){?> <div style="text-align: center;"><span class="general_instruction" style="color:red; font-weight: bold;"><?php echo $error;?></span><br/></div><?php }?>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" required>
                                            <span class="req-icon">*</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" required>
                                            <span class="req-icon">*</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <div class="req-icon-col">
                                            <input type="email" class="form-control" placeholder="Enter your email address" name="email" id="email" required>
                                            <span class="req-icon">*</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="req-icon-col">
                                            <select class="form-control" name="country" id="country" required>
											<option value="">Country</option>
											<?php
												foreach($country as $row)
												{
											?>
												<option value=<?php echo $row['id'];?>><?php echo $row['country'];?></option>
											<?php
												}
											?>	
											</select>
                                            <p><small>We collect this information to ensure we comply to your countries local data protection/storage guidelines</small></p>
                                            <span class="req-icon">*</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="req-icon-col">
                                            <input type="password" class="form-control" minlength="6" placeholder="Enter 6 digit password" name="password" id="password" required>
                                            <span class="req-icon">*</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <div class="req-icon-col">
                                            <input type="password" class="form-control" minlength="6" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required>
                                            <span class="req-icon">*</span>
                                        </div>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="refferal-discount common-form mb-5 mt-4">
                 <div class="row justify-content-center">
                 <div class="col-md-7">
                <div class="form-group">
                                        <label>Referrals and Discount</label>
                                        <div class="req-icon-col">
                                            <input type="text" class="form-control" placeholder="Enter Referral here" name="referral" id="referral">
                                        </div>
                                    </div>
									<div class="form-group">
									<input type="checkbox" value=1 required>&nbsp;I have read the <a href="<?php echo base_url();?>privacy" target="_blank">Privacy Policy</a> and <a href="<?php echo base_url();?>terms" target="_blank">Terms of Service</a> for Orglnsights (subsidiary of OrgPath) and agree to the terms outlined. 

									</div>
                </div>
                </div>
                </div>
                
                <div class="form-group text-center">
				<input type="hidden" name="self" value=1>
				<center>
				<div class="g-recaptcha" data-sitekey="<?php echo $RecaptchaSiteKey;?>"></div>
				<p>&nbsp;</p>
				</center>
                                        <button type="submit" class="btn btn-secondary btn-style-2" name="submit_register" id="submit_register">REGISTER NOW</button>
                                    </div>
                                </form>
                
            </div>

        </div>
    </div>
