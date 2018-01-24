<?php include_once('../admin_includes/config.php');
	include_once('../admin_includes/common_functions.php');
	$getSiteSettings = getAllDataWhere('services_site_settings','id','1'); 
    $getSiteSettingsData = $getSiteSettings->fetch_assoc();
?>
<div id="top_line">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong><a href="Tel:<?php echo $getSiteSettingsData['mobile']; ?>" style="color:white;"><?php echo $getSiteSettingsData['mobile']; ?></a></strong>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-6">
						<ul id="top_links">
							<li>
								<div class="dropdown dropdown-access">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="access_link">Sign in</a>
									<div class="dropdown-menu">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<a href="#" class="bt_facebook">
													<i class="icon-facebook"></i>Facebook </a>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<a href="#" class="bt_paypal">
													<i class="icon-google"></i>Google</a>
											</div>
										</div>
										<div class="login-or">
											<hr class="hr-or">
											<span class="span-or">or</span>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" id="inputUsernameEmail" placeholder="Email">
										</div>
										<div class="form-group">
											<input type="password" class="form-control" id="inputPassword" placeholder="Password">
										</div>
										<a id="forgot_pw" href="#">Forgot password?</a>
										<input type="submit" name="Sign_in" value="Sign in" id="Sign_in" class="button_drop">
										<input type="submit" name="Sign_up" value="Sign up" id="Sign_up" class="button_drop outline">
									</div>
								</div>
								<!-- End Dropdown access -->
							</li>
                                                        <li><a href="#" id="wishlist_link">Register</a></li>
                                                        
						</ul>
					</div>
				</div>
				<!-- End row -->
			</div>
			<!-- End container-->
		</div>