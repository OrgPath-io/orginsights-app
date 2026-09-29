    <div class="page-banner">
        <div class="container clearfix">
            <h1>Login</h1>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="register-column">
                <form id="form_login" name="form_login" method="Post">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="register-form p-0">
                                <div class="common-form">
                                        <div class="form-group">
										
										<?php if($error != ''){?> <div style="text-align: center;"><span class="general_instruction" style="color:red; font-weight: bold;"><?php echo $error;?></span><br/></div><?php }?>
                                            <label>Email Address</label>
                                            <div class="req-icon-col">
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="req-icon-col">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter 6 digit password">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                   
                    <div class="col-md-10 form-group text-center bottomBtns bottomBtns2">
					<div class="col-md-4">&nbsp;</div>
						<div>
							<button style="padding-left:75px;padding-right:75px;" type="submit" class="btn btn-secondary btn-style-2">Login</button>
						</div>
						<div>					
							<center><span class="ortext">OR</span></center>
						</div>
						<div>					
							 <a href="<?php echo base_url();?>register" class="btn btn-secondary btn-style-2">Register</a>
						</div>	 
						<div style="clear:both;"></div>
                    </div>
					<div style="clear:both;"></div>
					<div class="form-group text-center bottomBtns">
						<a href="<?php echo base_url();?>forgotpassword" class="text-danger">Forgot Password?</a>
					</div>
                </form>
                
            </div>

        </div>
