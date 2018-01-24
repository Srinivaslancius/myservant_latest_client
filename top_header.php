<?php
if(isset($_POST['submit'])) {
	$getCities1 = getIndividualDetails('grocery_lkp_cities','city_name',$_POST['city_area']);
	$_SESSION['city_name'] = $_POST['city_area'];
} 
if($_SESSION['city_name'] == '') {
	$_SESSION['city_name'] = 'Vijayawada';
}
?>
<?php $getSiteSettings1 = getAllDataWhere('grocery_site_settings','id','1'); 
$getSiteSettingsData1 = $getSiteSettings1->fetch_assoc(); ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<div class="container">
					<div class="row">
						<div class="col-md-4">
							<ul class="flat-support">
								<li>
									<a href="faq.php" title="">Support</a>
								</li>
								<li>
									<a href="trackorder.php" title="">Track Your Order</a>
								</li>
								<li><a href="javascript:avoid();" class="page-scroll" id="select-city">
               					<?php echo $_SESSION['city_name']; ?> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
								<!--Select City Popup
								=====================-->
								<form method="post">
									<div class="cities" id ="panel">
									  	<div class="city-triangle"></div>
									  	<div class="city-header"></div>
										<input type="text" name="city_area" id="city-area" placeholder="Search Your City">
										<button type="button" class="city-srch-btn"><i class="fa fa-search"></i></button>

										  <div class="city-names">
											<h3>Main Cities</h3>
						                   	<span id="cityloading"></span>
						            		<div id="citiesRead">
						       					<ul class="cityrow1">
						       						<?php 
						       						$getCity = "SELECT * FROM grocery_lkp_cities WHERE lkp_status_id = 0 AND id IN (SELECT lkp_city_id FROM grocery_product_bind_weight_prices WHERE lkp_status_id = 0)";
						       						$getCities = $conn->query($getCity);
						       						while($getCitiesNames = $getCities->fetch_assoc()) { ?>
							    					  <li><a href="javascript:avoid();" rel="83" class="citylink"><?php echo $getCitiesNames['city_name']; ?></a></li>
							    					  <?php } ?>
							 					</ul>
						                    </div>                     
										</div>
										<div class="underline"></div>
										<button type="submit" name="submit" class="submit pull-right" style="margin:10px;background-color:#FE6003">Submit</button>
									</div>
								</form>
								</li>
								 <!--<li><span class="icon-location" data-toggle="popover" data-placement="bottom" data-content="TOP SEARCHED: <br> Vijayawada, Hyderabad, Karimnagar, Chennai, Warangal, Pune, Bangalore" style="cursor:pointer">Vijayawada <i class="fa fa-angle-down" aria-hidden="true"></i></span></li>-->
							</ul><!-- /.flat-support -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4">
							<ul class="flat-infomation">
								<li class="phone">
									Call Us : <a href="Tel:<?php echo $getSiteSettingsData1['contact_number']; ?>" title=""> <?php echo $getSiteSettingsData1['contact_number']; ?></a>
								</li>
							</ul><!-- /.flat-infomation -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-4">
							<ul class="flat-unstyled">
							<!--<li class="locations1">
									<a href="#" title="">Hyderabad<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="unstyled" style="width:250px">
									<center><input type="text" class="form-control"  name="user_full_name"  placeholder="Enter your city"  required style="border-radius:5px;width:200px;height:35px;border:1px solid #ddd"></center>
									<hr>
									<div class="text" style="padding-left:10px;line-height:25px">
									<h4 style="margin-bottom:10px">Top Searched</h4>
									<p>Hyderabad, Kerala, Chennai, tamilnadu, Bagalore, Mysore, Karnataka</p>
									</div>
									</ul>
								</li>-->
								<?php if($_SESSION['user_login_session_id'] =='') { ?>
								<li class="account">
									<a href="#" title="">My Account<i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="unstyled">
										<li>
											<a href="login.php" title="">Login / Register</a>	
										</li>
									</ul><!-- /.unstyled -->
								</li>
								<?php } else { ?>
								<li class="account">
									<a href="#" title=""><?php echo $_SESSION['user_login_session_name']; ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
									
									<ul class="unstyled">										
										
										<li>
											<a href="shop_cart.php" title="">My Cart</a>
										</li>
										<li>
											<a href="my_account.php" title="">My Account</a>
										</li>
										<li>
											<a href="shop_checkout.php" title="">Checkout</a>
										</li>
										<li>
											<a href="logout.php">Logout</a>
										</li>
									</ul><!-- /.unstyled -->
								</li>
								<?php } ?>
								<li>
									<?php $language_name = "SELECT * FROM grocery_languages WHERE lkp_status_id = 0";
									$language_name1 = $conn->query($language_name);
									$language = $language_name1->fetch_assoc() ?>
									<a href="#" title=""><?php echo $language['language_name']; ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
									<ul class="unstyled">
										<?php $getLanguages1 = "SELECT * FROM grocery_languages WHERE lkp_status_id = 0";
										$getLanguages = $conn->query($getLanguages1); ?>
										<?php while($getLanguagesData = $getLanguages->fetch_assoc()) { ?>
										<li>
											<a href="#" title=""><?php echo $getLanguagesData['language_name']; ?></a>
										</li>
										<?php } ?>
									</ul><!-- /.unstyled -->
								</li>
							</ul><!-- /.flat-unstyled -->
						</div><!-- /.col-md-4 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
				<script> 
$(document).ready(function(){
    $("#select-city").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>
				<!--<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({
        html: true,
        template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-body"><div class="form-group"><input type="text" class="form-control1" placeholder="ENTER YOUR CITY" required></div></div><div class="popover-content"></div><div class="popover-footer"><a href="index.php" class="btn btn-info btn-sm">Submit</a></div></div>'
    });
    
    // Custom jQuery to hide popover on click of the close button
    $(document).on("click", ".popover-footer .btn" , function(){
        $(this).parents(".popover").popover('hide');
    });
});
</script>-->