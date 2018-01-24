
<div class="container">

<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>

				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="widget-ft widget-about">
							<div class="logo logo-ft">
								<a href="index.html" title="">
									<img src="images/logos/logo1.png" alt="">
								</a>
							</div><!-- /.logo-ft -->
							<div class="widget-content">
								<div class="icon">
									<img src="images/icons/call.png" alt="">
								</div>
								<div class="info">
									<p class="questions">Got Questions ? Call us 24/7!</p>
									<p class="phone">Call Us: <?php echo $getSiteSettingsData1['contact_number']; ?></p>
									<p class="address">
										<?php echo $getSiteSettingsData1['address']; ?>
									</p>
								</div>
							</div><!-- /.widget-content -->
							<ul class="social-list">
								<li>
									<a href="<?php echo $getSiteSettingsData1['fb_link'] ?>" target="_blank" title="">
											<i class="fa fa-facebook" aria-hidden="true"></i>
										</a>
								</li>
								<li>
									<a href="<?php echo $getSiteSettingsData1['twitter_link'] ?>" target="_blank">
											<i class="fa fa-twitter" aria-hidden="true"></i>
										</a>
								</li>
								<li>
									<a href="<?php echo $getSiteSettingsData1['inst_link'] ?>" target="_blank">
											<i class="fa fa-instagram" aria-hidden="true"></i>
										</a>
								</li>
								<li>
									<a href="<?php echo $getSiteSettingsData1['linkden_link'] ?>" target="_blank">
											<i class="fa fa-linkedin" aria-hidden="true"></i>
										</a>
								</li>
								<li>
									<a href="<?php echo $getSiteSettingsData1['you_tube_link'] ?>" target="_blank" >
											<i class="fa fa-youtube" aria-hidden="true"></i>
										</a>
								</li>
								<li>
									<a href="<?php echo $getSiteSettingsData1['gplus_link'] ?>" target="_blank">
											<i class="fa fa-google" aria-hidden="true"></i>
										</a>
								</li>
							</ul><!-- /.social-list -->
						</div><!-- /.widget-about -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget-ft widget-categories-ft">
							<div class="widget-title">
								<h3>Quick Links</h3>
							</div>
							<ul class="cat-list-ft">
								<li>
									<a href="about.php" title="">About us</a>
								</li>
								<li>
									<a href="products.php" title="">Products</a>
								</li>
								<li>
									<a href="newarraivals.php" title="">New Arraivals</a>
								</li>
								<li>
									<a href="offerzone.php" title="">Offer Products</a>
								</li>
								<li>
									<a href="faq.php" title="">FAQ</a>
								</li>
								<li>
									<a href="contact.php" title="">Contact Us</a>
								</li>
								
							</ul><!-- /.cat-list-ft -->
						</div><!-- /.widget-categories-ft -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget-ft widget-menu">
							<div class="widget-title">
								<h3>Customer Care</h3>
							</div>
							<ul>
								<li>
									<a href="myaccount.php" title="">
										My Account
									</a>
								</li>
								<li>
									<a href="trackorder.php" title="">
										Track Order
									</a>
								</li>
								<!-- <li>
									<a href="faq.php" title="">
										Help Center
									</a>
								</li> -->
								<li>
									<a href="delivery_areas.php" title="">
										Delivery Areas
									</a>
								</li>
								<li>
									<a href="terms_conditions.php" title="">
										Privacy Policy/Terms & Conditions
									</a>
								</li>
								<li>
									<a href="return_policy.php" title="">
										Return Policy
									</a>
								</li>
							<!--	<li>
									<a href="#" title="">
										Terms & Conditions
									</a>
								</li>-->
							</ul>
						</div><!-- /.widget-menu -->
					</div><!-- /.col-lg-2 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget-ft widget-menu">
							<div class="widget-title">
								<h3>Mobile Apps</h3>
							</div>
							<ul class="app-list">
								<li class="app-store">
									<a href="<?php echo $getSiteSettingsData1['apple_app_link'] ?>" target="_blank" title="">
										<div class="img">
											<img src="images/icons/app-store.png" alt="">
										</div>
										<div class="text">
											<h4>App Store</h4>
											<p>Now available on</p>
										</div>
									</a>
								</li><br><br>
								<li class="google-play">
									<a href="<?php echo $getSiteSettingsData1['android_app_link'] ?>" target="_blank" title="">
										<div class="img">
											<img src="images/icons/google-play.png" alt="">
										</div>
										<div class="text">
											<h4>Google Play</h4>
											<p>Get in on</p>
										</div>
									</a>	
								</li><!-- /.google-play -->
							</ul><!-- /.app-list -->
						</div><!-- /.widget-apps -->
					</div><!-- /.col-lg-4 col-md-6 -->
				</div>
			</div><!-- /.container -->
			<?php include "search_js_script.php"; ?>
			<!-- This Script For validations -->
			<script type="text/javascript" src="javascript/check_number_validations.js"></script>