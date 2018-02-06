
<div class="container">

<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>
<?php 
if(isset($_POST['submit'])) {
	$refer_email = $_POST['refer_email'];
	$user_id = $_SESSION['user_login_session_id'];
	$getEmail = getAllDataWhere('users','user_email',$refer_email);
	if($getEmail->num_rows > 0) {
		echo "<script>alert('You Can't refered this Mail');</script>";
	} else {
		$sql = "INSERT INTO grocery_refer_a_friend (`refered_user_id`,`refer_email_id`) VALUES ('$user_id','$refer_email')";
  		$result = $conn->query($sql);
	}
}
?>

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
									<a href="javascript:void(0)" title="" id="myBtn">Refer a friend</a>
								</li>

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
									<?php if($_SESSION['user_login_session_id'] =='') { ?>
										<a href="login.php" title="">
											My Account
										</a>
									<?php } else { ?>
										<a href="my_account.php" title="">
											My Account
										</a>
									<?php } ?>
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
			<script type="text/javascript">
			$(document).ready(function () {      
			    $("#myBtn").click(function(){
			         $('#myModal').modal('show');
			    });
			});
			</script>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			    	<form method="POST">
				        <div class="modal-content">
				            <div class="modal-header">			                
				                 <h4 class="modal-title" id="myModalLabel">Refer a friend</h4>
				            </div>
				            <div class="modal-body">
			            		<input type="email" name="refer_email" placeholder="please enter email" required>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
				            </div>
				        </div>
				    </form>
			    </div>
			</div>			


			<script type="text/javascript">
			function addWishList(productId) {

				//alert(productId);
				var weightType= $('#get_pr_price_'+productId).val();	
				//alert(weightType);
				var split = weightType.split(",");				
				var productWeightType = split[0];			
				//alert(productWeightType);
				$.ajax({
				  type:'post',
				  url:'save_wish_list.php',
				  data:{
				     product_id:productId,productWeightType:productWeightType,       
				  },
				  success:function(data) {
				    if(data == 1) {
				    	alert("Added to your Wishlist");
				    	$('#change_wishlist_img_'+productId).attr('src', "images/icons/1.png");
				    	
				    } else {
				    	alert("Removed from your Wishlist");
				    	$('#change_wishlist_img_'+productId).attr('src', "images/icons/wishlist.png");
				    }
				  }
				});

			}
			function addWishList1(ProductId) {

				//alert(ProductId);
				var weightType= $('#get_pr_price1_'+ProductId).val();	
				//alert(weightType);
				var split = weightType.split(",");				
				var productWeightType = split[0];			
				//alert(productWeightType);
				$.ajax({
				  type:'post',
				  url:'save_wish_list.php',
				  data:{
				     product_id:ProductId,productWeightType:productWeightType,       
				  },
				  success:function(data) {
				    if(data == 1) {
				    	alert("Added to your Wishlist");
				    	$('#change_wishlist_img1_'+ProductId).attr('src', "images/icons/1.png");
				    	
				    } else {
				    	alert("Removed from your Wishlist");
				    	$('#change_wishlist_img1_'+ProductId).attr('src', "images/icons/wishlist.png");
				    }
				  }
				});

			}
			</script>

			<script type="text/javascript" src="javascript/check_number_validations.js"></script>