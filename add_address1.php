<?php include_once 'meta.php';?>
<style>
.order-tracking{
	padding: 48px 50px 116px;
	text-align:left;
}
.text_brdr{
	text-align:left;
	border:1px solid #ddd;
	width:100%;
	height: auto;
	padding:20px;
	margin-bottom:20px;
}
.text_brdr h4{
	font-size:14px;
	
}
.text_brdr span{
	padding-left:10px;
}
.button1{
	margin-top:15px;
	padding:0px 20px;
}

</style>
<body class="header_sticky" onload="getDateTime()">
	<div class="boxed">

		<div class="overlay"></div>

		<!-- Preloader -->
		<div class="preloader">
			<div class="clear-loading loading-effect-2">
				// <span></span>
			</div>
		</div><!-- /.preloader -->
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
		

		

		<section class="flat-tracking">
			<div class="container-fluid">
			<form action="shop_checkout.php" method="post" accept-charset="utf-8">
				<div class="row">
				
					<div class="col-lg-8">
						<div class="order-tracking">
							<div class="title">
								<center><h2>My Addresses</h2></center>
								
							</div><!-- /.title --><br>
							<div class="tracking-content">
								<div class="row one">
								  <div class="col-sm-3">
								  </div>
								  <div class="col-sm-6">
									<center><img src="images/myaddress.png">
									<h4>No Addresses found in your account!</h4>
									<p>Add a delivery address.</p>
									<button class="button1">ADD ADDRESS</button></center>
									</div>
									<div class="col-sm-3">
								  </div>
								</div>
							<div class="two">
								<div class="text_brdr">
								<label class="container3">
								  <input type="radio" checked="checked" name="radio">Work
								  <span class="checkmarkR1"></span>
								</label>
								<p><b>Swapna <span> 9876543210</span></b></p>
								<p>Flat No:403, 4th Floor, V.R. Sunshine Building, Patrika Nagar Street NO:3, Near Maxcure Hospital, Madhapur, 500081.</p>
								</div>
								<div class="text_brdr">
								<label class="container3">
									  <input type="radio" checked="checked" name="radio">Home
									  <span class="checkmarkR1"></span>
									</label>
								<p><b>Swapna <span> 9876543210</span></b></p>
								<p>Flat No:403, 4th Floor, V.R. Sunshine Building, Patrika Nagar Street NO:3, Near Maxcure Hospital, Madhapur, 500081.</p>
								</div>
								<center><button class="button1">ADD NEW ADDRESS</button></center>							
							</div>
							<div class="three">
							<form method="post">
						 
						  <div class="row">
						  <div class="col-sm-6">
							<div class="form-group">
								<label for="first-name">Name*</label>
								<input type="text" class="form-control"  name="user_full_name" placeholder="Name" required>
							</div>
							</div>
							 <div class="col-sm-6">
							<div class="form-group">
								<label for="mobile">Mobile*</label>
								<input type="text" class="form-control valid_mobile_num" name="user_mobile" placeholder="Mobile"required>
							<span id="input_status1" style="color: red;"></span>
							</div>
							</div>
							 <div class="col-sm-6">
							<div class="form-group">
								<label for="pincode">Pincode*</label>
								<input type="text" class="form-control"  name="user_full_name" placeholder="Pincode" required>
							</div>
							</div>
							 <div class="col-sm-6">
								<div class="form-group">
								<label for="locality">Locality*</label>
								<input type="text" class="form-control"  name="user_full_name" placeholder="Locality" required>
							</div>
							</div>
							 <div class="col-sm-12">
							<div class="form-group">
								 <label for="address">Address*</label>
									<textarea class="form-control" rows="5" id="comment"  placeholder="Address"style="border-radius:30px;height:48px;padding:10px 0px 0px 20px"></textarea>
							</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label for="City/District/Town">City/District/Town*</label>
								<input type="text" class="form-control"  name="user_full_name" placeholder="locality" required>
							</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label for="sel1">Select State*</label>
							  <select class="form-control" id="sel1" style="border-radius:30px">
								<option>Select State</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							  </select></label>
							</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label for="Landmark">Landmark*</label>
								<input type="text" class="form-control"  name="user_full_name" placeholder="Landmark" required>
							</div>
							</div>
							 <div class="col-sm-6">
							<div class="form-group">
								<label for="mobile">Alternate Mobile</label>
								<input type="text" class="form-control valid_mobile_num" name="user_mobile" placeholder="Alternate Mobile"required>
							<span id="input_status1" style="color: red;"></span>
							</div>
							</div>
							</div>
							
							<div class="form-group">
								<button class="button1" type="submit" name="save" style="width:100px;font-size:18px">Save</button> 					
							</div>                    
						  </form>   
						</div>		  
         	
							</div><!-- /.tracking-content -->
						</div><!-- /.order-tracking -->
					</div><!-- /.col-md-12 -->
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
					$cartTotal = 0;
					while ($getCartItems = $cartItems->fetch_assoc()) { 
						$getProductImage = getIndividualDetails('grocery_product_bind_images','product_id',$getCartItems['product_id']);
						$cartTotal = $getCartItems['product_price']*$getCartItems['product_quantity'];
						$subTotal += $getCartItems['product_price']*$getCartItems['product_quantity'];
					}
					?>
                    <div class="col-lg-4">
                        <div class="cart-totals">
                            <h3>Cart Totals</h3>
                            
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td class="subtotal" id="subtotal">Rs . <?php echo $subTotal; ?></td>
                                        </tr>
                                        <tr>
                                            <td>GST(<?php echo $getSiteSettingsData1['service_tax']; ?>%)</td>
                                            <?php $service_tax += ($getSiteSettingsData1['service_tax']/100)*$subTotal; ?>
                                            <td class="subtotal" id="serviceTax1">Rs . <?php echo $service_tax; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Charges</td>
                                            <td class="subtotal">Rs . <?php echo $getSiteSettingsData1['delivery_charges']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class="price-total" id="ordertotal">Rs. <?php echo round($subTotal+$service_tax+$getSiteSettingsData1['delivery_charges']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-cart-totals">
                                    <center><button type="submit" class="checkout" title="" style="background-color: #fe6003;width:100%">Next</button></center>
                                </div><!-- /.btn-cart-totals -->
                            
                        </div><!-- /.cart-totals -->
                    </div>
				</div><!-- /.row -->
				</form><!-- /form -->
			</div><!-- /.container -->
		</section><!-- /.flat-tracking -->

		<section class="flat-row flat-iconbox style1 background">
			<div class="container">
				<div class="row">
                                    
					<div class="col-md-3">
						<div class="iconbox style1 v1">
							<div class="box-header">
								<div class="image">
									<img src="images/icons/car.png" alt="">
								</div>
								<div class="box-title">
									<h3>Worldwide Shipping</h3>
								</div>
								<div class="clearfix"></div>
							</div><!-- /.box-header -->
						</div><!-- /.iconbox -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
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
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
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
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="iconbox style1 v1">
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
					</div><!-- /.col-md-3 -->
                                    
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
<script type="text/javascript" src="javascript/jquery.zoom.min.js"></script>
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
		<script>
$(document).ready(function(){
	 $(".two,.three").hide();
    $(".one").click(function(){
        $(".one,.three").hide();
		$(".two").show();
    });
	$(".two").click(function(){
        $(".two,.one").hide();
		$(".three").show();
    });
});
</script>
</body>	
</html>