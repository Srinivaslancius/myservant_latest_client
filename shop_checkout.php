<?php include_once 'meta.php';?>
<style>
#options_2 label {
    font-size: 12px;
    padding-top: 5px;
}
::-ms-clear {
	  display: none;
	}

	.form-control-clear {
	  z-index: 10;
	  pointer-events: auto;
	  cursor: pointer;
	}
	.close-icon {
	border:1px solid transparent;
	/*background-color: transparent;*/
	display: inline-block;
	vertical-align: middle;
  outline: 0;
  cursor: pointer;
}
.close-icon:after {
	content: "X";
	display: block;
	width: 15px;
	height: 15px;
	position: absolute;
	/*background-color: #FA9595;*/
	z-index:1;
	right: 0px;
	top: 0px;
	bottom: 50px;
	margin: auto;
	padding: 2px;
	/*border-radius: 50%;*/
	text-align: center;
	color: black;
	font-weight: normal;
	font-size: 12px;
	/*box-shadow: 0 0 2px #E50F0F;*/
	cursor: pointer;
}
.form-control-feedback {
    position:absolute;
    top: 0;
    right: 0;
    z-index: 2;
    display: block;
    width: 34px;
    height: 54px;
    line-height: 50px;
    text-align: center;
    pointer-events: auto;
	 cursor: pointer;
}
.form-control:focus {
	box-shadow: 0 0 15px 5px #b0e0ee;
	border: 2px solid #bebede;
}
.order{
	background-color:#fe6003 !important;
	color:white !important;
}
th,td{
	border-bottom:1px solid #ddd;
	
}
</style>
<body class="header_sticky">
	<div class="boxed">

		<div class="overlay"></div>

		
		<section id="header" class="header">
			<div class="header-top">
			<?php include_once 'top_header.php';?>
			</div><!-- /.header-top -->
			<div class="header-middle">
			<?php include_once 'middle_header.php';?>
			</div><!-- /.header-middle -->
			<div class="header-bottom">
			<?php include_once 'bottom_header.php';?>
			</div><!-- /.header-bottom -->
		</section><!-- /#header -->
		<section class="flat-breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumbs">
							<li class="trail-item">
								<a href="<?php echo $base_url; ?>" title="">Home</a>
								<span><img src="images/icons/arrow-right.png" alt=""></span>
							</li>
							<li class="trail-item">
								<a href="#" title="">Shop_checkout</a>
								
							</li>
							
						</ul><!-- /.breacrumbs -->
					</div><!-- /.col-md-12 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-breadcrumb -->

		<?php
		if($_SESSION['user_login_session_id'] == '') {
		    header ("Location: logout.php");
		} 
		?>
		<?php 
		$id = $_SESSION['user_login_session_id'];
		$customer_id = $_GET['adid'];
		$getCustomerDeatils = getIndividualDetails('grocery_add_address','id',$customer_id);
		$getState = getIndividualDetails('grocery_lkp_states','id',$getCustomerDeatils['lkp_state_id']);
		$getDistrict = getIndividualDetails('grocery_lkp_districts','id',$getCustomerDeatils['lkp_district_id']);
		$getPincode = getIndividualDetails('grocery_lkp_pincodes','id',$getCustomerDeatils['lkp_pincode_id']);
		$getCity = getIndividualDetails('grocery_lkp_cities','id',$getCustomerDeatils['lkp_city_id']);
		$getArea = getIndividualDetails('grocery_lkp_areas','id',$getCustomerDeatils['lkp_location_id']);
		$getAllPaymentsSettings = getIndividualDetails('grocery_payments_settings','id','1');
		?>
		<section class="flat-checkout">
			<form method="post" accept-charset="utf-8" action="save_checkout.php">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="box-checkout">
								<div class="billing-fields">
									<input type="hidden" name="lkp_state_id" value="<?php echo $getCustomerDeatils['lkp_state_id']; ?>">
									<input type="hidden" name="lkp_district_id" value="<?php echo $getCustomerDeatils['lkp_district_id']; ?>">
									<input type="hidden" name="lkp_pincode_id" value="<?php echo $getCustomerDeatils['lkp_pincode_id']; ?>">
									<input type="hidden" name="lkp_city_id" value="<?php echo $getCustomerDeatils['lkp_city_id']; ?>">
									<input type="hidden" name="lkp_area_id" value="<?php echo $getCustomerDeatils['lkp_location_id']; ?>">
									<input type="hidden" name="lkp_sub_area_id" value="<?php echo $getCustomerDeatils['lkp_sub_location_id']; ?>">
									<div class="fields-title">
										<h3>Billing details</h3>
										<span></span>
										<div class="clearfix"></div>
									</div><!-- /.fields-title -->
									<div class="fields-content">
										<div class="field-row">
											<p class="field-one-half">
												<label for="first-name">First Name *</label>
												<input type="text" id="first-name" class="form-control" name="first_name" placeholder="First name" value="<?php echo $getCustomerDeatils['first_name']; ?>" readonly>
											</p>
											<p class="field-one-half">
												<label for="last-name">Last Name *</label>
												<input type="text" id="last-name" class="form-control" name="last_name" placeholder="Last name" value="<?php echo $getCustomerDeatils['last_name']; ?>" readonly>
											</p>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label for="email-address">Email Address *</label>
												<input type="email" id="email-address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="email" class="form-control" value="<?php echo $getCustomerDeatils['email']; ?>" placeholder="Your email" readonly>
											</p>
											<p class="field-one-half">
												<label for="phone">Phone *</label>
												<input type="text" id="phone" name="mobile" maxlength="10" pattern="[0-9]{10}" value="<?php echo $getCustomerDeatils['phone']; ?>" class="form-control valid_mobile_num" placeholder="Telephone/mobile" readonly>
											</p>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label>State *</label>
												<input type="text" class="form-control" id="lkp_state_id" placeholder="State" readonly value="<?php echo $getState['state_name']; ?>" >
											</p>
											<p class="field-one-half">
												<label>District *</label>
												<input type="text" class="form-control" id="lkp_district_id" placeholder="District" value="<?php echo $getDistrict['district_name']; ?>" readonly>
											</p>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label>City *</label>
												<input type="text" class="form-control" id="lkp_city_id" placeholder="City" value="<?php echo $getCity['city_name']; ?>" readonly>
											</p>
											<p class="field-one-half">
												<label>Pincode *</label>
												<input type="text" class="form-control" id="lkp_pincode_id" placeholder="Zip / Postal Code" value="<?php echo $getPincode['pincode']; ?>" readonly>
											</p>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<p class="field-one-half">
												<label>Location *</label>
												<input type="text" class="form-control" id="lkp_area_id" placeholder="Location" value="<?php echo $getArea['area_name']; ?>" readonly>
											</p>
											<?php 
											if($getCustomerDeatils['lkp_sub_location_id'] != 0) {
											$getsubArea = getIndividualDetails('grocery_lkp_sub_areas','id',$getCustomerDeatils['lkp_sub_location_id']); ?>
											<p class="field-one-half">
												<label>Sub Location</label>
												<input type="text" class="form-control" id="lkp_area_id" placeholder="Location" value="<?php echo $getsubArea['sub_area_name']; ?>" readonly>
											</p>
											<?php } ?>
											<div class="clearfix"></div>
										</div>
										<div class="field-row">
											<label for="address">Address *</label>
											<input type="text" class="form-control" id="address" name="address" placeholder="Street address" value="<?php echo $getCustomerDeatils['address']; ?>" readonly>
										</div>
										<div class="field-row">
											<label for="address">Order Note</label>
											<textarea style="height:150px" placeholder="Order Note...." name="order_note" id="order_note"></textarea>
										</div>
										<!-- <div class="checkbox">
											<input type="checkbox" id="create-account" name="create-account" checked>
											<label for="create-account">Create an account?</label>
										</div> -->
									</div><!-- /.fields-content -->
								</div><!-- /.billing-fields -->
							</div><!-- /.box-checkout -->
						</div><!-- /.col-md-7 -->
						<?php
						    if($_SESSION['CART_TEMP_RANDOM'] == "") {
						        $_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
						    }
						    $session_cart_id = $_SESSION['CART_TEMP_RANDOM'];
						    if(isset($_SESSION['user_login_session_id']) && $_SESSION['user_login_session_id']!='') {
						        $user_session_id = $_SESSION['user_login_session_id'];
						        $cartItems1 = "SELECT * FROM grocery_cart WHERE (user_id = '$user_session_id' OR session_cart_id='$session_cart_id') AND product_quantity!='0'";
						        $cartItems = $conn->query($cartItems1);
						    } else {
						      $cartItems1 = "SELECT * FROM grocery_cart WHERE  product_quantity!='0' AND session_cart_id='$session_cart_id' ";
						      $cartItems = $conn->query($cartItems1);
						    } 
						?>
						<div class="col-md-6">
							<div class="cart-totals style2">						
								<center><h3 style="color:#f28b00">Your Order Summary</h3></center>
								<!--<?php $getWalletAmount = getIndividualDetails('user_wallet','user_id',$_SESSION['user_login_session_id']); 
								?>
								<input type="hidden" name="wallet_amount" id="wallet_amount" value="<?php echo $getWalletAmount['amount']; ?>">
								<?php if($getWalletAmount['amount'] > 0) { ?>
								<div class="btn-radio style2">
									<div class="radio-info">
										<input type="radio" class="radio-button" id="wallet_id" name="walletid" value="1" checked>
										<label for="wallet_id">Wallet</label>
									</div>
								</div>
								<?php } ?>-->
									<table class="product">
										<thead>
											<tr>
												<th>Product</th>
												<th>QUANTITY</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$cartTotal = 0; $reward_points = 0;
												while ($getCartItems = $cartItems->fetch_assoc()) { 
												$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$getCartItems['product_id']);
												$cartTotal += $getCartItems['product_price']*$getCartItems['product_quantity'];
												$getProductName = getIndividualDetails('grocery_product_name_bind_languages','product_id',$getCartItems['product_id']);
												$reward_points += $getCartItems['reward_points']*$getCartItems['product_quantity'];
												$product_reward_points = $getCartItems['reward_points']*$getCartItems['product_quantity'];
											?>
											<input type="hidden" name='category_id[]' type='text' value='<?php echo $getCartItems['category_id'];?>'>
											<input type="hidden" name='sub_cat_id[]' type='text' value='<?php echo $getCartItems['sub_category_id'];?>'>
											<input type="hidden" name='product_id[]' type='text' value='<?php echo $getCartItems['product_id'];?>'>
											<input type="hidden" name='product_weight[]' type='text' value='<?php echo $getCartItems['product_weight_type'];?>'>
											<input type="hidden" name='product_quantity[]' type='text' value='<?php echo $getCartItems['product_quantity'];?>'>
											<input type="hidden" name='product_reward_points[]' type='text' value='<?php echo $product_reward_points;?>'>
											<tr>
												<td><?php echo $getProductName['product_name']; ?></td>
												<input type="hidden" name="product_name" value="<?php echo $getProductName['product_name']; ?>">
												<input type="hidden" name="product_price[]" value="<?php echo $getCartItems['product_price']; ?>">
												<input type="hidden" name="sub_total" value="<?php echo $cartTotal; ?>">
												<td> <?php echo $getCartItems['product_quantity']; ?></td>						
												<td>Rs . <?php echo $getCartItems['product_price'] ?></td>
											</tr>
											<?php } ?>									
										</tbody>
									</table><!-- /.product -->
									
									<?php 
									$service_tax += ($getSiteSettingsData1['service_tax']/100)*$cartTotal;
									if($getAllPaymentsSettings['delivery'] == 1 && $cartTotal <= $getAllPaymentsSettings['order_amount']) {
										$delivery_charges = $getAllPaymentsSettings['delivery_charges'];
									} else {
										$delivery_charges = 0;
									}
									$orderTotalwithoutWallet = round($cartTotal+$service_tax+$delivery_charges);
									?>
									<input type="hidden" id="order_total" name="order_total" value="<?php echo $orderTotalwithoutWallet; ?>">
									<input type="hidden" name="orderTotalwithoutWallet" value="<?php echo $orderTotalwithoutWallet; ?>">
									<input type="hidden" name="service_tax" value="<?php echo $service_tax; ?>" id="service_tax">
									<input type="hidden" name="delivery_charges" value="<?php echo $delivery_charges; ?>" id="delivery_charges">
									<input type="hidden" name="delivery_slot_date" value="<?php echo $_REQUEST['slot_date']; ?>">
									<input type="hidden" name="delivery_time" value="<?php echo $_REQUEST['slot_timings']; ?>">
									<input type="hidden" name="discount_money" value="0" id="discount_money">
									<input type="hidden" name="coupon_code_type" value="" id="coupon_code_type">
									<input type="hidden" name="coupon_id" value="" id="coupon_id">
									<input type="hidden" name="coupon_device_type" value="" id="coupon_device_type">
									<input type="hidden" name="reward_points" value="<?php echo round($reward_points); ?>">
									<table>
										<tbody>	
											<tr>
	                                            <td>Sub Total</td>
	                                            <td class="subtotal" id="serviceTax1">Rs . <?php echo $cartTotal; ?></td>
	                                        </tr>
											<tr>
	                                            <td>GST(<?php echo $getSiteSettingsData1['service_tax']; ?>%)</td>
	                                            <td class="subtotal" id="serviceTax1">Rs . <?php echo $service_tax; ?></td>
	                                        </tr>
	                                        <?php if($getAllPaymentsSettings['delivery'] == 1 && $cartTotal <= $getAllPaymentsSettings['order_amount']) { ?>
	                                        <tr>
	                                            <td>Delivery Charges</td>
	                                            <td class="subtotal">Rs . <?php echo $getAllPaymentsSettings['delivery_charges']; ?></td>
	                                        </tr>
	                                        <?php } ?>
	                                        <tr>
	                                            <td>Delivery Date</td>
	                                            <td class="subtotal" id="serviceTax1"><?php echo changeDateFormat($_REQUEST['slot_date']); ?></td>
	                                        </tr>
	                                        <tr>
	                                            <td>Delivery Slot</td>
	                                            <td class="subtotal" id="serviceTax1"><?php echo $_REQUEST['slot_timings']; ?></td>
	                                        </tr>
	                                        <tr>
												<td>Order Total</td>
												<td class="subtotal">Rs . <?php echo $orderTotalwithoutWallet; ?></td>
											</tr>
	                                        <tr id="wallet">
	                                            <td>Money in Your Wallet</td>
	                                            <td class="subtotal">Rs . <?php echo $getWalletAmount['amount']; ?></td>
	                                        </tr>
	                                        <tr id="discount_price">
								                <td>Discount<span style="color:green">(Coupon Applied.)</td> 
								                <td><span id="discount_price1" class="pull-right"></span></td>
								            </tr>
								            <tr>
												<td><b>TOTAL</b></td>
												<td class="price-total"><b>Rs . <?php echo round($orderTotalwithoutWallet); ?></b></td>
											</tr>
											
											<?php
											$getRewardPointsdata = getIndividualDetails('grocery_reward_points','id',1);
											//If reward status is yes
											if($getRewardPointsdata['reward_status'] == 0) { ?>
												<tr>
													<td colspan="2" style="text-align:left;border-bottom:0px">You will be awarded <b><?php echo round($reward_points); ?> points</b>.</td>
												</tr>
											<?php } ?>
											
										</tbody>
									</table>

									<?php $getWalletAmount = getIndividualDetails('user_wallet','user_id',$_SESSION['user_login_session_id']);
									?>
									<input type="hidden" name="wallet_amount" id="wallet_amount" value="<?php echo $getWalletAmount['amount']; ?>">
									<?php if($getWalletAmount['amount'] > 0) { ?>
									<label class="containerw"> Wallet
									  <input type="checkbox" class="wallet_check" value="1" name="walletid">
									  <span class="checkmarkw"></span>
									</label>
									<?php } ?>
									
										<div class="form-group coupon">
											<div class="row">
												<div class="col-md-8 col-sm-8 col-xs-8">
													<div class="field-group has-feedback has-clear twof" style="width:118%;margin-top:4px">
								      					<input autocomplete="off" type="text" name="coupon_code" value="" placeholder="Coupon Code" class="form-control pad_wdth" id="coupon_code" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;text-transform:uppercase">
								      					<button class="form-control-clear close-icon form-control-feedback hidden" type="reset"></button>
								    				</div>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-4">
													<div class="field-group btn-field">
														<button type="button" class="button1 bdr_rds btn_cart_outine apply_coupon" style="padding:0px 20px;border-top-left-radius: 0px;border-bottom-left-radius: 0px">Apply</button>
													</div>
												</div>
											</div>
											<div class="row">
												<span id="coupon_status" style="color: red;"></span>
											</div>
										</div>
										<h3 style="text-align:center;color:#fe6003">Payment Method</h3>
										<?php if($getAllPaymentsSettings['cash_on_delivery'] == 1) { ?>
											<label class="containerw">COD
											  <input type="radio" name="pay_mn" value="1" required>
											  <span class="checkmarkw"></span>
											</label>
										<?php } ?>

										<?php if($getAllPaymentsSettings['pay_u_payments'] == 1) { ?>
											<label class="containerw">PayUmoney
											  <input type="radio" name="pay_mn" value="2" required>
											  <span class="checkmarkw"></span>
											</label>
										<?php } ?>

										<?php if($getAllPaymentsSettings['hdfc_payments'] == 1) { ?>
											<label class="containerw">HDFC
											  <input type="radio" name="pay_mn" value="3" required>
											  <span class="checkmarkw"></span>
											</label>
										<?php } ?>

										<?php if($getAllPaymentsSettings['paytm_payments'] == 1) { ?>
											<label class="containerw"><img src="images/product/paytm1.png"><b>(Debit Card/Credit Card/NB/UPI/Wallet)</b>
											  <input type="radio" name="pay_mn" value="4" required>
											  <span class="checkmarkw"></span>
											</label>
										<?php } ?>
									
									<div class="checkbox">
										<input type="checkbox" id="checked-order" name="checked-order" checked required>
										<label for="checked-order">I’ve read and accept the terms & conditions *</label>
									</div><!-- /.checkbox -->
									<div class="btn-order">									
										<input type="submit" name="submit" value="Place Order" class="order">
									</div><!-- /.btn-order -->
							</div><!-- /.cart-totals style2 -->
						</div><!-- /.col-md-5 -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</form>
		</section><!-- /.flat-checkout -->

		<section class="flat-row flat-iconbox style5">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/car.png" alt="">
								</div>
								<div class="box-title">
									<h3>Free Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/order.png" alt="">
								</div>
								<div class="box-title">
									<h3>Order Online Service</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/payment.png" alt="">
								</div>
								<div class="box-title">
									<h3>Payment</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
					<div class="col-lg-3 col-md-6">
						<div class="iconbox style1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/return.png" alt="">
								</div>
								<div class="box-title">
									<h3>Return 30 Days</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-lg-3 col-md-6 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</section><!-- /.flat-iconbox -->
		<footer>
			<?php include_once 'footer.php';?>
		</footer><!-- /footer -->

		<section class="footer-bottom">
			<?php include_once 'footer_bottom.php';?>
		</section><!-- /.footer-bottom -->

	</div><!-- /.boxed -->

		<!-- Javascript -->
		<script type="text/javascript" src="javascript/jquery.min.js"></script>
		<script type="text/javascript" src="javascript/tether.min.js"></script>
		<script type="text/javascript" src="javascript/bootstrap.min.js"></script>
		<script type="text/javascript" src="javascript/waypoints.min.js"></script>
		<script type="text/javascript" src="javascript/jquery.circlechart.js"></script>
		<script type="text/javascript" src="javascript/easing.js"></script>
		<script type="text/javascript" src="javascript/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="javascript/owl.carousel.js"></script>
		<script type="text/javascript" src="javascript/smoothscroll.js"></script>
		<script type="text/javascript" src="javascript/jquery-ui.js"></script>
		<script type="text/javascript" src="javascript/jquery.mCustomScrollbar.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
	   	<script type="text/javascript" src="javascript/gmap3.min.js"></script>
	   	<script type="text/javascript" src="javascript/waves.min.js"></script>
		<script type="text/javascript" src="javascript/jquery.countdown.js"></script>

		<script type="text/javascript" src="javascript/main.js"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				if($('#order_total').val() == 0){
			    	$('.coupon,#discount_price').hide();
			    }
			});
		</script>
		<script type="text/javascript">
			$("#wallet").hide();
		    var totalWithoutWallet = $('#order_total').val();
		    var wallet_amount = $('#wallet_amount').val();
		    $(".wallet_check").click(function() {
		    	var discount_amount = $('#discount_money').val();
			    if($(this).is(":checked")) {
			        $("#wallet").show();
			        if(parseInt(wallet_amount) > parseInt($('#order_total').val())) {
			        	$('.price-total').html("Rs. "+0);
			    		$('#order_total').val(0);
			        } else {
			        	$('.price-total').html("Rs. "+Math.round((totalWithoutWallet-wallet_amount-discount_amount)));
			    		$('#order_total').val(Math.round(totalWithoutWallet-wallet_amount-discount_amount));
			        }
			    } else {
			        $("#wallet").hide();
			    	if(totalWithoutWallet == 0) {
				    	$('.coupon,#discount_price').hide();
				    	$('#discount_money').val('');
				    	$('.price-total').html("Rs. "+totalWithoutWallet);
			    		$('#order_total').val(totalWithoutWallet);
				    } else {
				    	$('.coupon').show();
				    	$('.price-total').html("Rs. "+Math.round((totalWithoutWallet-discount_amount)));
			    		$('#order_total').val(Math.round(totalWithoutWallet-discount_amount));
				    }
			    }
			});
		    </script>

			<script type="text/javascript">
			$('#discount_price').hide();
			$('.close-icon').hide();
			    $(".apply_coupon").click(function(){
			        var coupon_code = $("#coupon_code").val();
			        var order_total = $('#order_total').val();
			        $.ajax({
			           type: "POST",
			           url: "apply_coupon.php",
			           data: "coupon_code="+coupon_code+"&cart_total="+order_total,
			           success: function(value){
			           	//alert(value);
			           		if(value == 0) {
			           			$('#coupon_status').html("<span>Please Enter Valid Coupon.</span>");
			           			//alert('Please Enter Valid Coupon');
			           			$("#coupon_code,#coupon_id,#coupon_device_type").val('');
			           		} else if(value == 1) {
			           			$('#coupon_status').html("<span>Enter Coupon is not valid for this Service.</span>");
			           			//alert('Enter Coupon is not valid for this Service');
			           			$("#coupon_code,#coupon_id,#coupon_device_type").val('');
			           		} else if(value == 2) {
			           			$('#coupon_status').html("<span>Already Used.</span>");
			           			//alert('Enter Coupon is not valid for this Service');
			           			$("#coupon_code,#coupon_id,#coupon_device_type").val('');
			           		} else{
			           			$('#coupon_status').html("");
			           			$('#coupon_code').attr('readonly','true');
			           			$(".apply_coupon").hide();
			           			var data = value.split(",");
				          		$('.price-total').html("Rs. "+Math.round(data[0]));
					            $('#order_total').val(Math.round(data[0]));
			               		$('#discount_price').show();
			               		$('.close-icon').show();
			               		$('#discount_price1').html("Rs. "+data[1]);
			               		$('#discount_money').val(data[2]);
			               		$('#coupon_code_type').val(data[3]);
			               		$('#coupon_id').val(data[4]);
			               		$('#coupon_device_type').val(data[5]);
			               	}
			        	}
			        });

			        $('.has-clear input[type="text"]').on('input propertychange', function() {            	
					  var $this = $(this);
					  var visible = Boolean($this.val());
					  $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
					}).trigger('propertychange');

					$('.form-control-clear').click(function() {
						$('#coupon_code').removeAttr("readonly");
					    $(this).siblings('input[type="text"]').val('').trigger('propertychange').focus();
					    $(".apply_coupon").show();
					    $('.price-total').html("Rs. "+order_total);
						$('#order_total').val(order_total);
						$('#discount_price').hide();
						$('.close-icon').hide();
						$('#discount_money,#coupon_code_type,#coupon_id,#coupon_device_type').val('');
					});	
				});
			</script>
			<?php include "search_js_script.php"; ?>
</body>	
</html>