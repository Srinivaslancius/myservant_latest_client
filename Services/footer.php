		<div class="container-fluid" style="line-height:28px">
			<div class="row">
			<div class="col-md-1">
			</div>
				<div class="col-md-3 col-sm-3">
					<h3>CONTACT US</h3>
					<a href="" id="location"><span class=" icon-location" style="font-size:25px"></span><?php echo $getSiteSettingsData['address']; ?></a>
					<a href="Tel:<?php echo $getSiteSettingsData['mobile']; ?>" id="phone"><?php echo $getSiteSettingsData['mobile']; ?></a>
					<a href="mailto:<?php echo $getSiteSettingsData['email'] ?>" id="email_footer"><span class="__cf_email__" data-cfemail="6109040d112102081518150e1413124f020e0c"><?php echo $getSiteSettingsData['email'] ?></span></a>
				</div>
				<div class="col-md-2 col-sm-3">
					<h3>QUICK LINKS</h3>
					<ul>
						<li><a href="about.php">About Us</a>
						</li>
						<li><a href="services.php">Services</a>
						</li>
						<li><a href="testimonials.php">Testimonials</a>
						</li>
						<li><a href="partners.php">Partners</a>
						</li>
						<li><a href="all_brands.php">Brands</a>
						</li>
						<li><a href="contactus.php">Contact Us</a>
						</li>
					</ul>
				</div>
				
				<div class="col-md-3 col-sm-3">
					<h3>CUSTOMER SERVICE</h3>
					<ul>
						<?php if(!isset($_SESSION['user_login_session_id'])) { ?>
						<li><a href="login.php">My Account</a>
						</li>
						<?php } else { ?>
						<li><a href="my_dashboard.php">My Account</a>
						</li>
						<?php } ?>
						<?php if(!isset($_SESSION['user_login_session_id'])) { ?>
						<li><a href="login.php">Track Order</a>
						</li>
						<?php } else { ?>
						<li><a href="my_dashboard.php">Track Order</a>
						</li>
						<?php } ?>
						<li><a href="help_center.php">Help Center</a>
						</li>
						<li><a href="delivery_areas.php">Delivery Areas</a>
						</li>
						<li><a href="terms_privacy_policy.php">Privacy Policy/Terms & Conditions</a>
						</li>
						<li><a href="return_policy.php">Return Policy</a>
						</li>
						<li><a href="user_feedback_form.php">Customer Feed Back</a>
						</li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-3">
					<h3>DOWNLOAD OUR APP</h3>
					<a href="<?php echo $getSiteSettingsData['android_app_link'] ?>"  target="_blank"><img src="img/googleplay.png"></a><br>
					<a href="<?php echo $getSiteSettingsData['apple_app_link'] ?>"  target="_blank"><img src="img/applestore.png" style="margin-top:10px"></a>
					
				</div>
			</div>
			<!-- End row -->
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div id="social_footer">
						<ul>
							<li><a href="<?php echo $getSiteSettingsData['fb_link'] ?>" target="_blank"><i class="icon-facebook"></i></a>
							</li>
							<li><a href="<?php echo $getSiteSettingsData['twitter_link'] ?>" target="_blank"><i class="icon-twitter"></i></a>
							</li>
							<li><a href="<?php echo $getSiteSettingsData['gplus_link'] ?>" target="_blank"><i class="icon-google"></i></a>
							</li>
							<li><a href="<?php echo $getSiteSettingsData['inst_link'] ?>" target="_blank"><i class="icon-instagram"></i></a>
							</li>
							<li><a href="<?php echo $getSiteSettingsData['linked_link'] ?>" target="_blank"><i class="icon-linkedin"></i></a>
							</li>
						</ul>
						<p style="text-align:center"><?php echo $getSiteSettingsData['footer_text'];?> : Designed by <a href="https://lanciussolutions.com/" target="_blank"> Lancius IT Solutions</a></p>
					</div>
				</div>
			</div>
			<!-- End row -->
		</div>
		<script>
		//Custom alert 
		modernAlert();
		</script>

<!-- This Script For validations -->
<script type="text/javascript" src="js/check_number_validations.js"></script>