<?php
if(isset($_POST['submit'])) {
	$getCities1 = getAllDataWhere('grocery_lkp_cities','city_name',$_POST['city_area']);
	if($getCities1->num_rows > 0) {
		$_SESSION['city_name'] = $_POST['city_area'];
	} else {
		$_SESSION['city_name'] = '';
	}
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
						<div class="col-md-3">
							<ul class="flat-support">
								<!-- <li>
									<a href="faq.php" title="">Support</a>
								</li> -->
								<li class="phone">
											Call Us : <a href="Tel:<?php echo $getSiteSettingsData1['contact_number']; ?>" title=""> <?php echo $getSiteSettingsData1['contact_number']; ?></a>
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
						<?php 
                		$getDuration = getIndividualDetails('grocery_manage_time_slots','lkp_status_id',0);
                		$cur_time=date("Y-m-d H:i:00");
						$duration='+'.$getDuration['booking_time_gap'].' minutes';
						$getCurTime = date('H:i:00', strtotime($duration, strtotime($cur_time)));
                		$getTimeSlots = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  AND start_time > '$getCurTime' ";
                		$getTotalTimeSlots = $conn->query($getTimeSlots);
                		$gettotalSlt = $getTotalTimeSlots->num_rows;
                		?>
						<div class="col-md-6">
							<ul class="flat-infomation">
								<div class="row">
									<div class="col-md-6 col-xs-12">
										<a href="#"><p style="margin-top:9px">For above Rs.500 orders delivery free</p></a>
									</div>
									<div class="col-md-6 col-xs-12" style="margin-top:-8px">
									
									<div class="dropdown">
									  <button class="dropbtn" style="border:1px solid #f9f9f9;
										margin-top:12px;">Time Slot : Today - 2:00AM - 3:00PM</button>
									  <div class="dropdown-content">
										<a href="#">Today - 2:00AM - 3:00PM</a>
										<a href="#">Today - 2:00AM - 3:00PM</a>
										<a href="#">Today - 2:00AM - 3:00PM</a>
									  </div>
									</div>
										</div>

									<!--<div class="col-md-7 col-xs-12">
										<li class="time">
											<div class="row">
												<div class="col-md-4 col-xs-4">Time Slot : </div>
												<div class="col-md-8 col-xs-8" class="mrgn_llft" style="margin-left:-25px">
													<?php if($gettotalSlt == 0) {
	                                        			$getTimeSlots1 = "SELECT * FROM grocery_manage_time_slots WHERE lkp_status_id = 0  ";
	                                        			$getTotalTimeSlots1 = $conn->query($getTimeSlots1);
	                                        		?>
													<select style="border:0px;height:35px;padding:0px">
														<?php while($row1 = $getTotalTimeSlots1->fetch_assoc()) { ?>
															<option value="<?php echo $row1['total_slot_time']; ?>">Tomorrow - <?php echo $row1['total_slot_time']; ?></option>
														<?php } ?>
													</select>
													<?php } else { ?>
													<select style="border:0px;height:35px;padding:0px">
														<?php while($row = $getTotalTimeSlots->fetch_assoc()) { ?>
															<option value="<?php echo $row['total_slot_time']; ?>">Today - <?php echo $row['total_slot_time']; ?></option>
														<?php } ?>
													</select>
			                                    	<?php } ?>
												</div>
											</div>
										</li>

									</div>-->
								
							</ul><!-- /.flat-infomation -->
						</div><!-- /.col-md-4 -->
						<div class="col-md-3">
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
								<?php } else { 
									$getUserName = getIndividualDetails('users','id',$_SESSION['user_login_session_id']); ?>
								<li class="account">
									<a href="#" title=""><?php echo $getUserName['user_full_name'] ; ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
									
									<ul class="unstyled">										
										
										<li>
											<a href="shop_cart.php" title="">My Cart</a>
										</li>
										<li>
											<a href="my_account.php" title="">My Account</a>
										</li>
										<!-- <li>
											<a href="shop_checkout.php" title="">Checkout</a>
										</li> -->
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