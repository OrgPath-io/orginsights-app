<div class="page-banner">
	<div class="container clearfix">
		<h1>Set New Password</h1>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="register-column">
			<form id="set_new_password" name="set_new_password" method="Post">
				<div class="row justify-content-center">
					<div class="col-md-7">
						<div class="register-form p-0">
							<div class="common-form">

								<div class="form-heading text-center">
									<h4>Set New Password!</h4>

								</div>
								<?php if($error != ''){?> <div style="text-align: center;"><span class="general_instruction" style="color:red; font-weight: bold;"><?php echo $error;?></span><br/></div><?php }?>


										<input type="hidden" name="email" id="email" value="<?php echo $user->email;?>" >



								<div class="form-group">
									<label>New Password</label>
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



				<div class="form-group text-center">
					<button type="submit" class="btn btn-secondary btn-style-2" name="submit_register" id="submit_register">Update Password</button>
				</div>
			</form>

		</div>

	</div>
</div>
