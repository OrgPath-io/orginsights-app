<div class="page-banner">
	<div class="container clearfix">
		<h1>Forgot Password</h1>
	</div>
</div>

<div class="section">
	<div class="container">
		<div class="register-column">
			<form id="forgot_password" name="forgot_password" method="Post">
				<div class="row justify-content-center">
					<div class="col-md-7">
						<div class="register-form p-0">
							<div class="common-form">
								<div class="form-group">

									<?php if($error != ''){?> <div style="text-align: center;"><span class="general_instruction" style="color:red; font-weight: bold;"><?php echo $error;?></span><br/></div><?php }?>
									<?php if($success != ''){?> <div style="text-align: center;"><span class="general_instruction" style="color:green; font-weight: bold;"><?php echo $success;?></span><br/></div><?php }?>
									<label>Email Address</label>
									<div class="req-icon-col">
										<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address">

									</div>
								</div>

							</div>
						</div>
					</div>


				</div>

				<div class="form-group text-center">
					<button type="submit" class="btn btn-secondary btn-style-2">Submit</button>
				</div>

			</form>

		</div>

	</div>
